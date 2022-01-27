<?php
#region Inicial

// Kickstart the framework
$f3=require('f3/lib/base.php'); //core del framework

$f3->set('AUTOLOAD','app/'); //carga los .php de la carpeta app


// $f3->set('DEBUG',1); //set on config.ini
if ((float)PCRE_VERSION<8.0)
	trigger_error('PCRE version is out of date'); //averguar 

$f3->set('CACHE', TRUE);
	// $f3->set('CACHE', 'memcache=localhost'); //variable global
	// $f3->set('CACHE', FALSE);

// Load configuration
$f3->config('config/config.ini');

$f3->route('GET /', 'Main->index');
$f3->route('GET /index', 'Main->index');
$f3->route('GET /login', 'Main->login');
$f3->route('GET /logout', 'Main->logout');
$f3->route('POST /home', 'Main->iniciar_sesion'); //ex $f3->route('POST /iniciar_sesion', 'Main->iniciar_sesion');
$f3->route('GET /getHome', 'Main->home'); //ex $f3->route('GET /home', 'Main->home');

//Roles
$f3->route('GET /roles', 'Rol->roles');
$f3->route('GET /roles/@id', 'Rol->roles_read');
$f3->route('POST /roles/update/@id', 'Rol->roles_update');
$f3->route('POST /roles/create', 'Rol->roles_create');
$f3->route('POST /roles/delete/@id', 'Rol->roles_delete');

//Personas
$f3->route('GET /registro', 'Persona->registro');
$f3->route('GET /registro_empresa', 'Persona->registro_empresa');
$f3->route('GET /registro_profesional', 'Persona->registro_profesional');
$f3->route('POST /registrar_profesional_p2', 'Persona->registrar_profesional_p2');
$f3->route('POST /registrarProfesional', 'Persona->registrarProfesional');
$f3->route('POST /registrarEmpresa', 'Persona->registrarEmpresa');

$f3->route('GET /datosPersona', 'Persona->datosPersona');
$f3->route('POST /editar_datos', 'Persona->editar_datos');
$f3->route('POST /registrarDatosUsuario', 'Persona->registrarDatosUsuario');

$f3->route('GET /habilidadesPersona', 'Persona->habilidadesPersona');
$f3->route('GET /crearOferta', 'Persona->crearOferta');
$f3->route('POST /registrarOferta','Persona->registrarOferta');
$f3->route('GET /personas','Persona->personas');
$f3->route('GET /personas/@id', 'Persona->personas_read');
$f3->route('POST /personas/update/@id', 'Persona->personas_update');
$f3->route('POST /personas/create', 'Persona->personas_create');
$f3->route('POST /personas/delete/@id', 'Persona->personas_delete');
$f3->route('POST /nuevaHabilidad', 'Persona->nuevaHabilidad');

$f3->route('GET /empresa_match', 'Persona->empresa_match');
$f3->route('GET /solicituesProfesional','Persona->solicituesProfesional');



//Perfiles
$f3->route('GET /perfiles', 'Perfil->perfiles');
$f3->route('GET /perfiles/@id', 'Perfil->perfiles_read');
$f3->route('POST /perfiles/update/@id', 'Perfil->perfiles_update');
$f3->route('POST /perfiles/create', 'Perfil->perfiles_create');
$f3->route('POST /perfiles/delete/@id', 'Perfil->perfiles_delete');
$f3->route('GET /perfil', 'Perfil->ver_perfil');
$f3->route('POST /editar_perfil', 'Perfil->editar_perfil');
$f3->route('POST /registrarPerfil', 'Perfil->registrarPerfil');


//Estados
$f3->route('GET /estados', 'Estado->estados');
$f3->route('GET /estados/@id', 'Estado->estados_read');
$f3->route('POST /estados/update/@id', 'Estado->estados_update');
$f3->route('POST /estados/create', 'Estado->estados_create');
$f3->route('POST /estados/delete/@id', 'Estado->estados_delete');


//Ofertas
$f3->route('GET /ofertas', 'Oferta->ofertas');
$f3->route('GET /ofertas/@id', 'Oferta->ofertas_read');
$f3->route('POST /ofertas/update/@id', 'Oferta->ofertas_update');
$f3->route('POST /ofertas/create', 'Oferta->ofertas_create');
$f3->route('POST /ofertas/delete/@id', 'Oferta->ofertas_delete');
$f3->route('GET /ofertas_personas/@id', 'Oferta->ofertas_personas_read');
$f3->route('POST /ofertas_personas/update/@id', 'Oferta->ofertas_personas_update');
$f3->route('POST /ofertas_personas/create', 'Oferta->ofertas_personas_create');
$f3->route('POST /ofertas_personas/delete/@id', 'Oferta->ofertas_personas_delete');
$f3->route('POST /solicitar_oferta','Oferta->solicitar_oferta');
$f3->route('POST /oferta_detalle','Oferta->oferta_detalle');
$f3->route('GET /crearOferta', 'Oferta->crearOferta');
$f3->route('POST /registrarOferta','Oferta->registrarOferta');
$f3->route('POST /oferta_editar','Oferta->oferta_editar');
$f3->route('POST /editarOferta', 'Oferta->editarOferta');
$f3->route('GET /ofertas_empresa', 'Oferta->ofertas_empresa');
$f3->route('POST /eliminarOferta', 'Oferta->eliminarOferta');

