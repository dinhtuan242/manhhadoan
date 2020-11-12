<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'image' => 'user.png',
                'about' => 'Quản trị website',
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'role_id' => 2,
                'name' => 'Người dùng',
                'username' => 'user',
                'email' => 'user@user.com',
                'image' => 'user.png',
                'about' => '',
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'role_id' => 3,
                'name' => 'Nhân Viên',
                'username' => 'employee',
                'email' => 'employee@employee.com',
                'image' => 'user.png',
                'about' => '',
                'password' => bcrypt('123456'),
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);

        DB::table('roles')->insert([
            [
                'name' => 'Quản Trị Viên',
                'slug' => 'quan-tri-vien',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Người Dùng',
                'slug' => 'nguoi-dung',
                'created_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Nhân Viên',
                'slug' => 'nhan-vien',
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
