<?php

namespace App\Http\Controllers;

use App\Models\documentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;


class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */

     public function fillPDFFile_withCVDCode($file, $outputFilePath)
     {
         $fpdi = new FPDI;
         $count = $fpdi->setSourceFile($file);
         for ($i=1; $i<=$count; $i++) {
             $template = $fpdi->importPage($i);
             $size = $fpdi->getTemplateSize($template);
             $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
             $fpdi->useTemplate($template);
             $fpdi->SetFont("helvetica", "", 12);
             $fpdi->SetTextColor(153,0,153);
             $left = 20;
             $top = 170;
             $text = "Esta es una representación impresa cuya autenticidad puede ser contrastada con la representación imprimible localizada en la sede digital de la Presidencia  del consejo de ministros. La verificación puede ser efectuada a partir del  05/01/2021 hasta el 05/04/2021. Base Legal: Decreto Legislativo N° 1412, Decreto Supremo N° 029-2021-PCM y la Directiva N° 002-2021-PCM/SGTD";
             $fpdi->Cell($left,$top,$text,1,1,'FJ',1);
             
            //  $fpdi->Image("http://localhost/dylan.jpg", 40, 90); //para poner imágenes
         }
   
         return $fpdi->Output($outputFilePath, 'F');
     }
    
    public function algoritmo_lum(){

    }

    public function store(Request $request)
    {
        $obj = new documentos();
        $extension='';
        $archivo='';
        if ($request->hasFile('documento_adjunto')){
            $file = request('documento_adjunto')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension_adjunto = request('documento_adjunto')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension_adjunto;//
            request('documento_adjunto')->storeAs('documentos/',$archivo,'public');//refiere carpeta publica es el nombre de disco
            $obj->documento_adjunto = $archivo;
        }
        if ($request->hasFile('documento')){
            $file = request('documento')->getClientOriginalName();//archivo recibido
            $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
            $extension = request('documento')->getClientOriginalExtension();//extensión
            $archivo= $filename.'_'.time().'.'.$extension;//
            request('documento')->storeAs('documentos/',$archivo,'public');//refiere carpeta publica es el nombre de disco
            $obj->documento = $archivo;
        }
        $obj->extension=$extension;
        $obj->fecha = request('fecha');
        $obj->hora = request('hora');
        $obj->user_id=auth()->user()->id;
        $obj->save();
        
        $filePath = public_path('storage/documentos/'.$archivo);
        $outputFilePath = public_path('storage/documentos/'.$archivo);
        $this->fillPDFFile_withCVDCode($filePath, $outputFilePath);
        // return response()->file($outputFilePath);
        return redirect()->route('documentos.create');
     
    }



    /**
     * Display the specified resource.
     */
    public function show(documentos $documentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(documentos $documentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, documentos $documentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(documentos $documentos)
    {
        //
    }
}
