<?php

	/**
	 * 
	 */
	class Home extends Controllers
	{
		
		public function __construct()
		{
			parent::__construct();
		}

		public function home($params){

			$data['page_id'] = "1";
			$data['page_tag'] = "Home";
			$data['page_title'] = "Página Principal";
			$data['page_name'] = "home";
			$data['page_content'] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
			$this->views->getView($this,"home",$data);

		}

		public function insertar(){
			$data = $this->model->setUser("Carlos", 18);
			$data = $this->model->setUser("Daniel", 15);
			$data = $this->model->setUser("Andy", 23);
			$data = $this->model->setUser("Carmen", 48);
			$data = $this->model->setUser("Daniela", 28);
			print_r($data);
		}

		public function verusuario($id){
			$data = $this->model->getUser($id);
			print_r($data);
		}

		public function actualizar(){
			$data = $this->model->updateUser(1, "Roberto", 20);
			print_r($data);
		}

		public function verusuarios(){
			$data = $this->model->getUsers();
			print_r($data);
		}

		public function eliminarUsuario($id){
			$data = $this->model->delUser($id);
			print_r($data);
		}

	}

?>