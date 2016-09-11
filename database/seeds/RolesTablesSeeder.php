<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = Role::create([
            'name' => 'root',
            'label' => 'Root administrator of the website'
        ]);

        $r1 = Role::create([
            'name' => 'administrator',
            'label' => 'Administrator of the website'
        ]);

        $users = User::all();

        foreach ($users as $user) {
            $user->assignRole('administrator');
        }
    }
}
