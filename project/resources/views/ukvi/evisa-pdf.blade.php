<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <style>
    @page { margin: 0; }
    * { box-sizing: border-box; }
    body {
      font-family: "DejaVu Sans", Arial, Helvetica, sans-serif;
      color: #0b0c0c;
      margin: 0;
      padding: 0;
      font-size: 13px;
      line-height: 1.4;
    }
    .page {
      padding: 0 40px 40px 40px;
      page-break-after: always;
      position: relative;
      min-height: 1080px;
    }
    .page:last-child { page-break-after: auto; }

    /* GOV.UK header bar */
    .greenwebproject-header {
      background: #0b0c0c;
      border-bottom: 8px solid #1d70b8;
      padding: 12px 40px;
      margin: 0 -40px 0 -40px;
    }
    .greenwebproject-header .brand {
      color: #ffffff;
      font-size: 26px;
      font-weight: bold;
      vertical-align: middle;
    }
    .greenwebproject-header .service {
      color: #ffffff;
      font-size: 19px;
      vertical-align: middle;
    }
    .greenwebproject-header .divider {
      color: #ffffff;
      font-size: 22px;
      padding: 0 10px;
      vertical-align: middle;
    }

    /* Beta banner */
    .beta-banner {
      border-bottom: 1px solid #b1b4b6;
      padding: 10px 0;
      margin-bottom: 6px;
      font-size: 13px;
    }
    .beta-tag {
      background: #1d70b8;
      color: #ffffff;
      font-weight: bold;
      font-size: 11px;
      padding: 2px 8px;
      text-transform: uppercase;
      margin-right: 8px;
    }
    .back-link { font-size: 14px; color: #0b0c0c; margin: 14px 0; }

    h1 { font-size: 30px; font-weight: bold; margin: 18px 0 22px 0; line-height: 1.15; }
    h2 { font-size: 22px; font-weight: bold; margin: 22px 0 12px 0; }
    h3 { font-size: 18px; font-weight: bold; margin: 18px 0 10px 0; }

    table.details { width: 100%; border-collapse: collapse; }
    table.details td {
      border-bottom: 1px solid #b1b4b6;
      padding: 10px 8px 10px 0;
      vertical-align: top;
      font-size: 14px;
    }
    table.details td.label { font-weight: bold; width: 200px; }

    .photo-box { width: 150px; }
    .photo-box img { width: 150px; height: auto; border: 1px solid #b1b4b6; display: block; }
    .rotate-btn {
      display: inline-block;
      margin-top: 6px;
      background: #f3f2f1;
      border: 1px solid #b1b4b6;
      padding: 5px 12px;
      font-size: 13px;
    }

    p { margin: 0 0 14px 0; font-size: 14px; }

    /* Share code page */
    .share-label { font-size: 15px; font-weight: bold; margin-bottom: 4px; }
    .share-code {
      font-size: 34px;
      font-weight: bold;
      margin: 0 0 14px 0;
      letter-spacing: 1px;
    }
    .valid-note {
      border-left: 4px solid #b1b4b6;
      padding-left: 14px;
      font-size: 14px;
      margin-bottom: 26px;
    }
    ol.steps { padding-left: 20px; margin: 0; }
    ol.steps li { margin-bottom: 14px; font-size: 14px; line-height: 1.5; }
    a { color: #1d70b8; }

    .pdf-footer {
      position: absolute;
      bottom: 30px;
      left: 40px;
      right: 40px;
      font-size: 11px;
      color: #505a5f;
    }
    .pdf-footer .url { float: left; }
    .pdf-footer .pageno { float: right; }
  </style>
</head>
<body>

@php
  // Embed photo as base64 so dompdf can render it.
  $photoData = null;
  if (!empty($user->photo_path)) {
      if (str_starts_with($user->photo_path, 'data:image/')) {
          $photoData = $user->photo_path;
      } else {
          $candidates = [
              storage_path('app/public/' . $user->photo_path),
              public_path('storage/' . $user->photo_path),
              '/tmp/storage/app/public/' . $user->photo_path,
              '/tmp/' . $user->photo_path,
          ];
          foreach ($candidates as $photoFile) {
              if (is_file($photoFile)) {
                  $ext = strtolower(pathinfo($photoFile, PATHINFO_EXTENSION));
                  $mime = $ext === 'png' ? 'image/png' : 'image/jpeg';
                  $photoData = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($photoFile));
                  break;
              }
          }
      }
  }
@endphp

{{-- ============ PAGE 1: Immigration status ============ --}}
<div class="page">
  <div class="greenwebproject-header">
    <span class="brand">GOV.UK</span>
    <span class="divider">|</span>
    <span class="service">View and prove your immigration status</span>
  </div>

  <div class="beta-banner">
    <span class="beta-tag">Beta</span>
    This is a new service &ndash; your <a href="#">feedback</a> will help us to improve it.
  </div>

  <div class="back-link">← Back</div>

  <h1>Your immigration status (eVisa)</h1>

  <table style="width: 100%; border-collapse: collapse;">
    <tr>
      <td style="vertical-align: top; padding-right: 30px;">
        <table class="details">
          <tr><td class="label">Name</td><td>{{ $user->name }}</td></tr>
          <tr><td class="label">Date of birth</td><td>{{ $user->date_of_birth ? $user->date_of_birth->format('d/m/Y') : 'N/A' }}</td></tr>
          <tr><td class="label">Nationality</td><td>{{ $user->nationality ?? 'N/A' }}</td></tr>
          <tr><td class="label">Status</td><td>{{ $user->status ?? 'N/A' }}</td></tr>
          <tr><td class="label">Valid from</td><td>{{ $user->valid_from ? $user->valid_from->format('j F Y') : 'N/A' }}</td></tr>
          <tr><td class="label">Valid until</td><td>{{ $user->valid_until ? $user->valid_until->format('j F Y') : 'N/A' }}</td></tr>
          <tr><td class="label">National Insurance number</td><td>{{ $user->national_insurance_number ?? 'N/A' }}</td></tr>
        </table>
      </td>
      <td class="photo-box" style="vertical-align: top; width: 150px;">
        @if($photoData)
          <img src="{{ $photoData }}" alt="Photo of {{ $user->name }}">
        @endif
      </td>
    </tr>
  </table>

  <p style="margin-top: 26px;">
    You can stay in the UK until you receive a decision on your application, even if this is after
    {{ $user->valid_until ? $user->valid_until->format('j F Y') : 'your expiry date' }}.
    This includes during any appeal or administrative review that was made in the UK within the required deadlines.
  </p>

  <h2>Prove your status</h2>
  <p>If you need to prove your immigration status to someone, you can do this online with a share code.</p>

  <table style="border-collapse: collapse; margin-top: 4px;"><tr><td style="background: #00703c; padding: 10px 16px;">
    <span style="color: #ffffff; font-weight: bold; font-size: 15px;">Get a share code</span>
  </td></tr></table>
</div>

{{-- ============ PAGE 2: Details you need to share ============ --}}
<div class="page">
  <div class="greenwebproject-header">
    <span class="brand">GOV.UK</span>
  </div>

  <h1 style="margin-top: 30px;">Details you need to share</h1>

  <div class="share-label">Share code</div>
  <div class="share-code">{{ $shareCode }}</div>

  <div class="valid-note">
    This code is valid until {{ $user->valid_until ? $user->valid_until->format('j F Y') : ($user->code_valid_until ? $user->code_valid_until->format('j F Y') : 'N/A') }}.
  </div>

  <h3>What to do next</h3>
  <ol class="steps">
    <li>Give this share code and your date of birth to the person you want to prove your status to.</li>
    <li>To see your status, they must enter the share code and your date of birth at <a href="https://www.gov.uk/check-immigration-status">www.gov.uk/check-immigration-status</a>.</li>
    <li>Contact them to make sure they have all the information they need.</li>
  </ol>

  <div class="pdf-footer">
    <span class="url">https://gov.uk/evisa/view-evisa-get-share-code-prove-immigration-status/share/someone-else/code</span>
    <span class="pageno">1/1</span>
  </div>
</div>

</body>
</html>
