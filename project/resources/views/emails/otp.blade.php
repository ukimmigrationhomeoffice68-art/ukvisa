<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Your GOV.UK security code</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f2f1; -webkit-text-size-adjust:100%; font-family: Helvetica, Arial, sans-serif; color:#0b0c0c;">

  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3f2f1;">
    <tr>
      <td align="center" style="padding: 24px 16px;">

        {{-- Main card --}}
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%; background-color:#ffffff;">

          {{-- GOV.UK black header with blue underline --}}
          <tr>
            <td style="background-color:#0b0c0c; border-bottom:10px solid #1d70b8; padding:14px 24px;">
              <span style="color:#ffffff; font-size:26px; font-weight:700; letter-spacing:0.5px;">GOV.UK</span>
            </td>
          </tr>

          {{-- Body --}}
          <tr>
            <td style="padding: 32px 24px 8px 24px;">
              <p style="margin:0 0 6px 0; font-size:16px; color:#505a5f;">Sign in</p>
              <h1 style="margin:0 0 20px 0; font-size:26px; line-height:1.25; font-weight:700; color:#0b0c0c;">
                Your security code
              </h1>
              <p style="margin:0 0 24px 0; font-size:16px; line-height:1.55; color:#0b0c0c;">
                Use the security code below to sign in to your UKVI account and view your immigration status (eVisa).
              </p>
            </td>
          </tr>

          {{-- Code block --}}
          <tr>
            <td style="padding: 0 24px 24px 24px;">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                  <td style="background-color:#f3f2f1; border-left:5px solid #1d70b8; padding:18px 24px;">
                    <span style="font-size:40px; font-weight:700; letter-spacing:8px; color:#0b0c0c; font-family: 'Courier New', Courier, monospace;">{{ $otp }}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          {{-- Notes --}}
          <tr>
            <td style="padding: 0 24px 8px 24px;">
              <p style="margin:0 0 16px 0; font-size:16px; line-height:1.55; color:#0b0c0c;">
                This code will expire in <strong>10 minutes</strong>.
              </p>
              <p style="margin:0 0 28px 0; font-size:16px; line-height:1.55; color:#505a5f;">
                If you did not request this code, you can ignore this email.
              </p>
            </td>
          </tr>

          {{-- Divider --}}
          <tr>
            <td style="padding: 0 24px;">
              <hr style="border:0; border-top:1px solid #b1b4b6; margin:0;">
            </td>
          </tr>

          {{-- Footer note --}}
          <tr>
            <td style="padding: 18px 24px 28px 24px;">
              <p style="margin:0; font-size:14px; line-height:1.5; color:#505a5f;">
                This is an automated message from GOV.UK. Please do not reply to this email.
              </p>
            </td>
          </tr>

        </table>

        {{-- Crown copyright --}}
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%;">
          <tr>
            <td style="padding:16px 24px; text-align:center;">
              <span style="font-size:12px; color:#505a5f;">&copy; Crown copyright</span>
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>

</body>
</html>
