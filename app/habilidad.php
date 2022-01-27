<?php

class Habilidad extends Controller {

    function habilidades($f3){
		$db = $this->db; 
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); 
		$habilidades->load(["id_habilidad>?", 0]); 
		// if($habilidades->dry()){
		// 	die('No existen registros de habilidades.');
		// }
		$array = array();
		do {
			array_push($array, $habilidades->cast());
			$habilidades->skip();
		} while (!$habilidades->dry());
		$f3->set('habilidades', $array);

        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas');
        $habilidades_personas->persona = 'SELECT CONCAT(nombre_razonsocial, " ", apellidos) AS nombre FROM personas WHERE personas.id_persona=habilidades_personas.id_persona';
        $habilidades_personas->habilidad = 'SELECT nombre_habilidad FROM habilidades WHERE habilidades.id_habilidad=habilidades_personas.id_habilidad';
		$habilidades_personas->load(); 
		// if($habilidades_personas->dry()){
		// 	die('No existen registros de habilidades_personas.');
		// }
		$array_hp = array();
		do {
			array_push($array_hp, $habilidades_personas->cast());
			$habilidades_personas->skip();
		} while (!$habilidades_personas->dry());
		$f3->set('habilidades_personas', $array_hp);
        $personas = new DB\SQL\Mapper($db,'personas');
		$personas->load(['id_tipo_persona=?',$f3->get('TIPO_PERSONA_PROFESIONAL')]); 
		// if($personas->dry()){
		// 	die('No existen registros de personas.');
		// }
		$array_per = array();
		do {
			array_push($array_per, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('personas', $array_per);
        $f3->set('template', 'habilidades');

		echo View::instance()->render('layout.html');
	}
	function habilidades_read($f3, $args){
		$db = $this->db; 
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); 
		$habilidades->load(['id_habilidad=?', $args['id']]); 
		if($habilidades->dry()){
			die('No encuentra habilidad con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $habilidades->cast());
			$habilidades->skip();
		} while (!$habilidades->dry());

		$f3->set('habilidades', $array);
		echo View::instance()->render('habilidades.html');
	}

	function habilidades_update($f3, $args){
		$db = $this->db;
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); 
		$habilidades->load(['id_habilidad=?', $args['id']]); 
		$habilidades->copyFrom('POST');
		// print_r($habilidades);
		$habilidades->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/habilidades');
	}

	function habilidades_create($f3, $args){
		$db = $this->db; 
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); //mapeo de la tabla
		// $habilidades->load(['id_habilidad=?', $args['id']]); //filtro where
		$habilidades->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades);
		$habilidades->save(); //inserta o actualiza la tabla

		// $f3->reroute('@habilidades_read(@id='.$habilidades->id_habilidad.')');//return
		$f3->reroute('/habilidades');//return
	}

	function habilidades_delete($f3, $args){
		$db = $this->db; //Conexion a la BBDD
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); //mapeo de la tabla
		$habilidades->load(['id_habilidad=?', $args['id']]); //filtro where
		// $habilidades->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades);
		$habilidades->erase(); //elimina registro de la tabla

		$f3->reroute('/habilidades');//return
	
	}
	function habilidades_personas($f3){
		$db = $this->db; 
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); 
		$habilidades_personas->load(["id_habilidad_persona>?", 0]); 
		if($habilidades_personas->dry()){
			die('No existen registros de habilidades_personas.');
		}
		$array = array();
		do {
			array_push($array, $habilidades_personas->cast());
			$habilidades_personas->skip();
		} while (!$habilidades_personas->dry());
		$f3->set('habilidades_personas', $array);

		$rows_persona = $db->exec('SELECT per.id_persona, per.nombre_razonsocial, per.apellidos FROM personas per');
		$f3->set('id_persona_linelist',$rows_persona);

		$rows_habilidad = $db->exec('SELECT hab.id_habilidad, hab.nombre_habilidad FROM habilidades hab');
		$f3->set('id_habilidad_linelist',$rows_habilidad);

		echo View::instance()->render('habilidades_personas.html');
	}

	function habilidades_personas_read($f3, $args){
		$db = $this->db; 
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); 
		$habilidades_personas->load(['id_habilidad_persona=?', $args['id']]); 
		if($habilidades_personas->dry()){
			die('No encuentra habilidad persona con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $habilidades_personas->cast());
			$habilidades_personas->skip();
		} while (!$habilidades_personas->dry());

		$f3->set('habilidades_personas', $array);
        $f3->set('template', 'habilidades_personas');

		echo View::instance()->render('habilidades_personas.html');
	}

	function habilidades_personas_update($f3, $args){
		$db = $this->db;
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); 
		$habilidades_personas->load(['id_habilidad_persona=?', $args['id']]); 
		$habilidades_personas->copyFrom('POST');
		// print_r($habilidades_personas);
		$habilidades_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/habilidades');
	}

	function habilidades_personas_create($f3, $args){
		$db = $this->db; //Conexion a la BBDD
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); //la tabla habilidades_personas contiene la clave id_usuario
		// $habilidades_personas->load(['id_habilidad_persona=?', $args['id']]); //filtro where
		$habilidades_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades_personas);
		$habilidades_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@habilidades_personas_read(@id='.$habilidades_personas->id_habilidad_persona.')');//return
        $f3->set('template', 'habilidades_personas');

		$f3->reroute('/habilidades');//return
	}

	function habilidades_personas_delete($f3, $args){
		$db = $this->db; //Conexion a la BBDD
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); //mapeo de la tabla
		$habilidades_personas->load(['id_habilidad_persona=?', $args['id']]); //filtro where
		// $habilidades_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades_personas);
		$habilidades_personas->erase(); //elimina registro de la tabla
		$f3->set('template', 'habilidades');

		$f3->reroute('/habilidades');//return
	
	}

	function cambiarNivelHabilidad($f3){
		$db=$this->db;
		
		$nivel_nuevo = $f3->get('POST.nivelNuevo');
		$id_habilidad = $f3->get('POST.id_habilidad');
		$esta_session_persona = $f3->get('SESSION.persona');
		$id_persona = $esta_session_persona[0]['id_persona'];

		//Hago el update
		$db->exec("UPDATE habilidades_personas SET nivel = $nivel_nuevo WHERE id_persona = $id_persona AND id_habilidad = $id_habilidad");
		
		$esta_session_usuario = $f3->get('SESSION.usuario');
		$id_usuario = $esta_session_usuario[0]['id_usuario'];
		$this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'habilidadesPersona');
		$f3->reroute('/habilidadesPersona');
		
	}

	function eliminarHabilidad($f3){
		$db=$this->db;
		$id_habilidad = $f3->get('POST.id_habilidad');
		$esta_session_persona = $f3->get('SESSION.persona');
		$id_persona = $esta_session_persona[0]['id_persona'];
		$db->exec("DELETE FROM `habilidades_personas` WHERE id_habilidad = $id_habilidad AND id_persona = $id_persona");

		$esta_session_usuario = $f3->get('SESSION.usuario');
		$id_usuario = $esta_session_usuario[0]['id_usuario'];
		$this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'habilidadesPersona');
		$f3->reroute('/habilidadesPersona');
		
	}


}