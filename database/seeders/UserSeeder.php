<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminArray = [];
        $roleId = Role::where('name', '=', Config::get('constants.db.roles.admin'))->first();

        $this->command->info('Entering data for the administrator :');

        User::factory()
            ->count(9)
            ->hasphoto(1)
            ->create();

        $this->command->info('Creating Users.');

        $name = $this->command->askWithCompletion('Enter name', [Config::get('constants.admin.name')], Config::get('constants.admin.name'));

        $email = $this->command->askWithCompletion('Enter email', [Config::get('constants.admin.email')], Config::get('constants.admin.email'));

        $password = $this->command->askWithCompletion("Enter {$name}'s password", [Config::get('constants.admin.password')], Config::get('constants.admin.password'));

        $adminArray['name'] = $name;
        $adminArray['email'] = $email;
        $adminArray['password'] = Hash::make($password);
        $adminArray['role_id'] = $roleId;
        $adminArray['blocked'] = false;

        User::factory()
            ->count(1)
            ->hasphoto(1)
            ->create($adminArray);

        $this->command->info('The user are loaded into the database.');
    }
}
