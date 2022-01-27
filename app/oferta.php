<?php

class Oferta extends Controller {

    function ofertas($f3) {
		$db = $this->db;
        $ofertas = new DB\SQL\Mapper($db,'ofertas');
		$ofertas->load(["id_oferta>?", 0]); 
		if($ofertas->dry()){
			die('No existen registros de ofertas.');
		}
		$array = array();
		do {
			array_push($array, $ofertas->cast());
			$ofertas->skip();
		} while (!$ofertas->dry());
		$f3->set('ofertas', $array);

        $ofertas_personas = new DB\SQL\Mapper($db,'ofertas_personas'); 
		$ofertas_personas->persona = 'SELECT CONCAT(nombre_razonsocial, " ", apellidos) AS nombre FROM personas WHERE personas.id_persona=ofertas_personas.id_persona';
        $ofertas_personas->oferta = 'SELECT nombre_oferta FROM ofertas WHERE ofertas.id_oferta=ofertas_personas.id_oferta';
		$ofertas_personas->load(); 
		// if($ofertas_personas->dry()){
		// 	die('No existen registros de ofertas_personas.');
		// }
		$array_op = array();
		do {
			array_push($array_op, $ofertas_personas->cast());
			$ofertas_personas->skip();
		} while (!$ofertas_personas->dry());
		$f3->set('ofertas_personas', $array_op);

        $personas = new DB\SQL\Mapper($db,'personas'); 
		$personas->load(["id_tipo_persona=?", $f3->get('TIPO_PERSONA_EMPRESA')]); 
		// if($personas->dry()){
		// 	die('No existen registros de personas.');
		// }
		$array_per = array();
		do {
			array_push($array_per, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('personas', $array_per);

        $f3->set('template', 'ofertas');

		$f3->set('active_ofertas', 'active');

		echo View::instance()->render('layout.html');
	}
    function ofertas_read($f3, $args){
		$db = $this->db; 
        $ofertas = new DB\SQL\Mapper($db,'ofertas'); 
		$ofertas->load(['id_oferta=?', $args['id']]); 
		if($ofertas->dry()){
			die('No encuentra oferta con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $ofertas->cast());
			$ofertas->skip();
		} while (!$ofertas->dry());

		$f3->set('ofertas', $array);
		echo View::instance()->render('ofertas.html');
	}
	function ofertas_update($f3, $args){
		$db = $this->db;
        $ofertas = new DB\SQL\Mapper($db,'ofertas'); 
		$ofertas->load(['id_oferta=?', $args['id']]); 
		$ofertas->copyFrom('POST');
		// print_r($ofertas);
		$ofertas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/ofertas');
	}
	function ofertas_create($f3, $args){
		$db = $this->db; 
        $ofertas = new DB\SQL\Mapper($db,'ofertas'); //mapeo de la tabla
		// $ofertas->load(['id_oferta=?', $args['id']]); //filtro where
		$ofertas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas);
		$ofertas->save(); //inserta o actualiza la tabla

		// $f3->reroute('@ofertas_read(@id='.$ofertas->id_oferta.')');//return
		$f3->reroute('/ofertas');//return
	}
	function ofertas_delete($f3, $args){
		$db = $this->db; 
        $ofertas = new DB\SQL\Mapper($db,'ofertas'); //mapeo de la tabla
		$ofertas->load(['id_oferta=?', $args['id']]); //filtro where
		// $ofertas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas);
		$ofertas->erase(); //elimina registro de la tabla

		$f3->reroute('/ofertas');//return
	
	}
	function ofertas_personas_read($f3, $args) {
		$db = $this->db;
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas');
		$ofertas_personas->load(['id_oferta_persona=?', $args['id']]);
		if ($ofertas_personas->dry()) {
			die('No encuentra perfil con id ' . $args['id']);
		}
		$array = array();
		do {
			array_push($array, $ofertas_personas->cast());
			$ofertas_personas->skip();
		} while (!$ofertas_personas->dry());

		$f3->set('ofertas_personas', $array);
		echo View::instance()->render('ofertas.html');
	}

	function ofertas_personas_update($f3, $args) {
		$db = $this->db;
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas');
		$ofertas_personas->load(['id_oferta_persona=?', $args['id']]);
		$ofertas_personas->copyFrom('POST');
		// print_r($ofertas_personas);
		$ofertas_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('/ofertas');
	}

	function ofertas_personas_create($f3, $args) {
		$db = $this->db; //Conexion a la BBDD
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas'); //la tabla ofertas_personas contiene la clave id_usuario
		// $ofertas_personas->load(['id_oferta_persona=?', $args['id']]); //filtro where
		$ofertas_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas_personas);
		$ofertas_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@ofertas_personas_read(@id='.$ofertas_personas->id_oferta_persona.')');//return
		$f3->reroute('/ofertas'); //return
	}

	function ofertas_personas_delete($f3, $args) {
		$db = $this->db; //Conexion a la BBDD
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas'); //mapeo de la tabla
		$ofertas_personas->load(['id_oferta_persona=?', $args['id']]); //filtro where
		// $ofertas_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas_personas);
		$ofertas_personas->erase(); //elimina registro de la tabla

		$f3->reroute('/ofertas'); //return

	}
	function oferta_detalle($f3) {
        $array_oferta = array();

        $array_oferta['id_oferta'] = $f3->get('POST.id_oferta');
        $array_oferta['nombre_oferta'] = $f3->get('POST.nombre_oferta');
        $array_oferta['descripcion'] = $f3->get('POST.descripcion');
        $array_oferta['fecha_oferta'] = $f3->get('POST.fecha_oferta');
        $array_oferta['comentarios'] = $f3->get('POST.comentarios');
        $array_oferta['url_documento'] = $f3->get('POST.url_documento');
        $array_oferta['id_proyecto'] = $f3->get('POST.id_proyecto');
        $array_oferta['tipo_proyecto'] = $f3->get('POST.tipo_proyecto');
        $f3->set('SESSION.oferta', $array_oferta);
        
        $id_usuario = $f3->get('POST.id_usuario');
        
        $f3->set('template', 'oferta_detalle');
        $this->sessionPersona($f3,$id_usuario);

        echo View::instance()->render('layout.html');
    }
	function solicitar_oferta($f3) {
        $db = $this->db;
        //datos del profesional
        $id_oferta = $f3->get('POST.id_oferta');
        $id_usuario = $f3->get('POST.id_usuario');
        $id_persona_prof = $f3->get('POST.id_persona');

        //obtener la id_persona de la empresa que ha creado la oferta mediante la tabla 'ofertas_persona'
        $oferta_persona = new DB\SQL\Mapper($db, 'ofertas_personas');
        $oferta_persona->load(['id_oferta=?', $id_oferta]);
        $id_persona_emp = $oferta_persona->get('id_persona');

        $datetime_actual = date('Y-m-d H:i:s');
        $pendiente = $f3->get('ESTADO_SOLICITUD_PENDIENTE');

        // Inserto solicitud con estado = pendiente (5)
        $db->exec("INSERT INTO `solicitudes`(
                                            `id_oferta`,  
                                            `id_persona_prof`, 
                                            `id_persona_emp`, 
                                            `id_estado`, 
                                            `fecha_solicitud`)
                                            VALUES (
                                            $id_oferta,
                                            $id_persona_prof,
                                            $id_persona_emp,
                                            $pendiente,
                                            '$datetime_actual')"
        );

        //session de habilidades
        $habilidades = 	$db->exec("SELECT hp.id_persona,
                                          hab.nombre_habilidad 
                                   FROM habilidades_personas hp 
                                   INNER JOIN habilidades hab ON hab.id_habilidad = hp.id_habilidad
                                   WHERE hp.id_persona = $id_persona_prof");
        $f3->set('SESSION.habilidades', $habilidades);

        $f3->set('template', 'principal');
        $this->sessionPersona($f3,$id_usuario);
        echo View::instance()->render('layout.html');
    }

    function crearOferta($f3) {
        //Enviar las habilidades por session
        $db = $this->db;
        $habilidades = new DB\SQL\Mapper($db, 'habilidades');
        $habilidades->load(['id_habilidad>?', 0]);
        $array_habilidades = array();
        do {
            array_push($array_habilidades, $habilidades->cast());
         	$habilidades->skip();
        } while (!$habilidades->dry());
        $f3->set('SESSION.habilidades', $array_habilidades);
        // var_dump($array_habilidades);

		$id_usuario = $_SESSION['usuario'][0]['id_usuario'];
		$this->sessionPersona($f3,$id_usuario);

		$f3->set('template', 'crearOferta');
        echo View::instance()->render('layout.html');
        // $f3->reroute('/crearOferta');

    }

    function registrarOferta($f3){
        //Para crear una oferta:
        //1)inserta en la tabla 'ofertas' una nueva oferta 
        //2)inserta en la tabla 'ofertas_personas' con estado activo para asociar la empresa con la oferta recien creada
        //3)inserta en la tabla 'ofertas_habilidades' 'n' veces segun la cantidad de habilidades asociadas a la oferta.

        // print("<pre>".print_r($_POST,true)."</pre><br>");

        $db = $this->db;
        $oferta = new DB\SQL\Mapper($db, 'ofertas');
        $oferta->copyFrom('POST');
        $oferta->save();
        $id_oferta = $oferta->get('_id');
        $estado_oferta_activa = $f3->get('ESTADO_OFERTA_ACTIVA');
        $esta_session_persona = $f3->get('SESSION.persona');
        $id_persona = $esta_session_persona[0]['id_persona'];

        $db->exec("INSERT INTO `ofertas_personas`(`id_persona`, `id_oferta`, `id_estado`) VALUES ($id_persona,$id_oferta,$estado_oferta_activa)");

        $cant_habilidades = $db->exec("SELECT COUNT(*) AS cant_habilidades FROM `habilidades`");
        // var_dump($cant_habilidades[0]['cant_habilidades']);
        $suma_habilidades = 0;
        $array_id_habilidad = array();
        for ($i=0; $i <$cant_habilidades[0]['cant_habilidades']; $i++) { 
            if(isset($_POST['habilidad_'.($i+1)])){
                $suma_habilidades += 1;
                // $id_aux = $i + 1;
                // $aux_id_habilidad = $db->exec("SELECT `nombre_habilidad` AS nombre FROM `habilidades` WHERE `id_habilidad` = $i");
                // $array_id_habilidad[$i] = $aux_id_habilidad[0]['nombre'];
                array_push($array_id_habilidad, ($i+1));
                // echo 'detectada habilidad_'. $i .' vía POST'.'<br>';
            }
        }
        // echo 'Hay en total '.$suma_habilidades.' habilidades detectadas. <br>';
        // foreach($array_id_habilidad as $key){
        //     echo 'Habilidad detectada='.$key.'<br>';
        // }
        
        for ($i=0; $i <$suma_habilidades ; $i++) { 
            $db->exec("INSERT INTO`ofertas_habilidades`(`id_oferta`, `id_habilidad`) VALUES ($id_oferta,$array_id_habilidad[$i])");
            // echo $array_id_habilidad[$i];
            // echo "INSERT INTO`ofertas_habilidades`(`id_oferta`, `id_habilidad`) VALUES ($id_oferta,$array_id_habilidad[$i])".'<br>';
        }

        //Enviar las habilidades por session
        $habilidades = new DB\SQL\Mapper($db, 'habilidades');
        $habilidades->load(['id_habilidad>?', 0]);
        $array_habilidades = array();
        do {
            array_push($array_habilidades, $habilidades->cast());
         	$habilidades->skip();
        } while (!$habilidades->dry());
        $f3->set('SESSION.habilidades', $array_habilidades);

		$id_usuario = $_SESSION['usuario'][0]['id_usuario'];
		$this->sessionPersona($f3,$id_usuario);

		$f3->set('template', 'principal');
        echo View::instance()->render('layout.html');
        // echo View::instance()->render('crearOferta.html');
    }

    function oferta_editar($f3){
        $db = $this->db;
        $id_oferta = $f3->get('POST.id_oferta');
        $oferta = new DB\SQL\Mapper($db, 'ofertas');
        $oferta->load(['id_oferta=?', $id_oferta]);
        $array_oferta = array();
        do {
            array_push($array_oferta, $oferta->cast());
         	$oferta->skip();
        } while (!$oferta->dry());
        $f3->set('SESSION.oferta', $array_oferta);
        $id_usuario = $_SESSION['usuario'][0]['id_usuario'];
		$this->sessionPersona($f3,$id_usuario);
		$f3->set('template', 'oferta_editar');
        echo View::instance()->render('layout.html');
    }

    function editarOferta($f3){
        $db = $this->db;
        $id_oferta = $f3->get('POST.id_oferta');
        $oferta = new DB\SQL\Mapper($db, 'ofertas');
        $oferta->load(['id_oferta=?', $id_oferta]);
        $oferta->copyFrom('POST');
        $oferta->save();
        $esta_session_usuario = $f3->get('SESSION.usuario');
        $id_usuario = $esta_session_usuario[0]['id_usuario'];
		$this->sessionPersona($f3,$id_usuario);
		$f3->set('template', 'principal');
        echo View::instance()->render('layout.html');
    }

    function ofertas_empresa($f3){
        $f3->set('template', 'ofertas_empresa');
        echo View::instance()->render('layout.html');
    }

    function eliminarOferta($f3){
        //RECORDAR USAR CONSTANTES de config.ini
        //Para eliminar una oferta hacer 2 UPDATE
        //1) Cambiar idestado a 9 (inactivo) en la tabla ofertas_personas
        //2) Cambiar el estado de todas las solicitudes a 6 (suspendido)
        $db = $this->db;
        $id_oferta = $f3->get('POST.id_oferta');
        $estado_oferta_inactiva = $f3->get('ESTADO_OFERTA_INACTIVA');
        $estado_solicitud_suspendida = $f3->get('ESTADO_OFERTA_INACTIVA');
        $esta_session_persona = $f3->get('SESSION.persona');
        $id_persona = $esta_session_persona[0]['id_persona'];
        $db->exec("UPDATE `ofertas_personas` SET `id_estado`= $estado_oferta_inactiva WHERE id_oferta = $id_oferta AND id_persona = $id_persona");
        $db->exec("UPDATE `solicitudes` SET `id_estado`= $estado_solicitud_suspendida WHERE id_oferta = $id_oferta AND id_persona_emp = $id_persona");
        $f3->set('template', 'ofertas_empresa');
        echo View::instance()->render('layout.html');
    }
}