<?php

class Todo {
	private $id;
	private $descricao;
	private $data;
	private $hora;

	public function GetID() {
		return $this->id;
	}
	public function SetID($id) {
		$this->id = $id;
	}
	public function GetDescricao() {
		return $this->descricao;
	}
	public function SetDescricao($desc) {
		$this->descricao = $desc;
	}
	public function GetData() {
		return $this->data;
	}
	public function SetData($data) {
		$this->data = $data;
	}
	public function GetHora() {
		return $this->hora;
	}
	public function SetHora($hora) {
		$this->hora = $hora;
	}
	function Obter() {
		$pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM todo WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($this->id));
		$data = $q->fetch(PDO::FETCH_ASSOC);

		$this->descricao = $data['descricao'];
		$this->data = $data['data'];
		$this->hora = $data['hora'];

		Banco::desconectar();
	}
	
	function Gravar() {
		if ($this->id == false) {
			$pdo = Banco::conectar();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO todo (descricao, data, hora) VALUES(?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(
				array($this->descricao,
					  $this->data,
					  $this->hora
				)
			);
			return $pdo->lastInsertId();
		}
		elseif ($this->id > 0) {
			$pdo = Banco::conectar();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE todo SET descricao = ?, data = ?, hora = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(
				array(
					$this->descricao,
					$this->data,
					$this->hora,
					$this->id
				)
			);
			return true;
		}
		Banco::desconectar();
	}
	
	function Apagar() {
	
		$pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM todo WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($this->id));
		Banco::desconectar();
	
		return true;
	}
}

?>