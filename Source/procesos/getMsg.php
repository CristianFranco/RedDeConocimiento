<?php
    $mensajes=json_decode($_COOKIE["Mensajes"],true);
    $idMensaje=$_GET["idMensaje"];
    $mensaje=$mensajes[$idMensaje];
    $box=$_GET["box"];
    $img=strtolower($mensaje["Nombre"][0]);
    echo "<div class='modal-content'>";
    echo "<div class='row'>";
    echo "<div class='col s2'>";
    echo "<img src='../IMG/Avatar/$img.png'>";
    echo "</div>";
    echo "<div class='col s8'>";
    echo "<h6>$mensaje[Nombre]</h6>";
    echo "<h3 class='asunto'>$mensaje[Asunto]</h3>";
    echo "</div>";
    echo "<div class='col s2'>";
    echo "<h5>$mensaje[Fecha]</h5>";
    echo "</div>";
    echo "</div>";
    echo "<div class='divider'></div>";
    echo "<div class='col s12' style='word-wrap:break-word'>";
    echo "<p>";
    echo nl2br($mensaje["Mensaje"]);
    echo "</p>";
    echo "</div>";
    echo "</div>";
    if($box!=1){
        echo "<div class='modal-footer'>";
        echo "<a class='modal-action waves-effect waves-blue btn-flat'><i class='material-icons'>reply</i></a>";
        echo "</div>";
    }
?>