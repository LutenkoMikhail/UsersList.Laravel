<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->paginate = Config::get('constants.db.paginate_users.paginate_users_10');
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $users = User::with(['role', 'photo'])->orderBy('created_at', 'asc')->paginate($this->paginate);
        return view('admin.user.index',
            ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.user.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserStoreRequest $request)
    {
        if ($request->role_admin) {
            $roleId = Role::where('name', '=', Config::get('constants.db.roles.admin'))->first('id');
        } else {
            $roleId = Role::where('name', '=', Config::get('constants.db.roles.user'))->first('id');
        }

        $pathPhoto = $request->photo->store(
            Config::get('constants.photo.path_save_storage'),
            'public'
        );
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'blocked' => false,
            'role_id' => $roleId->id,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $user->photo()->create([
                'photo_path' => $pathPhoto
            ]
        );

        if ($user->save()) {
            return redirect()->route('user.index')->withSuccess('New user ' . $user->name . ' created!');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return View
     */
    public function show(User $user)
    {
        return view('admin.user.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return View
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',
            [
                'user' => $user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return View
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        if ($request->role_admin) {
            $roleId = Role::where('name', '=', Config::get('constants.db.roles.admin'))->first('id');
        } else {
            $roleId = Role::where('name', '=', Config::get('constants.db.roles.user'))->first('id');
        }

        $pathPhoto = $request->photo->store(
            Config::get('constants.photo.path_save_storage'),
            'public'
        );

        $user->photo()->create([
                'photo_path' => $pathPhoto
            ]
        );

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $roleId->id;

        $this->deletePhotoUser($user->photo->photo_path);
        $user->photo()->delete();

        $user->photo()->create([
                'photo_path' => $pathPhoto
            ]
        );

        if ($user->save()) {
            return redirect()->route('user.index')->withSuccess('User ' . $user->name . ' update!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return View
     */
    public function destroy(User $user)
    {
        $this->deletePhotoUser($user->photo->photo_path);
        $user->photo()->delete();
        $user->delete();
        return redirect()->route('user.index')->withSuccess('User ' . $user->name . ' deleted successfully !');
    }

    /**
     * Delete file photo user
     * @param string $photoPath
     * @return void
     */
    protected function deletePhotoUser(string $photoPath)
    {
        Storage::disk('public')->delete($photoPath);
    }

    /**
     * Changed status User
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(User $user)
    {
        if (! $user->isAdmin()) {
            $user->blocked = $user->blocked ? false : true;

        } else{
            $user->blocked = false;
        }

        if ($user->save()) {
            return redirect()->back()->withSuccess('Status ' . $user->name . ' changed!');
        }

        return redirect()->back();
    }
}
