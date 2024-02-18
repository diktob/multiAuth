<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('home');
    }

    public function adminHome(){
        return view('dashboard');
    }
    public function managerHome(){
        return view('role.manager');
    }
    public function supervisorHome(){
        return view('role.supervisor');
    }
}
