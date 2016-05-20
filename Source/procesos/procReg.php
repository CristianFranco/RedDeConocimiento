<?php
    session_start();
    require("connection.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $connection=connect();
    $query="select Nickname from Usuario";
    $result=$connection -> query($query);
    $ciudades=array();
    //Variables usadas para recoger los datos del formulario 
    $nombre=$_POST['nombre'];
    //echo $nombre;
    $apellido=$_POST['apell'];
    //echo $apellido;
    $email=$_POST['email'];
    //echo $email;
    $telefono=$_POST['tel'];
    //echo $telefono;
    $pais=$_POST['pais'];
    //echo $pais;
    $ciudad=$_POST['ciudad'];
    //echo $ciudad;
    $nickname=$_POST['nkname'];
    //echo $nickname;
    $pass=$_POST['pass'];
    //echo $pass;
    $cpass=$_POST['confpass'];
    //echo $cpass;
    $desc=$_POST['desc'];
    //Arreglo de errores
    $errores=array();
    //Bandera si existe el NickName en la BD o no existe
    define('band',FALSE);
    //Secuencias de caracteres permitidos en los campos
    $permitidos = "a-zA-Záéíóú";
    $permitidos2 = "a-zA-Záéíóú._@-";
    $permitidos3 ="0-9";
    $permitidos4 = "0-9a-zA-Záéíóú._?-";
    $permitidos5 = "0-9a-zA-Z";
    if(empty($nombre)){
        $errores[]="El campo Nombre esta vacio";
    }else if(!ereg("^[ $permitidos]",$nombre)){
        $errores[]="El campo Nombre tiene caracteres no permitidos";
        if(strlen($nombre)<4){
            $errores[]="El campo Nombre permite minimo 4 caracteres";
        }
    }else{
        echo "correcto nombre\n";
    }
    if(empty($apellido)){
        $errores[]="El campo Apellido esta vacio";
    }else if(!ereg("^[ $permitidos]{5,}$",$apellido)){
        $errores[]="El campo Apellido tiene caracteres no permitidos";
        if(strlen($apellido)<5){
            $errores[]="El campo Apellido permite minimo 5 caracteres";
        }
    }else{
     echo "correcto apellido\n";   
    }
    if(empty($email)){
        $errores[]="El campo Email esta vacio";
    }else if(!ereg("^[ $permitidos2]",$email)){
        $errores[]="El campo Email tiene caracteres no permitidos";
        if(strlen($email)>15){
            $errores[]="El campo Email permite minimo 15 caracteres";
        }
    }else{
        echo "correcto email\n";
    }
    if(empty($telefono)){
        $errores[]="El campo Telefono esta vacio";
    }else if(!is_numeric($telefono)){
        $errores[]="El campo Telefono solo admite numeros";
    }else{
        echo "telefono correcto";
    }
    if(empty($nickname)){
        $errores[]="El campo NickName esta vacio";
    }else if(!ereg("^[ $permitidos4]{4,}$",$nickname)){
        $errores[]="El campo Nombre tiene caracteres no permitidos";
        if(strlen($nickname)<4){
            $errores[]="El campo Nombre permite minimo 4 caracteres";
        }
    }else{
         while($row=$result->fetch_array(MYSQLI_ASSOC)){
            if($row['Nickname']==$nombre){
                $errores[]="El NickName ya existe debe cambiarlo";
                $band=TRUE;
                break;
            }
       }
    if(!band){
        echo "NickName no existente <br>";
    }
    }
    if(empty($pass) && empty($cpass)){
        $errores[]="Alguno de los campos Contraseña esta vacio";
    }else if(!ereg("^[ $permitidos5]{8,}$",$pass) && !ereg("^[ $permitidos5]{8,}$",$cpass)){
        $errores[]="El campo Contarseña solo permite alfanumericos";
        if(strlen($pass)<8 && strlen($cpass)<8){
            $errores[]="El campo Contraseña admite minimo 8 caracteres";
        }
    }else if($pass!=$cpass){ 
        $errores[]="Fallo al comprobar contraseña revise que sean iguales";
    }else{
        echo "contraseña correcta";
         $codigoverificacion = rand(0000000000,9999999999); // Conseguimos un codigo aleatorio de 10 digitos.
        /*if (!mysql_query("INSERT INTO registros(usuario,contrasena,email,codigo) values ('".$usuario."','".$contrasena1."','".$email."','".$codigoverificacion."')")) die (mysql_error());*/
        $headers = "From:omar.edcortesp@gmail.com"; 
        $mensaje = "Usted solicito un registro en mongox.com.ar, n 
        Para confirmarlo debe hacer click en el siguiente enlace: n 
        http://URL.COM/usuarios/190.226.115.158/confirmar.php?codigo=".$codigoverificacion; 
        if (!mail("$email","Confirmacion Registro","$mensaje","$headers")) die ("No se pudo enviar el email de confirmacion.");
        echo "Tu cuenta ha sido registrada, sin embargo, esta requiere que la confirmes desde el email que ingresaste en el registro.";
        } 
    //Comprobamos que errores este vacio para cargar a la base
    if(count($errores)==0){
        echo "Registro correcto";
    }else{
        for($i=0;$i<count($errores);$i++){
            echo $errores[$i]."<br>";
        }
    }
    
?>