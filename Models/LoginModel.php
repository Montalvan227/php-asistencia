<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}	

		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strPassword = $password;
			$sql = "SELECT id_persona, estado FROM tb_persona WHERE 
					(n_documento = '$this->strUsuario' OR email = '$this->strUsuario') and 
                	password = '$this->strPassword' and 
                	estado != 0 ";
			$request = $this->select($sql);
			return $request;
		}

		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLE 
			$sql = "SELECT p.id_persona,
							p.n_documento,
							p.nombres,
							p.apellidos,
							p.email,
							p.direccion,
							r.id_rol,
							r.nombre_rol,
							p.estado
					FROM tb_persona p
					INNER JOIN tb_rol r
					ON p.rol_id = r.id_rol
					WHERE p.id_persona = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

		public function getUserIdentifier(string $strIdentifier){
			$this->strUsuario = $strIdentifier;
			$sql = "SELECT id_persona,nombres,apellidos, estado FROM persona WHERE 
					(n_documento = '$this->strUsuario' OR email = '$this->strUsuario') and 
					estado = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $idpersona, string $token){
			$this->intIdUsuario = $idpersona;
			$this->strToken = $token;
			$sql = "UPDATE persona SET token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT idpersona FROM persona WHERE 
					email_user = '$this->strUsuario' and
					token = '$this->strToken' and
					status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idPersona, string $password){
			$this->intIdUsuario = $idPersona;
			$this->strPassword = $password;
			$sql = "UPDATE persona SET password = ?, token = ? WHERE idpersona = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>