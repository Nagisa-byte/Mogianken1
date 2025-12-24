<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }
}
