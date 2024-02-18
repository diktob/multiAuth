<?php

namespace App\Http\Controllers;

use App\Models\ListUser;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $listUser = ListUser::all();
        return view('users.index', compact('listUser'));
    }
}
