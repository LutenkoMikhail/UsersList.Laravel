<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $countUsers = User::count();

        return view('admin.home.index',[
            'countUsers'=>$countUsers,
        ]);
    }

}
