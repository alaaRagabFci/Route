<?php

namespace App\Actions\Generic\Lookup;

use App\Http\Resources\{ErrorResource, Generic\Lookup\ListManufactureResource, SuccessResource};
use App\Models\Manufacture;
use Illuminate\Http\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class ListManufactureAction
{
    use AsAction;


    /**
     * List Manufactures
     *
     * @return SuccessResource|ErrorResource
     */
    public function asController()
    {
        $manufactures = Manufacture::active()->get();

        return new SuccessResource(Response::HTTP_OK, '', ListManufactureResource::collection($manufactures));
    }
}
