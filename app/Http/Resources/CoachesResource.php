<?php

namespace App\Http\Resources;
use App\Http\Resources\AreaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'rate' => $this->rate,
            'description' => $this->description,
            // 'areas' => $this->areas,
            'areas' => AreaResource::collection($this->areas),
            // PostResource::collection($this->posts),
        ];
    }
}
