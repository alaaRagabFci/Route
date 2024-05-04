<?php

namespace App\Http\Resources\Generic\Lookup;

use Illuminate\Http\Resources\Json\JsonResource;

class ListModelResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
        ];
    }
}
