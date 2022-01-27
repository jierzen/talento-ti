(function($) {
  var formatear= function(Rut, digitoVerificador) {
    var sRut = new String(Rut);
    var sRutFormateado = '';
    sRut = quitarFormato(sRut);
    if (digitoVerificador) {
      var sDV = sRut.charAt(sRut.length - 1);
      sRut = sRut.substring(0, sRut.length - 1);
    }
    while (sRut.length > 3) {
      sRutFormateado = "." + sRut.substr(sRut.length - 3) + sRutFormateado;
      sRut = sRut.substring(0, sRut.length - 3);
    }
    sRutFormateado = sRut + sRutFormateado;
    if (sRutFormateado != "" && digitoVerificador) {
      sRutFormateado += "-" + sDV;
    } else if (digitoVerificador) {
      sRutFormateado += sDV;
    }
    return sRutFormateado;
  };

  var quitarFormato= function(rut) {
    var strRut = new String(rut);
    while (strRut.indexOf(".") != -1) {
      strRut = strRut.replace(".", "");
    }
    while (strRut.indexOf("-") != -1) {
      strRut = strRut.replace("-", "");
    }
    return strRut;
  };
  var digitoValido= function(dv) {
    if (dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k' && dv != 'K') {
      return false;
    }
    return true;
  };
  var digitoCorrecto= function(crut) {
    largo = crut.length;
    if (largo < 2) {
      return false;
    }
    if (largo > 2) {
      rut = crut.substring(0, largo - 1);
    } else {
      rut = crut.charAt(0);
    }
    dv = crut.charAt(largo - 1);
    digitoValido(dv);
    if (rut == null || dv == null) {
      return 0;
    }
    dvr = getDigito(rut);
    if (dvr != dv.toLowerCase()) {
      return false;
    }
    return true;
  };
  var getDigito= function(rut) {
    var dvr = '0';
    suma = 0;
    mul = 2;
    for (i = rut.length - 1; i >= 0; i--) {
      suma = suma + rut.charAt(i) * mul;
      if (mul == 7) {
        mul = 2;
      } else {
        mul++;
      }
    }
    res = suma % 11;
    if (res == 1) {
      return 'k';
    } else if (res == 0) {
      return '0';
    } else {
      return 11 - res;
    }
  };
  var validar= function(texto) {
    texto = quitarFormato(texto);
    largo = texto.length;
    if (largo < 2) {
      return false;
    }
    for (i = 0; i < largo; i++) {
      if (!digitoValido(texto.charAt(i))) {
        return false;
      }
    }
    var invertido = "";
    for (i = (largo - 1), j = 0; i >= 0; i--, j++) {
      invertido = invertido + texto.charAt(i);
    }
    var dtexto = "";
    dtexto = dtexto + invertido.charAt(0);
    dtexto = dtexto + '-';
    cnt = 0;
    for (i = 1, j = 2; i < largo; i++, j++) {
      if (cnt == 3) {
        dtexto = dtexto + '.';
        j++;
        dtexto = dtexto + invertido.charAt(i);
        cnt = 1;
      } else {
        dtexto = dtexto + invertido.charAt(i);
        cnt++;
      }
    }
    invertido = "";
    for (i = (dtexto.length - 1), j = 0; i >= 0; i--, j++) {
      invertido = invertido + dtexto.charAt(i);
    }
    if (digitoCorrecto(texto)) {
      return true;
    }
    return false;
  };

  jQuery.validator.addMethod("rut", function(value, element) {return this.optional(element) || validar(value) }, "Ingresa un RUT válido.");

})(jQuery);
