<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Cosechas
            ['name' => 'showCosechas', 'description' => 'Ver Cosechas', 'module' => 'Cosechas'],
            ['name' => 'createCosechas', 'description' => 'Crear Cosechas', 'module' => 'Cosechas'],
            ['name' => 'updateCosechas', 'description' => 'Actualizar Cosechas', 'module' => 'Cosechas'],
            ['name' => 'deleteCosechas', 'description' => 'Eliminar Cosechas', 'module' => 'Cosechas'],

            // Secciones
            ['name' => 'showSections', 'description' => 'Ver Secciones', 'module' => 'Secciones'],
            ['name' => 'createSections', 'description' => 'Crear Secciones', 'module' => 'Secciones'],
            ['name' => 'updateSections', 'description' => 'Actualizar Secciones', 'module' => 'Secciones'],
            ['name' => 'deleteSections', 'description' => 'Eliminar Secciones', 'module' => 'Secciones'],

            //Roles
            ['name' => 'showRols', 'description' => 'Ver Roles', 'module' => 'Rols'],
            ['name' => 'createRols', 'description' => 'Crear Roles', 'module' => 'Rols'],
            ['name' => 'updateRols', 'description' => 'Actualizar Roles', 'module' => 'Rols'],
            ['name' => 'deleteRols', 'description' => 'Eliminar Roles', 'module' => 'Rols'],

            // Cultivoparcelas
            ['name' => 'showCultivoparcelas', 'description' => 'Ver Cultivoparcelas', 'module' => 'Cultivoparcelas'],

            // Cultivos
            ['name' => 'showCultivos', 'description' => 'Ver Cultivos', 'module' => 'Cultivos'],
            ['name' => 'createCultivos', 'description' => 'Crear Cultivos', 'module' => 'Cultivos'],
            ['name' => 'updateCultivos', 'description' => 'Actualizar Cultivos', 'module' => 'Cultivos'],
            ['name' => 'deleteCultivos', 'description' => 'Eliminar Cultivos', 'module' => 'Cultivos'],

            // Mantenimientos
            ['name' => 'showMantenimientos', 'description' => 'Ver Mantenimientos', 'module' => 'Mantenimientos'],
            ['name' => 'createMantenimientos', 'description' => 'Crear Mantenimientos', 'module' => 'Mantenimientos'],
            ['name' => 'updateMantenimientos', 'description' => 'Actualizar Mantenimientos', 'module' => 'Mantenimientos'],
            ['name' => 'deleteMantenimientos', 'description' => 'Eliminar Mantenimientos', 'module' => 'Mantenimientos'],

            // Parcelas
            ['name' => 'showParcelas', 'description' => 'Ver Parcelas', 'module' => 'Parcelas'],
            ['name' => 'createParcelas', 'description' => 'Crear Parcelas', 'module' => 'Parcelas'],
            ['name' => 'updateParcelas', 'description' => 'Actualizar Parcelas', 'module' => 'Parcelas'],
            ['name' => 'deleteParcelas', 'description' => 'Eliminar Parcelas', 'module' => 'Parcelas']

        ];

        foreach($permissions as $permission) {

            $tmpPermission = Permission::where('name', '=', $permission['name'])
                                       ->where('module', '=', $permission['module'])
                                       ->first();

            if (empty($tmpPermission)) {

                $newPermission = new Permission();
                $newPermission->name = $permission['name'];
                $newPermission->description = $permission['description'];
                $newPermission->module = $permission['module'];
                $newPermission->save();
            }
        }
    }
}
