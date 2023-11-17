@extends('bases.base')
@section('extra_css')
@endsection
@section('content')
<div class="row" >
    <h5>Subir documento</h5>
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('documentosadjuntos.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="documento_id" value="{{$documento_id}}" hidden readonly>
                        <div class="input-group">
                            <p style="color: red">(*)Obligatorio</p>
                            <label for="">Seleccione el documento (Max. 10MB-doc,docx,pdf)</label>
                        </div>
                        <input class="form-control" type="file" name="documento" id="documento" onchange="validar_doc('documento','mensajeError')" accept=".pdf, .docx, .doc, .xlsx" required>
                        <p id="mensajeError" style="color: red;"></p>
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
@endsection