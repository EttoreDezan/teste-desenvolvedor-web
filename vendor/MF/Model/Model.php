<?php


namespace MF\Model;

abstract class Model {

	protected $conexao;

	public function __construct(\PDO $conexao) {
		$this->conexao = $conexao;
	}
}


?>