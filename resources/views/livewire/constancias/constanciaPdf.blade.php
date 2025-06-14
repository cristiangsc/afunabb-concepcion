<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <title> Constancia PDF </title>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial, Helvetica, 'Raleway', sans-serif;
        }

        body {
            margin: 2cm 2cm 2cm;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #7d7d7d;
            color: white;
            text-align: center;
            line-height: 35px;
        }
        .pie{
            font-size: 11px;
        }
        .pt{
            margin-top: -10px;
        }

    </style>
</head>

<body>

<header>
    <img src="{{ asset('assets/images/logo.png') }}" width="250" height="70" alt="logo">
</header>
<br>
<div class="text-center"><h3>CONSTANCIA Nº {{ $constancia->id }} </h3></div>
<br>

<div>
    <p>Fecha :<?php echo date("d/m/Y"); ?></p>
    <p class="pt">Rut :{{rutFormat($constancia->rut_id)}}</p>
    <p class="pt">Nombres :<b class="text-uppercase">{{ $constancia->user->fullName }}</b></p>
    <p class="pt">Repartición :{{ $constancia->user->reparticion->name }}</p>
    <p class="pt">Fecha Participación: Inicio: {{$constancia->inicio}} Término: {{ $constancia->termino }} </p>
</div>

<br>
<p>El DIRECTORIO de la Asociación de Funcionarios no Académicos de la Universidad del Bío-Bío Chillán,
    deja constancia que el socio/a antes individualizado/a participó en: <b>{{ $constancia->descripcion }}.</b></p>
<br>
<br>
<p>Se entrega la presente Constancia para los fines que estime conveniente.</p>

<br>
<br>
<br>
<div class="text-center text-uppercase pie">
    <p>{{ $presidente->user->fullName }}</p>
    <p class="pt">Rut: {{ rutFormat($presidente->user->rut) }} </p>
    <p>Presidente(a) AFUNABB CHILLÁN</p>
</div>


<footer>
    <h2>www.afunabb.cl</h2>
</footer>
</body>
</html>
