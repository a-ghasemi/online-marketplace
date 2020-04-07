<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'test admin',
            'email' => 'admin@example.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('123456'),
        ]);

        $user->assignRole('admin');

        $user->createToken('Laratoken')->accessToken;
    }
}
