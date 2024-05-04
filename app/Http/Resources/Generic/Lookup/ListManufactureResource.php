<?php

namespace App\Http\Resources\Generic\Lookup;

use Illuminate\Http\Resources\Json\JsonResource;

class ListManufactureResource extends JsonResource
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
            'manufacture' => $this->manufacture,
        ];
    }
}
