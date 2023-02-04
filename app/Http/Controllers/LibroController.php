<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Doctrine\Common\Annotations\Annotation\Required;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['libros']=Libro::paginate(10);
        return view('libro.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('libro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Titulo'=>'required|string|max:100',
            'Autor'=>'required|string|max:100',
            'Fecha'=>'required|string|max:100',
            'Editorial'=> 'required|string|max:100',
            'Portada'=>'required|max:10000|mimes:jpeg, png, jpg'
        ];
        $mensaje=[
            'required'=>'El campo :attribute es necesario llenarlo',
            'Portada.required'=>'La portada es necesaria'
        ];
        $this->validate($request,$campos,$mensaje);

        //$datosLibro =request()->all();
        $datosLibro =request()->except('_token');

        if($request->hasFile('Portada'))
        {
            $datosLibro['Portada']=$request->file('Portada')->store('uploads','public');
        }

        Libro::insert($datosLibro);
        //return response()->json($datosLibro);
        return redirect('libro')->with('mensaje','Libro agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $libro=Libro::findOrFail($id);
        return view('libro.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       $campos=[
            'Titulo'=>'required|string|max:100',
            'Autor'=>'required|string|max:100',
            'Fecha'=>'required|string|max:100',
            'Editorial'=> 'required|string|max:100',
            
        ];
        $mensaje=[
            'required'=>'El campo :attribute es necesario llenarlo',
            
        ];

       if($request->hasFile('Portada'))
        {

            $campos=['Portada'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=[
                'Portada.required'=>'La portada es necesaria'
            ];
        }

        $this->validate($request,$campos,$mensaje);
        $datosLibro = request()->except(['_token','_method']);
        
        if($request->hasFile('Portada'))
        {
            $libro=Libro::findOrFail($id);
            Storage::delete('public/',$libro->Portada);
            $datosLibro['Portada']=$request->file('Portada')->store('uploads','public');
        }
        Libro::where('id','=','$id')->update($datosLibro);
        $libro=Libro::findOrFail($id);
        return view('libro.edit', compact('libro'));
       
        //return redirect('libro')->with('mensaje','Libro Editar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $libro=Libro::findOrFail($id);

        if(Storage::delete('public/'.$libro->Portada)){
            Libro::destroy($id);
        }
        
        return redirect('libro')->with('mensaje','Libro Borrado');
    }

    public function filtrar(Request $request)
    {
    $eventos = Libro::when($request->fecha_inicio && $request->fecha_fin, function ($query) use ($request) {
        return $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
    })->get();
    
    return view('libro.filtrar', compact('libro'));
    }


}
