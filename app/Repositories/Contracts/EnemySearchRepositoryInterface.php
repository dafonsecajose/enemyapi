<?php

namespace App\Repositories\Contracts;

interface EnemySearchRepositoryInterface
{
    public function getAllEnemies();

    public function getEnemyBySlug($slug);

    public function getBook();

    public function getEnemySearch(string $name);
}
