<?php

namespace App\Http\Controllers;

use App\Models\ListUser;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function profilepage(){
        return view('role.supervisorProfile');
    }
    public function index()
    {
        $listUser = ListUser::whereIn('role', ['user', 'supervisor'])->get();
        return view('role.supervisorList', compact('listUser'));
    }
}
