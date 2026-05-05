<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Contrato - Actores S.C.G.</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;700;900&display=swap');

        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f7;
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            color: #ffffff;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f4f7;
            padding-bottom: 60px;
        }

        .main-card {
            max-width: 600px;
            margin: 40px auto;
            background-color: #000000;
            border: 1px solid #1a1a1a;
            overflow: hidden;
            box-shadow: 0 50px 100px -20px rgba(0,0,0,0.3);
        }

        .industrial-header {
            background-color: #2563eb; /* Azul Principal */
            padding: 60px 20px;
            text-align: center;
            border-bottom: 15px solid #000000;
            position: relative;
        }

        .hud-tag {
            display: inline-block;
            background-color: #000000;
            color: #ffffff;
            font-family: monospace;
            font-size: 10px;
            padding: 5px 15px;
            letter-spacing: 4px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .font-bebas {
            font-family: 'Bebas Neue', 'Arial Black', sans-serif;
        }

        .main-title {
            font-size: 60px;
            line-height: 0.85;
            color: #000000;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .content {
            padding: 50px 40px;
            text-align: center;
        }

        .welcome-tag {
            font-size: 12px;
            color: #2563eb;
            font-weight: 900;
            letter-spacing: 5px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .info-text {
            font-size: 13px;
            line-height: 1.8;
            color: #888888;
            margin-bottom: 35px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .data-highlight {
            color: #ffffff;
            font-weight: 900;
            border-bottom: 2px solid #2563eb;
        }

        .radicado-box {
            background-color: #080808;
            border: 2px dashed #333;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 40px;
        }

        .radicado-label {
            font-size: 10px;
            font-weight: 900;
            color: #2563eb;
            letter-spacing: 5px;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }

        .radicado-code {
            font-size: 42px;
            color: #ffffff;
            letter-spacing: 4px;
            line-height: 1;
            text-transform: uppercase;
        }

        .specs-container {
            text-align: left;
            background-color: #111;
            padding: 25px;
            border-left: 4px solid #2563eb;
            margin-bottom: 40px;
        }

        .spec-item {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            color: #aaa;
        }

        .spec-value {
            color: #fff;
            font-weight: bold;
        }

        .action-container {
            background-color: #ffffff;
            padding: 60px 30px;
            text-align: center;
        }

        .btn-industrial {
            background-color: #000000;
            color: #ffffff !important;
            padding: 20px 35px;
            text-decoration: none;
            font-size: 22px;
            letter-spacing: 2px;
            display: inline-block;
            border: 4px solid #000000;
            box-shadow: 8px 8px 0px #2563eb;
            text-transform: uppercase;
        }

        .footer {
            padding: 50px 20px;
            text-align: center;
            background-color: #000000;
        }

        .footer-legal {
            font-size: 9px;
            color: #ffffff;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 2;
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main-card">
            {{-- Header Branding --}}
            <div style="background-color: #000; padding: 40px 0 30px 0; border-bottom: 1px solid #1a1a1a; text-align: center;">
                <div style="color: #ffffff; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 4px;">
                    ACTORES S.C.G. | GESTIÓN JURÍDICA
                </div>
            </div>

            {{-- Main Industrial Header --}}
            <div class="industrial-header">
                <div class="hud-tag"><span style="color: #ffffff;">●</span> SYSTEM_CORE</div>
                <h1 class="font-bebas main-title">
                    CONTRATO<br><span style="color: #ffffff; letter-spacing: 3px;">REGISTRADO</span>
                </h1>
                <div style="font-size: 10px; color: #000; letter-spacing: 6px; margin-top: 20px; font-weight: 900; text-transform: uppercase; opacity: 0.8;">
                    NUEVA SOLICITUD GENERADA
                </div>
            </div>

            <div class="content">
                <div class="welcome-tag font-bebas">SISTEMA DE RADICACIÓN</div>
                <div class="font-bebas" style="font-size: 32px; color: white; margin-bottom: 25px;">CONTROL DE EXPEDIENTES</div>

                <p class="info-text">
                    SE HA FORMALIZADO EL REGISTRO DE UN NUEVO DOCUMENTO EN EL SISTEMA MAESTRO. 
                    POR FAVOR, REVISE LOS ADJUNTOS PARA VALIDACIÓN TÉCNICA.
                </p>

                {{-- Consecutivo Box --}}
                <div class="radicado-box">
                    <span class="radicado-label">CONSECUTIVO DE RADICADO</span>
                    <div class="font-bebas radicado-code">{{ $contrato->consecutivo }}</div>
                </div>

                {{-- Especificaciones Técnicas --}}
                <div class="specs-container font-bebas">
                    <div class="spec-item">Contratista: <span class="spec-value">{{ mb_strtoupper($contrato->nombre_razon) }}</span></div>
                    <div class="spec-item">Valor Total: <span class="spec-value">${{ number_format($contrato->valor_total, 2) }}</span></div>
                    <div class="spec-item" style="margin-bottom: 0;">Objeto: <span class="spec-value" style="font-family: 'Inter', sans-serif; font-size: 10px;">{{ $contrato->objeto }}</span></div>
                </div>

                <div class="action-container">
                    <div class="font-bebas" style="font-size: 24px; color: #000; margin-bottom: 20px; text-transform: uppercase;">Acceso a la Consola de Gestión</div>

                    <a href="{{ route('dashboard') }}" class="font-bebas btn-industrial">
                        GESTIONAR CONTRATO →
                    </a>

                    <div style="margin-top: 40px;">
                        <p style="color: #666; font-size: 10px; text-transform: uppercase; font-weight: 900; letter-spacing: 1px;">
                            Encuentre adjunto el borrador en Word<br>y los soportes legales en PDF.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="footer">
                <div class="footer-legal">
                    ACTORES S.C.G. | SOCIEDAD COLOMBIANA DE GESTIÓN<br>
                    DEPARTAMENTO DE TECNOLOGÍA Y SISTEMAS<br>
                    <span style="color: #2563eb; display: block; margin-top: 15px; font-weight: bold;">NOTIFICACIÓN AUTOMÁTICA • NO RESPONDER</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>