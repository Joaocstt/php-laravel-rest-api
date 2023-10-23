<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        if($users->isEmpty()) {
            return response()->json(['message' => 'Nenhum usuário encontrado!'], 404);
        }
        return response()->json($users, 200);
    }

    public function show($id): JsonResponse
    {
        $user = User::query()->find($id);
        if($user == null) {
            return response()->json(['message' => 'Nenhum usuário encontrado com esse ID'], 404);
        }
        return response()->json($user, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        $newUser = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        if($newUser) {
            return response()->json(['message' => 'Usuário cadastrado com sucesso!'], 200);
        }
        return response()->json(['message' => 'Erro ao cadastrar usuário!'], 400);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        $user = User::query()
            ->where('id', $id)
            ->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
        ]);

        if($user) {
            return response()->json(['message' => 'Usuário atualizado com sucesso!'], 200);
        }
        return response()->json(['message' => 'Erro ao atualizar usuário!'], 400);
    }

    public function delete($id): JsonResponse
    {
        $user = User::query()
            ->where('id', $id)
            ->delete();

        if($user) {
            return response()->json(['message' => 'Usuário deletado com sucesso!'], 200);
        }
        return response()->json(['message' => 'Erro ao deleter usuário!'], 400);
    }
}
