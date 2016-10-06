<?php

namespace App\Http\Controllers\Ad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdUsersController extends Controller
{
    public function index()
    {
        return view('ad.users.index');
    }
}
