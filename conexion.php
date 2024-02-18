

<?php


$host="127.0.0.1"; 
$basedatos="servicio";
$user="root";
$pass="";
$puerto="3306";

//try catch para saber si hay algun error
try{
    
    $bd = new PDO(
        "mysql:host=".$host.";dbname=".$basedatos.";port=".$puerto, $user, $pass);
    
    //atributo para arrojar errores
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // datos con acentos permitidos osea caracteres especiales
     $bd->exec("set names utf8");

    //echo "conexion lista";

}catch(PDOException $e){
    
echo "<br>Ocurrio un error: -> ".$e->getMessage();
    
}//catch

?>