<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseCrudController;

use Illuminate\Http\Request;

use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseCrudController
{

    public function __construct()
    {
        $this->model = new Role;
        // $this->modelQuery = $this->model->select("username", "full_name", "email");

        // $this->searchFields = ["username", "full_name"];
        // $this->columnOrder = "updated_at";
    }

    public function store(Request $request)
    {
        $role = $request->validate([
            'name' => 'required',
        ]);

        $insertedRole = Role::create($role);

        return response(["message" => "Data inserted", "data" => $insertedRole], 201);
    }
}