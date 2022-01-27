<?php

class Solicitud extends Controller {
    function solicitudes($f3) {
		$db = $this->db;
		$solicitudes = new DB\SQL\Mapper($db, 'solicitudes');
        $solicitudes->oferta = 'SELECT nombre_oferta FROM ofertas WHERE ofertas.id_oferta=solicitudes.id_oferta';
        $solicitudes->profesional = 'SELECT CONCAT(nombre_razonsocial, " ", apellidos) AS profesional FROM personas WHERE personas.id_persona=solicitudes.id_persona_prof';
        $solicitudes->empresa = 'SELECT CONCAT(nombre_razonsocial, " ", apellidos) AS empresa FROM personas WHERE personas.id_persona=solicitudes.id_persona_emp';
        $solicitudes->estado = 'SELECT nombre_estado FROM estados WHERE estados.id_estado=solicitudes.id_estado';
		$solicitudes->load();
		// if ($solicitudes->dry()) {
		// 	die('No existen registros de solicitudes.');
		// }
		$array = array();
		do {
			array_push($array, $solicitudes->cast());
			$solicitudes->skip();
		} while (!$solicitudes->dry());
		$f3->set('solicitudes', $array);

		$rows_oferta = $db->exec('SELECT * FROM ofertas');
		$f3->set('ofertas', $rows_oferta);

		$rows_idPerProf = $db->exec('SELECT per.id_persona, per.nombre_razonsocial, per.apellidos, hab.nombre_habilidad, hper.nivel 
									FROM personas per INNER JOIN habilidades_personas hper ON per.id_persona = hper.id_persona 
									INNER JOIN habilidades hab ON hper.id_habilidad = hab.id_habilidad 
									INNER JOIN usuarios usu ON per.id_usuario = usu.id_usuario 
									INNER JOIN usuarios_roles ur ON ur.id_usuario = usu.id_usuario 
									INNER JOIN roles rol ON ur.id_rol = rol.id_rol 
									WHERE rol.id_rol = 4');
		$f3->set('id_prof_linelist', $rows_idPerProf);

		$rows_idPerEmp = $db->exec('SELECT per.id_persona, per.nombre_razonsocial, per.apellidos FROM personas per
									INNER JOIN usuarios usu ON usu.id_usuario = per.id_usuario
									INNER JOIN usuarios_roles urol ON urol.id_usuario = usu.id_usuario
									INNER JOIN roles rol ON rol.id_rol = urol.id_rol
									WHERE rol.id_rol = 5');
		$f3->set('id_perEmp_linelist', $rows_idPerEmp);

		$rows_estado = $db->exec('SELECT id_estado, nombre_estado, descripcion_estado FROM estados WHERE tabla="solicitudes"');
		$f3->set('estados', $rows_estado);
        $prof = new DB\SQL\Mapper($db, 'personas');
		$prof->load(["id_tipo_persona=?", $f3->get('TIPO_PERSONA_PROFESIONAL')]);
		// if ($prof->dry()) {
		// 	die('No existen registros de solicitudes.');
		// }
		$array_prof = array();
		do {
			array_push($array_prof, $prof->cast());
			$prof->skip();
		} while (!$prof->dry());
		$f3->set('prof', $array_prof);
        $emp = new DB\SQL\Mapper($db, 'personas');
		$emp->load(["id_tipo_persona=?", $f3->get('TIPO_PERSONA_EMPRESA')]);
		// if ($emp->dry()) {
		// 	die('No existen registros de solicitudes.');
		// }
		$array_emp = array();
		do {
			array_push($array_emp, $emp->cast());
			$emp->skip();
		} while (!$emp->dry());
		$f3->set('emp', $array_emp);
		$f3->set('template', 'solicitudes');

		echo View::instance()->render('layout.html');
	}
	function solicitudes_read($f3, $args) {
		$db = $this->db;
		$solicitudes = new DB\SQL\Mapper($db, 'solicitudes');
		$solicitudes->load(['id_solicitud=?', $args['id']]);
		if ($solicitudes->dry()) {
			die('No encuentra solicitud con id ' . $args['id']);
		}
		$array = array();
		do {
			array_push($array, $solicitudes->cast());
			$solicitudes->skip();
		} while (!$solicitudes->dry());

		$f3->set('solicitudes', $array);
        $f3->set('template', 'solicitudes');

		echo View::instance()->render('layout.html');
	}
	function solicitudes_update($f3, $args) {
		$db = $this->db;
		$solicitudes = new DB\SQL\Mapper($db, 'solicitudes');
		$solicitudes->load(['id_solicitud=?', $args['id']]);
		$solicitudes->copyFrom('POST');
		// print_r($solicitudes);
		$solicitudes->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/solicitudes');
	}
    function solicitudes_create($f3, $args) {
        $db = $this->db; //Conexion a la BBDD
        $solicitudes = new DB\SQL\Mapper($db, 'solicitudes'); //la tabla solicitudes contiene la clave id_usuario
        // $solicitudes->load(['id_solicitud=?', $args['id']]); //filtro where
        $solicitudes->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
        // print_r($solicitudes);
        $solicitudes->save(); //inserta o actualiza la tabla
        // $f3->reroute('@solicitudes_read(@id='.$solicitudes->id_solicitud.')');//return
        $f3->reroute('/solicitudes'); //return
    }
    
    function solicitudes_delete($f3, $args) {
        $db = $this->db; //Conexion a la BBDD
        $solicitudes = new DB\SQL\Mapper($db, 'solicitudes'); //mapeo de la tabla
        $solicitudes->load(['id_solicitud=?', $args['id']]); //filtro where
        // $solicitudes->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
        // print_r($solicitudes);
        $solicitudes->erase(); //elimina registro de la tabla

        $f3->reroute('/solicitudes'); //return

    }
    
}