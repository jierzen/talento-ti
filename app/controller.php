<?php
class Controller {
    //! Instantiate class
	function __construct() {
        new Session();
		$f3=Base::instance();
		// Connect to the database
		$db=new DB\SQL(
            'mysql:host=localhost;port=3306;dbname='.getenv('DB_NAME'),
            getenv('DB_USER'),
            getenv('DB_PASSWORD')
        );
		// Use database-managed sessions
		new DB\SQL\Session($db);
		// Save frequently used variables
		$this->db=$db;
	}


	/**
 * Enviar la sesion de usuario, persona, ofertas y solicitudes segun corresponda
 *
 */
	function sessionPersona($f3, $id_usuario){
		//Se envia la sesion de los profesionales y empresas
		$db = $this->db;

		$usuario = new DB\SQL\Mapper($db, 'usuarios');
		$persona = new DB\SQL\Mapper($db, 'personas');

		//LOADs
		$usuario->load(['id_usuario=?', $id_usuario]);
		$persona->load(['id_usuario=?', $id_usuario]);

		$id_persona = $persona->get('id_persona');
		$tipo_persona = $persona->get('id_tipo_persona');

		$queryOfertas = '';
		$querySolicitudes = '';
		$queryMatches = '';

		$estado_oferta_activa = $f3->get('ESTADO_OFERTA_ACTIVA');
		$estado_solicitud_pendiente = $f3->get('ESTADO_SOLICITUD_PENDIENTE');
		$estado_solicitud_finalizada = $f3->get('ESTADO_SOLICITUD_FINALIZADA');


		switch ($tipo_persona) {
			case $f3->get('TIPO_PERSONA_EMPRESA'):
				$queryOfertas = "SELECT ofe.* FROM ofertas ofe 
				                 WHERE ofe.id_oferta IN
				                                        (SELECT op.id_oferta 
														FROM ofertas_personas op 
														WHERE op.id_persona = $id_persona AND op.id_estado = $estado_oferta_activa)";
				$ofertas = $db->exec($queryOfertas);

				//Las solicitudes son los registros de los profesionales que quieran ser contactados. Para una solicitud debe existir un match
				$querySolicitudes = "SELECT * FROM solicitudes sol WHERE sol.id_persona_emp = $id_persona";
				
				//Un match es solamente una comparacion entre las ofertas (ofertas_habilidades) creadas por Empresa vs las habilidades de la tabla habilidades_personas de los Profesionales
				// $queryMatches = $db->exec ("SELECT COUNT(*) AS matches, id_persona_prof, id_solicitud, id_oferta FROM solicitudes
				// 				 WHERE id_persona_emp = $id_persona
				// 				 GROUP BY id_persona_prof");				
				$queryMatches = $db->exec ("SELECT COUNT(per.id_persona) as matches, ofh.id_oferta FROM personas per 
											INNER JOIN habilidades_personas hp ON hp.id_persona = per.id_persona
											INNER JOIN ofertas_habilidades ofh ON ofh.id_habilidad = hp.id_habilidad
											WHERE hp.id_habilidad IN (SELECT ofe.id_habilidad FROM ofertas_habilidades ofe 
																	INNER JOIN ofertas_personas op ON op.id_oferta = ofe.id_oferta)
											GROUP BY ofh.id_oferta");
				$f3->set('SESSION.matches', $queryMatches);
				break;
			case $f3->get('TIPO_PERSONA_PROFESIONAL'):
				$queryOfertas = "SELECT DISTINCT(ofe.id_oferta), ofe.* FROM ofertas ofe
				                 INNER JOIN ofertas_personas ofp ON ofe.id_oferta = ofp.id_oferta
								 INNER JOIN ofertas_habilidades ofh ON ofh.id_oferta = ofe.id_oferta
								 INNER JOIN habilidades_personas hp ON ofh.id_habilidad = hp.id_habilidad
								 WHERE hp.id_persona = $id_persona
								 AND ofe.id_oferta NOT IN (
															SELECT ofe.id_oferta FROM ofertas ofe
															INNER JOIN solicitudes sol ON sol.id_oferta = ofe.id_oferta
															)
								AND ofp.id_estado = $estado_oferta_activa";
				$ofertas = $db->exec($queryOfertas);

				$queryOfertasSolicitadas = "SELECT DISTINCT(ofe.id_oferta), ofe.* FROM ofertas ofe
				                            INNER JOIN ofertas_personas ofp ON ofe.id_oferta = ofp.id_oferta
											INNER JOIN ofertas_habilidades ofh ON ofh.id_oferta = ofe.id_oferta
											INNER JOIN habilidades_personas hp ON ofh.id_habilidad = hp.id_habilidad
											WHERE hp.id_persona = $id_persona
											AND ofe.id_oferta IN (
																	SELECT ofe.id_oferta FROM ofertas ofe
																	INNER JOIN solicitudes sol ON sol.id_oferta = ofe.id_oferta
																	WHERE sol.id_estado IN ($estado_solicitud_pendiente,$estado_solicitud_finalizada))
											AND ofp.id_estado = $estado_oferta_activa";
				$ofertasSolicitadas = $db->exec($queryOfertasSolicitadas);
                $f3->set('SESSION.ofertasSolicitadas', $ofertasSolicitadas);
				
				$querySolicitudes = "SELECT * FROM solicitudes sol WHERE sol.id_persona_prof = $id_persona";

				$habilidades = 	$db->exec("SELECT hab.id_habilidad,
											      hab.nombre_habilidad,
												  hab.descripcion_habilidad,
												  hp.nivel,
												  hab.grupo 
										   FROM habilidades_personas hp 
										   INNER JOIN habilidades hab ON hab.id_habilidad = hp.id_habilidad
										   WHERE hp.id_persona = $id_persona");
				$f3->set('SESSION.habilidades', $habilidades);

				$queryHabilidadesPorOferta = '';
				foreach ($ofertas as $valor) {
					$queryHabilidadesPorOferta = $db->exec("SELECT COUNT(*) AS habilidades_count, hp.id_persona, ofe.id_oferta FROM ofertas_habilidades ofh
					INNER JOIN ofertas ofe ON ofe.id_oferta = ofh.id_oferta
					INNER JOIN habilidades_personas hp ON hp.id_habilidad = ofh.id_habilidad
					WHERE hp.id_persona = $id_persona
					GROUP BY ofh.id_oferta");
				}
				$f3->set('SESSION.habxofe', $queryHabilidadesPorOferta);
	
				//habilidades totales por oferta (solo Profesional)
				// $queryHabsTotalesPorOfer = $db->exec("SELECT COUNT(id_oferta_habilidad) AS total_habs, id_oferta from ofertas_habilidades
				// group by id_oferta");
				$queryHabsTotalesPorOfer = $db->exec("SELECT COUNT(hp.id_habilidad) AS total_habs, ofh.id_oferta FROM habilidades_personas hp
				INNER JOIN ofertas_habilidades ofh ON ofh.id_habilidad = hp.id_habilidad
				WHERE hp.id_persona = $id_persona AND
				hp.id_habilidad IN (SELECT id_habilidad FROM ofertas_habilidades)
				GROUP BY ofh.id_oferta");
				$f3->set('SESSION.habTot', $queryHabsTotalesPorOfer);
				break;
			default:
				# code...
				break;
		}

		//CASTs
		$session_usuario = array();
		do {
			array_push($session_usuario, $usuario->cast());
			$usuario->skip();
		} while (!$usuario->dry());

		$session_persona = array();
		do {
			array_push($session_persona, $persona->cast());
			$persona->skip();
		} while (!$persona->dry());

		$solicitudes = $db->exec($querySolicitudes);
		$f3->set('SESSION.usuario', $session_usuario);
		$f3->set('SESSION.persona', $session_persona);
		$f3->set('SESSION.ofertas', $ofertas);
		$f3->set('SESSION.solicitudes', $solicitudes);



	}
}
