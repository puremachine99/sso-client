<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin SmartID',
                'email' => 'admin@smartid.test',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@smartid.test',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@smartid.test',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@smartid.test',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@smartid.test',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $data) {
            User::create($data);
        }
    }
}
