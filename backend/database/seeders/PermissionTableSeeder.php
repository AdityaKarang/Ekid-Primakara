<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::where('id', '!=', null)->delete();

        //role
        Permission::insert([
            ['id' => 'role.index', 'name' => 'Lihat Role', 'group' => 'ROLE'],
            ['id' => 'role.create', 'name' => 'Buat Role', 'group' => 'ROLE'],
            ['id' => 'role.edit', 'name' => 'Edit Role', 'group' => 'ROLE'],
            ['id' => 'role.delete', 'name' => 'Hapus Role', 'group' => 'ROLE'],
        ]);

        Permission::insert([
            ['id' => 'user.index', 'name' => 'Lihat User', 'group' => 'USER'],
            ['id' => 'user.create', 'name' => 'Buat User', 'group' => 'USER'],
            ['id' => 'user.edit', 'name' => 'Edit User', 'group' => 'USER'],
            ['id' => 'user.delete', 'name' => 'Hapus User', 'group' => 'USER'],
        ]);
    }
}
