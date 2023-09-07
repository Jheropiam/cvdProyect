@extends('bases.base')
@section('extra_css')
    {{-- <link href="../../../assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
    <link href="../../../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" /> --}}
@endsection
@section('content')
<div class="row" style="text-align: center">
    <h5>Cargue aquí su documento (Max. 1 Documento)</h5>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('documentos.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>Documento con CVD</p>
                        <input id="documento_adjunto" class="form-control" type="file" name="documento_adjunto" accept=".docx, .pdf" required>
                        
                        <br>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-send"></i>Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</div>
   
@endsection
@section('extra_js')

@endsection