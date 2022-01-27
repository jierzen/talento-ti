(function($){"use strict";var fullHeight=function(){$('.js-fullheight').css('height',$(window).height());$(window).resize(function(){$('.js-fullheight').css('height',$(window).height());});};fullHeight();$('#sidebarCollapse').on('click',function(){$('#sidebar').toggleClass('active');});})(jQuery);

$(function () {
  $('[data-toggle="popover"]').popover()
})

$(function () {

  $('#busca-habilidades').keyup(function () {
    var that = this, $allListElements = $('#habilidades > li');
    var $matchingListElements = $allListElements.filter(function (i, li) {
      var listItemText = $(li).text().toUpperCase(), searchText = that.value.toUpperCase();
      return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
  });

  $('.busca-tabla').keyup(function () {
    var that = this, $allListElements = $('.tabla-busca tbody > tr');
    var $matchingListElements = $allListElements.filter(function (i, tr) {
      var listItemText = $(tr).text().toUpperCase(), searchText = that.value.toUpperCase();
      return ~listItemText.indexOf(searchText);
    });
    $allListElements.hide();
    $matchingListElements.show();
  });
});


$(document).ready(function () {
  $('.dataTable').DataTable({
    language: {
      "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es-cl.json"
    }
  });
});
// $(document).ready(function () {
//   $('.dataTable').DataTable({
//     "language": {
//       "lengthMenu": "Mostrar _MENU_ registros por página",
//       "zeroRecords": "No se encontraron registros",
//       "info": "Mostrando página _PAGE_ de _PAGES_",
//       "infoEmpty": "No hay registros disponibles",
//       "search": "Buscar:",
//       "paginate": {
//         "first": "Primero",
//         "last": "Último",
//         "next": "Siguiente",
//         "previous": "Anterior"
//       },
//       "infoFiltered": "(filtrado de _MAX_ registros totales)"
//     }
//   });
// });


// $(document).ready(function () {
//     $('#table_usuarios').DataTable({
//     });
// });
$("#editUser").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre = triggerLink.data("nombre");
  var email = triggerLink.data("email");
  var password = triggerLink.data("password");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_usuarios').attr('action', "usuarios/update/" + id);
  $('#form_edit_usuarios input[name=email]').val(email);
  $('#form_edit_usuarios input[name=password]').val(password);
});
$("#deleteUser").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var email = triggerLink.data("email");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_usuarios').attr('action', "usuarios/delete/" + id);
  $('#modal-delete-email').text(email);
});
$("#editUserRol").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var id_usuario = triggerLink.data("id-usuario");
  var id_rol = triggerLink.data("id-rol");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_usuarios_rol').attr('action', "usuarios_roles/update/" + id);
  $('#form_edit_usuarios_rol #id_usuario').val(id_usuario).change();
  $('#form_edit_usuarios_rol #id_rol').val(id_rol).change();
});
$("#deleteUserRol").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_usuario = triggerLink.data("nombre-usuario");
  var nombre_rol = triggerLink.data("nombre-rol");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_usuarios').attr('action', "usuarios/delete/" + id);
  $('#modal-delete-nombre-usuario').text(nombre_usuario);
  $('#modal-delete-nombre-rol').text(nombre_rol);
});
$("#editRol").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_rol = triggerLink.data("nombre-rol");
  var id_estado = triggerLink.data("id-estado");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_roles').attr('action', "roles/update/" + id);
  $('#form_edit_roles input[name=nombre_rol]').val(nombre_rol);
  $('#form_edit_roles #id_estado').val(id_estado).change();
});
$("#deleteRol").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_rol = triggerLink.data("nombre-rol");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_roles').attr('action', "roles/delete/" + id);
  $('#modal-delete-nombre-rol').text(nombre_rol);
});
$("#editPerfil").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var titulo_prof = triggerLink.data("titulo-prof");
  var resumen = triggerLink.data("resumen");
  var plazo_proyecto = triggerLink.data("plazo-proyecto");
  var disponibilidad = triggerLink.data("disponibilidad");
  var url_cv = triggerLink.data("url-cv");
  var id_persona = triggerLink.data("id-persona");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_perfiles').attr('action', "roles/update/" + id);
  $('#form_edit_perfiles input[name=titulo_prof]').val(titulo_prof);
  $('#form_edit_perfiles input[name=url_cv]').val(url_cv);
  $('#form_edit_perfiles input[name=disponibilidad]').val(disponibilidad);
  $('#form_edit_perfiles input[name=plazo_proyecto]').val(plazo_proyecto);
  $('#form_edit_perfiles textarea[name=resumen]').val(resumen);
  $('#form_edit_perfiles #id_persona').val(id_persona).change();
});
$("#deletePerfil").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var titulo_prof = triggerLink.data("titulo-prof");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_perfiles').attr('action', "perfiles/delete/" + id);
  $('#modal-delete-titulo-prof').text(titulo_prof);
});
$("#editPersona").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_razonsocial = triggerLink.data("nombre-razonsocial");
  var apellidos = triggerLink.data("apellidos");
  var direccion = triggerLink.data("direccion");
  var rut = triggerLink.data("rut");
  var comuna = triggerLink.data("comuna");
  var pais = triggerLink.data("pais");
  var region = triggerLink.data("region");
  var ciudad = triggerLink.data("ciudad");
  var telefono = triggerLink.data("telefono");
  var email = triggerLink.data("email");
  var id_tipo_persona = triggerLink.data("id-tipo-persona");
  var id_usuario = triggerLink.data("id-usuario");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_personas').attr('action', "personas/update/" + id);
  $('#form_edit_personas input[name=nombre_razonsocial]').val(nombre_razonsocial);
  $('#form_edit_personas input[name=email]').val(email);
  $('#form_edit_personas input[name=telefono]').val(telefono);
  $('#form_edit_personas input[name=ciudad]').val(ciudad);
  $('#form_edit_personas input[name=region]').val(region);
  $('#form_edit_personas input[name=pais]').val(pais);
  $('#form_edit_personas input[name=comuna]').val(comuna);
  $('#form_edit_personas input[name=rut]').val(rut);
  $('#form_edit_personas input[name=direccion]').val(direccion);
  $('#form_edit_personas input[name=apellidos]').val(apellidos);
  $('#form_edit_personas #id_usuario').val(id_usuario).change();
  $('#form_edit_personas #id_tipo_persona').val(id_tipo_persona).change();
});
$("#deletePersona").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_razonsocial = triggerLink.data("nombre-razonsocial");
  var apellidos = triggerLink.data("apellidos");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_personas').attr('action', "personas/delete/" + id);
  $('#modal-delete-apellidos').text(apellidos);
  $('#modal-delete-nombre-razonsocial').text(nombre_razonsocial);
});
$("#editEstado").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_estado = triggerLink.data("nombre-estado");
  var tabla = triggerLink.data("tabla");
  var descripcion_estado = triggerLink.data("descripcion-estado");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_estados').attr('action', "estados/update/" + id);
  $('#form_edit_estados #tabla').val(tabla).change();
  $('#form_edit_estados input[name=nombre_estado]').val(nombre_estado);
  $('#form_edit_estados input[name=descripcion_estado]').val(descripcion_estado);
});
$("#deleteEstado").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_estado = triggerLink.data("nombre-estado");
  var tabla = triggerLink.data("tabla");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_estados').attr('action', "estados/delete/" + id);
  $('#modal-delete-nombre-estado').text(nombre_estado);
  $('#modal-delete-tabla').text(tabla);
});
$("#editHabilidad").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_habilidad = triggerLink.data("nombre-habilidad");
  var grupo = triggerLink.data("grupo");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_habilidades').attr('action', "habilidades/update/" + id);
  $('#form_edit_habilidades input[name=nombre_habilidad]').val(nombre_habilidad);
  $('#form_edit_habilidades input[name=grupo]').val(grupo);
});
$("#deleteHabilidad").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_habilidad = triggerLink.data("nombre-habilidad");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_habilidades').attr('action', "habilidades/delete/" + id);
  $('#modal-delete-nombre-habilidad').text(nombre_habilidad);
});

