@extends('layouts.app')

@section('content')
<div class="p-6 text-center">
    <h1 class="text-2xl font-bold text-gray-800">Panel de Dependencia</h1>
    <p class="mt-2 text-gray-600">Bienvenido, {{ Auth::user()->nombre }}</p>
</div>
@endsection
