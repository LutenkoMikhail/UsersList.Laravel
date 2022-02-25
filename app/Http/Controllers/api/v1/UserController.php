<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Return All Users
     * @return UserCollection
     */
    public function all()
    {
        return new UserCollection(Cache::remember('allUsers', 2, function () {
            $users = new User();
            return $users->allUsersNotBlocked();
        }));
    }
}
