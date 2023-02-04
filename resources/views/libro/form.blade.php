<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<h1>{{$modo}} libro</h1>


<div class="form-group">
<label for="Titulo"> Titulo </label>
<input type="text" class="form-control" name="Titulo" value="{{ isset($libro->Titulo)?$libro->Titulo:old('Titulo')}}" id="Titulo">
</div>

<div class="form-group">
<label for="Autor"> Autor </label>
<input type="text" class="form-control" name="Autor" value="{{isset($libro->Autor)?$libro->Autor:old('Autor')}}" id="Autor">
</div>

<div class="form-group">
<label for="Fecha"> Fecha Publicacion </label>
<Input type="date" class="form-control" name="Fecha" value="{{isset($libro->Fecha)?$libro->Fecha:''}}" id="Fecha">
</div>

<div class="form-group">
<label for="Editorial"> Editorial </label>
<input type="text" class="form-control" name="Editorial" value="{{isset($libro->Editorial)?$libro->Editorial:old('Editorial')}}" id="Editorial">
</div>

<div class="form-group">
<label for="Portada"> Portada </label>
@if(isset($libro->Portada))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$libro->Portada}}" width="100" alt=""
@endif
>
 <input type="file" class="form-control" name="Portada" value="" id="Portada">

</div>
<br>

@if(count($errors)>0)

    <div class="alert alert-danger" rote="alert">
<ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</ul>
    </div>
    
@endif
<input type="submit" class="btn btn-success" value="{{$modo}} Datos">
<a href="{{url('libro/')}}" class="btn btn-danger">Volver</a>
