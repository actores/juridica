<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#f4f4f7;font-family:Arial,Helvetica,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0">
  <tr><td align="center" style="padding:40px 20px;">
    <table width="580" cellpadding="0" cellspacing="0" style="background:#ffffff;border:1px solid #e0e0e0;">

      <tr><td style="background:#1a3a5c;padding:28px 36px;">
        <table cellpadding="0" cellspacing="0"><tr>
          <td style="width:3px;background:rgba(255,255,255,0.3);padding:0;">&nbsp;</td>
          <td style="padding-left:16px;">
            <div style="color:rgba(255,255,255,0.6);font-size:10px;letter-spacing:2px;text-transform:uppercase;margin-bottom:4px;">Actores S.C.G.</div>
            <div style="color:#ffffff;font-size:15px;">Sistema de Gestión de Contratos</div>
          </td>
        </tr></table>
      </td></tr>

      <tr><td style="padding:36px 36px 0;">
        <p style="font-size:11px;color:#888;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 6px;">Nuevo registro</p>
        <h2 style="font-size:20px;font-weight:normal;color:#1a1a1a;margin:0 0 20px;">Contrato pendiente de revisión</h2>
        <p style="font-size:14px;color:#555;line-height:1.7;margin:0 0 24px;">
          Se ha registrado una nueva solicitud de elaboración de contrato en el sistema. A continuación se relacionan los datos del expediente para su gestión.
        </p>
      </td></tr>

      <tr><td style="padding:0 36px 24px;">
        <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e0e0e0;">
          <tr><td style="background:#f7f7f7;padding:10px 16px;border-bottom:1px solid #e0e0e0;">
            <span style="font-size:11px;color:#888;text-transform:uppercase;letter-spacing:1px;">Datos del expediente</span>
          </td></tr>
          <tr style="border-bottom:1px solid #e0e0e0;">
            <td style="padding:12px 16px;color:#888;font-size:13px;width:40%;border-bottom:1px solid #e0e0e0;">Consecutivo</td>
            <td style="padding:12px 16px;color:#1a1a1a;font-size:13px;font-family:monospace;border-bottom:1px solid #e0e0e0;">{{ $contrato->consecutivo }}</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:#888;font-size:13px;border-bottom:1px solid #e0e0e0;">Contratista</td>
            <td style="padding:12px 16px;color:#1a1a1a;font-size:13px;font-weight:bold;border-bottom:1px solid #e0e0e0;">{{ $contrato->nombre_razon }}</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:#888;font-size:13px;border-bottom:1px solid #e0e0e0;">Identificación</td>
            <td style="padding:12px 16px;color:#1a1a1a;font-size:13px;border-bottom:1px solid #e0e0e0;">{{ $contrato->tipo_id }} {{ $contrato->id_nit }}</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:#888;font-size:13px;border-bottom:1px solid #e0e0e0;">Valor del contrato</td>
            <td style="padding:12px 16px;color:#1a1a1a;font-size:13px;font-weight:bold;border-bottom:1px solid #e0e0e0;">${{ number_format($contrato->valor_total, 2) }}</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:#888;font-size:13px;border-bottom:1px solid #e0e0e0;">Vigencia</td>
            <td style="padding:12px 16px;color:#1a1a1a;font-size:13px;border-bottom:1px solid #e0e0e0;">{{ $contrato->fecha_inicio->format('d/m/Y') }} — {{ $contrato->fecha_fin->format('d/m/Y') }}</td>
          </tr>
          <tr>
            <td style="padding:12px 16px;color:#888;font-size:13px;vertical-align:top;">Objeto</td>
            <td style="padding:12px 16px;color:#1a1a1a;font-size:13px;line-height:1.6;">{{ $contrato->objeto }}</td>
          </tr>
        </table>
      </td></tr>

      <tr><td style="padding:0 36px 28px;">
        <p style="font-size:13px;color:#555;line-height:1.7;margin:0;">
          Se adjunta a este correo el borrador del contrato en formato Word para su revisión. Por favor, verifique que la información sea correcta y proceda con los pasos establecidos en el protocolo interno.
        </p>
      </td></tr>

      <tr><td style="padding:0 36px 36px;border-top:1px solid #e0e0e0;">
        <p style="font-size:13px;color:#555;margin:20px 0 4px;">Generado automáticamente por el</p>
        <p style="font-size:13px;color:#1a1a1a;margin:0;">Sistema de Gestión de Contratos</p>
        <p style="font-size:12px;color:#888;margin:0;">Actores S.C.G.</p>
      </td></tr>

      <tr><td style="background:#f7f7f7;border-top:1px solid #e0e0e0;padding:14px 36px;">
        <table width="100%"><tr>
          <td style="font-size:11px;color:#aaa;">Sistema de Gestión de Contratos</td>
          <td align="right" style="font-size:11px;color:#aaa;">Notificación automática — No responder</td>
        </tr></table>
      </td></tr>

    </table>
  </td></tr>
</table>
</body>
</html>