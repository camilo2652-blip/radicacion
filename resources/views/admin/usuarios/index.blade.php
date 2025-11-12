@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Usuarios</h2>
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">➕ Nuevo usuario</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ ucfirst($u->rol) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
