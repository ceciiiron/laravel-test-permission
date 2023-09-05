<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseCrudController;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseCrudController
{

    public function __construct()
    {
        $this->model = new Permission;
        // $this->modelQuery = $this->model->select("username", "full_name", "email");

        // $this->searchFields = ["username", "full_name"];
        // $this->columnOrder = "updated_at";
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json(Permission::all());
    }

    // public function store(Request $request)
    // {
    //     $role = $request->validate([
    //         'name' => 'required',
    //     ]);

    //     $insertedRole = Role::create($role);

    //     return response(["message" => "Data inserted", "data" => $insertedRole], 201);
    // }
}