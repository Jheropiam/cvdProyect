@extends('bases.base')
@section('extra_css')
    {{-- <link href="../../../assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
    <link href="../../../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" /> --}}
@endsection
@section('content')
<div class="row" style="text-align: center">
    <h5>Cargue aquí su documento</h5>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('documentos.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="">Seleccione Documento para CVD (Max. 20MB)</label>
                        <input id="documento" class="form-control" type="file" name="documento" id="documento" accept=".pdf" required>
                        <label for="">Seleccione Documento Adjunto(Firmado Electrónicamente Max. 20MB)</label>
                        <input id="documento_adjunto" class="form-control" type="file" name="documento_adjunto" id="documento_adjunto" accept=".pdf" required>
                        <input type="text" id="fecha" name="fecha" hidden>
                        <input type="hora" id="hora" name="hora" hidden>
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
    <script>
        setInterval(muestrahora, 1000);
        function muestrahora() { 
            var hoy = new Date();
            hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
            document.getElementById("hora").value = hora;    
        }
        var fecha = new Date();
        document.getElementById("fecha").value = fecha.toJSON().slice(0, 10);
        

        var imgsize = document.getElementsByClassName("documento")[0].files[0].size;
        if(imgsize > 1000){
            alert('El documento supera los 20MB.');
        }
        
        var imgsize2 = document.getElementsByClassName("documento_adjunto")[0].files[0].size;
        if(imgsize2 > 1000){
            alert('El documento adjunto supera los 20MB.');
        }
        

    </script>

    {{-- <script src="../../../assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script src="../../../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script src="../../../assets/js/form-file-upload.js"></script> --}}
@endsection