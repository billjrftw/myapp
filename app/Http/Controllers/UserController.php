<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc("id")->paginate(5);

        return view("users.index", ["users"=> $users]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }
    
    public function create()
    {
        return view("users.create");
    }

    public function store(UserRequest $request)
    {
        // dd($request);

        try {

        $user = User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> $request->password
        ]);

        return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        } catch(Exception) {
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update([
                'name'=> $request->name,
                'email'=> $request->email,
            ]);

            //return redirect()->route('user.edit', ['user' => $user->id])->with('success','Cadastro editado com sucesso');
            return redirect()->route('user.edit', ['user' => $user->id])->with('success', 'Cadastro editado com sucesso.');
        } catch (Exception $e) {
            return back()->withInput()->with('error','Cadastro não editado!');
        }
    }

    public function editPassword(User $user)
    {
        return view('users.editPassword', ['user' => $user]);
    }

    public function updatePassword(Request $request, User $user)
    {

        // Validar o formulário
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        try {

            // Editar as informações do registro no banco de dados
            $user->update([
                'password' => $request->password,
            ]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Senha do usuário não editada!');
        }
    }

    public function destroy(User $user)
    {
        try {
            // Excluir o registro do banco de dados
            $user->delete();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.index')->with('success', 'Usuário excluído com sucesso!');
        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('user.index')->with('error', 'Usuário não excluído!');
        }
    }
}