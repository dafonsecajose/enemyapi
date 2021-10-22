<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\EnemyRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EnemyRepositoryInterface;
use App\swagger\Controllers\Api\EnemyControllerInterface;

class EnemyController extends Controller implements EnemyControllerInterface
{
    private $enemy;

    public function __construct(EnemyRepositoryInterface $enemy)
    {
        $this->enemy = $enemy;
    }

    public function index()
    {
        return $this->enemy->getAllEnemies();
    }

    public function show($id)
    {
        return $this->enemy->getEnemyById($id);
    }

    public function store(EnemyRequest $request)
    {
        return $this->enemy->createEnemy($request);
    }

    public function update(EnemyRequest $request, $id)
    {
        return $this->enemy->updateEnemy($request, $id);
    }

    public function destroy($id)
    {
        return $this->enemy->deleteEnemy($id);
    }
}
