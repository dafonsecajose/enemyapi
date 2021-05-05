<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class EnemyResource extends JsonResource
{

    public static function collection($resource)
    {
        return tap(new EnemyCollection($resource), function($collection){
            $collection->collects = __CLASS__;
        });
    }
    protected $withoutFields = [];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  $this->filterFields([
            'id' => $this->id,
            'name' => $this->name,
            'rank' => $this->rank,
            'level' => $this->level,
            'affiliation' => $this->affiliation,
            'description' => $this->description,
            'slug' => $this->slug,
            'link' => route('search.enemies.show', ['slug' => $this->slug]),
            'photos' => PhotoEnemyResource::collection($this->whenLoaded('photos'))
        ]);
    }


    public function hide(array $fields)
    {
        $this->withoutFields = $fields;
        return $this;
    }

    protected function filterFields($array)
    {
        return collect($array)->forget($this->withoutFields)->toArray();
    }
}
