<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getDataUser()
    {
        return view('data-users', [
            'users' => User::all(),
        ]);
    }

    public function index()
    {
        return view('index');
    }

    public function show($id)
    {
        $p = User::find($id);
        return response()->json($p);
    }

    public function edit($id)
    {
        $p = User::find($id);
        return response()->json($p);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|',
            'email' => 'email|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 201,
                'errors' => $validator->errors(),
            ]);
        } else {
            $user = User::whereId($request->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return response()->json([
                'status' => 200,
                'message' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Edit data Successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;<span></button></div>',
                'data' => $user
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|',
            'email' => 'email|email:dns|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 201,
                'errors' => $validator->errors(),
            ]);
        } else {
            $users = User::create($request->all());
            return response()->json([
                'status' => 200,
                'message' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Add data Successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;<span></button></div>',
                'data' => $users
            ]);
        }
    }

    public function delete($id)
    {
        $user = User::find($id)->delete();

        if ($user == true) {
            return response()->json([
                'status' => 200,
                'message' => '<div class="alert alert-success alert-dismissible fade show" role="alert">Delete data Successfully<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;<span></button></div>'
            ]);
        } else {
            return response()->json([
                'status' => 201,
                'message' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">Delete data failed<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;<span></button></div>',
            ]);
        }
    }
}
