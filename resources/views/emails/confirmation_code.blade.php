<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{$name}}, has sido registrado en la plataforma virtual <strong>InterApp</strong> !</h2>
     <p>Tus datos para ingresar a tu cuenta son: </p>
    <p>correo: {{$email}}</p>
    <p>codigo: {{$codigo}}</p>
    <p>contraseña: {{$pass}}</p>
    <p>Puedes iniciar seción con tu correo electronico o codigo</p>
    <a href="{{ url('/')}}">
        Clic para entrar en a plataforma</a>
</body>
</html>