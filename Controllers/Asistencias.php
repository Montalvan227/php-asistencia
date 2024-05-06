<?php

	/**
	 * 
	 */
	class Asistencias extends Controllers
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
			getPermisos(7);
		}

		public function asistencias($params){

			//
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Registro de Asistencias";
			$data['page_name'] = "Asistencia";
			$data['page_title'] = "Asistencia - <small>Software Colegio</small>";
			$data['page_functions_js'] = "functions_asistencia.js";
			$currentTime = new DateTime(); // Obtiene la hora actual como un objeto DateTime
			$endTime = DateTime::createFromFormat('H:i:s', '09:00:00'); 
			if ($currentTime >= $endTime) {
				$data['cierre_asistencias'] = $this->model->cerrarAsistenciaD(date("Y-m-d"),date("Y-m-d H:i:s"));
			}

			$this->views->getView($this,"tomar_asistencia",$data);


		}

		public function verAsistencias($params){

			//
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Control de Asistencias";
			$data['page_name'] = "Asistencia";
			$data['page_title'] = "Asistencia - <small>Software Colegio</small>";
			$data['page_functions_js'] = "functions_asistencia2.js";
			$currentTime = new DateTime(); // Obtiene la hora actual como un objeto DateTime
			$endTime = DateTime::createFromFormat('H:i:s', '09:00:00'); // Crea un objeto DateTime para la hora de inicio (12:45:00)
			if ($currentTime >= $endTime) {
				$data['cierre_asistencias'] = $this->model->cerrarAsistenciaD(date("Y-m-d"),date("Y-m-d H:i:s"));
			}

			$this->views->getView($this,"asistencia",$data);

		}

		public function verAsistenciasGenerales(){

			if($_SESSION['permisosMod']['r']){
				$rol_id = "";
				$idP = $_SESSION['idUser'];
 				if ($_SESSION['userData']['id_rol'] == "5") {
					$rol_id = "1";
				}
				$arrData = $this->model->selectAsistenciasGenerales($rol_id, $idP);


				for ($i=0; $i < count($arrData); $i++) {
					if ($arrData[$i]['t_asistencia'] == 1) {
						$arrData[$i]['estado'] = '<span class="badge bg-primary">Asistencia Puntual</span>';
					}elseif($arrData[$i]['t_asistencia'] == 2){
						$arrData[$i]['estado'] = '<span class="badge" style="background-color: #FFBF00; color: white;">Tardanza</span>';
					}elseif($arrData[$i]['t_asistencia'] == 3){
						$arrData[$i]['estado'] = '<span class="badge" style="background-color: red; color: white;">Falta</span>';
					}elseif($arrData[$i]['t_asistencia'] == 4){
						$arrData[$i]['estado'] = '<span class="badge bg-danger">Falta Justificada</span>';
					}else{
						$arrData[$i]['estado'] = '<span class="badge bg-warning">Tardanza Justificada</span>';
					}

					if ($arrData[$i]['t_asistencia'] == 3 || $arrData[$i]['t_asistencia'] == 4) {
						$arrData[$i]['horaAsistencia'] = "-";
					}
					
					if($_SESSION['permisosMod']['u']){
						$arrData[$i]['acciones'] = '
                            <select class="form-select" id="editarM'.$arrData[$i]['id_asistencia'].'" name="editarM" onChange="editarMarcacion('.$arrData[$i]['id_asistencia'].');">
                              <option value="6" selected>Cambiar Asistencia</option>
                              <option value="5">Tardanza Justificada</option>
                              <option value="4">Falta Justificada</option>
                            </select>';
					}else{
						$arrData[$i]['acciones'] = 'S/A';
					}

				}




				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			if($_SESSION['permisosMod']['w']){
				$rol_id = "";
				$idP = $_SESSION['idUser'];
				if ($_SESSION['userData']['id_rol'] == "5"){
					$rol_id= "1";
				}
				$arrData = $this->model->selectAsistenciasGenerales($rol_id, $idP);
			}
			die();

		}



		public function setAsistencia() {
			$dniAsistencia = intval($_POST['dni_asistencia']);
			$currentTime = new DateTime(); // Obtiene la hora actual como un objeto DateTime
			$startTime = DateTime::createFromFormat('H:i:s', '15:12:00'); // Crea un objeto DateTime para la hora de Puntualidad-> (12:45:00)
			$endTime = DateTime::createFromFormat('H:i:s', '15:15:00'); // Crea un objeto DateTime para la hora de <-Tardanza (12:45:00)
		
			if ($currentTime <= $startTime) {
				$arrResponse = array("status" => false, "msg" => 'La Asistencia se inicia a partir de las 03:15');
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
				die();
			} else {
				if ($dniAsistencia) {
					// Verificar si es después de las 1:40 PM para marcar "falta"
					$threePM = DateTime::createFromFormat('H:i:s', '15:25:00'); // Crea un objeto DateTime para la hora de <-Falta (12:45:00)
					if ($currentTime >= $threePM) {
						$t_asistencia = "3"; // Marcar como falta
					} elseif ($currentTime <= $endTime) {
						$t_asistencia = "1"; // Marcar como puntual
					} else {
						$t_asistencia = "2"; // Marcar como tardanza
					}
		
					if ($_SESSION['permisosMod']['w']) {
						$request_asistencia = $this->model->insertAsistencia($dniAsistencia, $t_asistencia);
						$option = 1;
					}
				}
		
				if ($request_asistencia == 'exist') {
					$arrResponse = array('status' => false, 'msg' => 'Ya se tomó la Asistencia del Alumno');
				} elseif ($request_asistencia == 'error') {
					$arrResponse = array("status" => false, "msg" => 'Alumno no Registrado');
				} else {
					$arrResponse = array('status' => true, 'msg' => $request_asistencia);
				}
		
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
				die();
			}
		}

		public function updateTAsistencia()
		{	
			if($_POST){
				if($_SESSION['permisosMod']['u']){
					$intIdAsistencia = intval($_POST['idAsistencia']);
					$intTAsistencia = intval($_POST['tAsistencia']);
					$requestDelete = $this->model->updateAsistencia($intIdAsistencia,$intTAsistencia);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se actualizo la Asistencia');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'No es posible actualizar la Asistencia.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
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