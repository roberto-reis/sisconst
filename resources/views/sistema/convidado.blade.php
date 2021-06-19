<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Convidado - SisConst</title>
    <style>
        body{
            background-color: #e9ecef;
        }
        .msg{
            width: 620px;
            height: auto;
            margin: 50px auto;
            color: #555;
            font-size: 18px;
            background-color: #f8f8f8;
            padding: 10px 18px;
            border-radius: 5px;
        }
        form{
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="msg">
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

