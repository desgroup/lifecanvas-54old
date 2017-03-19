<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class iPhoneController extends ApiController
{
    public function login(Request $request)
    {
        if ($request->input('username') == 'cheddar' And $request->input('password') == 'cheese') {
            return 'true';
        }

        return 'false';
    }
}
