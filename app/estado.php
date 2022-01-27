<?php 

class Estado extends Controller {

    function estados($f3){
		$db = $this->db;
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		$estados->load(["id_estado>?", 0]); //filtro where, carga toda la tabla
		// if($estados->dry()){//¿esta la tabla vacia?
		// 	die('No existen registros de estados.');
		// }

		//Funcion para enviar en un arreglo los datos de una tabla
		$array = array();
		do {
			array_push($array, $estados->cast());
			$estados->skip();
		} while (!$estados->dry());
		$tablas = $db->exec('SELECT table_name AS table_name FROM information_schema.tables
		WHERE table_schema = "talento_ti";');
		$f3->set('tablas', $tablas);
		//'estados' se convierte en la variable del template
		$f3->set('estados', $array); //seteo de variable para usarla en el template
		// $f3->set('active_estados', 'active');
		$f3->set('template', 'estados');

		echo View::instance()->render('layout.html');
	}
    function estados_read($f3, $args){
		$db = $this->db; //Conexion a la BBDD
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		$estados->load(['id_estado=?', $args['id']]); //filtro where
		if($estados->dry()){//tabla vacia
			die('No encuentra estado con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $estados->cast());
			$estados->skip();
		} while (!$estados->dry());

		$f3->set('estados', $array); //seteo de variable para usarla en el template
		echo View::instance()->render('estados.html');
	}
	function estados_update($f3, $args){
		$db = $this->db; //Conexion a la BBDD
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		$estados->load(['id_estado=?', $args['id']]); //filtro where
		$estados->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($estados);
		$estados->save(); //inserta o actualiza la tabla

		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/estados');//return
	}
	function estados_create($f3, $args){
		$db = $this->db; //Conexion a la BBDD
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		// $estados->load(['id_estado=?', $args['id']]); //filtro where
		$estados->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($estados);
		$estados->save(); //inserta o actualiza la tabla

		// $f3->reroute('@estados_read(@id='.$estados->id_estado.')');//return
		$f3->reroute('/estados');//return
	}
	function estados_delete($f3, $args){
		$db = $this->db; //Conexion a la BBDD
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		$estados->load(['id_estado=?', $args['id']]); //filtro where
		// $estados->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($estados);
		$estados->erase(); //elimina registro de la tabla

		$f3->reroute('/estados');//return
	
	}

}