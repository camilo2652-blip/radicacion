<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            color: #333;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .title {
            color: #2563eb;
            font-size: 22px;
            font-weight: bold;
        }
        .numero {
            font-size: 20px;
            color: #16a34a;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card">
        <p class="title">📄 Confirmación de radicación</p>
        <p>Estimado(a) {{ $radicado->user->nombre }},</p>

        <p>Su documento ha sido radicado correctamente en el sistema.</p>

        <p><strong>Número de radicado:</strong> 
            <span class="numero">{{ $radicado->numero }}</span>
        </p>

        <p><strong>Asunto:</strong> {{ $radicado->asunto }}</p>

        <p>Puede consultar el estado de su radicado en su panel de ciudadano.</p>

        <br>
        <p>Atentamente,</p>
        <p><strong>Alcaldía de Angostura, Antioquia</strong></p>
        <p><strong>Calle 11 # 9 38</strong></p>
        <p><strong>+57 (604) 8645161</strong></p>
    </div>
</body>
</html>
