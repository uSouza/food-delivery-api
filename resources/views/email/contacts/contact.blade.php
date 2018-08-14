<div>
    <h1>Contato recebido!</h1>
</div>
<div>
    <h4>Nome: </h4> <p>{{$contact->name}}</p>
    <br>
    <h4>Razão Social:</h4> <p><{{$contact->social_name}}/p>
    <br>
    <h4>Email: </h4> <p>{{$contact->email}}</p>
    <br>
    <h4>Telefone: </h4><p>{{$contact->phone}}</p>
</div>
<div>
    <h4>Mensagem: </h4><br><p>{{$contact->message}}</p>
</div>