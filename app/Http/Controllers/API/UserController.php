<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseCrudController;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends BaseCrudController
{

    public function __construct()
    {
        $this->model = new User;
        $this->modelQuery = User::select("id", "username", "full_name", "email")->with("roles");
        // $this->modelQuery = User::select("username", "full_name", "email")->with(['roles' => function ($query) {
        // $query->select('id', 'name');
        // }]);

        // $this->model->select("username", "full_name", "email")
        $this->searchFields = ["username", "full_name"];
        $this->columnOrder = "updated_at";

        $this->middleware('can:show roles')->only('index', 'show');

        // https://stackoverflow.com/questions/32727060/select-specific-columns-from-eloquent-relations
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'username' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create($user);


        return response(["message" => "Data inserted", "data" => $user], 201);
    }

    public function syncRoles(Request $request, $id)
    {
        $roles = $request->validate([
            "roles" => 'required|array',
            'roles.*' => 'required',
        ]);


        User::find($id)->syncRoles($roles);

        return response()->json(["message" => "Successfully synced roles"]);
    }

    public function show($id)
    {
        $user = $this->modelQuery->find($id);
        return $user->getPermissionsViaRoles();
    }

    // public function getRoles(Request $request, $id)
    // {
    // }
}
