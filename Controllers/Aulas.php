<?php

	/**
	 * 
	 */
	class Aulas extends Controllers
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

		public function aulas($params){

			//
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Aulas";
			$data['page_name'] = "aulas";
			$data['page_title'] = "Aulas - <small>Software Colegio</small>";
			$data['page_functions_js'] = "functions_grados.js";

			$this->views->getView($this,"aulas",$data);

		}

		public function getAulas(){

			if($_SESSION['permisosMod']['r']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectAulas();

				for ($i=0; $i < count($arrData); $i++) { 
					if ($arrData[$i]['estado'] == 1) {
						$arrData[$i]['estado'] = '<span class="badge bg-primary">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button type="button" class="btn btn-icon btn-sm btn-secondary" onClick="fntEditAula('.$arrData[$i]['id_grado'].')" title="Editar"><span class="tf-icons bx bx-edit-alt"></span></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button type="button" class="btn btn-icon btn-sm btn-danger" onClick="fntDelAula('.$arrData[$i]['id_grado'].')" title="Eliminar"><span class="tf-icons bx bx-message-square-x"></span></button>';
					}
					
					$arrData[$i]['options'] = '<div class="text-center"> '.$btnEdit.' '.$btnDelete.'</div>';

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();

		}


		public function getSelectAulas()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectAulas();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id_grado'].'">'.$arrData[$i]['nombre_grado'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}

		public function getAula(int $idGrado)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdGrado = intval(strClean($idGrado));
				if($intIdGrado > 0)
				{
					$arrData = $this->model->selectAula($intIdGrado);
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


		public function setAula(){

			$intIdGrado = intval($_POST['idGrado']);
			$strAula = strClean($_POST['txtNombre']);
			$intStatus = intVal($_POST['listStatus']);
			//$request_aula = "";

			if($intIdGrado == 0)
			{
				//Crear
				if($_SESSION['permisosMod']['w']){
					$request_aula = $this->model->insertAula($strAula,$intStatus);
					$option = 1;
				}
			}else{
				//Actualizar
				if($_SESSION['permisosMod']['u']){
					$request_aula = $this->model->updateAula($intIdGrado, $strAula, $intStatus);
					$option = 2;
				}
			}

			if($request_aula > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_aula == 'exist'){
				
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El Grado ya existe.');
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();

		}

		public function delAula()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdGrado = intval($_POST['idGrado']);
					$requestDelete = $this->model->deleteAula($intIdGrado);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Grado');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Grado asociado a un Curso o Alumno.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Grado.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}


	}

?>