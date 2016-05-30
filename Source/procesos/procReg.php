<?php
    session_start();
    //require("class.phpmailer.php");
    header('Content-Type: application/json');
    require("class.phpmailer.php");
    require("connection.php");
    //require("class.smtp.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $connection=connect();
    $query="select Nickname from Usuario";
    $result=$connection -> query($query);
    $errores=array();
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
    //define('band',FALSE);
    //$result=$connection->query($query);
    //Checamos el que el NIckName no exista
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        if($row['Nickname']==$nickname){
            $errores=array("estado"=>false,"msg"=>"El NickName ".$nickname." ya esta en uso por otro usuario");
          //  $erores[]="lol";
            break;
        }
    }
    if(empty($ciudad) or empty($pais)){
        $errores=array("estado"=>false,"msg"=>"No se selccionó País");
    }
    //if(count($errores)==0){
        //echo "Registro correcto";
    if(count($errores)==0){
        $codigoAc =mt_rand(0000000000,9999999999); // Conseguimos un codigo aleatorio de 10 digitos.
        //echo $codigoAc;
       //Damos de alta
        $connectionr=connect();
        $query="INSERT INTO Usuario (Nickname,Password,Email,Telefono,Nombre,Apellidos,idCiudad,Descripcion,CodigoAc) VALUES ('".$nickname."','".$pass."','".$email."','".$telefono."','".$nombre."','".$apellido."',".$ciudad.",'".$desc."',".$codigoAc.");";
       // echo "<br/>".$query;
        //Verificamos que se hizo la consulta
        if($connectionr -> query($query)){
            //echo "registro correcto";
            //Sacamos el id de usuario que se acaba de agregar
            $query="SELECT IdUsuario FROM Usuario order by IdUsuario DESC LIMIT 1;";
            $result=$connection->query($query);
            $row=$result->fetch_array(MYSQLI_ASSOC);
            //Proceso para el correo
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
            $mail->Subject = "Confirmación Cuenta Red Conocimiento";
            $mensaje = "Usted se a registrado a la Red de Conocimiento, \n 
            Para confirmar su cuenta haga click en el siguiente enlace: \n 
            http://localhost/RedDeConocimiento/Source/confirmacion.php?confirmacion=".$codigoAc."&IdUsr=".$row['IdUsuario']."\n
            Usuario:".$nickname."\n Password=".$pass; //enviamos url con 
            $mail->Body = $mensaje;
            //$mail->AltBody = "Mensaje de prueba mandado con pbhpmailer en formato solo texto";
            $exito = $mail->Send();
            if(!$exito)
               {
                //echo "Problemas enviando correo electrónico a ".$email." actualize la pagina";
                //echo "<br/>".$mail->ErrorInfo;	
                $errores=array("estado"=>false,"msg"=>"La dirección de correo ".$email." no es válida ");
               }
               else
               {
                //echo "Se ha enviado un correo de confirmación a la cuenta ".$email;
               } 

             //echo 'El Mensaje a sido enviado. ha '.$email;

        }else{
            //echo "error";
            $errores=array("estado"=>false,"msg"=>"Fallo al registrar el usuario, inténtelo de nuevo");
        }
    }
     echo json_encode($errores);   
     
        
?>