$("#editHabilidadPersona").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var id_persona = triggerLink.data("id-persona");
  var id_habilidad = triggerLink.data("id-habilidad");
  var nivel = triggerLink.data("nivel");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_edit_habilidades_personas').attr('action', "habilidades_personas/update/" + id);
  $('#form_edit_habilidades_personas #id_persona').val(id_persona).change();
  $('#form_edit_habilidades_personas #id_habilidad').val(id_habilidad).change();
  $('#form_edit_habilidades_personas #nivel').val(nivel).change();
});
$("#deleteHabilidadPersona").on('show.bs.modal', function (e) {
  var triggerLink = $(e.relatedTarget);
  var id = triggerLink.data("id");
  var nombre_habilidad = triggerLink.data("nombre-habilidad");

  // $(this).find(".modal-body").html("<h5>id: "+id+"</h5><img src='"+cover_small+"'/>");
  $('#form_delete_habilidades_personas').attr('action', "habilidades_personas/delete/" + id);
  $('#modal-delete-nombre-habilidad').text(nombre_habilidad);
});
$(function(){

 $('#busca-habilidades').keyup(function(){
   var that = this, $allListElements = $('#habilidades > li');
  var $matchingListElements = $allListElements.filter(function(i, li){
      var listItemText = $(li).text().toUpperCase(), searchText = that.value.toUpperCase();
      return ~listItemText.indexOf(searchText);
  });
  $allListElements.hide();
  $matchingListElements.show();
 });

 $('.busca-tabla').keyup(function(){
   var that = this, $allListElements = $('.tabla-busca tbody > tr');
  var $matchingListElements = $allListElements.filter(function(i, tr){
      var listItemText = $(tr).text().toUpperCase(), searchText = that.value.toUpperCase();
      return ~listItemText.indexOf(searchText);
  });
  $allListElements.hide();
  $matchingListElements.show();
 });
});


