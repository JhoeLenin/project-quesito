<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //el sistema tendra 2 roles, 1 sera el admin y otro registrador

        $admin  = Role::create(['name' => 'admin']);
        $registrador  = Role::create(['name' => 'registrador']);


        Permission::create(['name' => 'index'])->syncRoles([$admin, $registrador]);
        Permission::create(['name' => 'reportes'])->syncRoles([$admin, $registrador]);
        Permission::create(['name' => 'pdf'])->syncRoles([$admin, $registrador]);
        Permission::create(['name' => 'pdf_fechas'])->syncRoles([$admin, $registrador]);
        Permission::create(['name' => 'home'])->syncRoles([$admin, $registrador]);
        Permission::create(['name' => 'becarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'escuelas'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'asistencias'])->syncRoles([$admin, $registrador]);

        User::find(1)->assignRole($admin);
        User::find(2)->assignRole($registrador);
    }
}
