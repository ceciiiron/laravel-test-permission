<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Enums\Permissions;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $accountManagerRole = Role::create(["name" => "superadmin"]);
        $accountManagerRole = Role::create(["name" => "account-manager"]);
        $hospitalClerkRole = Role::create(["name" => "hospital-clerk"]);
        $doctorRole = Role::create(["name" => "doctor"]);

        foreach (Permissions::cases() as $permission) {
            Permission::create(["name" => $permission->value]);
        }


        $accountManagerRole->givePermissionTo([
            Permissions::SHOW_USER->value,
            Permissions::CREATE_USER->value,
            Permissions::UPDATE_USER->value,
            Permissions::DELETE_USER->value,
            Permissions::VIEW_USERS->value,
        ]);

        $hospitalClerkRole->givePermissionTo([
            Permissions::SHOW_PATIENT->value,
            Permissions::CREATE_PATIENT->value,
            Permissions::UPDATE_PATIENT->value,
            Permissions::DELETE_PATIENT->value,
            Permissions::VIEW_PATIENTS->value,
        ]);

        $doctorRole->givePermissionTo([
            Permissions::SHOW_PRESCRIPTION->value,
            Permissions::CREATE_PRESCRIPTION->value,
            Permissions::UPDATE_PRESCRIPTION->value,
            Permissions::DELETE_PRESCRIPTION->value,
            Permissions::VIEW_PRESCRIPTIONS->value,
            Permissions::SHOW_PATIENT->value,
            Permissions::CREATE_PATIENT->value,
            Permissions::UPDATE_PATIENT->value,
            Permissions::DELETE_PATIENT->value,
            Permissions::VIEW_PATIENTS->value,
        ]);
    }
}
