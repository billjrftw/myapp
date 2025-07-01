<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc("id")->paginate(10);

        return view("users.index", ["users"=> $users]);
    }
    
    public function create()
    {
        return view("users.create");
    }

    public function store(UserRequest $request)
    {
        // dd($request);

        try {

        User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> $request->password
        ]);

        return redirect()->route('user.create')
            ->with('success','Usuário cadastrado com sucesso!');
        } catch(Exception) {
            return back()->withInput()->with('error','Usuário não cadastrado!');
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
        $request->validate([
            'password' => 'require|min:6'
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        try {
            $user->update([
                'password' => $request->password,
            ]);

            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Senha alterada com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error','Senha não foi alterada.');
        }
    }
}
