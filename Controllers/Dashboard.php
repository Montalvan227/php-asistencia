<?php

	/**
	 * 
	 */
	class Dashboard extends Controllers
	{
		
		public function __construct()
		{
			parent::__construct();
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MDASHBOARD);
		}

		public function dashboard()
		{


			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard";
			$data['page_title'] = "Dashboard";
			$data['page_name'] = "dashboard";
			$data['asistencia-hoy'] = $this->model->getAsistenciaHoy(date('Y-m-d'));
			$data['total-alumnos'] = $this->model->getAlumnosTotal();
			$data['totales-asistencias'] = $this->model->getTotalesAsistencias(date('Y-m-d'));
			$data['alumnos-puntuales'] = $this->model->getAlumnosPuntuales(date('Y-m-d'));
			$data['asistenciasXgrado'] = $this->model->asistenciasXgrado(date('Y-m-d'));
			$data['alumnos-mas-asistencias'] = $this->model->getAlumnosMasAsistencias();
			$data['alumnos-menos-asistencias'] = $this->model->getAlumnosMenosAsistencias();
			$data['page_functions_js'] = "functions_dashboard.js";
				$this->views->getView($this,"dashboard",$data);
			//}*/
		}


	}

?>