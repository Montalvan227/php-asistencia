<?php

	/**
	 * 
	 */
	class Roles extends Controllers
	{
		
		public function __construct()
		{
			//Función en Helpers
			sessionStart();
			parent::__construct();

			//
			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(12);
		}

		public function roles($params){

			//
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Roles Usuario";
			$data['page_name'] = "rol_usuario";
			$data['page_title'] = "Roles Usuario - <small>Tienda Virtual</small>";
			$data['page_functions_js'] = "functions_roles.js";

			$this->views->getView($this,"roles",$data);

		}

		public function getRoles(){

			if($_SESSION['permisosMod']['r']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectRoles();

				for ($i=0; $i < count($arrData); $i++) { 
					if ($arrData[$i]['estado'] == 1) {
						$arrData[$i]['estado'] = '<span class="badge bg-primary">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['u']){
						$btnView = '<button type="button" class="btn btn-icon btn-sm btn-primary" onClick="fntPermisos('.$arrData[$i]['id_rol'].')" title="Permisos"><span class="tf-icons bx bx-key"></span></button>';
						$btnEdit = '<button type="button" class="btn btn-icon btn-sm btn-secondary" onClick="fntEditRol('.$arrData[$i]['id_rol'].')" title="Editar"><span class="tf-icons bx bx-edit-alt"></span></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button type="button" class="btn btn-icon btn-sm btn-danger" onClick="fntDelRol('.$arrData[$i]['id_rol'].')" title="Eliminar"><span class="tf-icons bx bx-message-square-x"></span></button>';
					}
					
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();

		}


		public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id_rol'].'">'.$arrData[$i]['nombre_rol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

		public function getRol(int $idrol)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdrol = intval(strClean($idrol));
				if($intIdrol > 0)
				{
					$arrData = $this->model->selectRol($intIdrol);
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


		public function setRol(){

			$intIdrol = intval($_POST['idRol']);
			$strRol = strClean($_POST['txtNombre']);
			$strDescripcion = strClean($_POST['txtDescripcion']);
			$intStatus = intVal($_POST['listStatus']);
			//$request_rol = "";

			if($intIdrol == 0)
			{
				//Crear
				if($_SESSION['permisosMod']['w']){
					$request_rol = $this->model->insertRol($strRol, $strDescripcion,$intStatus);
					$option = 1;
				}
			}else{
				//Actualizar
				if($_SESSION['permisosMod']['u']){
					$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intStatus);
					$option = 2;
				}
			}

			if($request_rol > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_rol == 'exist'){
				
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();

		}

		public function delRol()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdrol = intval($_POST['idrol']);
					$requestDelete = $this->model->deleteRol($intIdrol);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}


	}

?>