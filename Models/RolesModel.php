<?php

	class RolesModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();	
		}

		public function selectRoles(){
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and id_rol != 1 ";
			}
			//EXTRAE ROLES
			$sql = "SELECT * FROM tb_rol WHERE estado != 0".$whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectRol(int $idrol){
			//EXTRAE ROL
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM tb_rol WHERE id_rol = $this->intIdrol";
			$request = $this->select($sql); 
			return $request;
		}

		public function insertRol(string $rol, string $descripcion, int $status){

			$return = "";
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_rol WHERE nombre_rol = '{$this->strRol}' AND estado != 0";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tb_rol(nombre_rol,descripcion,estado) VALUES(?,?,?)";
	        	$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;

		}

		public function updateRol(int $idrol, string $rol, string $descripcion, int $status){
			$this->intIdrol = $idrol;
			$this->strRol = $rol;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_rol WHERE nombre_rol = '$this->strRol' AND id_rol != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tb_rol SET nombre_rol = ?, descripcion = ?, estado = ? WHERE id_rol = $this->intIdrol ";
				$arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}


		public function deleteRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM tb_persona WHERE rol_id = $this->intIdrol";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE tb_rol SET estado = ? WHERE id_rol = $this->intIdrol ";
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