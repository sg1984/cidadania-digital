<div>
    <p><b>Tipo de email:</b> {{ $type }} </p>
    <p><b>Usuário: </b> {{ $user->name }}</p>
    <p><b>Email: </b> {{ $user->email }}</p>
    <p><b>Data: </b> {{ now()->format('Y-m-d H:i') }}</p>
    <p><b>Mensagem: </b></p>
    <p>{{ $content }}</p>
</div>