$(document).ready(function() {
    $('.dataTable').DataTable();
} );

function idOferta() {
  boton = document.getElementById("btnSolicitarOferta");
  boton.click();
}

function funcionRequiredCheckBoxGroup(){
  if($('div.checkbox-group.required :checkbox:checked').length > 0){
      boton = document.getElementById("crearOferta");
      boton.click();
  }
}

function filtrarHabilidad() {
  // Declare variables
  var input, filter, ul, li, button, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    button = li[i].getElementsByTagName("button")[0];
    txtValue = button.textContent || button.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}


function validaMismoCorreo(){
  //obtengo por id el valor del input "email" para validar el del input "repeatEmail"
  correo = document.getElementById('email');
  correoValidar = document.getElementById('repeatEmail');

  //obtengo por id los simbolos de check: "correoMal" y "correoBien"
  mal = document.getElementById('correoMal');
  bien = document.getElementById('correoBien');

  if(correo.value.length > 0 && correo.value == correoValidar.value){
    mal.style.display = "none";
    bien.style.display = "inline-block";

    mal.style.visibility = "hidden";
    bien.style.visibility = "visible";
    
  }else{
    bien.style.display = "none";
    mal.style.display = "inline-block";

    mal.style.visibility = "visible";
    bien.style.visibility = "hidden";
    
  }
}
  
function validarCorreo(){
  correo = document.getElementById('email');
  correoValidar = document.getElementById('repeatEmail');

  if(correo.value == correoValidar.value){
    return true;
    
  }else{
    return false;
    
  }

}

