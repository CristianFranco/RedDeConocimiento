<?php
    session_start();
    require('connection.php');
    $connection=connect();
    $idSession=$_SESSION["idUsuario"];
    //$idSession=1;
    $index=$_GET["index"];
    $box=$_GET["box"];
    $mensajes=json_decode($_COOKIE['Mensajes'],TRUE);
    echo "<table id='hovered' class='col s12 m12 highlight bordered' style='width:auto;'>";
    if(count($mensajes)>0){
        for($i=($index*7);$i<(($index+1)*7);$i++){
            if(($i+1)>count($mensajes)){
                break;
            }
           $mensaje=$mensajes[$i];
           $img=strtolower($mensaje["Nombre"][0]);
           echo "<tr style='height: 60px;'>";
           if($box!=1){
               echo "<td class='remove' title='Eliminar Mensaje' style='text-align: center;'><a onclick='eliminar($i);'><img class='deleteIcon' src='../IMG/DeleteRed.png'></a></td>";
               echo "<td class='report' title='Reportar Mensaje' style='text-align: center;'><a onclick='reportar($i);'><i class='material-icons icon-warn'>report_problem</i></a></td>";
           }
           echo "<td data-target='mensaje' class='imgColumn modal-trigger' style='text-align: center;' onclick='mostrar($i);'><img width='40' height='38' class='circle responsive-img' src='../IMG/Avatar/$img.png'></td>";
           echo "<td data-target='mensaje' class='userColumn modal-trigger' onclick='mostrar($i);'>$mensaje[Nombre]</td>";
           echo "<td data-target='mensaje' class='textColumn modal-trigger' onclick='mostrar($i);'>$mensaje[Asunto] - $mensaje[Mensaje]</td>";
           echo "<td data-target='mensaje' class='date modal-trigger' onclick='mostrar($i);'>$mensaje[Fecha]</td>";
           if($mensajes[$i]["Visto"]==1){
               echo "<td data-target='mensaje' class='noColumn modal-trigger' onclick='mostrar($i);'><span style='position:static;' class='new badge secundario'></span></td>";
           }else{
               echo "<td data-target='mensaje' class='noColumn modal-trigger' onclick='mostrar($i);'></td>";
           }
           echo "</tr>";
        }
    }else{
        echo "<h3>No hay mensajes</h3>";
    }
    echo "</table>";
?>