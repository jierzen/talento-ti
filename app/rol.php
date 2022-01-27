<?php

class Rol extends Controller {
    function roles($f3) {
		$db = $this->db;
		$roles = new DB\SQL\Mapper($db, 'roles');
		// if ($roles->dry()) {
		// 	die('No existen registros de roles.');
		// }
		$roles->nombre_estado = 'SELECT nombre_estado FROM estados WHERE tabla="roles" AND roles.id_estado=estados.id_estado';
		$roles->load();
		$array = array();
		do {
			array_push($array, $roles->cast());
			$roles->skip();
		} while (!$roles->dry());
		$f3->set('roles', $array);

		// $rows = $db->exec('SELECT est.id_estado, est.nombre_estado FROM estados est');
		// $f3->set('id_estado_linelist', $rows);
		$estados = new DB\SQL\Mapper($db, 'estados');
		$estados->load(["tabla=?", "roles"]);
		$array_estados = array();
		do {
			array_push($array_estados, $estados->cast());
			$estados->skip();
		} while (!$estados->dry());
		$f3->set('estados', $array_estados);
		$f3->set('template', 'roles');
		$f3->set('active_roles', 'active');
		$f3->set('base', $f3->get('BASE'));
		echo View::instance()->render('layout.html');
	}
	function roles_read($f3, $args){
		$db = $this->db; 
        $roles = new DB\SQL\Mapper($db,'roles'); 
		$roles->load(['id_rol=?', $args['id']]); 
		if($roles->dry()){
			die('No encuentra rol con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $roles->cast());
			$roles->skip();
		} while (!$roles->dry());

		$f3->set('roles', $array);
		$f3->set('template', 'roles');
		$f3->set('active_roles', 'active');
		echo View::instance()->render('layout.html');
	}
	function roles_update($f3, $args){
		$db = $this->db;
        $roles = new DB\SQL\Mapper($db,'roles'); 
		$roles->load(['id_rol=?', $args['id']]); 
		$roles->copyFrom('POST');
		// print_r($roles);
		$roles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/roles');
	}

	function roles_create($f3, $args){
		$db = $this->db; 
        $roles = new DB\SQL\Mapper($db,'roles'); //la tabla roles contiene la clave id_usuario
		// $roles->load(['id_rol=?', $args['id']]); //filtro where
		$roles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($roles);
		$roles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@roles_read(@id='.$roles->id_rol.')');//return
		$f3->reroute('/roles');
	}

	function roles_delete($f3, $args){
		$db = $this->db;
        $roles = new DB\SQL\Mapper($db,'roles'); //mapeo de la tabla
		$roles->load(['id_rol=?', $args['id']]); //filtro where
		// $roles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($roles);
		$roles->erase(); //elimina registro de la tabla

		$f3->reroute('/roles');
	
	}
}
?>