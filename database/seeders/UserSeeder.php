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


        User::factory()
            ->count(9)
            ->hasphoto(1)
            ->create();

        $this->command->info('Entering data for the administrator :');

        $name = $this->command->askWithCompletion('Enter name', ['admin',
            'Admin'], 'admin');

        $email = $this->command->askWithCompletion('Enter email', ['admin@admin.com'
        ], 'admin@admin.com');

        $password = $this->command->ask("Enter {$name}'s password", '123456789');

        $adminArray['name'] = $name;
        $adminArray['email'] = $email;
        $adminArray['password'] = Hash::make($password);
        $adminArray['role_id'] = $roleId;
        $adminArray['blocked'] = true;

        User::factory()
            ->count(1)
            ->hasphoto(1)
            ->create($adminArray);

        $this->command->info('The users are loaded into the database.');


    }
}