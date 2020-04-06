<?php

use Illuminate\Database\Seeder;

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
            'password' => hash('123456'),
        ]);

        $user->assignRole('admin');
    }
}
