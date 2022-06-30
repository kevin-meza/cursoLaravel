<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Datos Desde el form</h1>

    @if($nombre=='admin')
        Bienvenido {{$nombre}}

    @else
    Bienvenido:invitado
    @endif
    <hr>
   Bienvenido {{ ($nombre=='admin')?$nombre:'invitado'  }}
   <hr>

   @forelse($users as $user)
   <li>{{$user}}</li>
   @empty
<li>no users</li>
</body>
</html>
