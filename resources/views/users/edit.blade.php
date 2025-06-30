@extends('layouts.admin')    

@section('content')
    
    <div class="content">
        <div class="content-title">
            <h1 class="page-title">Editar Usuário</h1>
            <a href="{{ route('user.index') }}" class="btn-info">Listar</a>
        </div>
        
        <x-alert />
        
        <form action="{{ route("user.update", ['user' => $user->id]) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label">Nome: </label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Nome completo" value="{{ old('name', $user->name) }}"><br><br>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email: </label>
                <input type="email" name="email" id="email" placeholder="Email" class="form-input" value="{{ old('email', $user->email) }}"><br><br>
            </div>

            <button type="submit" class="btn-warning">Salvar</button>
        </form>
    </div>

@endsection