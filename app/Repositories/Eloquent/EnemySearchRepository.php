<?php

namespace App\Repositories\Eloquent;

use App\Models\Enemy;
use App\Repositories\Contracts\EnemySearchRepositoryInterface;
use App\Http\Resources\EnemyResource;
use App\Http\Resources\EnemyCollection;
use Exception;

class EnemySearchRepository extends AbstractRepository implements EnemySearchRepositoryInterface
{

    public function __construct(Enemy $model)
    {
        parent::__construct($model);
    }


    public function getAllEnemies()
    {
        try {
            $enemies = $this->model->paginate(200);

            $enemies = EnemyResource::collection($enemies)->hide([
                'id',
                'slug',
                'description',
                'created_at',
                'updated_at',
                'affiliation',
                'rank',
                'level'
                ]);
            return $this->success("All enemies", $enemies);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getEnemyBySlug($slug)
    {
        try {
            $enemy = $this->model->where('slug', $slug)
                ->with('photos')
                ->first();
            if (!$enemy) {
                return $this->error("Enemy not found", 404);
            }

            $enemy = (new EnemyResource($enemy))->hide(['id', 'slug', 'link']);
            return $this->success("Enemy found", $enemy);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getBook()
    {
        try {
            $enemy = $this->model->with('photos')->paginate(1);
            $enemy = (new EnemyCollection($enemy))->hide([
                'id',
                'slug',
                'link',
                'created_at',
                'updated_at'
            ]);

            return $this->success("Enemy found", $enemy);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getEnemySearch(string $name)
    {
        try {
            $enemy = $this->model
                ->where('name', 'LIKE', '%' . $name . '%')
                ->with('photos')
                ->paginate(200);

            $enemy = (new EnemyCollection($enemy))->hide([
                'id',
                'slug',
                'description',
                'created_at',
                'updated_at',
                'affiliation',
                'rank',
                'photos',
                'level']);
            return $this->success("Enemy found", $enemy);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
