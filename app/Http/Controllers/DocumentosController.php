<?php

namespace App\Http\Controllers;

use App\Models\documentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;


use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

// use BaconQrCode\Renderer\Image\Png;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



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

     public function fillPDFFile_withCVDCode($file, $outputFilePath,$archivo)
     {

         $fpdi = new FPDI;
         $count = $fpdi->setSourceFile($file);
         $ajuste=-5;

         $codigo_cvd='0015 3824 1828 2104'; //aqui cambiar el código

        for ($i=1; $i<=$count; $i++) {
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
            $fpdi->SetFont("Courier", "", 8);
            $fpdi->SetTextColor(0,0,0);
            $alto_pagina=$fpdi->GetPageHeight();
            $text = "Esta  es  una  representación  impresa  cuya autenticidad  puede  ser";
            $fpdi->Text(40,$alto_pagina-30+$ajuste,utf8_decode($text));
            $text = "contrastada  con  la representación  imprimible localizada en la  sede";
            $fpdi->Text(40,$alto_pagina-27+$ajuste,utf8_decode($text));
            $text = "digital  de la Presidencia  del consejo de ministros.  La verificación";
            $fpdi->Text(40,$alto_pagina-24+$ajuste,utf8_decode($text));
            $text = "puede ser efectuada a partir del  05/01/2021 hasta el 05/04/2021. Base";
            $fpdi->Text(40,$alto_pagina-21+$ajuste,utf8_decode($text));
            $text = "Legal:  Decreto Legislativo N° 1412, Decreto  Supremo  N° 029-2021-PCM";
            $fpdi->Text(40,$alto_pagina-18+$ajuste,utf8_decode($text));
            $text = "yqrcode la Directiva N° 002-2021-PCM/SGTD";
            $fpdi->Text(40,$alto_pagina-15+$ajuste,utf8_decode($text));
            $fpdi->SetFont("Courier", "B", 8);
            $text = "URL: https://codigocvd.regionloreto.gob.pe/verifica-cvd";
            $fpdi->Text(40,$alto_pagina-9+$ajuste,utf8_decode($text));
            $text = "CVD: ".$codigo_cvd;
            $fpdi->Text(40,$alto_pagina-6+$ajuste,utf8_decode($text));



            
            $fpdi->Image($path, 150, 250); //inserta qr en archivo

         }

        return $fpdi->Output($outputFilePath, 'F');
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
        $this->fillPDFFile_withCVDCode($filePath, $outputFilePath,$archivo);
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
