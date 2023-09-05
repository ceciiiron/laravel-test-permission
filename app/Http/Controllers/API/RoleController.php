<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseCrudController;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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

    public function index(Request $request): JsonResponse
    {
        return response()->json(Role::all());
    }

    public function store(Request $request)
    {
        $role = $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $insertedRole = Role::create(["name" => $role["name"], "guard_name" => "web"]);

        return response()->json(["message" => "Data inserted", "data" => $insertedRole], 201);
    }

    public function syncPermissions(Request $request, $id)
    {

        $permissions = $request->validate([
            "permissions" => 'required|array',
            "permissions.*" => "integer"
        ]);

        Role::find($id)->syncPermissions($permissions);

        return response()->json(["message" => "Permissions synced", "data" => $permissions], 201);
    }

    public function getPermissions(Request $request, $id)
    {
        return response()->json(Role::where("id", $id)->with("permissions")->get());
    }

    public function getUsers(Request $request, $id)
    {
        return response()->json(User::role($id)->get());
    }
}
