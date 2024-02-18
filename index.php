<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
    <title>Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css\style.css" rel="stylesheet" type="text/css"/>
    
</head>
<body onload="limpia_storage()">
    <?php
        if(isset($_GET["w_order"]) != true){
            echo "<script type='text/javascript'>";
            echo "document.location.href = 'https://www.ayconintegraciones.com.mx/login/HelpDesk/orders/'";
            echo "</script>";
        }
    ?>
    <!-- Navegaci贸n inicia -->
    <div class="containter-fluid">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <div class="navbar-collapse">
                <ul class="navbar-nav me-auto mb-3">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Link 1</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Link 2</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-secondary" href="#">Link 3</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn2 btn-primary" type="submit">Profile</button>
                </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navegaci贸n fin -->
            <?php
                include("consulta.php");

            ?>
    <!-- Contenido inicia -->
    <div class="container-fluid">

        <div class="container text-center">
            <p class="h1 text-white">
                    <span>Task</span>
            </p>

        </div>
    </div>   
    
    <div id="alertas">
            <div id="alert">

            </div>
    </div>

    <div class="contenedor">
        <div class="col container-fluid m-2" style="height:70vh;">
            <div class="col card">
                <div class="card-header fw-bold">
                    <p class="h3 fw-bold">Work Order: <?php echo $_GET["w_order"]?></p> <!-- Texto PHP -->
                </div>
                <div class="card-body scroll-m" style="height: 71.7vh;">
                    <p class="h4 fw-bold">Users</p>
                    <div class="row">
                        <div class="col container-fluid">
                            <div class="">

                            <table class="table table-borderless">
                            <thead>
                                <tr>
                                <th scope="col">Assign Technicians</th>
                                <th scope="col ">Technicians</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($rs5); $i++) : ?>
                                    <tr id='<?php echo "tecs_".$rs5[$i]["username"] ?>'>
                                    <?php echo ($filas5>0) ? "<th scope='row'><input class='form-check-input bg-dark ' style='border: #212529 !important; id = 'tec' type='checkbox' value='".$rs5[$i]["username"]."' name='tec' onchange='same_local_storage_tec()' ></th>": "<td>No Technicians to assing</td>" ?>
                                    <td><?php echo ($filas5>0) ? $rs5[$i]["name"]: "No task to assing" ?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class=" col container-fluid">
            <div clas="">

                <div class="card text-center m-2 scroll ">
                    <div class="card-header fw-bold">
                        Group A
                    </div>
                    <div class="card-body" id="grupoa">
                    <table class="table">
                            <thead>
                                <tr>
                                <th scope="col"><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='' name="#grupoa" onchange="checkAll(<?php echo $_GET['w_order'] ?>,1)" > </th>
                                <th scope="col">Taks Code</th>
                                <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($rs1); $i++) : ?>
                                    <tr id='<?php echo "row_".$rs1[$i]["task_order"] ?>' name="grupo_A">
                                    <?php echo ($filas1>0) ? "<th scope='row'><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='".$rs1[$i]["task_order"]."' name='flexCheckChecked' onchange='same_local_storage_task(".$_GET['w_order'].")'></th>": "<td>No task to assing</td>" ?>
                                    <td><?php echo ($filas1>0) ? $rs1[$i]["qa_code"]: "No task to assing" ?></td>
                                    <td><?php echo ($filas1>0) ? $rs1[$i]["name"]: "No task to assing"?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                </div>
        
            </div>
        </div>    

        <div class="">
            <div clas="">

                <div class="card text-center m-2 scroll">
                    <div class="card-header fw-bold">
                        Group B
                    </div>
                <div class="card-body" id="grupob">
                <table class="table">
                            <thead>
                                <tr>
                                <th scope="col"><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='' name="#grupob" onchange="checkAll(<?php echo $_GET['w_order'] ?>,2)" > </th>
                                <th scope="col">Taks Code</th>
                                <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($rs2); $i++) : ?>
                                    <tr id='<?php echo "row_".$rs2[$i]["task_order"] ?>' name="grupo_b">
                                    <?php echo ($filas2>0) ? "<th scope='row'><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='".$rs2[$i]["task_order"]."' name='flexCheckChecked' onchange='same_local_storage_task(".$_GET['w_order'].")'></th>": "<td>No task to assing</td>" ?>
                                    <td><?php echo ($filas2>0) ? $rs2[$i]["qa_code"]: "No task to assing" ?></td>
                                    <td><?php echo ($filas2>0) ? $rs2[$i]["name"]: "No task to assing"?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                </div>
                
            </div>
        </div>    


        <div class="">
            <div clas="">

                <div class="card text-center m-2 scroll">
                    <div class="card-header fw-bold">
                        Group Verify
                    </div>
                <div class="card-body" id="grupoverify">
                <table class="table">
                            <thead>
                                <tr>
                                <th scope="col"><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='' name="#grupoverify" onchange="checkAll(<?php echo $_GET['w_order'] ?>,3)" > </th>
                                <th scope="col">Taks Code</th>
                                <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($rs3); $i++) : ?>
                                    <tr id='<?php echo "row_".$rs3[$i]["task_order"] ?>' name="grupo_verify">
                                    <?php echo ($filas3>0) ? "<th scope='row'><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='".$rs3[$i]["task_order"]."' name='flexCheckChecked' onchange='same_local_storage_task(".$_GET['w_order'].")'></th>": "<td>No task to assing</td>" ?>
                                    <td><?php echo ($filas3>0) ? $rs3[$i]["qa_code"]: "No task to assing" ?></td>
                                    <td><?php echo ($filas3>0) ? $rs3[$i]["name"]: "No task to assing"?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                </div>
                
            </div>
        </div>
        
        
        <div class="">
            <div clas="">

                <div class="card text-center m-2 scroll">
                    <div class="card-header fw-bold">
                        Group Pre-Inspection
                    </div>
                <div class="card-body" id="grupoins">
                <table class="table" >
                            <thead>
                                <tr>
                                <th scope="col"><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='' name="#grupoins" onchange="checkAll(<?php echo $_GET['w_order'] ?>,4)" > </th>
                                <th scope="col">Taks Code</th>
                                <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($rs4); $i++) : ?>
                                    <tr id='<?php echo "row_".$rs4[$i]["task_order"] ?>' name="grupo_inspection">
                                    <?php echo ($filas4>0) ? "<th scope='row'><input class='form-check-input bg-dark ' style='border: #212529 !important; 'type='checkbox' value='".$rs4[$i]["task_order"]."' name='flexCheckChecked' onchange='same_local_storage_task(".$_GET['w_order'].")'></th>": "<td>No task to assing</td>" ?>
                                    <td><?php echo ($filas4>0) ? $rs4[$i]["qa_code"]: "No task to assing" ?></td>
                                    <td><?php echo ($filas4>0) ? $rs4[$i]["name"]: "No task to assing"?></td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                </div>
                
            </div>
        </div>    

            

    </div>
    </div>    


    

    <div class="text-center p-1 m-4">
    <div class="text-center">
        <button class="btn2 btn-lg btn-primary" onclick="AddTask(<?php echo $_GET['w_order'] ?>)">Add task</button>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./js/script.js" crossorigin="anonymous"></script>

</body>


</html>