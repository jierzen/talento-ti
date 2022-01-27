INSERT INTO `estados`(`id_estado`, `nombre_estado`, `descripcion_estado`, `tabla`) VALUES 
(1,'Activo','Usuario activo','usuarios'),
(2,'Inactivo','Usuario inactivo','usuarios'),
(3,'Activo','Rol activo','roles'),
(4,'Inactivo','Rol inactivo','roles'),
(5,'Pendiente','Solicitud pendiente','solicitudes'),
(6,'Suspendido','Solicitud suspendida','solicitudes'),
(7,'Finalizado','Solicitud finalizada','solicitudes'),
(8,'Activo','Oferta activa','ofertas_personas'),
(9,'Inactivo','Oferta inactiva','ofertas_personas'),
(10,'Activo','Tipo Persona activa','tipos_personas'),
(11,'Inactivo','Tipo Persona inactiva','tipos_personas');

INSERT INTO `tipos_personas`(`id_tipo_persona`, `descripcion_tipo`, `id_estado`) VALUES 
(1,'Administrador',10),
(2,'Empresa',10),
(3,'Profesional',10);

INSERT INTO `roles`(`id_rol`, `nombre_rol`, `id_estado`) VALUES 
(1,'Supervisor',1),
(2,'Usuario regular',1);

INSERT INTO `usuarios`(`id_usuario`, `email`, `password`) VALUES 
(1,'admin@k7.cl','admin'), 
(2,'empresa@test.cl','123'), 
(3,'profesional@test.cl','123');

INSERT INTO `usuarios_roles`(`id_usuario_rol`, `id_usuario`, `id_rol`) VALUES 
(1,1,1),
(2,2,2),
(3,3,2);

INSERT INTO `personas`(`id_persona`, `nombre_razonsocial`, `apellidos`, `id_usuario`, `rut`, `direccion`, `comuna`, `ciudad`, `region`, `pais`, `telefono`, `email`, `id_tipo_persona`, `sitio_web`, `giro`, `fecha_ingreso`) VALUES 
(1,'admin','admin',1,'11.111.111-1','Pasaje Las Torres 1130','Estación Central','Santiago','Región Metropolitana de Santiago','Chile','+56900000000','admin@k7.cl',1,'www.google.cl','adminGiro','2021-12-01 23:59:59'),
(2,'Empresa','Test',2,'79.999.999-9','Camino Amarillo 5698 piso 4 of 507','Huechuraba','Santiago','Región Metropolitana de Santiago','Chile','+56911111111','empresa@test.cl',2,'www.empresa.cl','empresaGiro','2021-12-01 23:59:59'),
(3,'Profesional','Test',3,'20.555.666-1','Las Amapolas 236','Independencia','Santiago','Región Metropolitana de Santiago','Chile','+56955556666','profesional@test.cl',3,'www.prof.cl','profesionalGiro','2021-12-01 23:59:59');

INSERT INTO `habilidades`(`id_habilidad`, `nombre_habilidad`, `grupo`, `descripcion_habilidad`) VALUES 
(1,'C#','lenguaje de programacion', 'leguaje de programacion en C#'),
(2,'Java','lenguaje de programacion', 'leguaje de programacion en Java'),
(3,'Python','lenguaje de programacion', 'leguaje de programacion en Python'),
(4,'PHP','lenguaje de programacion', 'leguaje de programacion en PHP'),
(5,'SQL','lenguaje de programacion', 'leguaje de programacion en SQL'),
(6,'Ruby','lenguaje de programacion', 'leguaje de programacion en Ruby'),
(7,'Visual Basic. NET','lenguaje de programacion', 'leguaje de programacion en Visual Basic. NET'),
(8,'R','lenguaje de programacion', 'leguaje de programacion en R'),
(9,'HTML','lenguaje de programacion', 'leguaje de programacion en HTML'),
(10,'Swift','lenguaje de programacion', 'leguaje de programacion en Swift'),
(11,'Rust','lenguaje de programacion', 'leguaje de programacion en Rust'),
(12,'Go','lenguaje de programacion', 'leguaje de programacion en Go'),
(13,'Kotlin','lenguaje de programacion', 'leguaje de programacion en Kotlin'),
(14,'Postscript','lenguaje de programacion', 'leguaje de programacion en Postscript'),
(15,'Scheme','lenguaje de programacion', 'leguaje de programacion en Scheme'),
(16,'Erlang','lenguaje de programacion', 'leguaje de programacion en Erlang'),
(17,'Elixir','lenguaje de programacion', 'leguaje de programacion en Elixir'),
(18,'Pascal','lenguaje de programacion', 'leguaje de programacion en Pascal'),
(19,'Scala','lenguaje de programacion', 'leguaje de programacion en Scala'),
(20,'Objective-C','lenguaje de programacion', 'leguaje de programacion en Objective-C');

