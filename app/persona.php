<?php

class Persona extends Controller {

    function registro($f3) {
		echo View::instance()->render('registro.html');
	}

    function registro_profesional($f3) {
        echo \Template::instance()->render('registro-profesional.html');
    }

    
    function registro_empresa($f3) {
        echo \Template::instance()->render('registro-empresa.html');
    }

    //Registro Profesional paso 1
    function registrar_profesional_p2($f3) {
        $nombre = $f3->get('POST.nombre_razonsocial');
        $apellidos = $f3->get('POST.apellidos');
        $rut = $f3->get('POST.rut');
        $data = array( 
                        'nombre_razonsocial' => $nombre,
                        'apellidos' => $apellidos,
                        'rut' => $rut
                    );
        // var_dump($data);
        $f3->set('registroPaso1', $data);
        echo View::instance()->render('registro-profesional-paso2.html');
    }
    
    //Registro Profesional paso 2
    function registrarProfesional($f3) {
        $db = $this->db;
        $usuario = new DB\SQL\Mapper($db, 'usuarios');
        //obtener los datos desde el registro pasos 1 y 2
        $email = $f3->get('POST.email');
        $telefono = $f3->get('POST.telefono');
        $nombre = $f3->get('POST.nombre_razonsocial');
        $apellidos = $f3->get('POST.apellidos');
        $rut = $f3->get('POST.rut');
        //Validacion de no repeticion de EMAIL y RUT
        $validacionEmail = $db->exec("SELECT * FROM personas WHERE email = '$email'");
        $validacionRut = $db->exec("SELECT * FROM personas WHERE rut = '$rut'");
        if($validacionEmail || $validacionRut){
            if($validacionEmail){
                die('Ya existe el email');
            }else if($validacionRut){
                die('Ya existe el rut');
            }
        }else{
            //inserto el profesional en la tabla usuarios
            $usuario->copyFrom('POST');
            $usuario->save();
            $id_usuario = $usuario->get('_id');
            $usuario->load(["id_usuario=?", $id_usuario]);
            $id_tipo_persona = $f3->get('TIPO_PERSONA_PROFESIONAL');
            //inserto el profesional en la tabla personas (id_tipo_persona = 3 profesional activo)
            $db->exec("INSERT INTO `personas`(
                                    `nombre_razonsocial`,
                                    `apellidos`, 
                                    `id_usuario`, 
                                    `rut`,
                                    `telefono`, 
                                    `email`, 
                                    `id_tipo_persona`)
                            VALUES (
                                    '$nombre',
                                    '$apellidos',
                                    $id_usuario,
                                    '$rut',
                                    '$telefono',
                                    '$email',
                                     $id_tipo_persona)"
            );
        }
        
