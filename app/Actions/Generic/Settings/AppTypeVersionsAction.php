<?php

namespace App\Actions\Generic\Settings;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use Lorisleiva\Actions\Concerns\AsAction;

class AppTypeVersionsAction
{
    use AsAction;

    /**
     * @return ErrorResource|SuccessResource
     */
    public function handle()
    {
        $appType = request()->header('app-type');
        $platform = request()->header('platform');

        if (!in_array($appType, ['driver', 'user'])) {
            return new ErrorResource(400, "Check your data");
        }

        if (!in_array($platform, ['ios', 'android'])) {
            return new ErrorResource(400, "Check your data");
        }

        return new SuccessResource(200, "",
            config('platform.' . $appType)[$platform]
        );
    }
}
