<?php
    session_start();
    //require("class.phpmailer.php");
include_once("class.phpmailer.php");
    require("connection.php");
    include_once("class.smtp.php");
    //require("class.phpmailer.php");
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
    $permitidos = "/^[_a-zA-Z \s]+$/";
    $permitidos2 = "/^[_a-zA-Z0-9._@-]+$/";
    $permitidos3 ="/^[_0-9]+$/";
    $permitidos4 = "/^[_0-9a-zA-Z\s._-]+$/";
    $permitidos5 = "/^[_0-9a-zA-Z]+$/";
    if(empty($nombre)){
        $errores[]="El campo Nombre esta vacio";
    }else if(!preg_match($permitidos,$nombre)){
        $errores[]="El campo Nombre tiene caracteres no permitidos";
        if(strlen($nombre)<6 or strlen($nombre)>15){
            $errores[]="El campo Nombre permite minimo 6 y maximo 15 caracteres";
        }
    }else{
        echo "correcto nombre\n";
    }
    if(empty($apellido)){
        $errores[]="El campo Apellido esta vacio";
    }else if(!preg_match($permitidos,$apellido)){
        $errores[]="El campo Apellido tiene caracteres no permitidos";
        if(strlen($apellido)<6 or strlen($apellido)>15){
            $errores[]="El campo Apellido permite minimo 6 y maximo 15 caracteres";
        }
    }else{
     echo "correcto apellido\n";   
    }
    if(empty($email)){
        $errores[]="El campo Email esta vacio";
    }else if(!preg_match($permitidos2,$email)){
        $errores[]="El campo Email tiene caracteres no permitidos";
        if(strlen($email)<12){
            $errores[]="El campo Email permite minimo 12 caracteres";
        }
    }else{
        echo "correcto email\n";
    }
    if(empty($telefono)){
        $errores[]="El campo Telefono esta vacio";
    }else if(!preg_match($permitidos3,$telefono)){
        $errores[]="El campo Telefono solo admite numeros";
        if(strlen($telefono)<10 or strlen($telefono)>20)
        {
            $errores[]="El campo Telefono permite minimo 10 y maximo 20 caracteres";
        }
    }else{
        echo "telefono correcto";
    }
    if(empty($nickname)){
        $errores[]="El campo NickName esta vacio";
    }else if(!preg_match($permitidos4,$nickname)){
        $errores[]="El campo NickName tiene caracteres no permitidos";
        if(strlen($nickname)<6 or strlen($nickname)>15){
            $errores[]="El campo NickName permite minimo 6 y maximo 15 caracteres";
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
    }else if(!preg_match($permitidos5,$pass) && !preg_match($permitidos5,$cpass) ){
        $errores[]="El campo Contarseña solo permite alfanumericos";
        if(strlen($pass)<8 && strlen($cpass)<8){
            $errores[]="El campo Contraseña admite minimo 8 caracteres";
        }
    }else if($pass!=$cpass){ 
        $errores[]="Fallo al comprobar contraseña revise que sean iguales";
    }else{
        echo "contraseña correcta";
        } 
    //Comprobamos que errores este vacio para cargar a la base
    if(count($errores)==0){
        echo "Registro correcto";
        $codigoverificacion = rand(0000000000,9999999999); // Conseguimos un codigo aleatorio de 10 digitos.
        /*if (!mysql_query("INSERT INTO registros(usuario,contrasena,email,codigo) values ('".$usuario."','".$contrasena1."','".$email."','".$codigoverificacion."')")) die (mysql_error());*/
       // $headers = "From:omar.edcortesp@gmail.com"; 
        //ini_set("SMTP","smtp.gmail.com");
        //ini_set("smtp_port","465");
       // $headers = "MIME-Version: 1.0\r\n"; 
        //$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
       /* $headers = "From: Omar <omar.edcortesp@gmail.com>\r\n";
        $headers.="X-Mailer: PHP/".phpversion();
        $mensaje = "Usted solicito un registro en mongox.com.ar, n 
        Para confirmarlo debe hacer click en el siguiente enlace: n 
        http://URL.COM/usuarios/190.226.115.158/confirmar.php?codigo=".$codigoverificacion; 
        if (!mail($email,"Confirmacion Registro",$mensaje,$headers)) {
            echo "<br> No se pudo enviar el email de confirmacion.";
        }
        else{
        echo "Tu cuenta ha sido registrada, sin embargo, esta requiere que la confirmes desde el email que ingresaste en el registro.";
        }*/
       
         $mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
//$mail->Mailer = "smtp";
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = "ssl"; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = "465"; // or 587 465
//$mail->IsHTML(true);
$mail->AddAddress($email,"lol");
$mail->Username = "omar.edcortesp@gmail.com";
$mail->Password = "123Italia";
$mail->From="From: omar <omar_cortesp@hotmail.com>";
//$mail->FromName="live.com";
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->MsgHtml("hola");
//$mail->Send();
if(!$mail->Send()) {
    echo "<br> Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
 
 //echo 'El Mensaje a sido enviado. ha '.$email;
    }else{
        for($i=0;$i<count($errores);$i++){
            echo $errores[$i]."<br>";
        }
    }
    
?>