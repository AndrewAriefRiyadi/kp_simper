<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verifikasi</title>
</head>
<body>
    <p>Halo {{ $user->name }},</p>
    <p>Terima kasih telah mendaftar di situs kami. Untuk melengkapi proses pendaftaran, silakan verifikasi alamat email Anda dengan menekan tombol di bawah ini:</p>
    <p> Form Pendaftaran :</p>
    <p> Nama : {{ $user->name }} </p>
    <p> Instansi : {{ $user->instansi }} </p>
    <p> No Badge : {{ $user->no_badge }} </p>
    <p> E-Mail : {{ $user->email }} </p>
    <a href="{{ $verificationUrl }}" style="display: inline-block; background-color: #4CAF50; color: white; padding: 15px 25px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 10px;">Verifikasi Email</a>
    <p>Jika Anda tidak mendaftar di situs kami, abaikan email ini.</p>
    <p>Terima kasih,</p>
    <p>Tim Kami</p>
</body>
</html>
