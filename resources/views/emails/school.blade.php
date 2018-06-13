<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{$name}},Te Damos la bienvenida a nuestra plataforma virtual <strong>InterApp</strong>!</h2>
     <p>Tus datos Para administrar tu institucion son: </p>
    <p>correo: {{$email_add}}</p>
    <p>codigo: {{$codigo}}</p>
    <p>contraseña: {{$pass}}</p>
    <p>Puedes iniciar seción con tu correo electronico o codigo</p>
    <a href="{{ url('/')}}">Clic para entrar en a plataforma</a>
</body>
</html>