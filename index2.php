<?php

include("session.php");


if (!$auth->isLogged()) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];            // Get the server
    $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // Get the current directory
    $url .= '/login.php';            // <-- Your relative path
    header('Location: ' . $url, true, 302);
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    	<title>Full Layout - jQuery EasyUI Demo</title>
    	<link rel="stylesheet" type="text/css" href="css/themes/USG/easyui.css">
    	<link rel="stylesheet" type="text/css" href="css/themes/icon.css">
    	<link rel="stylesheet" type="text/css" href="css/themes/demo.css">
    	<link rel="stylesheet" type="text/css" href="css/index.css">

    	<script type="text/javascript" src="js/jquery.min.js"></script>
    	<script type="text/javascript" src="js/jquery-easyui/jquery.easyui.min.js"></script>
    	<script type="text/javascript" src="js/datagrid-detailview.js"></script>
    	<script type="text/javascript" src="js/index.js"></script>
    	<script type="text/javascript" src="js/canvasjs/jquery.canvasjs.min.js"></script>
    	<script type="text/javascript">
           $(document).ready(function() {
                loadGraficas();
           });
        </script>





</head>
<body class="easyui-layout">
    <div style=" float: left; position: absolute; left: 0px; top: 0px; z-index: 4"><img src="images/logo-tts-gde.png" /></div>

	<div data-options="region:'north',border:false" style="height:100px;background:#000000;padding:10px">

	</div>
	<div data-options="region:'west',split:true,title:'Menu'" style="width:130px;padding:10px;">
		<div style="padding:5px 0;">
        		<a onclick="loadGraficas()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-grafica',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Graficas</a>
        		<a onclick="loadReportes()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-reportes',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Reportes</a>

        </div>
	</div>


	<div data-options="region:'south',border:false" style="height:50px;background:#000000;padding:10px;">TTS Logistics todos los derechos reservados 2016   Tel. +52 (55) 1333 1524   E-mail: admon@ttslogistics.com.mx</div>
	<div id="centerPanel" data-options="region:'center',title:'Center'">

	</div>
</body>
</html>