var RegionesYcomunas = {

  "regiones": 
  [
      {
          "NombreRegion": "Arica y Parinacota",
          "comunas": ["Arica", "Camarones", "Putre", "General Lagos"]
      },
      {
          "NombreRegion": "Tarapacá",
          "comunas": ["Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica"]
      },
      {
          "NombreRegion": "Antofagasta",
          "comunas": ["Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama", "Tocopilla", "María Elena"]
      },
      {
          "NombreRegion": "Atacama",
          "comunas": ["Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco"]
      },
      {
          "NombreRegion": "Coquimbo",
          "comunas": ["La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado"]
      },
      {
          "NombreRegion": "Valparaíso",
          "comunas": ["Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana"]
      },
      {
          "NombreRegion": "Región del Libertador Gral. Bernardo O’Higgins",
          "comunas": ["Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"]
      },
      {
          "NombreRegion": "Región del Maule",
          "comunas": ["Talca", "ConsVtución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "ReVro", "San Javier", "Villa Alegre", "Yerbas Buenas"]
      },
      {
          "NombreRegion": "Región del Biobío",
          "comunas": ["Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Chillán", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chillán Viejo", "El Carmen", "Ninhue", "Ñiquén", "Pemuco", "Pinto", "Portezuelo", "Quillón", "Quirihue", "Ránquil", "San Carlos", "San Fabián", "San Ignacio", "San Nicolás", "Treguaco", "Yungay"]
      },
      {
          "NombreRegion": "Región de la Araucanía",
          "comunas": ["Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria", ]
      },
      {
          "NombreRegion": "Región de Los Ríos",
          "comunas": ["Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno"]
      },
      {
          "NombreRegion": "Región de Los Lagos",
          "comunas": ["Puerto Montt", "Calbuco", "Cochamó", "Fresia", "FruVllar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena"]
      },
      {
          "NombreRegion": "Región Aisén del Gral. Carlos Ibáñez del Campo",
          "comunas": ["Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez"]
      },
      {
          "NombreRegion": "Región de Magallanes y la Antártica Chilena",
          "comunas": ["Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "AntárVca", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"]
      },
      {
          "NombreRegion": "Región Metropolitana de Santiago",
          "comunas": ["Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "Til Til", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor"]
      }
  ]
}


jQuery(document).ready(function() {

  var iRegion = 0;
  var htmlRegion = '<option value="sin-region">Seleccione región</option><option value="sin-region">--</option>';
  var htmlComunas = '<option value="sin-region">Seleccione comuna</option><option value="sin-region">--</option>';

  jQuery.each(RegionesYcomunas.regiones, function() {
      htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
      iRegion++;
  });

  jQuery('#regiones').html(htmlRegion);
  jQuery('#comunas').html(htmlComunas);

  jQuery('#regiones').change(function() {
      var iRegiones = 0;
      var valorRegion = jQuery(this).val();
      var htmlComuna = '<option value="sin-comuna">Seleccione comuna</option><option value="sin-comuna">--</option>';
      jQuery.each(RegionesYcomunas.regiones, function() {
          if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
              var iComunas = 0;
              jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function() {
                  htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
                  iComunas++;
              });
          }
          iRegiones++;
      });
      jQuery('#comunas').html(htmlComuna);
  });
  jQuery('#comunas').change(function() {
      if (jQuery(this).val() == 'sin-region') {
          alert('selecciones Región');
      } else if (jQuery(this).val() == 'sin-comuna') {
          alert('selecciones Comuna');
      }
  });
  jQuery('#regiones').change(function() {
      if (jQuery(this).val() == 'sin-region') {
          alert('selecciones Región');
      }
  });

});


function validaMismoCorreo(){
  //obtengo por id el valor del input "email" para validar el del input "repeatEmail"
  correo = document.getElementById('email');
  correoValidar = document.getElementById('repeatEmail');

  //obtengo por id los simbolos de check: "correoMal" y "correoBien"
  mal = document.getElementById('correoMal');
  bien = document.getElementById('correoBien');

  if(correo.value == correoValidar.value){
    mal.style.display = "none";
    bien.style.display = "inline-block";

    mal.style.visibility = "hidden";
    bien.style.visibility = "visible";
    
  }else{
    bien.style.display = "none";
    mal.style.display = "inline-block";

    mal.style.visibility = "visible";
    bien.style.visibility = "hidden";
    
  }
}
  
function validarCorreo(){
  correo = document.getElementById('email');
  correoValidar = document.getElementById('repeatEmail');

  if(correo.value == correoValidar.value){
    return true;
    
  }else{
    return false;
    
  }

}

$(document).ready(function (e) {
  'use strict';
  $("form").each(function () {
      $(this).validate({
          submitHandler: function (form) {
              form.submit();
          }
      });

  });
  $('input[name="rut"]').rules('add', {
    rut: true
  });
});
