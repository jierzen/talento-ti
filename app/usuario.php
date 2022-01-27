<?php

class Usuario extends Controller {

    function usuarios($f3){
		$db = $this->db; 
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		$usuarios->load(["id_usuario>?", 0]); //filtro where, carga toda la tabla
		// if($usuarios->dry()){//¿esta la tabla vacia?
		// 	die('No encuentran usuarios.');
		// }

		//Funcion para enviar en un arreglo los datos de una tabla
		$array = array();
		do {
			array_push($array, $usuarios->cast());
			$usuarios->skip();
		} while (!$usuarios->dry());

        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles');
        $usuarios_roles->nombre_usuario = 'SELECT email FROM usuarios WHERE usuarios.id_usuario=usuarios_roles.id_usuario';
        $usuarios_roles->nombre_rol = 'SELECT nombre_rol FROM roles WHERE roles.id_rol=usuarios_roles.id_rol';
        $usuarios_roles->load();
		$array_roles = array();
		do {
			array_push($array_roles, $usuarios_roles->cast());
			$usuarios_roles->skip();
		} while (!$usuarios_roles->dry());

        $roles = new DB\SQL\Mapper($db,'roles');
        $roles->load();
		$array2 = array();
		do {
			array_push($array2, $roles->cast());
			$roles->skip();
		} while (!$roles->dry());

		//'usuarios' se convierte en la variable del template
		$f3->set('usuarios', $array); //seteo de variable para usarla en el template
		$f3->set('usuarios_roles', $array_roles); //seteo de variable para usarla en el template
		$f3->set('roles', $array2); //seteo de variable para usarla en el template
        $f3->set('template', 'usuarios');
        $f3->set('active_usuarios', 'active');

		echo View::instance()->render('layout.html');
	}
	function usuarios_read($f3, $args){
		$db = $this->db; 
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		$usuarios->load(['id_usuario=?', $args['id']]); //filtro where
		if($usuarios->dry()){//tabla vacia
			die('No encuentra usuario con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $usuarios->cast());
			$usuarios->skip();
		} while (!$usuarios->dry());

		$f3->set('usuarios', $array); //seteo de variable para usarla en el template
		echo View::instance()->render('home.html');
	}
	function usuarios_update($f3, $args){
		$db = $this->db; 
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		$usuarios->load(['id_usuario=?', $args['id']]); //filtro where
		$usuarios->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios);
		$usuarios->save(); //inserta o actualiza la tabla

		// $f3->reroute('@usuarios_read(@id='.$args['id'].')');//return
		$f3->reroute('/usuarios');//return
	}
	function usuarios_create($f3, $args){
		$db = $this->db; 
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		// $usuarios->load(['id_usuario=?', $args['id']]); //filtro where
		$usuarios->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios);
		$usuarios->save(); //inserta o actualiza la tabla

		//$f3->reroute('@usuarios_read(@id='.$usuarios->id_usuario.')');//return
		$f3->reroute('/usuarios');//return
	}
	function usuarios_delete($f3, $args){
		$db = $this->db; 
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		$usuarios->load(['id_usuario=?', $args['id']]); //filtro where
		// $usuarios->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios);
        $personas = new DB\SQL\Mapper($db, 'personas');
        $personas->load(['id_usuario=?', $args['id']]);
        
        if($personas->count() == 0){
            $usuarios->erase();
        }
        else {
            $f3->error(403, "Error: no se puede eliminar usuario, porque tiene una persona asociada.");
        }
		
		$f3->reroute('/usuarios');//return
	}
	function usuarios_roles_read($f3, $args){
		$db = $this->db; 
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); 
		$usuarios_roles->load(['id_usuario_rol=?', $args['id']]); 
		// if($usuarios_roles->dry()){
		// 	die('No encuentra habilidad persona con id '.$args['id']);
		// }
		$array = array();
		do {
			array_push($array, $usuarios_roles->cast());
			$usuarios_roles->skip();
		} while (!$usuarios_roles->dry());

		$f3->set('usuarios_roles', $array);
		echo View::instance()->render('usuarios_roles.html');
	}
	function usuarios_roles_update($f3, $args){
		$db = $this->db;
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); 
		$usuarios_roles->load(['id_usuario_rol=?', $args['id']]); 
		$usuarios_roles->copyFrom('POST');
		// print_r($usuarios_roles);
		$usuarios_roles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/usuarios');
	}
	function usuarios_roles_create($f3, $args){
		$db = $this->db; 
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); //la tabla usuarios_roles contiene la clave id_usuario
		// $usuarios_roles->load(['id_habilidad_persona=?', $args['id']]); //filtro where
		$usuarios_roles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios_roles);
		// $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		// try{
		// 	$usuarios_roles->save(); //inserta o actualiza la tabla
		// }catch(\PDOException $e){
		// 	$f3->set('msg',$e);
		// 	echo View::instance()->render('usuarios_roles.html');
		// }
		$usuarios_roles->save();
		// $f3->reroute('@usuarios_roles_read(@id='.$usuarios_roles->id_habilidad_persona.')');//return
		$f3->reroute('/usuarios');//return
	}
	function usuarios_roles_delete($f3, $args){
		$db = $this->db; 
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); //mapeo de la tabla
		$usuarios_roles->load(['id_usuario_rol=?', $args['id']]); //filtro where
		// $usuarios_roles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios_roles);
		$usuarios_roles->erase(); //elimina registro de la tabla

		$f3->reroute('/usuarios');//return
	
	}

}