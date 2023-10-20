<?php

namespace App\Models;

use MF\Model\Model;
use mysql_xdevapi\Exception;

class Pessoa extends Model
{
    public function getPessoa()
    {

        $query = "SELECT * FROM pessoa
		          INNER JOIN endereco ON pessoa.id_pessoa = endereco.pessoa_id_pessoa ";
        return $this->conexao->query($query)->fetchAll();
    }

    public function getPessoaById($id)
    {
        $query = "SELECT * FROM pessoa
                  INNER JOIN endereco ON pessoa.id_pessoa = endereco.pessoa_id_pessoa
                  WHERE pessoa.id_pessoa = ?";

        $statement = $this->conexao->prepare($query);
        $statement->execute([$id]);

        if ($statement->rowCount() > 0) {
            return $statement->fetch();
        } else {
            return null;
        }
    }

    public function updatePessoa($id)
    {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];
        $dataNascimento = date("Y-m-d", strtotime($_POST['dataNascimento']));

        $cep = $_POST['cep'];
        $logradouro = $_POST['logradouro'];
        $localidade = $_POST['localidade'];
        $bairro = $_POST['bairro'];
        $uf = $_POST['uf'];
        $complementoEndereco = $_POST['complementoEndereco'];

        try {
            $this->conexao->beginTransaction();

            $sqlUpdatePessoa = "UPDATE pessoa 
                   SET nome_completo = ?, 
                       telefone = ?, 
                       cpf = ?, 
                       data_nascimento = ? 
                   WHERE id_pessoa = ?";

            $query = $this->conexao->prepare($sqlUpdatePessoa);
            $query->execute([$nome, $telefone, $cpf, $dataNascimento, $id]);

            $sqlUpdateEndereco = "UPDATE endereco 
                    SET cep = ?, 
                        logadouro = ?, 
                        localidade = ?, 
                        bairro = ?, 
                        uf = ?, 
                        complemento = ? 
                    WHERE pessoa_id_pessoa = ?";

            $query = $this->conexao->prepare($sqlUpdateEndereco);
            $query->execute([$cep, $logradouro, $localidade, $bairro, $uf, $complementoEndereco, $id]);

            $this->conexao->commit();

        } catch (\PDOException $error) {
            echo 'Error atualiazar Pessoa e Endereço => ', $error;
        }
    }

    public
    function insertPessoa()
    {
        try {
            $this->conexao->beginTransaction();

            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $cpf = $_POST['cpf'];
            $dataNascimento = date("Y-m-d", strtotime($_POST['dataNascimento']));

            $cep = $_POST['cep'];
            $logradouro = $_POST['logradouro'];
            $localidade = $_POST['localidade'];
            $bairro = $_POST['bairro'];
            $uf = $_POST['uf'];
            $complementoEndereco = $_POST['complementoEndereco'];

            $query = $this->conexao->prepare("INSERT INTO pessoa (
                                                            nome_completo, 
                                                            telefone, 
                                                            cpf, 
                                                            data_nascimento) 
                                                        VALUES(?,?,?,?)");

            $query->execute([$nome, $telefone, $cpf, $dataNascimento]);

            $lastId = $this->conexao->lastInsertId();

            $query = $this->conexao->prepare("INSERT INTO endereco (
                                                                      cep, 
                                                                      logadouro, 
                                                                      localidade, 
                                                                      bairro, 
                                                                      uf,
                                                                      complemento, 
                                                                      pessoa_id_pessoa) 
                                                        VALUES(?,?,?,?,?,?,?)");

            $query->execute([$cep, $logradouro, $localidade, $bairro, $uf, $complementoEndereco, $lastId]);

            $this->conexao->commit();

        } catch (\PDOException $error) {
            echo 'Error ao cadastrar Pessoa => ', $error;
        }
    }

    function deletePessoaById($id)
    {

        try {

            $this->conexao->beginTransaction();

            $queryDeleteEndereco = $this->conexao->prepare("DELETE FROM endereco WHERE pessoa_id_pessoa=?");

            $queryDeleteEndereco->execute([$id]);

            $queryDeletePessoa = $this->conexao->prepare("DELETE FROM pessoa WHERE id_pessoa=?");

            $queryDeletePessoa->execute([$id]);

            $this->conexao->commit();

        } catch (\PDOException $error) {
            echo 'Error ao deletar Pessoa => ', $error;
        }

    }
}
