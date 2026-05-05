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
            <div style="color:#ffffff;font-size:15px;">Área Jurídica</div>
          </td>
        </tr></table>
      </td></tr>

      <tr><td style="padding:36px 36px 0;">
        <p style="font-size:11px;color:#888;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 6px;">Confirmación de radicado</p>
        <h2 style="font-size:20px;font-weight:normal;color:#1a1a1a;margin:0 0 20px;">Su solicitud ha sido recibida</h2>
        <p style="font-size:14px;color:#555;line-height:1.7;margin:0 0 24px;">
          Estimado/a <strong style="color:#1a1a1a;">{{ explode(' ', $user->name)[0] }}</strong>,<br><br>
          Le informamos que el requerimiento de elaboración de contrato a nombre de
          <strong style="color:#1a1a1a;">{{ $contrato->nombre_razon }}</strong>
          ha sido recibido correctamente por el área jurídica y se encuentra en proceso de revisión.
        </p>
      </td></tr>

      <tr><td style="padding:0 36px 28px;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background:#f7f7f7;border:1px solid #e0e0e0;">
          <tr><td style="padding:20px 24px;">
            <p style="font-size:11px;color:#888;text-transform:uppercase;letter-spacing:1px;margin:0 0 8px;">Número de radicado</p>
            <p style="font-size:22px;color:#1a1a1a;font-family:monospace;margin:0;">{{ $contrato->consecutivo }}</p>
          </td></tr>
        </table>
      </td></tr>

      <tr><td style="padding:0 36px 28px;">
        <p style="font-size:13px;color:#555;line-height:1.7;margin:0 0 16px;">
          El equipo jurídico procederá a verificar la documentación adjunta y los soportes técnicos requeridos. Será notificado oportunamente cuando el contrato se encuentre listo para firma.
        </p>
        <p style="font-size:13px;color:#555;line-height:1.7;margin:0;">
          Si requiere información adicional sobre el estado de su solicitud, comuníquese directamente con el área jurídica.
        </p>
      </td></tr>

      <tr><td style="padding:0 36px 36px;border-top:1px solid #e0e0e0;">
        <p style="font-size:13px;color:#555;margin:20px 0 4px;">Cordialmente,</p>
        <p style="font-size:13px;color:#1a1a1a;margin:0;">Área Jurídica</p>
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