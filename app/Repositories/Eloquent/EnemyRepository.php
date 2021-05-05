<?php

namespace App\Repositories\Eloquent;

use App\Models\Enemy;
use App\Http\Requests\EnemyRequest;
use App\Repositories\Contracts\EnemyRepositoryInterface;

class EnemyRepository extends AbstractRepository implements EnemyRepositoryInterface
{

    public function __construct(Enemy $model){
        parent::__construct($model);
    }

    public function getAllEnemies()
    {
        try{
            $enemies = $this->model->with('photos')->paginate(200);
            return $this->success("Enemies found", $enemies);
        }catch(Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function createEnemy(EnemyRequest $request)
    {
        $data = $request->all();

        $images = $request->file('images');
        try{
            $enemyExist = $this->model->where('name', '=', $request->name)->first();
            if($enemyExist){
                return $this->error("Enemy already exists in the database", 200);
            }
            $enemy = $this->model->create($data);

            if($images){
                $imagesUpload = [];
                foreach($images as $keys => $image){
                    $path = $image->store('images', 'public');
                    $imagesUpload[] = ['photo' => $path, 'position' => $keys];
                }
                $enemy->photos()->createMany($imagesUpload);
            }
            return $this->success("Enemy successfully registered",
                $enemy, 201);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function updateEnemy(EnemyRequest $request, $id)
    {
        $data = $request->all();
        $images = $request->get('images');

        try{
            $enemy = $this->model->find($id);
            if(!$enemy){
                return $this->error("Enemy not found", 404);
            }
            $enemy->update($data);

            if($images){
                $imagesUpload = [];
                foreach($images as $keys => $image){
                    $path = $image->store('images', 'public');
                    $imagesUpload[] = ['photo' => $path, 'position' => $keys];
                    $photo = $enemy->photos()->where('position', $keys)->get();

                    if($photos) {
                        $this->destroyPhoto($photos);

                        $enemy->photos()->where('position', $keys)->delete();
                    }
                }
                $enemy->photos()->createMany($imagesUpload);
            }
            return $this->success("Enemy sucessfully updated", $enemy, 200);
        }catch (Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }

    }

    public function deleteEnemy($id)
    {
        try{
            $enemy = $this->model->find($id);

            if(!$enemy){
                return $this->error("Enemy does not exist", 404);
            }
            $photos = $enemy->photos()->get();
            if($photos){
                $this->destroyPhoto($photos);
                $enemy->photos()->delete();
            }

            $enemy->delete();
            return $this->success("Enemy successfully removed", $enemy);
        }catch(Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }

    }

    public function getEnemyById($id)
    {
        try{
            $enemy = $this->model->with('photos')->find($id);
            if(!$enemy) {
                return $this->error("Enemy not found", 404);
            }
            return $this->success("Enemy found", $enemy);
        }catch (Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    private function destroyPhoto($photos){
        foreach($photos as $photo){
            if(Storage::disk('public')->exists($photo->photo))
                Storage::disk('public')->delete($photo->photo);
        }
    }

}