//Usuarios
$f3->route('GET /usuarios', 'Usuario->usuarios');
$f3->route('GET /usuarios/@id', 'Usuario->usuarios_read');
$f3->route('POST /usuarios/update/@id', 'Usuario->usuarios_update');
$f3->route('POST /usuarios/create', 'Usuario->usuarios_create');
$f3->route('POST /usuarios/delete/@id', 'Usuario->usuarios_delete');
$f3->route('GET /usuarios_roles', 'Usuario->usuarios_roles');
$f3->route('GET /usuarios_roles/@id', 'Usuario->usuarios_roles_read');
$f3->route('POST /usuarios_roles/update/@id', 'Usuario->usuarios_roles_update');
$f3->route('POST /usuarios_roles/create', 'Usuario->usuarios_roles_create');
$f3->route('POST /usuarios_roles/delete/@id', 'Usuario->usuarios_roles_delete');

//Solicitudes
$f3->route('GET /solicitudes', 'Solicitud->solicitudes');
$f3->route('GET /solicitudes/@id', 'Solicitud->solicitudes_read');
$f3->route('POST /solicitudes/update/@id', 'Solicitud->solicitudes_update');
$f3->route('POST /solicitudes/create', 'Solicitud->solicitudes_create');
$f3->route('POST /solicitudes/delete/@id', 'Solicitud->solicitudes_delete');

//Habilidades
$f3->route('GET /habilidades', 'Habilidad->habilidades');
$f3->route('GET /habilidades/@id', 'Habilidad->habilidades_read');
$f3->route('POST /habilidades/update/@id', 'Habilidad->habilidades_update');
$f3->route('POST /habilidades/create', 'Habilidad->habilidades_create');
$f3->route('POST /habilidades/delete/@id', 'Habilidad->habilidades_delete');
$f3->route('GET /habilidades_personas/@id', 'Habilidad->habilidades_personas_read');
$f3->route('POST /habilidades_personas/update/@id', 'Habilidad->habilidades_personas_update');
$f3->route('POST /habilidades_personas/create', 'Habilidad->habilidades_personas_create');
$f3->route('POST /habilidades_personas/delete/@id', 'Habilidad->habilidades_personas_delete');
$f3->route('POST /cambiarNivelHabilidad', 'Habilidad->cambiarNivelHabilidad');
$f3->route('POST /eliminarHabilidad', 'Habilidad->eliminarHabilidad');

