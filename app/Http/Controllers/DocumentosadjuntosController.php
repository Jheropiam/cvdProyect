<?php

namespace App\Http\Controllers;

use App\Models\documentosadjuntos;
use Illuminate\Http\Request;

class DocumentosadjuntosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($iddocumento)
    {
        $documento_id=$iddocumento;
        return view('documentosadjuntos.create',['documento_id'=>$documento_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj = new documentosadjuntos();
        if ($request->hasFile('documento')){
            $file = request('documento')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('documento')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('documento')->storeAs('documentosadjuntos/',$archivo,'public');//refiere carpeta publica es el nombre de disco
            $obj->documento = $archivo;
        }
        $obj->documentos_id=request('documento_id');
        $obj->extension=$extension;
        $obj->save();
        return redirect()->route('documentos.index')->with('mensaje','Documentos registrados correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(documentosadjuntos $documentosadjuntos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(documentosadjuntos $documentosadjuntos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, documentosadjuntos $documentosadjuntos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $doc=documentosadjuntos::findOrFail($id);
        $doc->delete();
        return redirect()->route('documentos.index')->with('mensaje','El documento fue eliminado');
    }
}
