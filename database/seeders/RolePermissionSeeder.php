<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'seguridad.usuarios.view',
            'seguridad.usuarios.create',
            'seguridad.usuarios.update',
            'seguridad.usuarios.block',
            'seguridad.usuarios.activate',

            'seguridad.roles.view',
            'seguridad.roles.create',
            'seguridad.roles.update',
            'seguridad.roles.assign',

            'seguridad.permisos.view',

            'seguridad.sesiones.view',
            'seguridad.sesiones.revoke',

            'seguridad.auditoria.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'SUPERADMIN',
            'guard_name' => 'web',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'ADMINISTRADOR',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions($permissions);
    }
}
