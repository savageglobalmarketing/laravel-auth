<?php

namespace SavageGlobalMarketing\Auth\Database\Seeders;

use SavageGlobalMarketing\Auth\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::create([
            'name' => 'Admin users',
            'email' => 'admin@email.com',
            'password' => 'secret'
        ])->roles()->sync(1);
    }
}
