<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateMemberUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of users to create
        $users = [
            [
                'name' => 'Ganesh',
                'email' => 'ganesh@gmail.com',
                'password' => 'abcd123',
            ],
            [
                'name' => 'Yash',
                'email' => 'yash@gmail.com',
                'password' => 'abcd123',
            ],
            [
                'name' => 'Vipul',
                'email' => 'vipul@gmail.com',
                'password' => 'abcd123',
            ],
            // Add more users here as needed
        ];

        // Retrieve or create the member role
        $role = Role::firstOrCreate(['name' => 'member']);

        // Permissions to assign to the role
        $permissions = [
            "permissions.index",
            "projects.index",
            "projects.show",
            "tasks.index",
            "tasks.store",
            "tasks.update",
            "tasks.destroy",
            "tasks.show",
            "taskSubmissions.index",
            "taskSubmissions.store",
            "taskSubmissions.show",
            "taskSubmissions.update",
            "taskSubmissions.destroy",
            "show.files",
        ];

        // Assign permissions to the role
        $role->syncPermissions($permissions);

        // Loop through each user and create/update them
        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']], // Search for user by email
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']) // Hash the password
                ]
            );

            // Assign the member role to the user
            $user->assignRole([$role->id]);
        }
    }
}