INSERT INTO `habilidades_personas`(`id_habilidad_persona`, `id_persona`, `id_habilidad`, `nivel`) VALUES 
(1,3,9,1),
(2,3,6,2),
(3,3,5,1),
(4,3,4,1),
(5,3,3,5),
(6,3,2,1),
(7,3,1,5);

INSERT INTO `perfiles`(`id_perfil`, `titulo_prof`, `resumen`, `url_cv`, `disponibilidad`, `id_persona`, `plazo_proyecto`,`modalidad`,`portafolio`) VALUES 
(1,'Ingeniero en Informatica','Profesional de las tecnologias de la informacion','F:/cv/test.pdf','Inmediata',3,'Plazo test','Remoto','F:/portafolio/portafolio.zip');

INSERT INTO `ofertas`(`id_oferta`, `nombre_oferta`, `descripcion`, `fecha_oferta`, `comentarios`, `url_documento`, `id_proyecto`, `tipo_proyecto`,`fecha_termino`) VALUES 
(1,'Se busca Desarrollador en C#, SQL y HTML+PHP','Se necesita ingeniero en informatica con 1 año de experiencia en C# y otros lenguajes de programacion asociados','2021-12-31 23:59:59','Sin comentarios','F:/doc/oferta_test1-pdf','id proyecto','Desarrollo Web','2022-01-31 23:59:59'),
(2,'Se busca Programador MVC JavaSE Spring Boot, SQL y HTML+php','Se busca tecnico o ingeniero en informatica con mas de 2 años de experiencia trabajando con MVC ojala en SpringBoot y asociados','2021-12-24 23:59:59','Sin comentarios','F:/doc/oferta_test2-pdf','id proyecto','Desarrollo Web','2022-01-24 23:59:59'),
(3,'Se busca Programador Android MVC, Kotlin, SQL, PHP','Se busca entusiasta ingeniero en informatica con s sin experiencia en area Desarrollo Kotlin Android MVC que sea proactivo','2021-12-17 14:56:22','Sin comentarios','F:/doc/oferta_test3-pdf','id proyecto','Desarrollo Aplicaciones','2022-01-17 14:56:22');

INSERT INTO `ofertas_personas`(`id_oferta_persona`, `id_persona`, `id_oferta`, `id_estado`) VALUES 
(1,2,1,8),
(2,2,2,8),
(3,2,3,8);

INSERT INTO `ofertas_habilidades`(`id_oferta_habilidad`, `id_oferta`, `id_habilidad`, `nivel`) VALUES
(1,1,1,1),
(2,1,4,1),
(3,1,5,1),
(4,1,9,1),
(5,2,2,1),
(6,2,4,1),
(7,2,5,1),
(8,2,9,1),
(9,3,4,1),
(10,3,5,1),
(11,3,13,1);

INSERT INTO `solicitudes`(`id_solicitud`, `id_oferta`, `id_persona_prof`, `id_persona_emp`, `id_estado`, `fecha_solicitud`) VALUES 
(1,2,3,2,5,'2021-12-29 12:00:00');