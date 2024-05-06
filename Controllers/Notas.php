<?php

	/**
	 * 
	 */
	class Notas extends Controllers
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
			getPermisos(8);
		}

		public function notas($params){

			//
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Promedios";
			$data['page_name'] = "notas";
			$data['page_title'] = "Notas - <small></small>";
			$data['page_functions_js'] = "functions_notas.js";

			$this->views->getView($this,"notas",$data);

		}
		public function verNotas($params){

			//
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_id'] = 2;
			$data['page_tag'] = "Promedios Finales";
			$data['page_name'] = "notas";
			$data['page_title'] = "Notas - <small></small>";
			$data['page_functions_js'] = "functions_notas2.js";

			$this->views->getView($this,"ver-notas",$data);

		}

		public function getRegistros(){

			if($_SESSION['permisosMod']['r']){
				$btnNot = '';
				$arrData = $this->model->selectRegistros($_SESSION['idUser']);

				for ($i=0; $i < count($arrData); $i++) {

					if($_SESSION['permisosMod']['u']){
						$btnNot = '<button type="button" class="btn btn-icon btn-sm btn-primary" onClick="fntAgregarNotas('.$arrData[$i]['id_grado_curso'].')" title="Permisos"><span class="tf-icons bx bx-key"></span></button>';
					}
					
					$arrData[$i]['options'] = '<div class="text-center">'.$btnNot.'</div>';

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();

		}

		public function verNotasGenerales(){

			if($_SESSION['permisosMod']['r']){

				$rol_id = "";
				$idP = $_SESSION['idUser'];
 				if ($_SESSION['userData']['id_rol'] == "5") {
					$rol_id = "1";
				} elseif ($_SESSION['userData']['id_rol'] == "3"){
					$rol_id = "2";
				}


				$arrData = $this->model->selectNotasGenerales($rol_id, $idP);

				for ($i=0; $i < count($arrData); $i++) {
					if (intVal($arrData[$i]['promedio']) >= 11) {
						$arrData[$i]['calificacion'] = '<span class="badge bg-success">Aprobado</span>';
					}else{
						$arrData[$i]['calificacion'] = '<span class="badge bg-danger">Desapobrado</span>';
					}

				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();

		}


		public function getNotasAlumnos(int $idGc){
			$idGc = intval($idGc);
			if ($idGc > 0) {
				$arrCursoGrado = array('id_grado_curso' => $idGc);
				$arrAlumnos = $this->model->selectAlumnosGrado($idGc);
				if (empty($arrAlumnos)) {
					$html = getModal("modalNotasAlumnos", $arrCursoGrado);
					die();
				}
				$arrNotasCursoGrados = $this->model->selectNotasCursoGrados($idGc);
				$arrNotas = array('n1' => '', 'n2' => '', 'n3' => '', 'n4' => '','promedio' => '');

				if(empty($arrNotasCursoGrados))
				{
					for ($i=0; $i < count($arrAlumnos) ; $i++) { 

						$arrAlumnos[$i]['ar_notas'] = $arrNotas;
					}
				}else{
					for ($i=0; $i < count($arrAlumnos); $i++) {
						$arrNotas = array('n1' => '', 'n2' => '', 'n3' => '', 'n4' => '','promedio' => '');
						if(isset($arrNotasCursoGrados[$i])){
							$arrNotas = array('n1' => $arrNotasCursoGrados[$i]['nota_1'],
											  'n2' => $arrNotasCursoGrados[$i]['nota_2'],
											  'n3' => $arrNotasCursoGrados[$i]['nota_3'],
											  'n4' => $arrNotasCursoGrados[$i]['nota_4'],
											  'promedio' => $arrNotasCursoGrados[$i]['promedio']
												);
						}
						$arrAlumnos[$i]['ar_notas'] = $arrNotas;
						
						
					}
				}
				$arrCursoGrado['notas'] = $arrAlumnos;
				$html = getModal("modalNotasAlumnos", $arrCursoGrado);


			}

			die();

		}

		public function setNotasAlumnos()
		{
			if($_POST)
			{
				$intIdGradoCurso = intval($_POST['idGraC']);
				$notas = $_POST['notas'];

				$this->model->deleteNotasAlumnos($intIdGradoCurso);
				foreach ($notas as $nota) {
					$alumno = $nota['id_persona'];
					$nota_1 = round(floatval($nota['n1']),0);
					$nota_2 = round(floatval($nota['n2']),0);
					$nota_3 = round(floatval($nota['n3']),0);
					$nota_4 = round(floatval($nota['n4']),0);
					$promedio = round((($nota_1 + $nota_2 + $nota_3 + $nota_4) / 4), 0);
					$requestRelacion = $this->model->insertNotasAlumnos($intIdGradoCurso, $nota_1, $nota_2, $nota_3, $nota_4, $promedio, $alumno);
				}
				if($requestRelacion > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Notas guardadas correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible guardar las notas.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}



	}

?>