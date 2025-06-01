<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class RolSeeder extends Seeder
{
    public function run()
    {
        // Desactivar temporalmente las restricciones de clave foránea
        Schema::disableForeignKeyConstraints();

        // Limpiar tablas relacionadas
        DB::table('model_has_roles')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();

        // Crear permisos básicos
        $permissions = [
            'acceso_admin',
            'gestionar_productos',
            'gestionar_clientes',
            'gestionar_facturas'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Crear roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $clienteRole = Role::create(['name' => 'cliente', 'guard_name' => 'web']);

        // Asignar todos los permisos al rol admin
        $adminRole->givePermissionTo(Permission::all());

        // Limpiar cache de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Asignar roles según rol_id
        Usuario::where('rol_id', 1)->each(function ($usuario) {
            $usuario->assignRole('admin');
        });

        Usuario::where('rol_id', 2)->each(function ($usuario) {
            $usuario->assignRole('cliente');
        });

        // Reactivar las restricciones de clave foránea
        Schema::enableForeignKeyConstraints();
    }
}
