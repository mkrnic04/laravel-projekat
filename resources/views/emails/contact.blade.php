<!DOCTYPE html>
<html>
<head>
    <title>Kontakt</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Imate novu poruku sa kontakt forme!</h2>
    <p><strong>Ime pošiljaoca:</strong> {{ $data['name'] }}</p>
    <p><strong>Email pošiljaoca:</strong> {{ $data['email'] }}</p>
    <hr>
    <p><strong>Poruka:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
