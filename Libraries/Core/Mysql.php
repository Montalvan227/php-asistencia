<?php
	
	/**
	 * 
	 */
	class Mysql extends Conexion
	{
		
		private $conexion;
		private $strquery;
		private $arrValues;

		function __construct()
		{
			$this->conexion = new Conexion();
			$this->conexion = $this->conexion->conect();
		}
		
		//INSERTAR UN REGISTRO
		public function insert(string $query, array $arrValues)
		{
			$this->strquery = $query;
			$this->arrVAlues = $arrValues;

			$insert = $this->conexion->prepare($this->strquery);
			$resInsert = $insert->execute($this->arrVAlues);
			if ($resInsert) {
				$lastInsert = $this->conexion->lastInsertId();
			}else{
				$lastInsert=0;
			}
			return $lastInsert;

		}

		//BUSCAR UN REGISTRO
		public function select(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		//BUSCAR TODOS LOS REGISTROS
		public function select_all(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		//ACTUALIZAR UN REGISTRO
		public function update(string $query, array $arrValues)
		{
			$this->strquery = $query;
			$this->arrVAlues = $arrValues;
			$update = $this->conexion->prepare($this->strquery);
			$resExecute = $update->execute($this->arrVAlues);
	        return $resExecute;

		}

		//ELIMINAR UN REGISTRO
		public function delete(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			return $result;
		}

	}


?>