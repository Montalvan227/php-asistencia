<?php
	require_once("Models/PersonaModel.php"); 

	/**
	 * 
	 */
	class Alumnos extends Controllers
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
			getPermisos(3);
		}

		public function alumnos(){

			
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Alumnos";
			$data['page_name'] = "Alumnos";
			$data['page_title'] = "Alumnos - <small>Software de Colegio</small>";
			$data['page_functions_js'] = "functions_alumnos.js";

			$this->views->getView($this,"alumnos",$data);

		}

		public function getAlumnos()
		{	

			if($_SESSION['permisosMod']['r']){
				
				$arrData = $this->model->selectAlumnos();
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
				
	}


?>