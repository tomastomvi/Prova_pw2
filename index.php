<?php

class Usuario {
    protected $id;
    protected $nome;
    protected $email;
    protected $senha;

    public function __construct($id, $nome, $email, $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function autenticar($senha) {
        return password_verify($senha, $this->senha);
    }

    public function exibirDados() {
        return "ID: {$this->id} | Nome: {$this->nome} | Email: {$this->email}";
    }
}

class Cliente extends Usuario {
    private $nivel;

    public function __construct($id, $nome, $email, $senha, $nivel) {
        parent::__construct($id, $nome, $email, $senha);
        $this->nivel = $nivel;
    }

    public function exibirDados() {
        return parent::exibirDados() . " | Tipo: Cliente | Nível: {$this->nivel}";
    }
}


class Administrador extends Usuario {
    private $acessoTotal;

    public function __construct($id, $nome, $email, $senha, $acessoTotal) {
        parent::__construct($id, $nome, $email, $senha);
        $this->acessoTotal = $acessoTotal;
    }

    public function exibirDados() {
        $acesso = $this->acessoTotal ? "Sim" : "Não";
        return parent::exibirDados() . " | Tipo: Administrador | Acesso Total: {$acesso}";
    }
}


$cliente = new Cliente(1, "João Silva", "joao@email.com", "123456", "Prata");
$admin = new Administrador(2, "Maria Souza", "maria@email.com", "admin123", true);


echo $cliente->exibirDados() . "<br>";
echo $admin->exibirDados() . "<br>";

echo "Senha do cliente correta? " . ($cliente->autenticar("123456") ? "Sim" : "Não") . "<br>";
echo "Senha do admin correta? " . ($admin->autenticar("senhaerrada") ? "Sim" : "Não") . "<br>";

?>