@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif

<a href="{{url('libro/create')}}" class="btn btn-primary">Registar Nuevos Libros</a>
</br>
</br>
<<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Portada</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Fecha</th>
            <th>Editorial</th>
            <th>Likes</th>
            <th>Acciones</th>
        </tr>
    </thead>
        @foreach($libros as $libro)
    <tbody>
        <tr>
            <td>{{$libro->id}}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$libro->Portada}}" width="100" alt=""> 
            </td>
            
            <td>{{$libro->Titulo}}</td>
            <td>{{$libro->Autor}}</td>
            <td>{{$libro->Fecha}}</td>
            <td>{{$libro->Editorial}}</td>
            <td>{{$libro->Likes}}</td>
            <td>
                
            <a href="{{ url('/libro/'.$libro->id.'/edit')  }}" class="btn btn-success" >
            Editar
            </a>
             | 
                
            <form action="{{ url('/libro/'.$libro->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }} 
            <input type="submit" class="btn btn-danger" onclick="return confirm('Quieres borrar?')"value="Borrar">

            </form>

            </td>
        @endforeach
        </tr>
    </tbody>
</table>
</div>
@endsection