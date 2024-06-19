<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Método para retornar todos os usuários
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Método para criar um novo usuário
    public function store(Request $request)
    {
        // Valida os dados recebidos do request
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'cpf' => 'required|string|max:14|unique:users,cpf',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Cria um novo usuário com os dados recebidos
        $user = new User([
            'name' => $request->get('name'),
            'cpf' => $request->get('cpf'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $user->save();

        return response()->json($user, 201);
    }

    // Método para mostrar os detalhes de um usuário específico
    public function show(User $user)
    {
        return response()->json($user);
    }

    // Método para atualizar os dados de um usuário existente
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'cpf' => 'required|string|max:14|unique:users,cpf,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'name' => $request->get('name'),
            'cpf' => $request->get('cpf'),
            'email' => $request->get('email'),
            'password' => $request->get('password') ? bcrypt($request->get('password')) : $user->password,
        ]);

        return response()->json($user);
    }

    // Método para deletar um usuário
    public function delete(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
