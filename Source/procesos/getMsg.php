<?php
    $mensajes=json_decode($_COOKIE["Mensajes"],true);
    $idMensaje=$_GET["idMensaje"];
    $mensaje=$mensajes[$idMensaje];
    $box=$_GET["box"];
    $img=strtolower($mensaje["Nombre"][0]);
    require('connection.php');
    $connection=connect();
    $query="SELECT U.idUsuario
            FROM Usuario U
            WHERE U.Nickname='$mensaje[Nombre]';";
    $result=$connection->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    $idEnviar=$row["idUsuario"];
    echo "<div class='modal-content'>";
    echo "<div class='row'>";
    echo "<div class='col s2 m2'>";
    echo "<img class='responsive-img' src='../IMG/Avatar/$img.png'>";
    echo "</div>";
    echo "<div class='col s6 m6'>";
    echo "<h6 class='asunto'>$mensaje[Nombre]</h6>";
    echo "<h3 class='asunto'>$mensaje[Asunto]</h3>";
    echo "</div>";
    echo "<div class='col s4 m4'>";
    echo "<h5 class='asunto'>$mensaje[Fecha]</h5>";
    echo "</div>";
    echo "</div>";
    echo "<div class='divider'></div>";
    echo "<div class='col s12 m12' style='word-wrap:break-word'>";
    echo "<p>";
    echo nl2br($mensaje["Mensaje"]);
    echo "</p>";
    echo "</div>";
    echo "</div>";
    if($box!=1){
        echo "<div class='modal-footer'>";
        echo "<a id='resp' class='modal-action waves-effect waves-blue btn-flat'><i class='material-icons'>reply</i></a>";
        echo "</div>";
    }
    echo "<input type='hidden' id='idEnviar' value='$idEnviar'>";
    echo "<input type='hidden' id='asnt' value='$mensaje[Asunto]'>";
?>