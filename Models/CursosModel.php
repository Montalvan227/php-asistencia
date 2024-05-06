<?php

	class CursosModel extends Mysql
	{
		public $intIdCurso;
		public $strGrado;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();	
		}

		public function selectCursos(){
			$whereAdmin = "";
			
			$sql = "SELECT * FROM tb_cursos WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectCurso(int $idCurso){
			//EXTRAE ROL
			$this->intIdCurso = $idCurso;
			$sql = "SELECT * FROM tb_cursos WHERE id_curso = $this->intIdCurso";
			$request = $this->select($sql); 
			return $request;
		}

		public function insertCurso(string $curso, int $status){

			$return = "";
			$this->strGrado = $curso;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_cursos WHERE nombre_curso = '{$this->strGrado}' AND estado != 0";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tb_cursos(nombre_curso,estado) VALUES(?,?)";
	        	$arrData = array($this->strGrado, $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;

		}

		public function updateCurso(int $idCurso, string $curso, int $status){
			$this->intIdCurso = $idCurso;
			$this->strCurso = $curso;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tb_cursos WHERE nombre_curso = '$this->strCurso' AND id_curso != $this->intIdCurso";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tb_cursos SET nombre_curso = ?, estado = ? WHERE id_curso = $this->intIdCurso ";
				$arrData = array($this->strCurso, $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}


		public function deleteCurso(int $idCurso)
		{
			$this->intIdCurso = $idCurso;
			$sql = "SELECT * FROM tb_persona WHERE grado_id = $this->intIdCurso";
			$request = $this->select_all($sql);
			$sql2 = "SELECT * FROM tb_cursos_curso WHERE grado_id = $this->intIdCurso";
			$request3 = $this->select_all($sql);
			if(empty($request) AND empty($request2))
			{
				$sql = "UPDATE tb_cursos SET estado = ? WHERE id_curso = $this->intIdCurso ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}


		public function selectGrados(){
			$whereAdmin = "";
			
			$sql = "SELECT * FROM tb_grado WHERE estado != 0 AND id_grado != 1";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectCursoGrados(int $idCurso){
			$this->intIdCurso = $idCurso;

			$sql = "SELECT gc.*, c.nombre_curso, p.id_persona, p.nombres, p.apellidos FROM tb_grado_curso gc INNER JOIN tb_cursos c ON gc.curso_id = c.id_curso INNER JOIN tb_persona p ON gc.persona_id = p.id_persona  WHERE curso_id = $this->intIdCurso ";
			$request = $this->select_all($sql);
			return $request;
		}


		public function deleteRelacion(int $idcurso)
		{
			$this->intCursoId = $idcurso;
			$sql = "DELETE FROM tb_grado_curso WHERE curso_id = $this->intCursoId";
			$request = $this->delete($sql);
			return $request;
		}

		public function insertRelacion(int $idcurso, int $idgrado, int $idDocente, int $estado){
			$this->intCursoId = $idcurso;
			$this->intGradoId = $idgrado;
			$this->intDocenteId = $idDocente;
			$this->estado = $estado;

			$sql = "SELECT * FROM tb_grado_curso WHERE grado_id = '$this->intGradoId' AND curso_id = $this->intCursoId";
			$request = $this->select($sql);

			if(empty($request)){
				$query_insert  = "INSERT INTO tb_grado_curso(curso_id,grado_id,persona_id,estado) VALUES(?,?,?,?)";
				$arrData = array($this->intCursoId, $this->intGradoId, $this->intDocenteId, $this->estado);
				$request_insert = $this->insert($query_insert,$arrData);
				return $request_insert;
			} else {


				$sql = "UPDATE tb_grado_curso SET persona_id = ? WHERE grado_id = $this->intGradoId AND curso_id = $this->intCursoId";
				$arrData = array($this->intDocenteId);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = '1';	
				}else{
					$request = '0';
				}

				return $request;

			}

		}




		public function selectDocentesCursos(){
			$sql = "SELECT * FROM tb_persona WHERE estado != 0 AND rol_id = 3";
			$request = $this->select_all($sql);
			return $request;
		}


	}

?>