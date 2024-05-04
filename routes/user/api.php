<?php

use App\Actions\User\Auth\{
    ForgotPasswordAction,
    LoginAction,
    RegisterAction,
    ResendVerificationCodeAction,
    ResetPasswordAction,
    VerifyRegisterAction,
    LogoutAction,
};
use App\Actions\User\Settings\Profile\{
    ViewUserAction,
    ChangeUserPasswordAction,
    DeleteUserAction,
    DeleteUserImageAction,
    EditUserAction,
    CreateCarAction
};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([], function () {
    Route::post('/register', RegisterAction::class);
    Route::post('/verify/register', VerifyRegisterAction::class);
    Route::post('/login', LoginAction::class);
    Route::post('/phone/verify/resend', ResendVerificationCodeAction::class);
    Route::post('/password/email', ForgotPasswordAction::class);
    Route::post('/password/reset', ResetPasswordAction::class);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', LogoutAction::class);

    Route::group(['prefix' => 'users'], function () {
        Route::get('{user}', ViewUserAction::class);
        Route::put('/{user}', EditUserAction::class);
        Route::put('/{user}/car_info', CreateCarAction::class);
        Route::delete('/{user}', DeleteUserAction::class);
        Route::delete('/{user}/image', DeleteUserImageAction::class);
        Route::post('/change/password', ChangeUserPasswordAction::class);
    });
});
