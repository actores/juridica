<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;900&display=swap');
        body { margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Inter', sans-serif; }
        .main-card { max-width: 600px; margin: 40px auto; background-color: #000000; border: 1px solid #1a1a1a; overflow: hidden; }
        .header { background-color: #2563eb; padding: 40px 20px; text-align: center; }
        .content { padding: 50px 40px; text-align: center; color: #ffffff; }
        .font-bebas { font-family: 'Bebas Neue', sans-serif; text-transform: uppercase; }
        .status-tag { font-size: 10px; font-weight: 900; color: #2563eb; letter-spacing: 5px; text-transform: uppercase; margin-bottom: 10px; display: block; }
        .radicado-box { background-color: #080808; border: 2px dashed #333; padding: 30px 20px; margin: 30px 0; }
        .footer { padding: 30px; text-align: center; background-color: #000; border-top: 1px solid #1a1a1a; }
        .legal { font-size: 9px; color: #ffffff; opacity: 0.4; letter-spacing: 2px; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="main-card">
        <div class="header">
            <div style="font-size: 10px; font-weight: 800; letter-spacing: 5px; color: #000; margin-bottom: 15px;">ACTORES S.C.G.</div>
            <h1 class="font-bebas" style="font-size: 50px; color: #000; margin: 0; line-height: 0.9;">Solicitud<br><span style="color: #fff;">Procesada</span></h1>
        </div>

        <div class="content">
            <span class="status-tag">Confirmación de Radicado</span>
            <h2 class="font-bebas" style="font-size: 32px; margin-bottom: 10px;">Hola, {{ explode(' ', $user->name)[0] }}</h2>
            
            <p style="font-size: 13px; color: #888; line-height: 1.8; text-transform: uppercase; letter-spacing: 1px;">
                Tu requerimiento para la creación del contrato a nombre de 
                <span style="color: #fff; font-weight: 900;">"{{ $contrato->nombre_razon }}"</span> 
                ha sido recibido por el departamento jurídico.
            </p>

            <div class="radicado-box">
                <span class="status-tag" style="margin-bottom: 5px;">Tu número de radicado es:</span>
                <div class="font-bebas" style="font-size: 45px; color: #ffffff; letter-spacing: 3px;">{{ $contrato->consecutivo }}</div>
            </div>

            <p style="font-size: 11px; color: #555; text-transform: uppercase; letter-spacing: 1px; margin-top: 20px;">
                El equipo revisará los soportes técnicos y legales. <br>Recibirás una notificación cuando el contrato esté listo para firma.
            </p>
        </div>

        <div class="footer">
            <div class="legal">
                SISTEMA DE GESTIÓN DE CONTRATOS ACTORES S.C.G.<br>
                ESTE ES UN MENSAJE AUTOMÁTICO • NO RESPONDER
            </div>
        </div>
    </div>
</body>
</html>