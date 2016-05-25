<?php
    session_start();
    //require("class.phpmailer.php");
    require("class.phpmailer.php");
    require("connection.php");
    //require("class.smtp.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $connection=connect();
    $query="select Nickname from Usuario";
    $result=$connection -> query($query);
    //$ciudades=array();
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
    //Comprobamos que errores este vacio para cargar a la base
    //if(count($errores)==0){
        //echo "Registro correcto";
        $codigoverificacion = 10;//rand(0000000000,9999999999); // Conseguimos un codigo aleatorio de 10 digitos.
       //Damos de alta
        $connectionr=connect();
        $query="INSERT INTO Usuario (Nickname,Password,Email,Telefono,Nombre,Apellidos,idCiudad,Descripcion) VALUES ('".$nickname."','".$pass."','".$email."','".$telefono."','".$nombre."','".$apellido."',".$ciudad.",'".$desc."');";
        //echo $query;
        if($connectionr -> query($query)){
            //echo "registro correcto";
            $mail = new phpmailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->PluginDir="";
            $mail->Mailer='smtp';
            $mail->Host = "smtp.gmail.com" ;
            //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->Username = "proyecto.red.conocimiento@gmail.com";
            $mail->Password = "StrUsr94?";
            $mail->From="proyecto.red.conocimiento@gmail.com";
            $mail->FromName="proyecto.red.conocimiento@gmail.com";
            $mail->Timeout=20;
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->AddAddress($email);        
            $mail->CharSet    = 'UTF-8';
            $mail->Port = 587; // or 587 465
            //$mail->IsHTML(true);
            $mail->Subject = "Confirmacion Cuenta Red Conocimiento";
            $mensaje = "Usted solicito un registro en Red de Conocimiento, \n 
            Para confirmarlo debe hacer click en el siguiente enlace: \n 
            http://localhost:3030/ROC/Source/index.php  ".$codigoverificacion; 
            $mail->Body = $mensaje;
            $mail->AltBody = "Mensaje de prueba mandado con pbhpmailer en formato solo texto";
            $exito = $mail->Send();
            if(!$exito)
               {
                echo "Problemas enviando correo electrónico a ".$email." actualize la pagina";
                echo "<br/>".$mail->ErrorInfo;	
               }
               else
               {
                echo "Se ha enviado un correo de confirmación a la cuenta ".$email;
               } 

             //echo 'El Mensaje a sido enviado. ha '.$email;

        }else{
            echo "error";
        }
        
        
?>