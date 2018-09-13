<?php
   include("php/session.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $name=$_POST['name']; // Fetching Values from URL.
      $user=$_POST['user']; // Fetching Values from URL.
      $email=$_POST['email'];
      $password= sha1($_POST['password']); // Password Encryption, If you like you can also leave sha1.
      $cpassword= sha1($_POST['cpassword']); // Password Encryption, If you like you can also leave sha1.
      // Check if e-mail address syntax is valid or not
      $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
      $params = array();

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invalid Email.......";
      }else{
	  
	    $return = $auth->register($name, $user, $email, $password, $cpassword, $params, NULL, NULL);
	    if($return['error']==false)
	        echo "NoError";
	    else
	        echo $return['message'];


	    exit;
	  }
	  
	  }else{
             $id=$_GET['id'];
             $id=str_replace(" ", "+",$id);
             $query = $dbh->prepare("call validateRegistroUsuario(?)");
            $query->bindParam(1, $id, PDO::PARAM_STR);
            $valid=0;
            if ($query->execute()) {
                $rows = $query->fetchAll();
            }
            $valid=count($rows);
       	  }
	  ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    	<title>TTS Logistics - Register</title>
    	<link rel="stylesheet" type="text/css" href="css/themes/USG/easyui.css">
    	<link rel="stylesheet" type="text/css" href="css/themes/icon.css">
    	<link rel="stylesheet" type="text/css" href="css/themes/demo.css">
    	<link rel="stylesheet" type="text/css" href="css/style.css">
    	<script type="text/javascript" src="js/jquery.min.js"></script>
    	<script type="text/javascript" src="js/jquery-easyui/jquery.easyui.min.js"></script>
    	<script type="text/javascript" src="js/register.js"></script>

</head>
<body class="easyui-layout">
    <div style=" float: left; position: absolute; left: 0px; top: 0px; z-index: 4"><img src="images/logo-tts-gde.png" /></div>

	<div data-options="region:'north',border:false" style="height:100px;background:#000000;padding:10px">

	</div>
	<div data-options="region:'south',border:false" style="height:50px;background:#000000;padding:10px; text-align:center">TTS Logistics todos los derechos reservados 2016   Tel. +52 (55) 1333 1524   E-mail: admon@ttslogistics.com.mx</div>
	<div data-options="region:'center'" style="background-image: url(images/USGback1.png); background-repeat: no-repeat; -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover; background-position:center;">
	<div id="register_form" class="easyui-window" data-options=" shadow:false, border:false, collapsible:false, closable:false, minimizable:false, maximizable:false" title="SISTEMA USG"  style="padding: 50px; background-image:url(images/backOrange.png); background-repeat: no-repeat; -webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: 110%; background-position:center;  width:400px; height:400px; text-align:center ">
            <form id="create" class="form" method="post" action="#" style="text-align: right;">
                <table style="width:100%">
                    <tr><td colspan="2" style="text-align:center; font-size:42px; font-family:'Open sans'">SISTEMA <b>USG</b><td/></tr>
                    <tr><td colspan="2" style="text-align:center; font-size:10px; font-family:'Open sans condensed'"><b>_______________________________________________________________________________________</b><td/></tr>
                    <tr><td colspan="2" style="text-align:center; font-size:10px; font-family:'Open sans condensed'"> <td/></tr>
                    <?php if($valid){ ?>
                    <tr>
                        <td style="width:140px"> Nombre :</td>
                        <td> <input name="name" id="name" class="easyui-textbox"></td>
                    </tr>
                    <tr>
                        <td> Usuario :</td>
                        <td> <input name="user" id="user" class="easyui-textbox"></td>
                    </tr>
                    <tr>
                        <td> Correo electrónico :</td>
                        <td> <input name="email" id="email" class="easyui-textbox"></td>
                    </tr>
                    <tr>
                        <td> Contraseña :</td>
                        <td> <input type="password" name="password" id="password" class="easyui-textbox"></td>
                    </tr>
                    <tr>
                        <td> Confirmar contraseña :</td>
                        <td> <input type="password" name="cpassword" id="cpassword" class="easyui-textbox"></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> __________________________

                        </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> <a href="#" name="register" id="register" class="easyui-linkbutton"  style="width:100px">Registrar</a>

                        </td>
                    </tr>
                    <?php }?>


                </table>
            </form>
	</div>
</body>
</html>

