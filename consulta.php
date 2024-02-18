<?php

    include("conexion.php");
    $w_order = $_GET["w_order"];
    //$consulta = "SELECT * FROM usuarios";
    $station= "SELECT s.position 
    FROM truck_order o left join stations s on trim(s.name) = trim(o.station)
    where o.w_order = $w_order ;";

    $query = $bd->prepare($station);
    //2
    $query->execute();
    //3
    $rs = $query->fetchAll();
    //contar filas
    $position=$rs[0]["position"];

    $consulta1 = "SELECT * FROM stations_tasks
    WHERE station_id = $position
    and `group` IN ('A') 
    AND task_order NOT IN (SELECT station_task_id from `truck_follow` 
    WHERE truck_order_id = $w_order 
    AND station_id = $position) 
    ORDER BY task_order;";

    $consulta2 = "SELECT * FROM `stations_tasks` 
    WHERE station_id = $position
    and `group` IN ('B') 
    AND task_order NOT IN (SELECT station_task_id from `truck_follow` 
    WHERE truck_order_id = $w_order 
    AND station_id = $position) 
    ORDER BY task_order ";

    $consulta3 = "SELECT * FROM `stations_tasks` 
    WHERE station_id = $position 
    and `group` IN ('VERIFY') 
    AND task_order NOT IN (SELECT station_task_id from `truck_follow` 
    WHERE truck_order_id = $w_order 
    AND station_id = $position) 
    ORDER BY task_order ";

    $consulta4 = "SELECT * FROM `stations_tasks` 
    WHERE station_id = $position
    and `group` IN ('INSPECTION') 
    AND task_order NOT IN (SELECT station_task_id from `truck_follow` 
    WHERE truck_order_id = $w_order 
    AND station_id = $position) 
    ORDER BY task_order;";

    $consulta5 = "SELECT t.username, t.name FROM `technicians` t ";


    $query = $bd->prepare($consulta1);
    $query->execute();
    $rs1 = $query->fetchAll();
    $filas1 = count($rs1);

    $query = $bd->prepare($consulta2);
    $query->execute();
    $rs2 = $query->fetchAll();
    $filas2 = count($rs2);

    $query = $bd->prepare($consulta3);
    $query->execute();
    $rs3 = $query->fetchAll();
    $filas3 = count($rs3);

    $query = $bd->prepare($consulta4);
    $query->execute();
    $rs4 = $query->fetchAll();
   $filas4 = count($rs4);

    $query = $bd->prepare($consulta5);
    $query->execute();
    $rs5 = $query->fetchAll();
    $filas5 = count($rs5);
    
    
    
?>