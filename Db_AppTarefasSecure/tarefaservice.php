<?php
    class TarefaService {
        private $conexao;
        private $tarefa;

        public function __construct($conexao, $tarefa) {
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        // Verificar se usuario existe
        public function verificar() {
            $query = "
            SELECT * FROM tb_usuarios where login = :email
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':email', $this->tarefa->__get('login'));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //Criar conta
        public function cadastro() {
            $query = "
                INSERT INTO tb_usuarios(nome, login, senha) 
                VALUES(:nome , :login , :senha)
            ";

            // echo '<pre>';
            // print_r($this->tarefa) ;
            // echo '</pre>';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome' , $this->tarefa->__get('nome'));
            $stmt->bindValue(':login' , $this->tarefa->__get('login'));
            $stmt->bindValue(':senha' , $this->tarefa->__get('senha'));
            $stmt->execute();

            return true;
        }

        // Login
        public function login() {
            $query = "
            SELECT * FROM tb_usuarios where login = :email AND senha = :senha
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':email', $this->tarefa->__get('email'));
            $stmt->bindValue(':senha', $this->tarefa->__get('senha'));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
           
        }

        //Create
        public function inserir() {
            $query = '
                insert into tb_tarefas(id_usuario, tarefa) values(:id_usuario , :tarefa)
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $this->tarefa->__get('id_usuario'));
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));

            $stmt->execute();
        }

        //read
        public function recuperar() {
            $query = "
                select 
                t.id, t.id_usuario, t.id_status, s.status, t.tarefa 
                from 
                tb_tarefas as t 
                left join 
                tb_status as s 
                on 
                (t.id_status = s.id)
                WHERE
                t.id_usuario = :id_usuario
            ";
            
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario' , $this->tarefa->__get('id_usuario'));
            $stmt->execute();            

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //update
        public function atualizar() {
            $query = "
                UPDATE 
                    tb_tarefas
                SET 
                    tarefa =  :tarefa
                WHERE
                    id = :id
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa' , $this->tarefa->__get('tarefa'));
            $stmt->bindValue(':id' , $this->tarefa->__get('id'));
            $stmt->execute();
        }

        //delete
        public function remover() {
            $query = "
                DELETE FROM 
                    tb_tarefas
                WHERE 
                    id = :id
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            $stmt->execute();
        }

        //Marcar
        public function marcar() {
            $query = "
                UPDATE
                    tb_tarefas
                SET
                    id_status = :id_status
                WHERE
                    id = :id                
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            $stmt->execute();
        }

        //Recuperar Pendentes
        public function recup_pendentes() {
            $query = "
                SELECT
                    id, id_usuario, tarefa, id_status
                FROM
                    tb_tarefas
                WHERE
                    id_status = 1 
                AND 
                    id_usuario = :id_usuario
            ";

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id_usuario' , $this->tarefa->__get('id_usuario'));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        
    }
