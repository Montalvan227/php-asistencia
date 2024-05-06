<?php

	/**
	 * 
	 */
	class Cursos extends Controllers
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

		public function cursos($params){

			//
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 5;
			$data['page_tag'] = "Cursos";
			$data['page_name'] = "cursos";
			$data['page_title'] = "Cursos - <small>Software Colegio</small>";
			$data['page_functions_js'] = "functions_cursos.js";

			$this->views->getView($this,"cursos",$data);

		}

		public function getCursos(){

			if($_SESSION['permisosMod']['r']){
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				$arrData = $this->model->selectCursos();

				for ($i=0; $i < count($arrData); $i++) {
					if ($arrData[$i]['estado'] == 1) {
						$arrData[$i]['estado'] = '<span class="badge bg-primary">Activo</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge bg-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['u']){
						$btnGrados = '<button type="button" class="btn btn-icon btn-sm btn-primary" onClick="fntCursosGrados('.$arrData[$i]['id_curso'].')" title="Grados"><span class="tf-icons bx bx-collection"></span></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button type="button" class="btn btn-icon btn-sm btn-secondary" onClick="fntEditCurso('.$arrData[$i]['id_curso'].')" title="Editar"><span class="tf-icons bx bx-edit-alt"></span></button>';
					}
					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button type="button" class="btn btn-icon btn-sm btn-danger" onClick="fntDelCurso('.$arrData[$i]['id_curso'].')" title="Eliminar"><span class="tf-icons bx bx-message-square-x"></span></button>';
					}
					
					$arrData[$i]['options'] = '<div class="text-center"> '.$btnGrados.' '.$btnEdit.' '.$btnDelete.'</div>';

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();

		}


		public function getSelectCursos()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectCursos();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id_curso'].'">'.$arrData[$i]['nombre_curso'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();
		}

		public function getCurso(int $idCurso)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdCurso = intval(strClean($idCurso));
				if($intIdCurso > 0)
				{
					$arrData = $this->model->selectCurso($intIdCurso);
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


		public function setCurso(){

			$intIdCurso = intval($_POST['idCurso']);
			$strCurso = strClean($_POST['txtNombre']);
			$intStatus = intVal($_POST['listStatus']);
			//$request_curso = "";

			if($intIdCurso == 0)
			{
				//Crear
				if($_SESSION['permisosMod']['w']){
					$request_curso = $this->model->insertCurso($strCurso,$intStatus);
					$option = 1;
				}
			}else{
				//Actualizar
				if($_SESSION['permisosMod']['u']){
					$request_curso = $this->model->updateCurso($intIdCurso, $strCurso, $intStatus);
					$option = 2;
				}
			}

			if($request_curso > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_curso == 'exist'){
				
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El Curso ya existe.');
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();

		}

		public function delCurso()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdCurso = intval($_POST['idCurso']);
					$requestDelete = $this->model->deleteCurso($intIdCurso);
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





		public function getCursosGrado(int $idcurso){
			$cursoid = intval($idcurso);
			if ($cursoid > 0) {
				$arrGrados = $this->model->selectGrados();
				$arrCursoGrados = $this->model->selectCursoGrados($cursoid);
				$arrRelacion = array('estado' => 0, 'id_persona' => 1, 'nombre_completo' => '--');
				$arrCursoGrado = array('id_curso' => $cursoid);

				if(empty($arrCursoGrados))
				{
					for ($i=0; $i < count($arrGrados) ; $i++) { 

						$arrGrados[$i]['s_grados'] = $arrRelacion;
					}
				}else{
					for ($i=0; $i < count($arrGrados); $i++) {
						$arrRelacion = array('estado' => 0);
						if(isset($arrCursoGrados[$i])){
							$arrRelacion = array('estado' => $arrCursoGrados[$i]['estado'],
												'id_persona' => $arrCursoGrados[$i]['id_persona'],
												'nombre_completo' => $arrCursoGrados[$i]['nombres'] ." ". $arrCursoGrados[$i]['apellidos']
												);
						}
						$arrGrados[$i]['s_grados'] = $arrRelacion;
						
						
					}
				}
				$arrCursoGrado['grados'] = $arrGrados;
				$html = getModal("modalCursoGrados", $arrCursoGrado);


			}

			die();

		}

		public function setCursosGrado()
		{
			if($_POST)
			{
				$intIdCurso = intval($_POST['idCurso']);
				$grados = $_POST['grados'];

				//$this->model->deleteRelacion($intIdCurso);
				foreach ($grados as $grado) {
					$idRel = $grado['id_grado'];
					$docente = $grado['persona_id'];
					$estado = empty($grado['estado']) ? 0 : 1;
					$requestRelacion = $this->model->insertRelacion($intIdCurso, $idRel, $docente, $estado);
				}
				if($requestRelacion > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Grados asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los Grados.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}



		public function getSelectDocentesCursos()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectDocentesCursos();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id_persona'].'">'.$arrData[$i]['nombres']." ".$arrData[$i]['apellidos'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}




	}

?>