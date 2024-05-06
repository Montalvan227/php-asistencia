<?php

	class NotasModel extends Mysql
	{
		public $intIdGrado;
		public $strGrado;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();	
		}

		public function selectRegistros(int $idUser){

			$this->intIdUser = $idUser;
			
			$sql = "SELECT gc.*, g.nombre_grado, c.nombre_curso FROM tb_grado_curso gc INNER JOIN tb_grado g ON gc.grado_id = g.id_grado INNER JOIN tb_cursos c ON gc.curso_id = c.id_curso INNER JOIN tb_persona p ON gc.persona_id = p.id_persona WHERE gc.estado != 0 AND gc.persona_id = $this->intIdUser";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectNotasGenerales(string $rolid, int $idP){

			$this->strRolId = $rolid;
			$this->intIdP = $idP;
			$whereAdmin = "";
			if($rolid == "1"){
				$whereAdmin = " and n.persona_id = " . $idP;
			} elseif($rolid == "2") {
				$whereAdmin = " and gc.persona_id = " . $idP;
			}


			
			$sql = "SELECT p.nombres, p.apellidos, Concat(p.nombres, ' ',p.apellidos) as nombre_completo, gc.*, g.nombre_grado, c.nombre_curso, n.*  FROM tb_grado_curso gc INNER JOIN tb_grado g ON gc.grado_id = g.id_grado INNER JOIN tb_cursos c ON gc.curso_id = c.id_curso INNER JOIN tb_notas n ON gc.id_grado_curso = n.grado_curso_id INNER JOIN tb_persona p ON n.persona_id = p.id_persona WHERE gc.estado != 0" . $whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectAula(int $idGrado){
			//EXTRAE ROL
			$this->intIdGrado = $idGrado;
			$sql = "SELECT * FROM tb_grado WHERE id_grado = $this->intIdGrado";
			$request = $this->select($sql); 
			return $request;
		}

		public function insertAula(string $grado, int $status){

			$return = "";
			$this->strGrado = $grado;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_grado WHERE nombre_grado = '{$this->strGrado}' AND estado != 0";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tb_grado(nombre_grado,estado) VALUES(?,?)";
	        	$arrData = array($this->strGrado, $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;

		}

		public function selectAlumnosGrado(int $idGradoC){
			//EXTRAE ROL
			$this->intIdGradoC = $idGradoC;
			$sql = "SELECT p.* FROM tb_persona p INNER JOIN tb_grado_curso gc ON p.grado_id = gc.grado_id WHERE gc.id_grado_curso = $this->intIdGradoC";
			$request = $this->select_all($sql); 
			return $request;
		}

		public function selectNotasCursoGrados(int $idGradoC){
			//EXTRAE ROL
			$this->intIdGradoC = $idGradoC;
			$sql = "SELECT p.*, gc.*, n.* FROM tb_notas n INNER JOIN tb_grado_curso gc ON n.grado_curso_id = gc.id_grado_curso INNER JOIN tb_persona p ON n.persona_id = p.id_persona WHERE n.grado_curso_id = $this->intIdGradoC";
			$request = $this->select_all($sql); 
			return $request;
		}


		public function deleteNotasAlumnos(int $idGraC)
		{
			$this->intIdGradoCurso = $idGraC;
			$sql = "DELETE FROM tb_notas WHERE grado_curso_id = $this->intIdGradoCurso";
			$request = $this->delete($sql);
			return $request;
		}

		public function insertNotasAlumnos(int $idGraC, int $n1, int $n2, int $n3, int $n4, int $promedio, int $idPersona){
			$this->intIdGradoCurso = $idGraC;
			$this->n1 = $n1;
			$this->n2 = $n2;
			$this->n3 = $n3;
			$this->n4 = $n4;
			$this->promedio = $promedio;
			$this->idAlumno = $idPersona;
			$query_insert  = "INSERT INTO tb_notas(nota_1,nota_2,nota_3,nota_4,promedio,grado_curso_id,persona_id) VALUES(?,?,?,?,?,?,?)";
        	$arrData = array($this->n1, $this->n2, $this->n3, $this->n4, $this->promedio, $this->intIdGradoCurso, $this->idAlumno);
        	$request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}





	}

?>