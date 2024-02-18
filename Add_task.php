<?php
date_default_timezone_set('America/Mexico_City');
$created_at = date("d-m-Y h:i:s");
header('Content-Type: application/json; charset=utf-8');
$jsons = file_get_contents('php://input');
$jsons = json_decode($jsons,true);
#echo print_r($jsons);
$w_order = $jsons[0]['w_order'];
include("conexion.php");
$station= "SELECT s.position 
    FROM truck_order o left join stations s on trim(s.name) = trim(o.station)
    where o.w_order = $w_order;";
$query = $bd->prepare($station);
$query->execute();
$rs = $query->fetchAll();
$position=$rs[0]["position"];
 
for ($i = 0; $i < count($jsons); $i++){
    $w_order = $jsons[$i]["w_order"];
    $data = [$jsons[$i]["w_order"],$position,$jsons[$i]["task_order"],$jsons[$i]["technical"],$created_at,"ACTIVO"];
    $stmt = $bd->prepare("INSERT INTO truck_follow (truck_order_id, station_id, station_task_id,technician_id,startin_date,status,created_at) 
    VALUES (?,?,?,?,?,?,CURDATE())");
    try {
        $bd->beginTransaction();
        $stmt->execute($data);
        $bd->commit();
       /* echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Task added succesfully!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";*/
      $exito= "Task added succesfully!";
    }catch (Exception $e){
        $bd->rollback();
        throw $e;
    }
}
if(isset($e) != True){
    echo $exito= "Task added succesfully!";
}


$sql = "UPDATE truck_order SET status_truck	 = 'Progress' WHERE w_order = $w_order";
$query = $bd->prepare($sql);
//2
$query->execute();
?>