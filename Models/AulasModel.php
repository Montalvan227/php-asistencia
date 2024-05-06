<?php

	class AulasModel extends Mysql
	{
		public $intIdGrado;
		public $strGrado;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();	
		}

		public function selectAulas(){
			$whereAdmin = "";
			
			$sql = "SELECT * FROM tb_grado WHERE estado != 0 AND id_grado != 1";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectAula(int $idGrado){
			//EXTRAE ROL
			$this->intIdGrado = $idGrado;
			$sql = "SELECT * FROM tb_grado WHERE id_grado = $this->intIdGrado";
			$request = $this->select($sql); 
			return $request;
		}

		public function insertAula(string $grado, int $status){

			$return = "";
			$this->strGrado = $grado;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_grado WHERE nombre_grado = '{$this->strGrado}' AND estado != 0";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tb_grado(nombre_grado,estado) VALUES(?,?)";
	        	$arrData = array($this->strGrado, $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;

		}

		public function updateAula(int $idGrado, string $grado, int $status){
			$this->intIdGrado = $idGrado;
			$this->strGrado = $grado;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_grado WHERE nombre_grado = '$this->strGrado' AND id_grado != $this->intIdGrado";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tb_grado SET nombre_grado = ?, estado = ? WHERE id_grado = $this->intIdGrado ";
				$arrData = array($this->strGrado, $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}


		public function deleteAula(int $idGrado)
		{
			$this->intIdGrado = $idGrado;
			$sql = "SELECT * FROM tb_persona WHERE grado_id = $this->intIdGrado";
			$request = $this->select_all($sql);
			$sql2 = "SELECT * FROM tb_grado_curso WHERE grado_id = $this->intIdGrado";
			$request3 = $this->select_all($sql);
			if(empty($request) AND empty($request2))
			{
				$sql = "UPDATE tb_grado SET estado = ? WHERE id_grado = $this->intIdGrado ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}


	}

?>