<div>
    <p>
        Olá <b>{{ $user->name }}</b>,
    </p>
    <p>
        Seu cadastro foi efetuado na plataforma Cidadania Digital. Inicialmente não estamos possibilitando a troca de senhas, portanto, pedimos para que guarde este e-mail. Caso se esqueça da sua senha, pode entrar em contato que lhe enviaremos outra.
    </p>

    <p>
        O acesso da plataforma se dá pelo link:
        <a href="{{ route('index') }}" class="text-reset">
            <b>{{ env('APP_URL') }}</b>
        </a>
    </p>

    <p><b>login:</b> {{ $user->email }} </p>
    <p><b>senha: </b> {{ $password }}</p>

    <p>Obrigado,</p>
    <p> --- </p>
    <p> Plataforma Cidadania Digital </p>
</div>
