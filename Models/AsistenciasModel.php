<?php

	class AsistenciasModel extends Mysql
	{
		public $intIdCurso;
		public $strGrado;
		public $intStatus;
		
		public function __construct()
		{
			parent::__construct();	
		}

		public function selectAsistencias(){
			$whereAdmin = "";
			
			$sql = "SELECT * FROM tb_cursos WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectAsistencia(int $idCurso){
			//EXTRAE ROL
			$this->intIdCurso = $idCurso;
			$sql = "SELECT * FROM tb_cursos WHERE id_curso = $this->intIdCurso";
			$request = $this->select($sql); 
			return $request;
		}


		public function selectAsistenciasGenerales(string $rolid, int $idP){

			$this->strRolId = $rolid;
			$this->intIdP = $idP;
			$whereAdmin = "";
			if(!empty($rolid)){
				$whereAdmin = " and a.persona_id = " . $idP;
			}

			
			$sql = "SELECT CONCAT(p.nombres, ' ', p.apellidos) AS nombre_completo, g.nombre_grado, DATE_FORMAT(a.fecha_asistencia, '%d-%m-%Y') as fechaAsistencia, TIME(a.fecha_asistencia) as horaAsistencia, a.t_asistencia, a.id_asistencia FROM  tb_asistencia a INNER JOIN tb_persona p ON a.persona_id = p.id_persona INNER JOIN tb_grado g ON p.grado_id = g.id_grado WHERE p.estado != 0" . $whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}
		public function insertAsistencia(string $documento, string $t_asistencia){

			$return = "";
			$this->strDocumento = $documento;
			$this->strTAsistencia = $t_asistencia;
			$this->strFecha  = date('Y-m-d H:i:s');
			$this->strFechas  = date("Y-m-d", strtotime($this->strFecha));

			$sql = "SELECT id_persona FROM tb_persona WHERE n_documento = '{$this->strDocumento}' AND estado != 0 AND rol_id = 5";
			$request_i = $this->select_all($sql);


			if(!empty($request_i)){

				$this->strId = $request_i[0]["id_persona"];
				
				$sql = "SELECT * FROM tb_asistencia a INNER JOIN tb_persona p ON a.persona_id = p.id_persona WHERE p.id_persona = '$this->strId' AND DATE(a.fecha_asistencia) = '$this->strFechas'  AND estado != 0";
				$request = $this->select($sql);

				if(empty($request))
				{
					$query_insert  = "INSERT INTO tb_asistencia(persona_id,fecha_asistencia,t_asistencia) VALUES(?,?,?)";
		        	$arrData = array($this->strId, $this->strFecha, $this->strTAsistencia);
		        	$request_insert = $this->insert($query_insert,$arrData);
		        	if($request_insert > 0){
		                // Registro insertado correctamente, devuelve el registro ingresado
		                $return = $this->getAsistenciaById($request_insert);
		            }else{
		                // Maneja el error de inserción
		                $return = "error";
		            }
				}else{
					$return = "exist";
				}
			}else{
				$return = "error";
			}

			return $return;

		}

		public function cerrarAsistenciaD(string $fecha, string $fechaHora){
			$this->strFecha = $fecha;
			$this->strFechaC = $fechaHora;
			$sql = "SELECT COUNT(*) AS total FROM tb_asistencia WHERE DATE(fecha_asistencia) = CURDATE()";
			$request = $this->select($sql);
			dep($request['total']);
			if ($request['total'] >= 1) {
				$query_insert = "INSERT INTO tb_asistencia (persona_id, fecha_asistencia, t_asistencia) SELECT p.id_persona, ?, '3' FROM tb_persona p WHERE p.id_persona NOT IN (SELECT DISTINCT a.persona_id FROM tb_asistencia a WHERE DATE(a.fecha_asistencia) = CURDATE()) AND p.rol_id = '5'";
			    $arrData = array($this->strFechaC);
			    $request_insert = $this->insert($query_insert,$arrData);
				return $request_insert;
			}

		}

		public function getAsistenciaById($id){
    		// Consulta para obtener el registro de asistencia por ID
		    $sql = "SELECT a.*, p.*, g.nombre_grado FROM tb_asistencia a INNER JOIN tb_persona p ON a.persona_id = p.id_persona INNER JOIN tb_grado g ON p.grado_id = g.id_grado WHERE id_asistencia = $id";
		    $request = $this->select($sql);
		    
		    // Verifica si se encontró el registro
		    if(!empty($request)){
		        return $request; // Devuelve el registro encontrado
		    }else{
		        return "error"; // Maneja el caso en el que no se encontró el registro
		    }
		}




		public function updateAsistencia(int $idAsistencia, int $tAsistencia)
		{
			$this->intIdAsistencia = $idAsistencia;
			$this->intTAsistencia = $tAsistencia;

			$sql = "UPDATE tb_asistencia SET t_asistencia = ? WHERE id_asistencia = $this->intIdAsistencia ";
			$arrData = array($this->intTAsistencia);
			$request = $this->update($sql,$arrData);
			if($request)
			{
				$request = 'ok';	
			}else{
				$request = 'error';
			}
			return $request;
		}


	}

?>