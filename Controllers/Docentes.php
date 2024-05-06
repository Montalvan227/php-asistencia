<?php
	require_once("Models/PersonaModel.php"); 

	/**
	 * 
	 */
	class Docentes extends Controllers
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

		public function docentes(){

			
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Docentes";
			$data['page_name'] = "Docentes";
			$data['page_title'] = "Docentes - <small>Software de Colegio</small>";
			$data['page_functions_js'] = "functions_docentes.js";

			$this->views->getView($this,"docentes",$data);

		}

		public function getDocentes()
		{	

			if($_SESSION['permisosMod']['r']){
				
				$arrData = $this->model->selectDocentes();
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