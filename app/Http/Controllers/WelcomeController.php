<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application start page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = new User();
        return view('welcome',[
            'usersCount' => $users->allUsers()->count(),

        ]);
    }
}
