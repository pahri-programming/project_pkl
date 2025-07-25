<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        \App\Models\User::create([
            'name'     => 'Pahri',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('rahasia'),
            'isAdmin'  => 1,
        ]);

        \App\Models\User::create([
            'name'     => 'Almalik',
            'email'    => 'Almalik@gmail.com',
            'password' => bcrypt('12345678'),
            'isAdmin'  => 0,
        ]);

    }
}
