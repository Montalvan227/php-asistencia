<?php 

	class UsuariosModel extends Mysql
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

		public function selectUsuarios()
		{
			$whereAdmin = "";
			if($_SESSION['idUser'] != 1 ){
				$whereAdmin = " and p.id_persona != 1 ";
			}
			$sql = "SELECT p.id_persona,p.t_documento,p.n_documento,p.nombres,p.apellidos,p.telefono,p.email,p.direccion,p.estado,r.id_rol,r.nombre_rol,p.f_creacion 
					FROM tb_persona p 
					INNER JOIN tb_rol r
					ON p.rol_id = r.id_rol
					WHERE p.estado != 0 ".$whereAdmin;
					$request = $this->select_all($sql);
					return $request;
		}

		public function updatePerfil(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $password){
			$this->intIdUsuario = $idUsuario;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strPassword = $password;

			if($this->strPassword != "")
			{
				$sql = "UPDATE tb_persona SET identificacion=?, nombres=?, apellidos=?, telefono=?, password=? 
						WHERE id_persona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono,
								$this->strPassword);
			}else{
				$sql = "UPDATE tb_persona SET identificacion=?, nombres=?, apellidos=?, telefono=? 
						WHERE id_persona = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
								$this->strNombre,
								$this->strApellido,
								$this->intTelefono);
			}
			$request = $this->update($sql,$arrData);
		    return $request;
		}

	}


?>
