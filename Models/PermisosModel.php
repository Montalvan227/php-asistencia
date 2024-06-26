<?php

	/**
	 * 
	 */
	class PermisosModel extends Mysql
	{
		public $intIdpermiso;
		public $intRolid;
		public $intModuloid;
		public $r;
		public $w;
		public $u;
		public $d;

		public function __construct()
		{
			parent::__construct();	
		}

		public function selectModulos()
		{
			$sql = "SELECT * FROM tb_modulo WHERE status != 0 ORDER BY numero ASC";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectPermisosRol(int $idrol)
		{
			$this->intRolid = $idrol;
			$sql = "SELECT * FROM tb_permisos WHERE rolid = $this->intRolid";
			$request = $this->select_all($sql);
			return $request;
		}
		
		public function deletePermisos(int $idrol)
		{
			$this->intRolid = $idrol;
			$sql = "DELETE FROM tb_permisos WHERE rolid = $this->intRolid";
			$request = $this->delete($sql);
			return $request;
		}

		public function insertPermisos(int $idrol, int $idmodulo, int $r, int $w, int $u, int $d){
			$this->intRolid = $idrol;
			$this->intModuloid = $idmodulo;
			$this->r = $r;
			$this->w = $w;
			$this->u = $u;
			$this->d = $d;
			$query_insert  = "INSERT INTO tb_permisos(rolid,moduloid,r,w,u,d) VALUES(?,?,?,?,?,?)";
        	$arrData = array($this->intRolid, $this->intModuloid, $this->r, $this->w, $this->u, $this->d);
        	$request_insert = $this->insert($query_insert,$arrData);		
	        return $request_insert;
		}

		public function permisosModulo(int $idrol){
			$this->intRolid = $idrol;
			$sql = "SELECT p.rolid,
						   p.moduloid,
						   m.titulo as modulo,
						   p.r,
						   p.w,
						   p.u,
						   p.d 
					FROM tb_permisos p 
					INNER JOIN tb_modulo m
					ON p.moduloid = m.id_modulo
					WHERE p.rolid = $this->intRolid";
			$request = $this->select_all($sql);
			$arrPermisos = array();
			for ($i=0; $i < count($request); $i++) { 
				$arrPermisos[$request[$i]['moduloid']] = $request[$i];
			}
			return $arrPermisos;
		}

		public function getRol(int $idrol){
			$this->intRolid = $idrol;
			$sql = "SELECT * FROM tb_rol WHERE id_rol = $this->intRolid";
			$request = $this->select($sql);
			return $request;
		}

	}

?>