$f3->set('ONERROR',
    function($f3) {
        // custom error handler code goes here
        // use this if you want to display errors in a
        // format consistent with your site's theme
        echo $f3->get('ERROR.text');
    }
);
/*
#endregion

//Ruta al home
$f3->route(
	'GET @home: /home',
	function ($f3) {
		$session = $f3->get('SESSION.usuario');
		if(empty($session)){
			echo View::instance()->render('login.html');
		}else{
			$f3->set('SESSION.usuario', $session);
			echo View::instance()->render('home.html');
		}
		// $f3->get('SESSION.usuario');
		// $f3->route('home.html');
	}
);

$f3->route(
	'GET /',
	function ($f3) {
		$f3->reroute('@login()');
	}
);

//Ruta al login
$f3->route(
	'GET @login: /login',
	function ($f3) {
		$session = $f3->get('SESSION.usuario');
		// if(session_status() !== PHP_SESSION_ACTIVE || session_id() != ''){
		// 	session_destroy();
		// }
		if(empty($session)){
			echo View::instance()->render('login.html');
		}else{
			$f3->set('SESSION.usuario', $session);
			echo View::instance()->render('home.html');
		}
		// echo View::instance()->render('login.html');
	}
);

//Cerrar sesion (destruye la session actual)
$f3->route(
	'GET @logout: /logout',
	function ($f3) {
		// $f3->set('content','userref.htm');
		session_start();
		if(session_destroy()){
			// echo 'session destruida';
		}else{
			// echo 'no se ha podido destruir la session';
		}
		
		$f3->reroute('@login()');
	}
);

//Ruta al registro
$f3->route(
	'GET /registro',
	function ($f3) {
		echo View::instance()->render('registro.html');
	}
);

//Logica del inicio de sesion
$f3->route(
	'POST @iniciar_sesion: /iniciar_sesion',
	function ($f3) {
		$db = getConnection();
		$usuarios = new DB\SQL\Mapper($db, 'usuarios');
		$auth = new \Auth($usuarios, array('id' => 'email', 'pw' => 'password'));
		//obtengo credenciales
		$email = $f3->get('POST.email');
		$password = $f3->get('POST.password');
		$loginResult = $auth->login($email, $password); //pruebo el login
		if (!$loginResult) {
			die('Error de acceso.');
		} else {
			new Session();
			$id_usuario = $usuarios->get('id_usuario');
			$usuarios->load(['id_usuario=?', $id_usuario]);
			$personas = new DB\SQL\Mapper($db, 'personas');
			$personas->load(['id_usuario=?', $id_usuario]);
			$array_usuario = array();
			do {
				array_push($array_usuario, $usuarios->cast());
				$usuarios->skip();
			} while (!$usuarios->dry());
			// array_push($array_usuario, $personas->get('id_tipo_persona'));
			$array_usuario['id_tipo_persona'] = $personas->get('id_tipo_persona');
			$array_usuario['nombre_razonsocial'] = $personas->get('nombre_razonsocial');
			$array_usuario['apellidos'] = $personas->get('apellidos');
			$f3->set('SESSION.usuario', $array_usuario);
			// echo View::instance()->render('home.html');
			$f3->reroute('@home()');
		}
	}
);

#region RUTAS DENTRO DE homeEmpresa

//Menu ---> Mis Datos (obtengo id_usuario via POST)
//Entrego a misDatosEmp.html los datos de la tabla Personas y la tabla Usuarios
$f3->route(
	'GET|POST @personaEmp: /personaEmp',
	function ($f3) {
		$db = getConnection();
		$usuarios = new DB\SQL\Mapper($db, 'usuarios');
		$personas = new DB\SQL\Mapper($db, 'personas');
		$id_usuario = $f3->get('POST.id_usuario');

		$usuarios->load(['id_usuario=?', $id_usuario]);

		$personas->load(['id_usuario=?', $id_usuario]);

		$array_usuario = array();
		do {
			array_push($array_usuario, $usuarios->cast());
			$usuarios->skip();
		} while (!$usuarios->dry());
		$f3->set('usuario', $array_usuario);

		$array_persona = array();
		do {
			array_push($array_persona, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('persona', $array_persona);

		// new Session();
		$f3->set('SESSION.usuario', $array_usuario);
		$f3->set('SESSION.persona', $array_persona);
		echo View::instance()->render('misDatosEmp.html');
	}
);

$f3->route(
	'GET @personaEmp_read: /personaEmp/read/@id',
	function ($f3, $args) {
		$db = getConnection();
		$usuarios = new DB\SQL\Mapper($db, 'usuarios');
		$personas = new DB\SQL\Mapper($db, 'personas');

		$usuarios->load(['id_usuario=?', $args['id']]);

		$personas->load(['id_usuario=?', $args['id']]);

		if ($usuarios->dry() && $personas->dry()) {
			die('No encuentra usuario o persona con id_usuario = ' . $args['id']);
		}

		$array_usuario = array();
		do {
			array_push($array_usuario, $usuarios->cast());
			$usuarios->skip();
		} while (!$usuarios->dry());
		$f3->set('usuario', $array_usuario);

		$array_persona = array();
		do {
			array_push($array_persona, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('persona', $array_persona);

		// new Session();
		$f3->set('SESSION.usuario', $array_usuario);
		$f3->set('SESSION.persona', $array_persona);

		echo View::instance()->render('misDatosEmp.html');
	}
);

//Editar los datos de personales (tabla personas) en la vista misDatosEmp.html
$f3->route(
	'POST @personaEmp_update: /personaEmp/updatePersona/@id',
	function ($f3, $args) {
		$db = getConnection();
		$persona = new DB\SQL\Mapper($db, 'personas');
		$persona->load(['id_persona=?', $args['id']]);
		$persona->copyFrom('POST');
		$persona->save();
		$id_usuario = $f3->get('POST.id_usuario');
		$f3->reroute('@personaEmp_read(@id=' . $id_usuario . ')');
	}
);

//Editar los datos de usuario (tabla usuarios) en la vista misDatosEmp.html
$f3->route(
	'POST @personaEmp_update: /personaEmp/updateUsuario/@id',
	function ($f3, $args) {
		$db = getConnection();
		$usuario = new DB\SQL\Mapper($db, 'usuarios');
		$usuario->load(['id_usuario=?', $args['id']]);
		$usuario->copyFrom('POST');
		$usuario->save();
		$id_usuario = $f3->get('POST.id_usuario');
		$f3->reroute('@personaEmp_read(@id=' . $id_usuario . ')');
	}
);
#endregion

#region EMPRESAS Y PROFESIONAL

$f3->route(
	'GET @registro_profesional: /registro_profesional',
	function ($f3) {
		echo \Template::instance()->render('registro-profesional.html');
	}
);

$f3->route(
	'GET @registro_empresa: /registro_empresa',
	function ($f3) {
		echo \Template::instance()->render('registro-empresa.html');
	}
);

//Registro Profesional paso 1
$f3->route(
	'POST @registrar_profesional_p1: /registrar_profesional_p1',
	function ($f3) {
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
);

//Registro Profesional paso 2
$f3->route(
	'POST @registrarProfesional: /registrarProfesional',
	function ($f3) {
		$db = getConnection();
		$usuario = new DB\SQL\Mapper($db, 'usuarios');
		//obtener los datos desde el registro pasos 1 y 2
		$email = $f3->get('POST.email');
		$telefono = $f3->get('POST.telefono');
		$nombre = $f3->get('POST.nombre_razonsocial');
		$apellidos = $f3->get('POST.apellidos');
		$rut = $f3->get('POST.rut');
		//inserto el profesional en la tabla usuarios
		$usuario->copyFrom('POST');
		$usuario->save();
		$id_usuario = $usuario->get('_id');
		$usuario->load(["id_usuario=?", $id_usuario]);
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
								3)"
		);
		// var_dump($usuario);
		$array_usuario = array();
		do {
			array_push($array_usuario, $usuario->cast());
			$usuario->skip();
		} while (!$usuario->dry());

		$persona = new DB\SQL\Mapper($db, 'personas');
		$persona->load(["id_usuario=?",$id_usuario]);
		$array_usuario['id_tipo_persona'] = $persona->get('id_tipo_persona');
		// $array_persona = array();
		// do {
		// 	array_push($array_persona, $persona->cast());
		// 	$persona->skip();
		// } while (!$persona->dry());

		// new Session();

		$f3->set('SESSION.usuario', $array_usuario);
		// $f3->set('SESSION.persona', $array_persona);
		echo View::instance()->render('home.html');
	}
);

//Registro de empresa
$f3->route(
	'POST @registrarEmpresa: /registrarEmpresa',
	function ($f3) {
		$db = getConnection();
		$usuario = new DB\SQL\Mapper($db, 'usuarios');
		//obtener los datos desde POST
		$email = $f3->get('POST.email');
		$telefono = $f3->get('POST.telefono');
		$nombre = $f3->get('POST.nombre_razonsocial');
		$rut = $f3->get('POST.rut');
		//inserto el profesional en la tabla usuarios
		$usuario->copyFrom('POST');
		$usuario->save();
		$id_usuario = $usuario->get('_id');
		$usuario->load(["id_usuario=?", $id_usuario]);
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
								1)"
		);
		// var_dump($usuario);
		$array_usuario = array();
		do {
			array_push($array_usuario, $usuario->cast());
			$usuario->skip();
		} while (!$usuario->dry());

		$persona = new DB\SQL\Mapper($db, 'personas');
		$persona->load(["id_usuario=?",$id_usuario]);
		$array_usuario['id_tipo_persona'] = $persona->get('id_tipo_persona');
		$array_usuario['nombre_razonsocial'] = $persona->get('nombre_razonsocial');
		// $array_persona = array();
		// do {
		// 	array_push($array_persona, $persona->cast());
		// 	$persona->skip();
		// } while (!$persona->dry());

		// new Session();
		$f3->set('SESSION.usuario', $array_usuario);
		// $f3->set('SESSION.persona', $array_persona);
		echo View::instance()->render('home.html');
	}
);
#endregion

#region OFERTAS PERSONAS

$f3->route(
	'GET @ofertas_personas: /ofertas_personas',
	function ($f3) {
		$db = getConnection();
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas');
		$ofertas_personas->load(["id_oferta_persona>?", 0]);
		if ($ofertas_personas->dry()) {
			die('No existen registros de Ofertas personas.');
		}
		$array = array();
		do {
			array_push($array, $ofertas_personas->cast());
			$ofertas_personas->skip();
		} while (!$ofertas_personas->dry());
		$f3->set('ofertas_personas', $array);

		$rows_oferta = $db->exec('SELECT ofe.id_oferta, ofe.nombre_oferta, ofe.descripcion, ofe.fecha_oferta, ofe.id_proyecto 
									FROM ofertas ofe 
									INNER JOIN ofertas_personas ofp ON ofe.id_oferta = ofp.id_oferta');
		$f3->set('id_oferta_linelist', $rows_oferta);

		$rows_persona = $db->exec('SELECT per.id_persona, per.nombre_razonsocial, per.apellidos, per.rut, per.email, per.id_usuario 
									FROM personas per 
									INNER JOIN ofertas_personas ofp ON per.id_persona = ofp.id_persona');
		$f3->set('id_persona_linelist', $rows_persona);

		echo View::instance()->render('ofertas_personas.html');
	}
);

$f3->route(
	'GET @ofertas_personas_read: /ofertas_personas/read/@id',
	function ($f3, $args) {
		$db = getConnection();
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
		echo View::instance()->render('ofertas_personas.html');
	}
);

$f3->route(
	'POST @ofertas_personas_update: /ofertas_personas/update/@id',
	function ($f3, $args) {
		$db = getConnection();
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas');
		$ofertas_personas->load(['id_oferta_persona=?', $args['id']]);
		$ofertas_personas->copyFrom('POST');
		// print_r($ofertas_personas);
		$ofertas_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@ofertas_personas');
	}
);

$f3->route(
	'POST @ofertas_personas_create: /ofertas_personas/create',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas'); //la tabla ofertas_personas contiene la clave id_usuario
		// $ofertas_personas->load(['id_oferta_persona=?', $args['id']]); //filtro where
		$ofertas_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas_personas);
		$ofertas_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@ofertas_personas_read(@id='.$ofertas_personas->id_oferta_persona.')');//return
		$f3->reroute('@ofertas_personas'); //return
	}
);

$f3->route(
	'POST @ofertas_personas_delete: /ofertas_personas/delete/@id',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$ofertas_personas = new DB\SQL\Mapper($db, 'ofertas_personas'); //mapeo de la tabla
		$ofertas_personas->load(['id_oferta_persona=?', $args['id']]); //filtro where
		// $ofertas_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas_personas);
		$ofertas_personas->erase(); //elimina registro de la tabla

		$f3->reroute('@ofertas_personas'); //return

	}
);

#endregion

#region PERFILES

$f3->route(
	'GET @perfiles: /perfiles',
	function ($f3) {
		$db = getConnection();
		$perfiles = new DB\SQL\Mapper($db, 'perfiles');
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

		$rows_persona = $db->exec('SELECT per.id_persona, per.nombre_razonsocial, per.apellidos, per.rut, per.email FROM personas per 
		INNER JOIN perfiles pf ON per.id_persona = pf.id_persona');
		$f3->set('id_persona_linelist', $rows_persona);
		$f3->set('template', 'templates/perfiles.html');
		$f3->set('active_perfiles', 'active');

		echo View::instance()->render('home.html');
	}
);

$f3->route(
	'GET @perfiles_read: /perfiles/read/@id',
	function ($f3, $args) {
		$db = getConnection();
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
);

$f3->route(
	'POST @perfiles_update: /perfiles/update/@id',
	function ($f3, $args) {
		$db = getConnection();
		$perfiles = new DB\SQL\Mapper($db, 'perfiles');
		$perfiles->load(['id_perfil=?', $args['id']]);
		$perfiles->copyFrom('POST');
		// print_r($perfiles);
		$perfiles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@perfiles');
	}
);

$f3->route(
	'POST @perfiles_create: /perfiles/create',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$perfiles = new DB\SQL\Mapper($db, 'perfiles'); //la tabla perfiles contiene la clave id_usuario
		// $perfiles->load(['id_perfil=?', $args['id']]); //filtro where
		$perfiles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($perfiles);
		$perfiles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@perfiles_read(@id='.$perfiles->id_perfil.')');//return
		$f3->reroute('@perfiles'); //return
	}
);

$f3->route(
	'POST @perfiles_delete: /perfiles/delete/@id',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$perfiles = new DB\SQL\Mapper($db, 'perfiles'); //mapeo de la tabla
		$perfiles->load(['id_perfil=?', $args['id']]); //filtro where
		// $perfiles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($perfiles);
		$perfiles->erase(); //elimina registro de la tabla

		$f3->reroute('@perfiles'); //return

	}
);
#endregion

#region OFERTAS HABILIDADES

$f3->route(
	'GET @ofertas_habilidades: /ofertas_habilidades',
	function ($f3) {
		$db = getConnection();
		$ofertas_habilidades = new DB\SQL\Mapper($db, 'ofertas_habilidades');
		$ofertas_habilidades->load(["id_oferta_habilidad>?", 0]);
		if ($ofertas_habilidades->dry()) {
			die('No existen registros de ofertas_habilidades.');
		}
		$array = array();
		do {
			array_push($array, $ofertas_habilidades->cast());
			$ofertas_habilidades->skip();
		} while (!$ofertas_habilidades->dry());
		$f3->set('ofertas_habilidades', $array);

		$rows_idHab = $db->exec('SELECT hab.id_habilidad, hab.nombre_habilidad, hab.grupo FROM habilidades hab 
									INNER JOIN ofertas_habilidades oha ON hab.id_habilidad = oha.id_habilidad');
		$f3->set('id_habilidad_linelist', $rows_idHab);

		$rows_idOfe = $db->exec('SELECT ofe.id_oferta, ofe.nombre_oferta, ofe.descripcion, ofe.fecha_oferta, ofe.comentarios,
									ofe.url_documento, ofe.id_proyecto, ofe.tipo_proyecto FROM ofertas ofe
									INNER JOIN ofertas_habilidades oha ON ofe.id_oferta = oha.id_oferta');
		$f3->set('id_oferta_linelist', $rows_idOfe);

		echo View::instance()->render('ofertas_habilidades.html');
	}
);

$f3->route(
	'GET @ofertas_habilidades_read: /ofertas_habilidades/read/@id',
	function ($f3, $args) {
		$db = getConnection();
		$ofertas_habilidades = new DB\SQL\Mapper($db, 'ofertas_habilidades');
		$ofertas_habilidades->load(['id_oferta_habilidad=?', $args['id']]);
		if ($ofertas_habilidades->dry()) {
			die('No encuentra oferta_habilidad con id ' . $args['id']);
		}
		$array = array();
		do {
			array_push($array, $ofertas_habilidades->cast());
			$ofertas_habilidades->skip();
		} while (!$ofertas_habilidades->dry());

		$f3->set('ofertas_habilidades', $array);
		echo View::instance()->render('ofertas_habilidades.html');
	}
);

$f3->route(
	'POST @ofertas_habilidades_update: /ofertas_habilidades/update/@id',
	function ($f3, $args) {
		$db = getConnection();
		$ofertas_habilidades = new DB\SQL\Mapper($db, 'ofertas_habilidades');
		$ofertas_habilidades->load(['id_oferta_habilidad=?', $args['id']]);
		$ofertas_habilidades->copyFrom('POST');
		// print_r($ofertas_habilidades);
		$ofertas_habilidades->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@ofertas_habilidades');
	}
);

$f3->route(
	'POST @ofertas_habilidades_create: /ofertas_habilidades/create',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$ofertas_habilidades = new DB\SQL\Mapper($db, 'ofertas_habilidades'); //la tabla ofertas_habilidades contiene la clave id_usuario
		// $ofertas_habilidades->load(['id_oferta_habilidad=?', $args['id']]); //filtro where
		$ofertas_habilidades->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas_habilidades);
		$ofertas_habilidades->save(); //inserta o actualiza la tabla
		// $f3->reroute('@ofertas_habilidades_read(@id='.$ofertas_habilidades->id_oferta_habilidad.')');//return
		$f3->reroute('@ofertas_habilidades'); //return
	}
);

$f3->route(
	'POST @ofertas_habilidades_delete: /ofertas_habilidades/delete/@id',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$ofertas_habilidades = new DB\SQL\Mapper($db, 'ofertas_habilidades'); //mapeo de la tabla
		$ofertas_habilidades->load(['id_oferta_habilidad=?', $args['id']]); //filtro where
		// $ofertas_habilidades->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas_habilidades);
		$ofertas_habilidades->erase(); //elimina registro de la tabla

		$f3->reroute('@ofertas_habilidades'); //return

	}
);
#endregion

#region SOLICITUDES

$f3->route(
	'GET @solicitudes: /solicitudes',
	function ($f3) {
		$db = getConnection();
		$solicitudes = new DB\SQL\Mapper($db, 'solicitudes');
		$solicitudes->load(["id_solicitud>?", 0]);
		if ($solicitudes->dry()) {
			die('No existen registros de solicitudes.');
		}
		$array = array();
		do {
			array_push($array, $solicitudes->cast());
			$solicitudes->skip();
		} while (!$solicitudes->dry());
		$f3->set('solicitudes', $array);

		$rows_oferta = $db->exec('SELECT of.id_oferta FROM ofertas of');
		$f3->set('id_oferta_linelist', $rows_oferta);

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

		$rows_estado = $db->exec('SELECT id_estado, nombre_estado, descripcion_estado FROM estados');
		$f3->set('id_estado_linelist', $rows_estado);

		echo View::instance()->render('solicitudes.html');
	}
);

$f3->route(
	'GET @solicitudes_read: /solicitudes/read/@id',
	function ($f3, $args) {
		$db = getConnection();
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
		echo View::instance()->render('solicitudes.html');
	}
);

$f3->route(
	'POST @solicitudes_update: /solicitudes/update/@id',
	function ($f3, $args) {
		$db = getConnection();
		$solicitudes = new DB\SQL\Mapper($db, 'solicitudes');
		$solicitudes->load(['id_solicitud=?', $args['id']]);
		$solicitudes->copyFrom('POST');
		// print_r($solicitudes);
		$solicitudes->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@solicitudes');
	}
);

$f3->route(
	'POST @solicitudes_create: /solicitudes/create',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$solicitudes = new DB\SQL\Mapper($db, 'solicitudes'); //la tabla solicitudes contiene la clave id_usuario
		// $solicitudes->load(['id_solicitud=?', $args['id']]); //filtro where
		$solicitudes->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($solicitudes);
		$solicitudes->save(); //inserta o actualiza la tabla
		// $f3->reroute('@solicitudes_read(@id='.$solicitudes->id_solicitud.')');//return
		$f3->reroute('@solicitudes'); //return
	}
);

$f3->route(
	'POST @solicitudes_delete: /solicitudes/delete/@id',
	function ($f3, $args) {
		$db = getConnection(); //Conexion a la BBDD
		$solicitudes = new DB\SQL\Mapper($db, 'solicitudes'); //mapeo de la tabla
		$solicitudes->load(['id_solicitud=?', $args['id']]); //filtro where
		// $solicitudes->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($solicitudes);
		$solicitudes->erase(); //elimina registro de la tabla

		$f3->reroute('@solicitudes'); //return

	}
);
#endregion

#region USUARIOS ROLES
$f3->route('GET @usuarios_roles: /usuarios_roles', 
	function($f3){
		$db = getConnection(); 
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); 
		$usuarios_roles->load(["id_usuario_rol>?", 0]); 
		if($usuarios_roles->dry()){
			die('No existen registros de usuarios roles.');
		}
		$array = array();
		do {
			array_push($array, $usuarios_roles->cast());
			$usuarios_roles->skip();
		} while (!$usuarios_roles->dry());
		$f3->set('usuarios_roles', $array);

		$rows_usuario = $db->exec('SELECT usu.id_usuario, usu.email FROM usuarios usu');
		$f3->set('id_usuario_linelist',$rows_usuario);

		$rows_roles = $db->exec('SELECT r.id_rol, r.nombre_rol FROM roles r');
		$f3->set('id_rol_linelist',$rows_roles);

		echo View::instance()->render('usuarios_roles.html');
	}
);

$f3->route('GET @usuarios_roles_read: /usuarios_roles/read/@id', 
	function($f3, $args){
		$db = getConnection(); 
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); 
		$usuarios_roles->load(['id_usuario_rol=?', $args['id']]); 
		if($usuarios_roles->dry()){
			die('No encuentra habilidad persona con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $usuarios_roles->cast());
			$usuarios_roles->skip();
		} while (!$usuarios_roles->dry());

		$f3->set('usuarios_roles', $array);
		echo View::instance()->render('usuarios_roles.html');
	}
);

$f3->route('POST @usuarios_roles_update: /usuarios_roles/update/@id', 
	function($f3, $args){
		$db = getConnection();
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); 
		$usuarios_roles->load(['id_usuario_rol=?', $args['id']]); 
		$usuarios_roles->copyFrom('POST');
		// print_r($usuarios_roles);
		$usuarios_roles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@usuarios_roles');
	}
);

$f3->route('POST @usuarios_roles_create: /usuarios_roles/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
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
		$f3->reroute('@usuarios_roles');//return
	}
);

$f3->route('POST @usuarios_roles_delete: /usuarios_roles/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $usuarios_roles = new DB\SQL\Mapper($db,'usuarios_roles'); //mapeo de la tabla
		$usuarios_roles->load(['id_usuario_rol=?', $args['id']]); //filtro where
		// $usuarios_roles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios_roles);
		$usuarios_roles->erase(); //elimina registro de la tabla

		$f3->reroute('@usuarios_roles');//return
	
	}
);
#endregion

#region HABILIDADES PERSONAS
$f3->route('GET @habilidades_personas: /habilidades_personas', 
	function($f3){
		$db = getConnection(); 
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
);

$f3->route('GET @habilidades_personas_read: /habilidades_personas/read/@id', 
	function($f3, $args){
		$db = getConnection(); 
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
		echo View::instance()->render('habilidades_personas.html');
	}
);

$f3->route('POST @habilidades_personas_update: /habilidades_personas/update/@id', 
	function($f3, $args){
		$db = getConnection();
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); 
		$habilidades_personas->load(['id_habilidad_persona=?', $args['id']]); 
		$habilidades_personas->copyFrom('POST');
		// print_r($habilidades_personas);
		$habilidades_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@habilidades_personas');
	}
);

$f3->route('POST @habilidades_personas_create: /habilidades_personas/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); //la tabla habilidades_personas contiene la clave id_usuario
		// $habilidades_personas->load(['id_habilidad_persona=?', $args['id']]); //filtro where
		$habilidades_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades_personas);
		$habilidades_personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@habilidades_personas_read(@id='.$habilidades_personas->id_habilidad_persona.')');//return
		$f3->reroute('@habilidades_personas');//return
	}
);

$f3->route('POST @habilidades_personas_delete: /habilidades_personas/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $habilidades_personas = new DB\SQL\Mapper($db,'habilidades_personas'); //mapeo de la tabla
		$habilidades_personas->load(['id_habilidad_persona=?', $args['id']]); //filtro where
		// $habilidades_personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades_personas);
		$habilidades_personas->erase(); //elimina registro de la tabla

		$f3->reroute('@habilidades_personas');//return
	
	}
);
#endregion

#region ROLES

$f3->route(
	'GET @roles: /roles',
	function ($f3) {
		$db = getConnection();
		$roles = new DB\SQL\Mapper($db, 'roles');
		$roles->load(["id_rol>?", 0]);
		// if ($roles->dry()) {
		// 	die('No existen registros de roles.');
		// }
		$array = array();
		do {
			array_push($array, $roles->cast());
			$roles->skip();
		} while (!$roles->dry());
		$f3->set('roles', $array);

		$rows = $db->exec('SELECT est.id_estado, est.nombre_estado FROM estados est');
		$f3->set('id_estado_linelist', $rows);
		$f3->set('template', 'templates/roles.html');
		$f3->set('active_roles', 'active');
		echo View::instance()->render('home.html');
	}
);

$f3->route('GET @roles_read: /roles/read/@id', 
	function($f3, $args){
		$db = getConnection(); 
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
		echo View::instance()->render('roles.html');
	}
);

$f3->route('POST @roles_update: /roles/update/@id', 
	function($f3, $args){
		$db = getConnection();
        $roles = new DB\SQL\Mapper($db,'roles'); 
		$roles->load(['id_rol=?', $args['id']]); 
		$roles->copyFrom('POST');
		// print_r($roles);
		$roles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@roles');
	}
);

$f3->route('POST @roles_create: /roles/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $roles = new DB\SQL\Mapper($db,'roles'); //la tabla roles contiene la clave id_usuario
		// $roles->load(['id_rol=?', $args['id']]); //filtro where
		$roles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($roles);
		$roles->save(); //inserta o actualiza la tabla
		// $f3->reroute('@roles_read(@id='.$roles->id_rol.')');//return
		$f3->reroute('@roles');//return
	}
);

$f3->route('POST @roles_delete: /roles/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $roles = new DB\SQL\Mapper($db,'roles'); //mapeo de la tabla
		$roles->load(['id_rol=?', $args['id']]); //filtro where
		// $roles->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($roles);
		$roles->erase(); //elimina registro de la tabla

		$f3->reroute('@roles');//return
	
	}
);
#endregion

#region PERSONAS
$f3->route('GET @personas: /personas', 
	function($f3){
		$db = getConnection(); 
        $personas = new DB\SQL\Mapper($db,'personas'); 
		$personas->load(["id_persona>?", 0]); 
		// if($personas->dry()){
		// 	die('No existen registros de personas.');
		// }
		$array = array();
		do {
			array_push($array, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('personas', $array);

		$rows = $db->exec('SELECT usu.id_usuario, usu.email FROM usuarios usu');
		$f3->set('id_usuario_linelist',$rows);
		$f3->set('template', 'templates/personas.html');
		$f3->set('active_personas', 'active');

		echo View::instance()->render('home.html');
	}
);

$f3->route('GET @personas_read: /personas/read/@id', 
	function($f3, $args){
		$db = getConnection(); 
        $personas = new DB\SQL\Mapper($db,'personas'); 
		$personas->load(['id_persona=?', $args['id']]); 
		if($personas->dry()){
			die('No encuentra persona con id '.$args['id']);
		}
		$array = array();
		do {
			array_push($array, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());

		$f3->set('personas', $array);
		echo View::instance()->render('personas.html');
	}
);

$f3->route('POST @personas_update: /personas/update/@id', 
	function($f3, $args){
		$db = getConnection();
		$personas = new DB\SQL\Mapper($db, 'personas');
		$personas->load(['id_persona=?', $args['id']]);
		$personas->copyFrom('POST');
		$personas->save(); //inserta o actualiza la tabla
		$idUsu = $f3->get('POST.idUsuario');
		$email = $f3->get('POST.email');
		$db->exec("UPDATE `usuarios` 
					SET 
					`email` = '$email'
					WHERE `id_usuario` = $idUsu");
		$render = $f3->get('POST.render');
		$array = array();
		do {
			array_push($array, $personas->cast());
			$personas->skip();
		} while (!$personas->dry());
		$f3->set('personaUsu', $array);

		echo View::instance()->render($render . '.html');
		// $f3->reroute('@'.$render);

	}
);

$f3->route('POST @personas_create: /personas/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $personas = new DB\SQL\Mapper($db,'personas'); //la tabla personas contiene la clave id_usuario
		// $personas->load(['id_persona=?', $args['id']]); //filtro where
		$personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($personas);
		$personas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@personas_read(@id='.$personas->id_persona.')');//return
		$f3->reroute('@personas');//return
	}
);

$f3->route('POST @personas_delete: /personas/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $personas = new DB\SQL\Mapper($db,'personas'); //mapeo de la tabla
		$personas->load(['id_persona=?', $args['id']]); //filtro where
		// $personas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($personas);
		$personas->erase(); //elimina registro de la tabla

		$f3->reroute('@personas');//return
	
	}
);
#endregion

#region HABILIDADES

$f3->route('GET @habilidades: /habilidades', 
	function($f3){
		$db = getConnection(); 
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); 
		$habilidades->load(["id_habilidad>?", 0]); 
		if($habilidades->dry()){
			die('No existen registros de habilidades.');
		}
		$array = array();
		do {
			array_push($array, $habilidades->cast());
			$habilidades->skip();
		} while (!$habilidades->dry());
		$f3->set('habilidades', $array);
		echo View::instance()->render('habilidades.html');
	}
);

$f3->route('GET @habilidades_read: /habilidades/read/@id', 
	function($f3, $args){
		$db = getConnection(); 
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
);

$f3->route('POST @habilidades_update: /habilidades/update/@id', 
	function($f3, $args){
		$db = getConnection();
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); 
		$habilidades->load(['id_habilidad=?', $args['id']]); 
		$habilidades->copyFrom('POST');
		// print_r($habilidades);
		$habilidades->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@habilidades');
	}
);

$f3->route('POST @habilidades_create: /habilidades/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); //mapeo de la tabla
		// $habilidades->load(['id_habilidad=?', $args['id']]); //filtro where
		$habilidades->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades);
		$habilidades->save(); //inserta o actualiza la tabla

		// $f3->reroute('@habilidades_read(@id='.$habilidades->id_habilidad.')');//return
		$f3->reroute('@habilidades');//return
	}
);

$f3->route('POST @habilidades_delete: /habilidades/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $habilidades = new DB\SQL\Mapper($db,'habilidades'); //mapeo de la tabla
		$habilidades->load(['id_habilidad=?', $args['id']]); //filtro where
		// $habilidades->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($habilidades);
		$habilidades->erase(); //elimina registro de la tabla

		$f3->reroute('@habilidades');//return
	
	}
);

#endregion

#region OFERTAS
$f3->route('GET @ofertas: /ofertas', 
	function($f3){
		$db = getConnection(); 
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
		echo View::instance()->render('ofertas.html');
	}
);

$f3->route('GET @ofertas_read: /ofertas/read/@id', 
	function($f3, $args){
		$db = getConnection(); 
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
);

$f3->route('POST @ofertas_update: /ofertas/update/@id', 
	function($f3, $args){
		$db = getConnection();
        $ofertas = new DB\SQL\Mapper($db,'ofertas'); 
		$ofertas->load(['id_oferta=?', $args['id']]); 
		$ofertas->copyFrom('POST');
		// print_r($ofertas);
		$ofertas->save(); //inserta o actualiza la tabla
		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@ofertas');
	}
);

$f3->route('POST @ofertas_create: /ofertas/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $ofertas = new DB\SQL\Mapper($db,'ofertas'); //mapeo de la tabla
		// $ofertas->load(['id_oferta=?', $args['id']]); //filtro where
		$ofertas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas);
		$ofertas->save(); //inserta o actualiza la tabla

		// $f3->reroute('@ofertas_read(@id='.$ofertas->id_oferta.')');//return
		$f3->reroute('@ofertas');//return
	}
);

$f3->route('POST @ofertas_delete: /ofertas/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $ofertas = new DB\SQL\Mapper($db,'ofertas'); //mapeo de la tabla
		$ofertas->load(['id_oferta=?', $args['id']]); //filtro where
		// $ofertas->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($ofertas);
		$ofertas->erase(); //elimina registro de la tabla

		$f3->reroute('@ofertas');//return
	
	}
);

#endregion

#region ESTADOS

$f3->route('GET @estados: /estados', 
	function($f3){
		$db = getConnection(); //Conexion a la BBDD
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

		//'estados' se convierte en la variable del template
		$f3->set('estados', $array); //seteo de variable para usarla en el template
		$f3->set('active_estados', 'active');
		$f3->set('template', 'templates/estados.html');

		echo View::instance()->render('home.html');
	}
);

$f3->route('GET @estados_read: /estados/read/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
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
);

$f3->route('POST @estados_update: /estados/update/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		$estados->load(['id_estado=?', $args['id']]); //filtro where
		$estados->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($estados);
		$estados->save(); //inserta o actualiza la tabla

		// $f3->reroute('@estados_read(@id='.$args['id'].')');//return
		$f3->reroute('@estados');//return
	}
);

$f3->route('POST @estados_create: /estados/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		// $estados->load(['id_estado=?', $args['id']]); //filtro where
		$estados->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($estados);
		$estados->save(); //inserta o actualiza la tabla

		// $f3->reroute('@estados_read(@id='.$estados->id_estado.')');//return
		$f3->reroute('@estados');//return
	}
);

$f3->route('POST @estados_delete: /estados/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $estados = new DB\SQL\Mapper($db,'estados'); //mapeo de la tabla
		$estados->load(['id_estado=?', $args['id']]); //filtro where
		// $estados->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($estados);
		$estados->erase(); //elimina registro de la tabla

		$f3->reroute('@estados');//return
	
	}
);
#endregion

#region USUARIOS

$f3->route('GET @usuarios: /usuarios', 
	function($f3){
		$db = getConnection(); //Conexion a la BBDD
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		$usuarios->load(["id_usuario>?", 0]); //filtro where, carga toda la tabla
		if($usuarios->dry()){//¿esta la tabla vacia?
			die('No encuentran usuarios.');
		}

		//Funcion para enviar en un arreglo los datos de una tabla
		$array = array();
		do {
			array_push($array, $usuarios->cast());
			$usuarios->skip();
		} while (!$usuarios->dry());

		//'usuarios' se convierte en la variable del template
		$f3->set('usuarios', $array); //seteo de variable para usarla en el template
		echo View::instance()->render('home.html');
	}
);

$f3->route('GET @usuarios_read: /usuarios/read/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
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
);

$f3->route('POST @usuarios_update: /usuarios/update/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		$usuarios->load(['id_usuario=?', $args['id']]); //filtro where
		$usuarios->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios);
		$usuarios->save(); //inserta o actualiza la tabla

		// $f3->reroute('@usuarios_read(@id='.$args['id'].')');//return
		$f3->reroute('@usuarios');//return
	}
);

$f3->route('POST @usuarios_create: /usuarios/create', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		// $usuarios->load(['id_usuario=?', $args['id']]); //filtro where
		$usuarios->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios);
		$usuarios->save(); //inserta o actualiza la tabla

		//$f3->reroute('@usuarios_read(@id='.$usuarios->id_usuario.')');//return
		$f3->reroute('@usuarios');//return
	}
);

$f3->route('POST @usuarios_delete: /usuarios/delete/@id', 
	function($f3, $args){
		$db = getConnection(); //Conexion a la BBDD
        $usuarios = new DB\SQL\Mapper($db,'usuarios'); //mapeo de la tabla
		$usuarios->load(['id_usuario=?', $args['id']]); //filtro where
		// $usuarios->copyFrom('POST'); //toma el contenido del post y lo convierte a variables de f3
		// print_r($usuarios);

		$usuarios->erase();
		
		$f3->reroute('@usuarios');//return
	}
);

#endregion
*/
$f3->run();

/*
//Ejemplo conexion a la BBDD
function getConnection() {
	$dbh=new DB\SQL(
		'mysql:host=localhost;port=3306;dbname=talento_ti',
		'root',
		'6457'
	);
    return $dbh;
}
*/
?>