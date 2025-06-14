<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de Contacto</title>
    <style>
         div, h1, h2, p {
            font-family: Arial, sans-serif;
        }

    </style>
</head>
    <body>
            <div>
                <a href="https://www.afunabb.cl" style="text-decoration:none;"><img src="{{ asset('assets/images/logo.png') }}" width="240" alt="Logo Afunabb"></a>
                <h2>Mensaje de: {{ $contact->name }}</h2>
                <p><strong>Correo:</strong> {{ $contact->email }}</p>
                <p><strong>Motivo:</strong> {{ $contact->subject }}</p>
                <p><strong>Mensaje:</strong> {{ $contact->message }}</p>
            </div>

    </body>
</html>


