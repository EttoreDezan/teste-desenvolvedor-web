<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

			$conexao = new \PDO(
				"mysql:host=localhost;dbname=banco_projeto;charset=utf8",
				"root",
				"e1l2s3d4"
			);

			return $conexao;

		} catch (\PDOException $e) {
			echo "Ocorreu um Erro ao acessar servidor. Verifique dados.";
		}
	}
}
