<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EnemyCollection extends ResourceCollection
{

    protected $withoutFields = [];
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
                'data' => $this->processCollection($request),
                "total" => $this->total(),
                "per_page" => $this->perPage(),
                "current_page" => $this->currentPage(),
                "last_page" => $this->lastPage(),
                "first_page_url" => $this->url(1),
                "last_page_url" => $this->url($this->lastPage()),
                "next_page_url" => $this->nextPageUrl(),
                "prev_page_url" => $this->previousPageUrl(),
                "path" => $this->getOptions()['path'],
            ];
    }

    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }


    public function processCollection($request)
    {
        return $this->collection->map( function (EnemyResource $resource) use($request) {
            return $resource->hide($this->withoutFields)->toArray($request);
        })->all();
    }
}
