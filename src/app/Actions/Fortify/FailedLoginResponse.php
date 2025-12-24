<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\FailedLoginResponse as FailedLoginResponseContract;
use Illuminate\Validation\ValidationException;

class FailedLoginResponse implements FailedLoginResponseContract
{
    public function toResponse($request)
    {
        throw ValidationException::withMessages([
            'email' => ['ログイン情報が登録されていません'],
        ]);
    }
}
