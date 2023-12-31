<?php

namespace App\Http\Controllers;

use App\Models\documentos;
use App\Models\documentosadjuntos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;

use App\Custom\CvdController;//de ginovski
use App\Custom\Qrcodeg;//de ginovski
use DB;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = DB::table('documentos')
        ->where('documentos.estado','=',true)
        ->where('documentos.user_id','=',auth()->user()->id)
        ->get();
        $documentos_adjuntos = documentosadjuntos::all();
        $eliminado='';
        $creado='';
        return view('documentos.index',['documentos'=>$documentos,'eliminado'=>$eliminado,'creado'=>$creado,'documentos_adjuntos'=>$documentos_adjuntos]);
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

     public function fillPDFFile_withCVDCode($file, $outputFilePath,$ultimo_id,$fecha_registro)
     
     {
        $fpdi = new FPDI;
        $count = $fpdi->setSourceFile($file);
        $ajuste=-5;
        $codigo_cvd=CvdController::makeCvd(); //aqui cambiar el código
        
        // Genera el código QR
        $path=public_path('storage/qrcodes/'.$codigo_cvd.'.png');    
        $texto_codificar=asset('https://consultacvd.regionloreto.gob.pe/verifica-cvd');//Aqui será cambiado a la url de 
        // Guarda el código QR en el disco público
        $Qrlib = new Qrcodeg($texto_codificar,$path);
        $Qrlib->makeQR();
        // dd($ruta);
        
        for ($i=1; $i<=$count; $i++) {
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
            if ($i==1) {
                $fpdi->SetFont("Courier", "", 8);
                $fpdi->SetTextColor(0,0,0);
                $alto_pagina=$fpdi->GetPageHeight();
                $text = "Esta es una representación impresa cuya autenticidad puede  ser  contrastada";
                $fpdi->Text(38,$alto_pagina-50+$ajuste,utf8_decode($text));
                $text = "con la representación imprimible localizada en la sede digital  del Gobierno";
                $fpdi->Text(38,$alto_pagina-47+$ajuste,utf8_decode($text));
                $text = "Regional de Loreto. La representación imprimible ha sido generada atendiendo";
                $fpdi->Text(38,$alto_pagina-44+$ajuste,utf8_decode($text));
                $text = "lo dispuesto en la Directiva N° 003-2021-PCM/SGTD.La verificación  puede ser";
                $fpdi->Text(38,$alto_pagina-41+$ajuste,utf8_decode($text));
                $text = "efectuada a partir del ". $fecha_registro. ". Base Legal: Decreto  Legislativo N° 1412,";
                $fpdi->Text(38,$alto_pagina-38+$ajuste,utf8_decode($text));
                $text = "Decreto Supremo N° 029-2021-PCM y la Directiva N° 002-2021-PCM/SGTD.";
                $fpdi->Text(38,$alto_pagina-35+$ajuste,utf8_decode($text));
                $fpdi->SetFont("Courier", "B", 10);
                $text = "URL: https://consultacvd.regionloreto.gob.pe/verifica-cvd";
                $fpdi->Text(38,$alto_pagina-29+$ajuste,utf8_decode($text));
                $text = "CVD: ".$codigo_cvd;
                $fpdi->Text(38,$alto_pagina-26+$ajuste,utf8_decode($text));
                $fpdi->Image('storage/qrcodes/'.$codigo_cvd.'.png', 170, $alto_pagina-50+$ajuste); //inserta qrcode en archivo  
            }
            
        }
        $doc=documentos::findOrFail($ultimo_id);
        $doc->cvd=$codigo_cvd;
        $doc->save();
        
        return $fpdi->Output($outputFilePath, 'F');
        
  
     }

    public function store(Request $request)
    {
        $obj = new documentos();
        
        $extension='';
        $archivo='';
        
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
        $ultimo_id=$obj->id;
        $fecha_registro=$obj->fecha;

        if ($request->hasFile('documento_adjunto')){
            $files=$request->file('documento_adjunto');
            foreach ($files as $f) {
                
                $obj_adjuntos = new documentosadjuntos();
                $file = $f->getClientOriginalName();//archivo recibido
                $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
                $extension_adjunto = $f->getClientOriginalExtension();//extensión
                $archivo_adjunto= $filename.'_'.time().'.'.$extension_adjunto;//
                $f->storeAs('documentos_adjuntos/',$archivo_adjunto,'public');//refiere carpeta publica es el nombre de disco
                $obj_adjuntos->documento = $archivo_adjunto;
                $obj_adjuntos->documentos_id=$ultimo_id;
                $obj_adjuntos->documento=$archivo_adjunto;
                $obj_adjuntos->extension=$extension_adjunto;
                $obj_adjuntos->save();
            }
        }

        $filePath = public_path('storage/documentos/'.$archivo);
        $outputFilePath = public_path('storage/documentos/'.$archivo);
        $this->fillPDFFile_withCVDCode($filePath, $outputFilePath,$ultimo_id,$fecha_registro);
        
        $documentos = documentos::all()->where('estado',true);
        // $creado='si';
        // $eliminado='';
        return redirect()->route('documentos.index')->with('mensaje','Registro guardado');
        // return view('documentos.index',['documentos'=>$documentos,'creado'=>$creado,'eliminado'=>$eliminado]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $codigo=request('codigo');
        $codigo=str_replace(' ', '', $codigo);
        $doc=documentos::where('cvd','=',$codigo)->where('estado','=',1)->get();
        $id_doc=$doc->first();

        if ($doc->count()>0){
            $msje='existe';
            $doc_adjuntos=documentosadjuntos::where('documentos_id','=',$id_doc->id)
            ->select('documento')
            ->get();
        }else{
            $msje='noexiste';
            $doc_adjuntos=['data'=>'No existend datos'];
        }
        
        // dd($doc_adjuntos);

        return view('plantillas.home_public',['mensaje'=>$msje,'doc'=>$doc,'doc_adjuntos'=>$doc_adjuntos]);
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
    public function destroy(Request $request)
    {
        $id=request('iddocumento');
        $doc=documentos::findOrFail($id);
        $doc->estado=0;
        $doc->save();
        return redirect()->route('documentos.index')->with('mensaje','Registro eliminado');
    }
}
