<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Enums\PermissionTypes;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountManagerRole = Role::create(["name" => "account-manager"]);
        $hospitalClerkRole = Role::create(["name" => "hospital-clerk"]);
        $doctorRole = Role::create(["name" => "doctor"]);

        foreach (PermissionTypes::cases() as $permission) {
            Permission::create(["name" => $permission->value]);
        }

        $accountManagerRole->givePermissionTo([1, 2, 3, 4, 5]);

        $accountManagerRole->givePermissionTo([
            PermissionTypes::SHOW_USER,
            PermissionTypes::CREATE_USER,
            PermissionTypes::UPDATE_USER,
            PermissionTypes::DELETE_USER,
            PermissionTypes::VIEW_USERS,
        ]);

        $hospitalClerkRole->givePermissionTo([
            PermissionTypes::SHOW_PATIENT,
            PermissionTypes::CREATE_PATIENT,
            PermissionTypes::UPDATE_PATIENT,
            PermissionTypes::DELETE_PATIENT,
            PermissionTypes::VIEW_PATIENTS,
        ]);

        $doctorRole->givePermissionTo([
            PermissionTypes::SHOW_PRESCRIPTION,
            PermissionTypes::CREATE_PRESCRIPTION,
            PermissionTypes::UPDATE_PRESCRIPTION,
            PermissionTypes::DELETE_PRESCRIPTION,
            PermissionTypes::VIEW_PRESCRIPTIONS,
            PermissionTypes::SHOW_PATIENT,
            PermissionTypes::CREATE_PATIENT,
            PermissionTypes::UPDATE_PATIENT,
            PermissionTypes::DELETE_PATIENT,
            PermissionTypes::VIEW_PATIENTS,
        ]);
    }
}
