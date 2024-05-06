<?php 

	class PersonaModel extends Mysql
	{
		private $intIdUsuario;
		private $tipoPersona;
		private $tipoDocumento;
		private $strIdentificacion;
		private $strNombre;
		private $strApellido;
		private $strNombreFiscal;
		private $intTelefono;
		private $strEmail;
		private $strPassword;
		private $strToken;
		private $intTipoId;
		private $intStatus;
		private $strNit;
		private $strNomFiscal;
		private $strDireccion;

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertPersona(int $tdocumento, string $ndocumento, string $nombre, string $apellido, string $telefono, string $email, string $password, string $direccion, string $apoderado, int $rolid, int $gradoid, int $status){

			$this->intTipoDocumento = $tdocumento;
			$this->strIdentificacion = $ndocumento;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->strDireccion = $direccion;
			$this->strApoderado = $apoderado;
			$this->intTipoId = $rolid;
			$this->intGradoId = $gradoid;
			$this->intStatus = $status;
			$return = 0;

			$sql = "SELECT * FROM tb_persona WHERE 
					email = '{$this->strEmail}' or n_documento = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tb_persona(t_documento,n_documento,nombres,apellidos,telefono,email,password,direccion,apoderado,rol_id, grado_id, estado) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intTipoDocumento,
        						$this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword,
        						$this->strDireccion,
        						$this->strApoderado,
        						$this->intTipoId,
        						$this->intGradoId,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = "1";
			}else{
				$return = "exist";
			}
	        return $return;
		}
		
		public function selectPersona(int $idpersona){
			$this->intIdUsuario = $idpersona;
			$sql = "SELECT p.id_persona,p.t_documento,p.n_documento,p.nombres,p.apellidos,p.telefono,p.email,p.direccion,p.apoderado,p.estado,r.id_rol,r.nombre_rol,g.id_grado,g.nombre_grado,p.estado, DATE_FORMAT(p.f_creacion, '%d-%m-%Y') as fechaRegistro 
					FROM tb_persona p
					INNER JOIN tb_rol r
					ON p.rol_id = r.id_rol
					INNER JOIN tb_grado g
					ON p.grado_id = g.id_grado
					WHERE p.id_persona = $this->intIdUsuario";
			$request = $this->select($sql);
			return $request;
		}

		public function updatePersona(int $idUsuario, int $tdocumento, string $ndocumento, string $nombre, string $apellido, string $telefono, string $email, string $password, string $direccion, string $apoderado, int $rolid, int $gradoid, int $status){

			$this->intIdUsuario = $idUsuario;
			$this->intTipoDocumento = $tdocumento;
			$this->strIdentificacion = $ndocumento;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strPassword = $password;
			$this->strDireccion = $direccion;
			$this->strApoderado = $apoderado;
			$this->intTipoId = $rolid;
			$this->intGradoId = $gradoid;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_persona WHERE (email = '{$this->strEmail}' AND id_persona != $this->intIdUsuario)
										  OR (n_documento = '{$this->strIdentificacion}' AND id_persona != $this->intIdUsuario) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				if($this->strPassword  != "")
				{
					$sql = "UPDATE tb_persona SET t_documento=?,n_documento=?,nombres=?,apellidos=?,telefono=?,email=?,password=?,direccion=?,apoderado=?,rol_id=?, grado_id=?, estado=?
							WHERE id_persona = $this->intIdUsuario ";
					$arrData = array($this->intTipoDocumento,
	        						$this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strPassword,
	        						$this->strDireccion,
	        						$this->strApoderado,
	        						$this->intTipoId,
	        						$this->intGradoId,
	        						$this->intStatus);
				}else{
					$sql = "UPDATE tb_persona SET t_documento=?,n_documento=?,nombres=?,apellidos=?,telefono=?,email=?,direccion=?,apoderado=?,rol_id=?, grado_id=?, estado=?
							WHERE id_persona = $this->intIdUsuario ";
					$arrData = array($this->intTipoDocumento,
	        						$this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strApellido,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->strDireccion,
	        						$this->strApoderado,
	        						$this->intTipoId,
	        						$this->intGradoId,
	        						$this->intStatus);
				}
				$request = $this->update($sql,$arrData);
				$request = "2";
			}else{
				$request = "exist";
			}
			return $request;
		
		}

		public function deletePersona(int $intIdpersona)
		{
			$this->intIdUsuario = $intIdpersona;
			$sql = "UPDATE tb_persona SET estado = ? WHERE id_persona = $this->intIdUsuario ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}


?>
