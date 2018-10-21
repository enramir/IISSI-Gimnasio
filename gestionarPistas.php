<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de libros de la capa de acceso a datos 		
     * #==========================================================#
     */

  
function alta_pistas($conn,$form_us) {
  // BUSCA LA OPERACIÓN ALMACENADA "INSERTAR_USUARIO" EN SQL
  //      PARA SABER CUÁLES SON SUS PARÁMETROS.
  // RECUERDA QUE SE INVOCA MEDIANTE 'CALL' EN PL/SQL
  // RECUERDA QUE EL FORMATO DE FECHA PARA ORACLE ES "d/m/Y"
  // UTILIZA EL MÉTODO "PREPARE" DEL OBJETO PDO
  // RECUERDA EL TRY/CATCH
  $comand_text = "CALL INSERTAR_PISTA(:NUMERO_PISTA, :PISTA, :PRECIO)";
  try{  
        $SQL=$conn->prepare($comand_text);
           $SQL->execute(array($form_us["numpista"],$form_us["pista"],$form_us["precio"]));
             return 0;
     } catch(PDOException $e) {
        if ($e->getCode()=="HY000") return 1; //Cliente duplicado 
        else {
         $_SESSION['excepcion'] = $e->GetMessage();
         header("Location: excepcion.php");
        }
     }
 }

?>