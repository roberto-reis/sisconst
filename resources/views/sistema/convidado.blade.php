<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        div{
            width: 620px;
            height: auto;
            margin: 50px auto;
            color: #555;
            font-size: 18px;
        }
        form{
            display: inline-block;
        }
    </style>
</head>
<body>
    <div>
        <h2>Olá <b> {{ $user->name }}</b>, seu cadastro foi efetuado com sucesso, solicite ao administrador para alterar o seu nivel de usuário. 
            <form action="/logout" method="post">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    Sair
                </a>
            </form>
        </h2>
    </div>
</body>
</html>

