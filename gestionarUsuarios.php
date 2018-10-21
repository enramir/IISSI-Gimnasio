<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

 function alta_usuario($conn,$form_us) {
	// BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
	// 			PARA SABER CUÁLES SON SUS PARÁMETROS.
	// RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
	// RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
	// RECUERDA EL TRY/CATCH
	$comand_text = "CALL INSERTAR_PERSONA (:DNI, :NOMBRE, :APELLIDOS, :FECHADENACIMIENTO, :TELEFONO, :DIRECCION, :EMAIL)";
	$form_us["fechaNacimiento"]=date("d/m/Y",strtotime($form_us["fechaNacimiento"]));
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array($form_us["dni"],$form_us["nombre"],$form_us["apellidos"],
          	$form_us["fechaNacimiento"],$form_us["telefono"],$form_us["direccion"],$form_us["email"]));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}

 function alta_cliente($conn,$form_us) {
  // BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
  //      PARA SABER CUÁLES SON SUS PARÁMETROS.
  // RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
  // RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
  // UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
  // RECUERDA EL TRY/CATCH
  $comand_text = "CALL REGISTRAR_CLIENTE (:NICKNAME, :CUENTAPENDIENTE, :CONTRASEÑA, :DNI)";
  try{  
        $SQL=$conn->prepare($comand_text);
           $SQL->execute(array($form_us["nickname"],'NO',$form_us["contraseña"],$form_us["dni"]));
             return 0;
     } catch(PDOException $e) {
        if ($e->getCode()=="HY000") return 1; //Cliente duplicado 
        else {
         $_SESSION['excepcion'] = $e->GetMessage();
         header("Location: excepcion.php");
        }
     }
 }
  
function alta_cliente_Persona($conn,$form_us){
	$comand_text = "CALL registrar_cliente_persona(:DNI, :NOMBRE, :APELLIDOS, :FECHADENACIMIENTO, :TELEFONO, :DIRECCION, :EMAIL,:NICKNAME, :CUENTAPENDIENTE, :CONTRASEÑA)";
	$form_us["fechaNacimiento"]=date("d/m/Y",strtotime($form_us["fechaNacimiento"]));
	try{  
        $SQL=$conn->prepare($comand_text);
          $SQL->execute(array($form_us["dni"],$form_us["nombre"],$form_us["apellidos"],
          $form_us["fechaNacimiento"],$form_us["telefono"],$form_us["direccion"],
          $form_us["email"],$form_us["nickname"],'NO',$form_us["contraseña"]));
            return 0;
    } catch(PDOException $e) {
    	 if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
    	 else {
    	 	$_SESSION['excepcion'] = $e->GetMessage();
		    header("Location: excepcion.php");
    	 }
    } 
}


// ESTA FUNCIÓN SE EDITA EN LA SEGUNDA PARTE DE LA PRÁCTICA
function consultarCliente($conn,$nickname,$contraseña) {
	// SENTENCIA SELECT PARA CONTAR CUANTOS USUARIOS HAY
	// 		CON DICHO EMAIL Y PASS
	// UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO 
	// RETORNE EL RESULTADO DEL MÉTODO "FETCHCOLUMN"
 	$SQL="SELECT nickname FROM clientes
    WHERE UPPER(nickname)=UPPER('$nickname')
    AND UPPER (contraseña)=UPPER('$contraseña')";
    try{  
        $stmt=$conn->query($SQL);
        return $stmt->fetch()["NICKNAME"];
    } catch(PDOException $e) {
        if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
        else {
            $_SESSION['excepcion'] = $e->GetMessage();
            header("Location: excepcion.php");
         }
    }
}

function consultarAdministrador($conn,$dni) {
  // SENTENCIA SELECT PARA CONTAR CUANTOS USUARIOS HAY
  //    CON DICHO EMAIL Y PASS
  // UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO 
  // RETORNE EL RESULTADO DEL MÉTODO "FETCHCOLUMN"
  $SQL="SELECT dni FROM TRABAJADORES
    WHERE UPPER(dni)=UPPER('$dni')";
    try{  
        $stmt=$conn->query($SQL);
        return $stmt->fetch()["DNI"];
    } catch(PDOException $e) {
        if ($e->getCode()=="HY000") return 1; //Usuario duplicado 
        else {
            $_SESSION['excepcion'] = $e->GetMessage();
            header("Location: excepcion.php");
         }
    }
}

?>