        $f3->reroute('/login');
    }
    
    //Registro de empresa
    function registrarEmpresa($f3) {
        $db = $this->db;
        $usuario = new DB\SQL\Mapper($db, 'usuarios');
        //obtener los datos desde POST
        $email = $f3->get('POST.email');
        $telefono = $f3->get('POST.telefono');
        $nombre = $f3->get('POST.nombre_razonsocial');
        $rut = $f3->get('POST.rut');
        
        $validacionEmail = $db->exec("SELECT * FROM personas WHERE email = '$email'");
        $validacionRut = $db->exec("SELECT * FROM personas WHERE rut = '$rut'");
        if($validacionEmail || $validacionRut){
            if($validacionEmail){
                die('Ya existe el email');
            }else if($validacionRut){
                die('Ya existe el rut');
            }
        }else{
            //inserto el profesional en la tabla usuarios
            $usuario->copyFrom('POST');
            $usuario->save();
            $id_usuario = $usuario->get('_id');
            $usuario->load(["id_usuario=?", $id_usuario]);

            $id_tipo_persona = $f3->get('TIPO_PERSONA_EMPRESA');
            //inserto el profesional en la tabla personas (id_tipo_persona = 3 profesional activo)
            $db->exec("INSERT INTO `personas`(
                                    `nombre_razonsocial`,
                                    `id_usuario`, 
                                    `rut`,
                                    `telefono`, 
                                    `email`, 
                                    `id_tipo_persona`)
                            VALUES (
                                    '$nombre',
                                    $id_usuario,
                                    '$rut',
                                    '$telefono',
                                    '$email',
                                    $id_tipo_persona)"
            );
        }
        $f3->reroute('/login');
    }

    function datosPersona($f3) {
        $esta_sesion_usuario = $f3->get('SESSION.usuario');
        $id_usuario = $esta_sesion_usuario[0]['id_usuario'];
        $this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'datosPersona');
        echo View::instance()->render('layout.html');
    }

    function habilidadesPersona($f3) {
        $db = $this->db;
        $esta_sesion_usuario = $f3->get('SESSION.usuario');
        $esta_sesion_persona = $f3->get('SESSION.persona');
        $id_usuario = $esta_sesion_usuario[0]['id_usuario'];
        $id_persona = $esta_sesion_persona[0]['id_persona'];
        $habilidades = 	$db->exec("SELECT hp.id_persona,
                                          hp.nivel,
                                          hab.nombre_habilidad,
                                          hab.id_habilidad 
                                   FROM habilidades_personas hp 
                                   INNER JOIN habilidades hab ON hab.id_habilidad = hp.id_habilidad
                                   WHERE hp.id_persona = $id_persona");
        $f3->set('SESSION.habilidades', $habilidades);

        $habilidades_no_adquiridas = $db->exec("SELECT * FROM habilidades 
                                                WHERE id_habilidad NOT IN (
                                                                        SELECT id_habilidad 
                                                                        FROM habilidades_personas 
                                                                        WHERE id_persona = $id_persona)"
        );
        $f3->set('SESSION.habilidades_no_adquiridas', $habilidades_no_adquiridas);
        // $habilidadesTodas = new DB\SQL\Mapper($db, 'habilidades');
        // $habilidadesTodas->load(['id_habilidad>?',0]);
        // $arr_habilidadesTod = array();
        // do{
        //     array_push($arr_habilidadesTod, $habilidadesTodas->cast());
        //     $habilidadesTodas->skip();
        // }while(!$habilidadesTodas->dry());
        // $f3->set('SESSION.habilidadesTodas', $arr_habilidadesTod);


        $this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'habilidadesPersona');
        echo View::instance()->render('layout.html');
    }

    function nuevaHabilidad($f3){
        $db = $this->db;
        $esta_session_persona = $f3->get('SESSION.persona');
        // $esta_session_usuario = $f3->get('SESSION.usuario');
        $id_persona = $esta_session_persona[0]['id_persona'];
        // $habilidades = $db->exec("SELECT * FROM habilidades 
        //                           WHERE id_habilidad NOT IN (
        //                                                      SELECT id_habilidad 
        //                                                      FROM habilidades_personas 
        //                                                      WHERE id_persona = $id_persona)"
        // );
        // $f3->set('SESSION.habilidades', $habilidades);
        // $id_usuario = $esta_session_usuario[0]['id_usuario'];
        // $this->sessionPersona($f3,$id_usuario);
        // echo ($_POST['checkbox']);
        //print("<pre>".print_r($_POST['checkbox'],true)."</pre><br>");
        foreach ($_POST['checkbox'] as $key => $value) {
        $valores = $db->exec("INSERT INTO habilidades_personas(`id_persona`,
                                                `id_habilidad`, 
                                                `nivel`) 
                                                VALUES
                                                ($id_persona,
                                                $value,
                                                1)"
            );
        }                                
        $esta_session_usuario = $f3->get('SESSION.usuario');
		$id_usuario = $esta_session_usuario[0]['id_usuario'];  
        $this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'habilidadesPersona');
        // echo View::instance()->render('layout.html');
        $f3->reroute('/habilidadesPersona');
    }
        
    function crearHabilidad($f3){
        $db=$this->db;
        $habilidades_personas = new DB\SQL\Mapper($db, 'habilidades_personas');
        $habilidades_personas->copyFrom('POST');
        $habilidades_personas->save();
        $esta_session_usuario = $f3->get('SESSION.usuario');
        $id_usuario = $esta_session_usuario[0]['id_usuario'];
        $this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'principal');
        echo View::instance()->render('layout.html');
    }

    function editar_datos($f3){
        $esta_sesion_usuario = $f3->get('SESSION.usuario');
        $id_usuario = $esta_sesion_usuario[0]['id_usuario'];
        $this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'editar_datos');
        echo View::instance()->render('layout.html');
    }

    function registrarDatosUsuario($f3){
        $db=$this->db;
        
        $esta_sesion_usuario = $f3->get('SESSION.usuario');
        $id_usuario = $esta_sesion_usuario[0]['id_usuario'];

        $esta_sesion_persona = $f3->get('SESSION.persona');
        $id_persona = $esta_sesion_persona[0]['id_persona'];

        $usuario = new DB\SQL\Mapper($db, 'usuarios');
        $persona = new DB\SQL\Mapper($db, 'personas');

        $usuario->load(['id_usuario=?',$id_usuario]);
        $persona->load(['id_persona=?',$id_persona]);

        $usuario->copyFrom('POST');
        $persona->copyFrom('POST');

        $usuario->save();
        $persona->save();

        $esta_sesion_usuario = $f3->get('SESSION.usuario');
        $id_usuario = $esta_sesion_usuario[0]['id_usuario'];
        $this->sessionPersona($f3,$id_usuario);
        $f3->set('template', 'principal');
        echo View::instance()->render('layout.html');
    }
	function personas($f3){
		$db = $this->db; 
        $personas = new DB\SQL\Mapper($db,'personas'); 
        $personas->email_usuario = 'SELECT email FROM usuarios WHERE usuarios.id_usuario=personas.id_usuario';
        $personas->tipo_persona = 'SELECT descripcion_tipo FROM tipos_personas WHERE tipos_personas.id_tipo_persona=personas.id_tipo_persona';
		$personas->load(['id_tipo_persona=?',$f3->get('TIPO_PERSONA_PROFESIONAL')]); 
		// if($personas->dry()){
		// 	die('No existen registros de personas.');
		// }
		$array = array();
		do {
			array_push($array, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('personas', $array);

        $empresas = new DB\SQL\Mapper($db,'personas'); 
        $empresas->email_usuario = 'SELECT email FROM usuarios WHERE usuarios.id_usuario=personas.id_usuario';
        $empresas->tipo_persona = 'SELECT descripcion_tipo FROM tipos_personas WHERE tipos_personas.id_tipo_persona=personas.id_tipo_persona';
		$empresas->load(['id_tipo_persona=?',$f3->get('TIPO_PERSONA_EMPRESA')]); 
		// if($empresas->dry()){
		// 	die('No existen registros de personas.');
		// }
		$array_emp = array();
		do {
			array_push($array_emp, $empresas->cast());
			$empresas->skip();
		} while (!$empresas->dry());
		$f3->set('empresas', $array_emp);

        $tipos_personas = new DB\SQL\Mapper($db,'tipos_personas');
        $tipos_personas->load();
		$array_tipos_personas = array();
		do {
			array_push($array_tipos_personas, $tipos_personas->cast());
			$tipos_personas->skip();
		} while (!$tipos_personas->dry());
		$f3->set('tipos_personas', $array_tipos_personas);
		// $rows = $db->exec('SELECT usu.id_usuario, usu.email FROM usuarios usu');
        $usuarios = new DB\SQL\Mapper($db,'usuarios');
        $usuarios->load();
		$array_usuarios = array();
		do {
			array_push($array_usuarios, $usuarios->cast());
			$usuarios->skip();
		} while (!$usuarios->dry());
		$f3->set('usuarios',$array_usuarios);
		$f3->set('template', 'personas');
		// $f3->set('active_personas', 'active');

		echo View::instance()->render('layout.html');
	}
	function personas_read($f3, $args){
		$db = $this->db; 
        $personas = new DB\SQL\Mapper($db,'personas'); 
		$personas->load(['id_persona=?', $args['id']]); 
		// if($personas->dry()){
		// 	die('No encuentra persona con id '.$args['id']);
		// }
		$array = array();
		do {
			array_push($array, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());

		$f3->set('personas', $array);
		echo View::instance()->render('personas.html');
	}
	function personas_update($f3, $args){
		$db = $this->db;
		$personas = new DB\SQL\Mapper($db, 'personas');
		$personas->load(['id_persona=?', $args['id']]);
		$personas->copyFrom('POST');
		$personas->save(); //inserta o actualiza la tabla
		// $idUsu = $f3->get('POST.idUsuario');
		$email = $f3->get('POST.email');
		$db->exec("UPDATE `usuarios` 
					SET 
					`email` = '$email'
					WHERE `id_usuario` = $personas->id_usuario");
		// $render = $f3->get('POST.render');
		$array = array();
		do {
			array_push($array, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('personaUsu', $array);

		// echo View::instance()->render('personas.html');
		$f3->reroute('/personas');

	}
	function personas_create($f3, $args){
		$db = $this->db; 
        $personas = new DB\SQL\Mapper($db,'personas'); //la tabla personas contiene la clave id_usuario
		// $personas->load(['id_persona=?', $args['id']]); //filtro where
		$personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($personas);
		$personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@personas_read(@id='.$personas->id_persona.')');//return
		$f3->reroute('/personas');
	}
	function personas_delete($f3, $args){
		$db = $this->db; 
        $personas = new DB\SQL\Mapper($db,'personas'); //mapeo de la tabla
		$personas->load(['id_persona=?', $args['id']]); //filtro where
		// $personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($personas);
		$personas->erase(); //elimina registro de la tabla

		$f3->reroute('/personas');//return
	
	}

    function empresa_match($f3){
        $f3->set('template', 'empresa_match');
        echo View::instance()->render('layout.html');
    }

    function solicituesProfesional($f3){
        $f3->set('template', 'solicitudesProfesional');
        echo View::instance()->render('layout.html');
    }
}