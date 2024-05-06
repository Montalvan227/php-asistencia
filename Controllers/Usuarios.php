<?php
	require_once("Models/PersonaModel.php"); 

	/**
	 * 
	 */
	class Usuarios extends Controllers
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

		public function usuarios(){

			
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Usuarios";
			$data['page_name'] = "Usuarios";
			$data['page_title'] = "Usuarios - <small>Software de Colegio</small>";
			$data['page_functions_js'] = "functions_usuarios.js";

			$this->views->getView($this,"usuarios",$data);

		}

		public function getUsuarios()
		{	

			if($_SESSION['permisosMod']['r']){
				
				$arrData = $this->model->selectUsuarios();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					$arrData[$i]['nombresApellidos'] = $arrData[$i]['nombres'] . ' ' . $arrData[$i]['apellidos'];

					if($arrData[$i]['estado'] == 1)
					{
						$arrData[$i]['estado'] = '<span class="badge bg-primary">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button type="button" class="btn btn-icon btn-sm btn-primary btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['id_persona'].')" title="Ver usuario"><span class="tf-icons bx bx-expand"></span></button>';
					}
					if($_SESSION['permisosMod']['u']){
						if(($_SESSION['idUser'] == 2 and $_SESSION['userData']['id_rol'] == 2) ||
							($_SESSION['userData']['id_rol'] == 1 and $arrData[$i]['id_rol'] != 1) ){
							$btnEdit = '<button type="button" class="btn btn-icon btn-sm btn-secondary btnEditUsuario" onClick="fntEditUsuario(this,'.$arrData[$i]['id_persona'].')" title="Editar usuario"><span class="tf-icons bx bx-edit-alt"></span></button>';
						}else{
							$btnEdit = '<button class="btn btn-icon btn-sm btn-secondary" disabled ><span class="tf-icons bx bx-edit-alt"></span></button>';
						}
					}
					if($_SESSION['permisosMod']['d']){
						if(($_SESSION['idUser'] == 2 and $_SESSION['userData']['id_rol'] == 2) ||
							($_SESSION['userData']['id_rol'] == 1 and $arrData[$i]['id_rol'] != 1) and
							($_SESSION['userData']['id_persona'] != $arrData[$i]['id_persona'] )
							 ){
							$btnDelete = '<button type="button" class="btn btn-icon btn-sm btn-danger btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['id_persona'].')" title="Eliminar usuario"><span class="tf-icons bx bx-message-square-x"></span></button>';
						}else{
							$btnDelete = '<button class="btn btn-icon btn-sm btn-danger" disabled ><span class="tf-icons bx bx-message-square-x"></span></button>';
						}
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				
			}
			die();
		}
		
		public function perfil(){
			$data['page_tag'] = "Perfil";
			$data['page_title'] = "Perfil de usuario";
			$data['page_name'] = "perfil";
			$data['page_functions_js'] = "functions_usuarios.js";
			$this->views->getView($this,"perfil",$data);
		}

		public function putPerfil(){
			//dep($_POST);
			if($_POST){
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					$idUsuario = $_SESSION['idUser'];
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = strClean($_POST['txtNombre']);
					$strApellido = strClean($_POST['txtApellido']);
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strPassword = "";
					/*if(!empty($_POST['txtPassword'])){
						$strPassword = hash("SHA256",$_POST['txtPassword']);
					}*/
					$request_user = $this->model->updatePerfil($idUsuario,
																$strIdentificacion, 
																$strNombre,
																$strApellido, 
																$intTelefono, 
																$strPassword);
					if($request_user)
					{
						sessionUser($_SESSION['idUser']);
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
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
		
	}


?>