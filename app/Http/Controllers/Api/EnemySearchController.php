<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\EnemySearchRepositoryInterface;

class EnemySearchController extends Controller
{
    private $enemy;

    public function __construct(EnemySearchRepositoryInterface $enemy)
    {
        $this->enemy = $enemy;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->enemy->getAllEnemies();
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return $this->enemy->getEnemyBySlug($slug);
    }

    public function book()
    {
        return $this->enemy->getBook();
    }

    public function search(Request $request)
    {
        if ($request->has('name')) {
            $name = $request->get('name');
            return $this->enemy->getEnemySearch($name);
        }
    }
}
