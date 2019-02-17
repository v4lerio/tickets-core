<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class CurrentUserController extends Controller
{

    public function show() {
        return new UserResource(\Auth::user());
    }

}
