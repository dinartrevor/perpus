<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $email = 'admin@admin.com';
        $user = User::whereEmail('email', $email)->first();

        if (is_null($user)) {
            User::create([
                'email' => $email,
                'password' => Hash::make('password'),
                'name' => 'Admin'
            ]);
        }
    }
}
