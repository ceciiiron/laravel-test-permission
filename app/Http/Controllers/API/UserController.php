<?php

namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseCrudController;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends BaseCrudController
{

    public function __construct()
    {
        $this->model = new User;
        $this->modelQuery = $this->model->select("username", "full_name", "email");

        $this->searchFields = ["username", "full_name"];
        $this->columnOrder = "updated_at";
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
}
