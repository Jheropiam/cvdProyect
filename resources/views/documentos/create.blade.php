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
                        <label for="">Seleccione Documento.pdf con firma electrónica para CVD(Max. 10MB)</label>
                        <input id="documento" class="form-control" type="file" name="documento" id="documento" onchange="validar_doc('documento','mensajeError')" accept=".pdf" required>
                        <p id="mensajeError" style="color: red;"></p>

                        {{-- <label for="">Seleccione Documento Adjunto.pdf(Max. 10MB)</label>
                        <input id="documento_adjunto" class="form-control" type="file" name="documento_adjunto" onchange="validar_doc('documento_adjunto','mensajeError2')" id="documento_adjunto" accept=".pdf" required>
                        <p id="mensajeError2" style="color: red;"></p> --}}
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
        
               
        function validar_doc(input,mensaje) {
            const archivoInput = document.getElementById(input);
            const mensajeError = document.getElementById(mensaje);
            // Verificar si se ha seleccionado un archivo
            if (archivoInput.files.length === 0) {
                mensajeError.textContent = 'Por favor, seleccione un archivo.';
                return;
            }
            // Obtener el tamaño del archivo en bytes
            const tamañoArchivo = archivoInput.files[0].size;
            // Definir el tamaño máximo permitido (en este ejemplo, 5 MB)
            const tamañoMaximo = 10 * 1024 * 1024; // 5 MB en bytes

            // Verificar si el archivo supera el tamaño máximo
            if (tamañoArchivo > tamañoMaximo) {
                mensajeError.textContent = 'El archivo seleccionado es demasiado grande. El tamaño máximo permitido es de 10 MB.';
                archivoInput.value = ''; // Borrar la selección del archivo
            } else {
                mensajeError.textContent = ''; // Limpiar mensaje de error si el archivo es válido
            }
            
        }


    </script>

    {{-- <script src="../../../assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="../../../assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script src="../../../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
    <script src="../../../assets/js/form-file-upload.js"></script> --}}
@endsection