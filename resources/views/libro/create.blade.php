@extends('layouts.app')
@section('content')
<head>
<style>
    body{
        background-image: url("https://img.freepik.com/fotos-premium/fondo-textura-superficie-carton-papel-reciclado-blanco_293060-3899.jpg?w=2000");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
</style>
</head>
<div class="container">

<form action="{{ url('/libro') }}" method="post" enctype="multipart/form-data">
@csrf
@include('libro.form',['modo'=>'Crear']);

</form>

</div>
@endsection
