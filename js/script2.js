

function same_local_storage_tec() {
    if (window.localStorage.getItem('tecnicos') !== undefined
    && window.localStorage.getItem('tecnicos')){
        //const result = Object.assign({}, data, data);
        prev_json = JSON.parse(localStorage.getItem("tecnicos"));
        console.log(localStorage.getItem("tecnicos"));
        var data_r = Array();
        for (j=0; j < Object.keys(prev_json).length; j++){
            data_r.push({"tec":prev_json[j].tec,"color":prev_json[j].color});
            console.log("El tecnico es "+prev_json[j].tec)
        } 
        for (i = 0; i < 100; i++) {
            if(document.getElementsByName('tec')[i]){
                if(document.getElementsByName('tec')[i].checked ){
                    for (j=0; j< Object.keys(prev_json).length; j++){
                        if(prev_json[j].tec != document.getElementsByName('tec')[i].value){
                            data_r.push({"tec":document.getElementsByName('tec')[i].value,"color":random_rgba()});
                        }
                    }
                }
            }
        }
        result = JSON.stringify(data_r);
        localStorage.setItem("tecnicos",result);
        console.log(localStorage.getItem("tecnicos"));
    }else{
        c_act = 0;
        var technical = Array();
        for (i = 0; i < 100; i++) {
            if(document.getElementsByName('tec')[i]){
                if(document.getElementsByName('tec')[i].checked ){
                    if (c_act == 1) {
                        //document.getElementsByName('tec')[i].disabled = true;  
                    }else{
                        c_act += 1
                        technical.push({"tec":document.getElementsByName('tec')[i].value,"color":random_rgba()});
                        data = JSON.stringify(technical);
                    }
                }
            }
        }
        localStorage.setItem("tecnicos",data);
        console.log(localStorage.getItem("tecnicos"));
    }
    
}

function same_local_storage_task(w_order) {
    if (window.localStorage.getItem('tecnicos') !== undefined
    && window.localStorage.getItem('tecnicos')){
        //const result = Object.assign({}, data, data);localStorage.removeItem("Prev_insert");
        prev_json = JSON.parse(localStorage.getItem("tecnicos"))
        var task_order = Array();
        var technical = prev_json[Object.keys(prev_json).length-1].tec;
        var color = prev_json[Object.keys(prev_json).length-1].color;
        console.log(technical);
        for (i = 0; i < 100; i++) {
            if(document.getElementsByName('flexCheckChecked')[i]){
                if(document.getElementsByName('flexCheckChecked')[i].checked){
                    task_order.push(document.getElementsByName('flexCheckChecked')[i].value);
                }
            }
        }
        if (window.localStorage.getItem('Prev_insert') !== undefined
        && window.localStorage.getItem('Prev_insert')){
            data_json = JSON.parse(localStorage.getItem("Prev_insert"))
            var data_r = Array();
            var task = Array();
            for (j=0; j < Object.keys(data_json).length; j++){
                data_r.push({ "w_order": data_json[j].w_order, 
                            "task_order": data_json[j].task_order,
                            "technical": data_json[j].technical});
                task.push(data_json[j].task_order);
            }
            var e=0;
            task_order.forEach(element => {
                if (task.includes(element) === false) {
                    data_r.push({ "w_order": w_order, "task_order": element,"technical": technical});
                    registro = document.getElementById('tecs_'+technical)
                    registro2 = document.getElementById('row_'+element)
                    add_color_task(registro,color)
                    add_color_task(registro2,color)
                }
            });
            data_r = JSON.stringify(data_r);
            localStorage.setItem("Prev_insert",data_r);
        }else{
            var data = Array()
            task_order.forEach(element => {
                data.push({ "w_order": w_order, "task_order": element,"technical": technical});
                registro = document.getElementById('tecs_'+technical)
                registro2 = document.getElementById('row_'+element)
                add_color_task(registro,color)
                add_color_task(registro2,color)
            });
            data = JSON.stringify(data);
            localStorage.setItem("Prev_insert",data);
        }
        console.log(localStorage.getItem("Prev_insert"));
    }else{
        alert("Sin tecnico asignado")
    }
}

function AddTask(w_order) {
    //console.log(contador)
    if (window.localStorage.getItem('Prev_insert') !== undefined
    && window.localStorage.getItem('Prev_insert')){
        request = new XMLHttpRequest();
        request.open("POST", "/Task/Add_Task.php", true);
        request.setRequestHeader("Content-type", "application/json");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                // Print received data from server
                    alert(request.response);
            }
        };
        data_json = JSON.parse(localStorage.getItem("Prev_insert"))
        var data_r = Array();
        for (j=0; j < Object.keys(data_json).length; j++){
            data_r.push({ "w_order": data_json[j].w_order, 
                        "task_order": data_json[j].task_order,
                        "technical": data_json[j].technical});
        }
        data = JSON.stringify(data_r);
        request.send(data);
        localStorage.removeItem("Prev_insert");
        localStorage.removeItem("tecnicos");
    }else{  
        alert("Most to assign task and technicals");
        
    }
}

function limpia_storage() {
    if (window.localStorage.getItem('Prev_insert') !== undefined
    && window.localStorage.getItem('Prev_insert')){
        localStorage.removeItem("Prev_insert");
    }
    if (window.localStorage.getItem('tecnicos') !== undefined
    && window.localStorage.getItem('tecnicos')){
        localStorage.removeItem("tecnicos");
    }
}

function random_rgba() {
    clases = Array("table-primary",
    "table-secondary",
    "table-success",
    "table-danger",
    "table-warning",
    "table-info",
    "table-light",
    "table-dark"
    )
    v = getRandomInt(7);
    if (window.localStorage.getItem('tecnicos') !== undefined
    && window.localStorage.getItem('tecnicos')){
        data_json = JSON.parse(localStorage.getItem("tecnicos"))
        var data_r = Array();
        for (j=0; j < Object.keys(data_json).length; j++){
            data_r.push(data_json[j].color);
        }
        var valida = false 
        while (valida == false) {
            if (data_r.includes(clases[v]) === false){
                v = getRandomInt(7);
                valida= true
            }
        }
    }else{
        v = getRandomInt(7);
    }
    return clases[v]
}

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
  }

function add_color_task(element,color) {
    element.classList.add(color);
}
function checkAll(w_order) {
    document.querySelectorAll('#grupoa input[type=checkbox]').forEach(function(checkElement) {
        checkElement.checked = true;
        same_local_storage_tec(w_order);
        same_local_storage_task(w_order);
        AddTask(w_order)
    });
    
    
    
}




