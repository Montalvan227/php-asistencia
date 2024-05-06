<?php 

	class DashboardModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}	

		public function getAsistenciaHoy(string $fecha)
		{
			$this->dateFecha = $fecha;
			$sql = "SELECT COUNT(*) AS total FROM tb_asistencia WHERE DATE(fecha_asistencia) = '{$this->dateFecha}'";
					$request = $this->select_all($sql);
					return $request;
		}

		public function getAlumnosTotal()
		{
			$sql = "SELECT COUNT(*) AS total FROM tb_persona WHERE rol_id = 5";
					$request = $this->select_all($sql);
					return $request;
		}

		public function getTotalesAsistencias(string $fecha)
		{
			$this->dateFecha = $fecha;
			$sql = "SELECT SUM(FIND_IN_SET('1', a.t_asistencia)) AS asistencias, SUM(FIND_IN_SET('2', a.t_asistencia)) AS tardanzas, (SELECT COUNT(*) FROM tb_persona tp WHERE tp.rol_id = 5) AS faltas FROM tb_asistencia a INNER JOIN tb_persona p ON a.persona_id = p.id_persona WHERE DATE(a.fecha_asistencia) = '{$this->dateFecha}'";
					$request = $this->select_all($sql);
					return $request;
		}

		public function getAlumnosPuntuales(string $fecha)
		{
			$this->dateFecha = $fecha;
			$sql = "SELECT p.*,a.* FROM tb_persona p INNER JOIN tb_asistencia a ON p.id_persona = a.persona_id WHERE DATE(a.fecha_asistencia) = '{$this->dateFecha}' LIMIT 5";
					$request = $this->select_all($sql);
					return $request;
		}

		public function getAlumnosMasAsistencias()
		{
			$sql = "SELECT p.id_persona, p.nombres, p.apellidos, COUNT(a.persona_id) AS total_asistencias FROM tb_persona p LEFT JOIN tb_asistencia a ON p.id_persona = a.persona_id  WHERE p.rol_id = 5 GROUP BY p.id_persona, p.nombres, p.apellidos ORDER BY total_asistencias DESC LIMIT 5";
					$request = $this->select_all($sql);
					return $request;
		}

		public function getAlumnosMenosAsistencias()
		{
			$sql = "SELECT p.id_persona, p.nombres, p.apellidos, COUNT(a.persona_id) AS total_asistencias FROM tb_persona p LEFT JOIN tb_asistencia a ON p.id_persona = a.persona_id  WHERE p.rol_id = 5 GROUP BY p.id_persona, p.nombres, p.apellidos ORDER BY total_asistencias ASC LIMIT 5";
					$request = $this->select_all($sql);
					return $request;
		}

		public function asistenciasXgrado(string $fecha)
		{
			$this->dateFecha = $fecha;
			$sql = "SELECT g.nombre_grado, 
				SUM(CASE WHEN a.t_asistencia = '1' THEN 1 ELSE 0 END) AS puntuales,
				SUM(CASE WHEN a.t_asistencia = '2' THEN 1 ELSE 0 END) AS tardanza,
				SUM(CASE WHEN a.t_asistencia = '3' THEN 1 ELSE 0 END) AS tardanza_justificada,
				SUM(CASE WHEN a.t_asistencia = '4' THEN 1 ELSE 0 END) AS falta_justificada,
				SUM(CASE WHEN a.t_asistencia = '5' THEN 1 ELSE 0 END) AS falta
				FROM `tb_asistencia` a INNER JOIN tb_persona p ON a.persona_id = p.id_persona INNER JOIN tb_grado g ON g.id_grado = p.grado_id WHERE DATE(a.fecha_asistencia) = '{$this->dateFecha}' GROUP BY g.id_grado";

				$request = $this->select_all($sql);
					return $request;

		}


	}


?>
