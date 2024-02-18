<?php

namespace App\Http\Controllers;

use App\Models\ListUser;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function profilepage(){
        return view('role.managerProfile');
    }
    public function index()
    {
        $listUser = ListUser::where('role', 'supervisor')->get();
        return view('role.userListSupervisor', compact('listUser'));
    }
}
