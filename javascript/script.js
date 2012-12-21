function validar(formulario) {
  	var letrasvalidas = "ABCDEFGHIJKLMN—OPQRSTUVWXYZ¡…Õ”⁄" + "abcdefghijklmnÒopqrstuvwxyz·ÈÌÛ˙ " + "1234567890";
  	var campo = formulario.id.value;
	var password = formulario.pwd.value;
  	var todovalido = true;
	
  	if (campo.length < 4) {
		alert("El campo del identificador debe ser tener al menos 4 caracteres.");
		formulario.id.focus();
		return (false);
  	}


  	for (i = 0; i < campo.length; i++) {
    		ch = campo.charAt(i);
    		for (j = 0; j < letrasvalidas.length; j++)
      			if (ch == letrasvalidas.charAt(j))
        		break;
    		if (j == letrasvalidas.length) {
      			todovalido = false;
      			break;
    		}
  	}

  if (todovalido == false) {
    alert("Escriba sÛlo letras o n˙meros en el campo de identificaciÛn.");
    formulario.id.focus();
    return (false);
  }
  
  if (password.length == 0){
    alert("Introduzca la contraseÒa.");
    formulario.id.focus();
    return (false);
  }	

registrardatos(formulario);
return (true);	

}



function registro(formulario) {

	var letrasvalidas = "ABCDEFGHIJKLMN—OPQRSTUVWXYZ¡…Õ”⁄" + "abcdefghijklmnÒopqrstuvwxyz·ÈÌÛ˙ ";
  	var campo = formulario.nom.value;
	var todovalido = true;	

	if (campo.length == 0) {
		alert("Introduzca su nombre.");
		formulario.nom.focus();
    		return (false);
	}
	
  	for (i = 0; i < campo.length; i++) {
    		ch = campo.charAt(i);
    		for (j = 0; j < letrasvalidas.length; j++)
      			if (ch == letrasvalidas.charAt(j))
        		break;
    		if (j == letrasvalidas.length) {
      			todovalido = false;
      			break;
    		}
  	}

  if (todovalido == false) {
    alert("Escriba sÛlo letras en el campo Nombre.");
    formulario.nom.focus();
    return (false);
  }

	campo = formulario.ape.value;

	if (campo.length == 0) {
		alert("Introduzca sus apellidos.");
		formulario.ape.focus();
    		return (false);
	}
	
  	for (i = 0; i < campo.length; i++) {
    		ch = campo.charAt(i);
    		for (j = 0; j < letrasvalidas.length; j++)
      			if (ch == letrasvalidas.charAt(j))
        		break;
    		if (j == letrasvalidas.length) {
      			todovalido = false;
      			break;
    		}
  	}

  if (todovalido == false) {
    alert("Escriba sÛlo letras en el campo Apellidos.");
    formulario.ape.focus();
    return (false);
  }

	campo = formulario.dni.value;

	if (campo.length == 0 || campo.length < 9 || campo.length > 9) {
		alert("Introduzca un dni de 9 caracteres. Ej: XXXXXXXXL");
		formulario.dni.focus();
    		return (false);
	}

	var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
 
	if( !(/^\d{8}[A-Z]$/.test(campo)) ) {
		alert("Introduzca un dni v·lido de 9 caracteres. Ej: XXXXXXXXL");
		formulario.dni.focus();
    		return (false);		
	}
 
	if(campo.charAt(8) != letras[(campo.substring(0, 8))%23]) {
		alert("Letra de DNI incorrecta");
		formulario.dni.focus();
    		return (false);
	}


	campo = formulario.dir.value;

	if (campo.length == 0) {
		alert("Introduzca su domicilio.");
		formulario.dir.focus();
    		return (false);
	}

	campo = formulario.cod.value;
	var er_cp = /(^([0-9]{5,5})|^)$/;

	if (campo.length == 0) {
		alert("Introduzca el codigo postal.");
		formulario.cod.focus();
    		return (false);
	}

    	if(!er_cp.test(campo)) {   
		alert("Introduzca un codigo postal correcto.");
		formulario.cod.focus();
    		return (false);  
     	}   
	

	campo = formulario.email.value;
	if (campo.length != 0){
	

		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(campo))){

			alert("La direcciÛn de email es incorrecta.");
			formulario.email.focus();
    			return (false);

		}
	

	}

	
	letrasvalidas = "ABCDEFGHIJKLMN—OPQRSTUVWXYZ¡…Õ”⁄" + "abcdefghijklmnÒopqrstuvwxyz·ÈÌÛ˙ " + "1234567890";
  	campo = formulario.login.value;
	var password = formulario.pass.value;
	
  	if (campo.length < 4) {
		alert("El campo login debe ser tener al menos 4 caracteres.");
		formulario.login.focus();
		return (false);
  	}


  	for (i = 0; i < campo.length; i++) {
    		ch = campo.charAt(i);
    		for (j = 0; j < letrasvalidas.length; j++)
      			if (ch == letrasvalidas.charAt(j))
        		break;
    		if (j == letrasvalidas.length) {
      			todovalido = false;
      			break;
    		}
  	}

  	if (todovalido == false) {
    		alert("Escriba sÛlo letras o n˙meros en el campo login.");
    		formulario.login.focus();
    		return (false);
  	}
  
  	if (password.length == 0){
    		alert("Introduzca la contraseÒa.");
    		formulario.pass.focus();
    		return (false);
  	}

  	for (i = 0; i < password.length; i++) {
    		ch = campo.charAt(i);
    		for (j = 0; j < letrasvalidas.length; j++)
      			if (ch == letrasvalidas.charAt(j))
        		break;
    		if (j == letrasvalidas.length) {
      			todovalido = false;
      			break;
    		}
  	}

  	if (todovalido == false) {
    		alert("Escriba sÛlo letras o n˙meros en el campo contraseÒa.");
    		formulario.pass.focus();
    		return (false);
  	}

	password2 = formulario.pass2.value;
	
	if (password != password2) {
		alert("Las contraseÒas no coinciden, por favor repita las contraseÒas.");
		formulario.pass2.focus();
    		return (false);
	}

	
	
	


return (true);

}


function esnumerico(formulario) {



 	var campo = formulario.nom.value;

	if (campo.length == 0){
		alert("Escriba un nombre para el nuevo producto.");
		formulario.nom.focus();
    		return (false);

	}
	
	campo = formulario.precio.value;
	
    	if (campo.length == 0){
		alert("Establezca un precio para el nuevo producto.");
		formulario.precio.focus();
    		return (false);

	}
	

	if (isNaN(campo)) {
		alert("Introduzca un valor numÈrico en el campo precio.");
		formulario.precio.focus();
    		return (false);
	
	}

return (true);

}