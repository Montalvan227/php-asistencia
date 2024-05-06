<?php 

	class DocentesModel extends Mysql
	{
		private $intIdUsuario;
		private $tipoPersona;
		private $tipoDocumento;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
		private $strDireccion;

		public function __construct()
		{
			parent::__construct();
		}	

		public function selectDocentes()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.id_persona != 1 ";
			}
			$sql = "SELECT p.id_persona,p.t_documento,p.n_documento,p.nombres,p.apellidos,p.telefono,p.email,p.direccion,p.estado,r.id_rol,r.nombre_rol,g.id_grado,g.nombre_grado,p.estado, DATE_FORMAT(p.f_creacion, '%d-%m-%Y') as fechaRegistro 
					FROM tb_persona p 
					INNER JOIN tb_rol r
					ON p.rol_id = r.id_rol
					INNER JOIN tb_grado g
					ON p.grado_id = g.id_grado
					WHERE r.id_rol = 3 AND p.estado != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

	}


?>
