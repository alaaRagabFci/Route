<?php

namespace App\Actions\Generic\Lookup;

use App\Http\Resources\{ErrorResource, Generic\Lookup\ListModelResource, SuccessResource};
use App\Models\CarModel;
use App\Models\Manufacture;
use Illuminate\Http\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ListModelAction
{
    use AsAction;


    /**
     * List Models
     *
     * @param Manufacture $manufacture
     * @return SuccessResource|ErrorResource
     */
    public function asController(Manufacture $manufacture)
    {
        $models = CarModel::active()->where('manufacture_id', $manufacture->id)->get();

        return new SuccessResource(Response::HTTP_OK, '', ListModelResource::collection($models));
    }
}
