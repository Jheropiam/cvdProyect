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
                    <form action="{{route('documentos.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="">Seleccione Documento para CVD</label>
                        <input id="documento" class="form-control" type="file" name="documento" accept=".doc, .docx, .pdf,.png,.jpg" required>
                        <label for="">Seleccione Documento Adjunto(Firmado Electrónicamente)</label>
                        <input id="documento_adjunto" class="form-control" type="file" name="documento_adjunto" accept=".pdf" required>
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
        
        // input.addEventListener('change', function(evt){
        //     var i = 0, len = input.files.length, img, reader, file;
        //     if (len > 2) {
        //         alert('Solo puedes seleccionar 2 imágenes');
        //         input.value = '';
        //         return false;
        //     }

    </script>

    {{-- <script src="../../../assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script src="../../../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script src="../../../assets/js/form-file-upload.js"></script> --}}
@endsection