<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saludo de Cumpleaños</title>
    <style>
        table, td, div, h1, p {
            font-family: Arial, sans-serif;
        }
        @media screen and (max-width: 800px) {
            .unsub {
                display: block;
                padding: 8px;
                margin-top: 14px;
                border-radius: 6px;
                background-color: #555555;
                text-decoration: none !important;
                font-weight: bold;
            }
            .col-lge {
                max-width: 100% !important;
            }
        }
        @media screen and (min-width: 801px) {
            .col-sml {
                max-width: 27% !important;
            }
            .col-lge {
                max-width: 73% !important;
            }
        }
    </style>
</head>
<body style="margin:0;padding:0;word-spacing:normal;background-color:#939297;">
<div role="article" aria-roledescription="email" lang="es" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#939297;">
    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:100%;max-width:800px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">

                    <tr>
                        <td style="padding:30px;background-color:#ffffff;">
                            <h1 style="margin-top:0;margin-bottom:5px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em; text-align:center; color:#060479; ">La Asociación de Funcionarios no Académicos</h1>
                            <h1 style="margin-top:0;margin-bottom:5px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em; text-align:center; color:#060479; ">AFUNABB CHILLÁN</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:0;font-size:24px;line-height:28px;font-weight:bold;">
                            <img src="{{asset($contenido['imagen'])}}" width="800" alt="Happy Birthday" style="width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">

                            <p style="margin-top:0;margin-bottom:12px; color:#060479; text-align:justify;"><strong>{{ $contenido['nombre'] }}</strong>, {{ $contenido['saludo'] }} .</p>
                            <p style="margin-top:0;margin-bottom:12px; color:#060479; text-align:center;"><strong>¡FELIZ CUMPLEAÑOS COLEGA!</strong>.</p>

                        </td>
                    </tr>

                    <tr>

                        <td style="padding:30px;background-color:#ffffff;">
                            <a href="http://www.afunabb.cl/" style="text-decoration:none;"> <img src="{{ asset('assets/images/logo.png') }}" width="240" alt="Logo"></a>
                        </td>

                    </tr>

                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
