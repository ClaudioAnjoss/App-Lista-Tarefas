<?php
    class TarefaService {
        private $conexao;
        private $tarefa;

        public function __construct($conexao, $tarefa) {
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        //Create
        public function inserir() {
            $query = '
                insert into tb_tarefas(tarefa) values(:tarefa)
            ';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));

            $stmt->execute();
        }

        //read
        public function recuperar() {
            $query = "
                select 
                    t.id, t.id_status, s.status, t.tarefa 
                from 
                    tb_tarefas as t 
                left join 
                    tb_status as s 
                on 
                    (t.id_status = s.id)
            ";
            
            $stmt = $this->conexao->prepare($query);
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

            header('location: ../todas_tarefas.php?atualiza=success');
            
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
            
            header('location: todas_tarefas.php?remove=success');
        }
    }
?>