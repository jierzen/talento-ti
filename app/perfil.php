<?php

class Perfil extends Controller {
    function perfiles($f3) {
		$db = $this->db;
		$perfiles = new DB\SQL\Mapper($db, 'perfiles');
		$perfiles->nombre_persona = 'SELECT CONCAT(nombre_razonsocial," ",apellidos) AS nombre FROM personas WHERE personas.id_persona=perfiles.id_persona';
		$perfiles->load(["id_perfil>?", 0]);
		// if ($perfiles->dry()) {
		// 	die('No existen registros de perfiles.');
		// }
		$array = array();
		do {
			array_push($array, $perfiles->cast());
			$perfiles->skip();
		} while (!$perfiles->dry());
		$f3->set('perfiles', $array);

		$prof = new DB\SQL\Mapper($db, 'personas');
		$prof->load(["id_tipo_persona=?", $f3->get('TIPO_PERSONA_PROFESIONAL')]);
		// if ($prof->dry()) {
		// 	die('No existen registros de prof.');
		// }
		$array_prof = array();
		do {
			array_push($array_prof, $prof->cast());
			$prof->skip();
		} while (!$prof->dry());
		$f3->set('prof', $array_prof);

		$rows_persona = $db->exec('SELECT per.id_persona, per.nombre_razonsocial, per.apellidos, per.rut, per.email FROM personas per 
		INNER JOIN perfiles pf ON per.id_persona = pf.id_persona');
		$f3->set('id_persona_linelist', $rows_persona);
		$f3->set('template', 'perfiles');
		$f3->set('active_perfiles', 'active');

		echo View::instance()->render('layout.html');
    }
    function perfiles_read($f3, $args) {
		$db = $this->db;
		$perfiles = new DB\SQL\Mapper($db, 'perfiles');
		$perfiles->load(['id_perfil=?', $args['id']]);
		if ($perfiles->dry()) {
			die('No encuentra perfil con id ' . $args['id']);
		}
		$array = array();
		do {
			array_push($array, $perfiles->cast());
			$perfiles->skip();
		} while (!$perfiles->dry());

		$f3->set('perfiles', $array);
		echo View::instance()->render('perfiles.html');
	}
	function perfiles_update($f3, $args) {
		$db = $this->db;
		$perfiles = new DB\SQL\Mapper($db, 'perfiles');
		$perfiles->load(['id_perfil=?', $args['id']]);
		$perfiles->copyFrom('POST');
		// print_r($perfiles);
		$perfiles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/perfiles');
	}
	function perfiles_create($f3, $args) {
		$db = $this->db; 
		$perfiles = new DB\SQL\Mapper($db, 'perfiles'); //la tabla perfiles contiene la clave id_usuario
		// $perfiles->load(['id_perfil=?', $args['id']]); //filtro where
		$perfiles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($perfiles);
		$perfiles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@perfiles_read(@id='.$perfiles->id_perfil.')');//return
		$f3->reroute('/perfiles'); //return
	}
	function perfiles_delete($f3, $args) {
		$db = $this->db; 
		$perfiles = new DB\SQL\Mapper($db, 'perfiles'); //mapeo de la tabla
		$perfiles->load(['id_perfil=?', $args['id']]); //filtro where
		// $perfiles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($perfiles);
		$perfiles->erase(); //elimina registro de la tabla

		$f3->reroute('/perfiles'); //return

	}

	function ver_perfil($f3){
		$db = $this->db;
		$perfil = new DB\SQL\Mapper($db, 'perfiles');
		$esta_sesion_persona = $f3->get('SESSION.persona');
		$esta_sesion_usuario = $f3->get('SESSION.usuario');
		$id_persona = $esta_sesion_persona[0]['id_persona'];
		$id_usuario = $esta_sesion_usuario[0]['id_usuario'];
		$perfil->load(['id_persona=?', $id_persona]);
		$array_perfil = array();
		do {
			array_push($array_perfil, $perfil->cast());
			$perfil->skip();
		} while (!$perfil->dry());
		$f3->set('SESSION.perfil', $array_perfil);
		$f3->set('template', 'perfil');
        $this->sessionPersona($f3,$id_usuario);
        echo View::instance()->render('layout.html');
	}

	function editar_perfil($f3){
		$db = $this->db; 
		
		$esta_session_perfil = $f3->get('SESSION.perfil');
		$esta_session_usuario = $f3->get('SESSION.usuario');
		$id_usuario = $esta_session_usuario[0]['id_usuario'];
		$id_perfil = $esta_session_perfil[0]['id_perfil'];

		$perfil = new DB\SQL\Mapper($db, 'perfiles');
		$perfil->load(['id_perfil=?', $id_perfil]);

		$array_perfil = array();
		do {
			array_push($array_perfil, $perfil->cast());
			$perfil->skip();
		} while (!$perfil->dry());

        $f3->set('SESSION.perfil', $array_perfil);
        
        $f3->set('template', 'editar_perfil');
        $this->sessionPersona($f3,$id_usuario);

        echo View::instance()->render('layout.html');
	}

	function registrarPerfil($f3){
		$db=$this->db;
		// $datosPerfil = $f3->get('POST');

		$id_usuario = $f3->get('POST.id_usuario');
		// $id_persona = $f3->get('POST.id_persona');
		$id_perfil = $f3->get('POST.id_perfil');

		// $titulo_prof=$datosPerfil['titulo_prof'];
		// $resumen =$datosPerfil['resumen '];
		// $url_cv=$datosPerfil['url_cv'];
		// $disponibilidad=$datosPerfil['disponibilidad'];
		// $id_persona=$datosPerfil['id_persona'];
		// $plazo_proyecto=$datosPerfil['plazo_proyecto'];
		// $query="UPDATE `perfiles` SET `titulo_prof`= $titulo_prof, 
		// 							   `resumen`= $resumen, 
		// 							   `url_cv`= $url_cv, 
		// 							   `disponibilidad` = $disponibilidad,
		// 							   `plazo_proyecto` = $plazo_proyecto 
		// 		WHERE `id_persona` = $id_persona";
		// $db->exec($query);

		$perfil = new DB\SQL\Mapper($db, 'perfiles');
		$perfil->load(['id_perfil=?',$id_perfil]);
		$perfil->copyfrom('POST');
		$perfil->save();

        $f3->set('template', 'principal');
        $this->sessionPersona($f3,$id_usuario);
        echo View::instance()->render('layout.html');
	}

}