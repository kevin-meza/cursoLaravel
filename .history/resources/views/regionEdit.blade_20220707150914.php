@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificar Region</h1>
{{-- {{dd($region)}} --}}
    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/region/update" method="post">
            @csrf
            <div class="form-group">
                <label for="regNombre">Nombre de la región</label>
                <input type="text" name="regNombre" value="{{$region->regNombre}}"

                       class="form-control" id="regNombre" required>
            </div>
            <input type="hidden" name="idRegion" value="{{$region->idRegion}}">


            <button class="btn btn-dark my-3 px-4">Modificar región</button>
            <a href="/regiones/edit" class="btn btn-outline-secondary">
                Volver a panel de regiones
            </a>
        </form>
    </div>
<script>function disa(){
    $('#aceptar').click(function(e){
    $('#aceptar').prop('disabled', true);
    setTimeout(function() {
        $('#aceptar').prop('disabled', false);
    }, 5000);
    $('#console').html('<br />Disabled');
    });
}</script>
@endsection
