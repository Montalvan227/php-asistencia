<?php
	require_once("Models/PersonaModel.php"); 

	/**
	 * 
	 */
	class Personas extends Controllers
	{
		
		public function __construct()
		{
			//Función en Helpers
			sessionStart();
			parent::__construct();

			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(2);
		}

		public function personas(){

			
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Personas";
			$data['page_name'] = "Personas";
			$data['page_title'] = "Personas";
			//$data['page_functions_js'] = "functions_usuarios.js";

		}


		public function setPersona(){
			//dep($_POST);
			if($_POST){
				if(empty($_POST['txtIdentificacion']) || empty($_POST['listTDocumento']) || empty($_POST['txtNombre']) & empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idUsuario = intval($_POST['idUsuario']);
					$intTipoDocumento = intval(strClean($_POST['listTDocumento']));
					$strIdentificacion = intval(strClean($_POST['txtIdentificacion']));
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$strTelefono = strClean($_POST['txtTelefono']);
					$strDireccion = strClean($_POST['txtDireccion']);
					$strApoderado = strClean($_POST['txtApoderado']);
					$intRolId = intval(strClean($_POST['listRolid']));
					$intGradoId = intval(strClean($_POST['listGradoid']));
					$intStatus = intval(strClean($_POST['listStatus']));

					$request_user = "";
					if($idUsuario == 0)
					{
						$option = 1;
						$strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);

						if($_SESSION['permisosMod']['w']){
							$request_user = (new PersonaModel)->insertPersona($intTipoDocumento,
																			$strIdentificacion,
																			$strNombre, 
																			$strApellido, 
																			$strTelefono, 
																			$strEmail,
																			$strPassword, 
																			$strDireccion,
																			$strApoderado,
																			$intRolId,
																			$intGradoId,
																			$intStatus);
						}
					}else{
						$option = 2;
						$strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
						if($_SESSION['permisosMod']['u']){
							$request_user = (new PersonaModel)->updatePersona($idUsuario,
																			$intTipoDocumento,
																			$strIdentificacion,
																			$strNombre, 
																			$strApellido, 
																			$strTelefono, 
																			$strEmail,
																			$strPassword, 
																			$strDireccion,
																			$strApoderado,
																			$intRolId,
																			$intGradoId,
																			$intStatus);
						}
					}

					if($request_user != "exist" && $request_user > 0)
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
							//Enviar correo al crear nueva cuenta de un cliente
							/*if ($es_cliente = 1) {
								$nombreUsuario = $strNombre.' '.$strApellido;
								$dataUsuario = array('nombreUsuario' => $nombreUsuario,
													 'email' => $strEmail,
													 'asunto' => 'Bienvenido a tu tienda en línea');
								sendEmail($dataUsuario,'email_bienvenida');
							}*/
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_user == 'exist'){
						
						$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				//dep($arrResponse);
			}
			die();
		}




		public function getPersona($idpersona){
			if($_SESSION['permisosMod']['r']){
				$idusuario = intval($idpersona);
				if($idusuario > 0)
				{
					$arrData = (new PersonaModel)->selectPersona($idusuario);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function delPersona()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdpersona = intval($_POST['idUsuario']);
					$requestDelete = (new PersonaModel)->deletePersona($intIdpersona);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el cliente');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar al cliente.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		
		public function buscarPorDni(){
			//dep($_POST);
			error_reporting(0);
			$dni = intval(strClean($_POST['nDocumento']));
			if(empty($dni) || $dni <= 9999999){
				$arrResponse = array("status" => false, "msg" => 'Dni no Valido.');

			}else{
				//SIN CONECTAR EL API

				if (file_get_contents('https://api.apis.net.pe/v1/dni?numero=' . $dni)) {
					$arrResponse = file_get_contents('https://api.apis.net.pe/v1/dni?numero=' . $dni);
					$arrResponse = array("status" => true, "data" => json_decode($arrResponse));
				} else {
					$arrResponse = array("status" => false, "msg" => 'Dni no Valido.');
				}

				

			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
			
		}

		public function buscarPorRuc($ruc){
			error_reporting(0);
			$ruc = intval(strClean($_POST['nDocumento']));
			if(empty($ruc) || $ruc <= 9999999999){
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				//SIN CONECTAR EL API
				if (file_get_contents('https://api.apis.net.pe/v1/ruc?numero=' . $ruc)) {
					$arrResponse = file_get_contents('https://api.apis.net.pe/v1/ruc?numero=' . $ruc);
					$arrResponse = array("status" => true, "data" => json_decode($arrResponse));
				} else {
					$arrResponse = array("status" => false, "msg" => 'RUC no Valido.');
				}
			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

			die();

		}



	}


?>