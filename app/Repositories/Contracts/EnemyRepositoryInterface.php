<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\EnemyRequest;

interface EnemyRepositoryInterface
{

    public function createEnemy(EnemyRequest $request);

    public function updateEnemy(EnemyRequest $request, $id);

    public function deleteEnemy($id);

    public function getEnemyById($id);

    public function getAllEnemies();
}
