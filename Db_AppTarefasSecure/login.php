<?php

class Login {
    private $id;
    private $nome;
    private $login;
    private $senha;

    public function __set($attr, $value) {
        $this->$attr = $value;
    }
    public function __get($attr) {
        return $this->$attr;
    }
}

?>