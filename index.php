<?php

include("php/session.php");


if (!$auth->isLogged()) {
    $url = 'http://' . $_SERVER['HTTP_HOST'];            // Get the server
    $url .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); // Get the current directory
    $url .= '/login.php';            // <-- Your relative path
    header('Location: ' . $url, true, 302);
    exit();
}else{
    $hash=$_COOKIE[$auth->config->cookie_name];
    $uid = $auth->getSessionUID($hash);
    $user = $auth->getUser($uid);


    $query = $dbh->prepare("call getPerfilByUserId(?)");
    $query->bindParam(1, $uid, PDO::PARAM_INT);
    if ($query->execute()) {
        $rows = $query->fetchAll();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    	<title>TTS Logistics IT</title>
    	<?php if($rows[0]['iTTSTheme']=='Si'){?>
        <link rel="stylesheet" type="text/css" href="css/themes/USG/easyui.css">
        <?php } else
        if($rows[0]['iUSGTheme']=='Si'){ ?>
        <link rel="stylesheet" type="text/css" href="css/themes/USG/usg.css">
        <?php } else {?>
            <link rel="stylesheet" type="text/css" href="css/themes/USG/easyui.css">
        <?php } ?>

    	<link rel="stylesheet" type="text/css" href="css/themes/icon.css">
    	<link rel="stylesheet" type="text/css" href="css/themes/demo.css">
    	<link rel="stylesheet" type="text/css" href="css/index.css">
    	<link rel="stylesheet" type="text/css" href="css/themes/ribbon.css">
        <link rel="stylesheet" type="text/css" href="css/themes/ribbon-icon.css">
        <link rel="stylesheet" type="text/css" href="css/themes/texteditor.css">
        <link rel="stylesheet" type="text/css" href="css/arrow.css">

    	<script type="text/javascript" src="js/jquery.min.js"></script>
    	<script type="text/javascript" src="js/jquery-easyui/jquery.easyui.min.js"></script>
    	<script type="text/javascript" src="js/datagrid-detailview.js"></script>
        <script type="text/javascript" src="js/date.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
    	<script type="text/javascript" src="js/canvasjs/jquery.canvasjs.min.js"></script>
    	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnt_ARIvtO4qIkTFLaZIRQ3PpJB340zuc"></script>

    	<script type="text/javascript" src="js/jquery.gomap.js"></script>
    	<script type="text/javascript" src="js/jquery.download.js"></script>
    	<script type="text/javascript" src="js/jquery.ribbon.js"></script>
    	<script type="text/javascript" src="js/jquery.texteditor.js"></script>
    	<script type="text/javascript" src="js/moment.min.js"></script>
    	<?php
            $isGPS = $_GET['GPS'];
            $isGPS = $rows[0]['vName'] == 'GPS'? 1 : 0;
        ?>
        <script type="text/javascript">
        $(document).ready(function() {
             perfilPriv = { iIdUser:"<?php echo $uid ?>",
                            vUser:"<?php echo $rows[0]['vName']?>",
                            vMail:"<?php echo $rows[0]['vEmail']?>",
                            vIdClient:"<?php echo $user['vIdClient']?>",
                            iSeguimiento:"<?php echo $rows[0]['iSeguimiento']?>",
                            iCatalogos:"<?php echo $rows[0]['iCatalogos']?>",
                            iGraficas:"<?php echo $rows[0]['iGraficas']?>",
                            iReportes:"<?php echo $rows[0]['iReportes']?>",
                            iEmbarquesGPS:"<?php echo $rows[0]['iEmbarquesGPS']?>",
                            iPlantas:"<?php echo $rows[0]['iPlantas']?>",
                            iLogs:"<?php echo $rows[0]['iLogs']?>",
                            iSoporte:"<?php echo $rows[0]['iSoporte']?>",
                            iIsSupport :"<?php echo $rows[0]['iIsSupport']?>",

                            iTTSTheme:"<?php echo $rows[0]['iTTSTheme']?>",
                            iUSGTheme:"<?php echo $rows[0]['iUSGTheme']?>",
                            iViewCarga:"<?php echo $rows[0]['iViewCarga']?>",
                            iEditCargaFechaHoraLlegada:"<?php echo $rows[0]['iEditCargaFechaHoraLlegada']?>",
                            iEditCargaFechaHoraIngreso:"<?php echo $rows[0]['iEditCargaFechaHoraIngreso']?>",
                            iEditCargaOT:"<?php echo $rows[0]['iEditCargaOT']?>",
                            iEditCargaDetalle:"<?php echo $rows[0]['iEditCargaDetalle']?>",
                            iEditCargaComentario:"<?php echo $rows[0]['iEditCargaComentario']?>",
                        
                            iViewSalida:"<?php echo $rows[0]['iViewSalida']?>",
                            iEditSalidaFechaHoraLlegada:"<?php echo $rows[0]['iEditSalidaFechaHoraLlegada']?>",
                            iEditSalidaEstatusPlanta:"<?php echo $rows[0]['iEditSalidaEstatusPlanta']?>",
                            iEditSalidaOT:"<?php echo $rows[0]['iEditSalidaOT']?>",
                            iEditSalidaDetalle:"<?php echo $rows[0]['iEditSalidaDetalle']?>",
                            iEditSalidaComentario:"<?php echo $rows[0]['iEditSalidaComentario']?>",

                            iViewCliente:"<?php echo $rows[0]['iViewCliente']?>",
                            iEditClienteFechaHoraLlegada:"<?php echo $rows[0]['iEditClienteFechaHoraLlegada']?>",
                            iEditClienteFechaHoraSalida:"<?php echo $rows[0]['iEditClienteFechaHoraSalida']?>",
                            iEditClienteEstatus:"<?php echo $rows[0]['iEditClienteEstatus']?>",
                            iEditClienteOT:"<?php echo $rows[0]['iEditClienteOT']?>",
                            iEditClienteDetalle:"<?php echo $rows[0]['iEditClienteDetalle']?>",
                            iEditClienteComentario:"<?php echo $rows[0]['iEditClienteComentario']?>",
                            iViewEstadias:"<?php echo $rows[0]['iViewEstadias']?>",
                            iEditEstadias:"<?php echo $rows[0]['iEditEstadias']?>",
                            iViewReclamacion:"<?php echo $rows[0]['iViewReclamacion']?>",
                            iEditReclamacion:"<?php echo $rows[0]['iEditReclamacion']?>",
                            iViewFaltantes:"<?php echo $rows[0]['iViewFaltantes']?>",
                            iEditFaltantes:"<?php echo $rows[0]['iEditFaltantes']?>",
                            iViewDesvios:"<?php echo $rows[0]['iViewDesvios']?>",
                            iEditDesvios:"<?php echo $rows[0]['iEditDesvios']?>",
                            iViewCancelacion:"<?php echo $rows[0]['iViewCancelacion']?>",
                            iEditCancelacion:"<?php echo $rows[0]['iEditCancelacion']?>",
                            iViewRoute:"<?php echo $rows[0]['iViewRoute']?>",
                            iViewWarning:"<?php echo $rows[0]['iViewWarning']?>",

                            };

            isGPS = <?php echo $isGPS ?>;
            if(isGPS==1)
                loadInsertPoint();


        });

        </script>





</head>
<body class="easyui-layout">

        <?php if($rows[0]['iTTSTheme']=='Si'){?>
        <div data-options="region:'north',border:false" style="height:100px;background:#000000;padding:10px">
            <div style=" float: right;"><img src="images/logo-tts-gde.png" style=" height: 85px" /></div>
        <?php } else
        if($rows[0]['iUSGTheme']=='Si'){ ?>

        <div data-options="region:'north',border:false" style="height:100px;background:#fff;padding:10px" >
            <div style=" float: right; "><img src="images/logo-tts-gde.png" style=" height: 85px" /></div>

        <?php } else {?>
            <div data-options="region:'north',border:false" style="height:100px;background:#000000;padding:10px" >
                <div style=" float: right; "><img src="images/CT-logisticsLogo.png" style=" height: 85px"  /></div>

                <?php } ?>
        <div style=" float: left; position: absolute; left: 218px; top: 21px; z-index: 4"><div style="width:60px; display:inline-block">Usuario:</div><?php echo $rows[0]['vName']; ?><br><div style="width:60px;display:inline-block">Perfil:</div><?php echo $rows[0]['vPerfilNombre']; ?> <br> <a id="btn" href="logout.php" class="easyui-linkbutton" data-options="iconCls:'icon-back'">Logout</a>   </div>

                <div style=" float: left; "><img src="images/usg_logo_detail.png" style=" height: 85px" /></div>
	</div>

	<div data-options="region:'west',split:true,title:'Menu'" style="width:140px;padding:10px;">
		<div style="padding:5px 0; ">
                <?php if($rows[0]['iSeguimiento']=='Si'){?>
        		<a onclick="loadIndiceSeg()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-indiceseg',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Seguimiento</a>
        		<?php }
        		if($rows[0]['iCatalogos']=='Si'){ ?>
        		<a onclick="loadCatalogs()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-cat',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Catalogos</a>
        		<?php }
                if($rows[0]['iArchivo']=='Si'){ ?>
        		<a onclick="loadCargaArchivo()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-arch',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Archivo</a>
        		<?php }
                if($rows[0]['iGraficas']=='Si'){ ?>
        		<a onclick="loadGraficas()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-grafica',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Graficas</a>
        		<?php }
                if($rows[0]['iReportes']=='Si'){ ?>
        		<a onclick="loadReportes()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-reportes',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Reportes</a>
        		<?php }
                if($rows[0]['iEmbarquesGPS']=='Si'){ ?>
        		<a onclick="loadMapEmbarques()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-mapa',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Embarques</a>
        		<?php }
                if($rows[0]['iPlantas']=='Si'){ ?>
        		<a onclick="loadPlantasSeg()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-indiceseg',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Plantas</a>
        		<?php }
                if($rows[0]['iSoporte']=='Si'){ ?>
                    <a onclick="loadTickets()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-soporte',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Soporte</a>
                <?php }
                if($rows[0]['iLogs']=='Si'){ ?>
        		<a onclick="loadLogs()" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-large-logs',size:'large',iconAlign:'top'" style="width:100px; margin:2px;">Logs</a>
        		<?php }?>
        </div>
	</div>

    <?php if($rows[0]['iTTSTheme']=='Si'){?>
    <div data-options="region:'south',border:false" style="height:50px;background:#000000;padding:10px; text-align:center;">TTS Logistics todos los derechos reservados 2016   Tel. +52 (55) 1451 8501   E-mail: jrios@ttslogistics.com.mx</div>
    <?php } else
    if($rows[0]['iUSGTheme']=='Si'){ ?>
    <div data-options="region:'south',border:false" style="height:50px;background:#fff;padding:10px; text-align:center;">TTS Logistics todos los derechos reservados 2016   Tel. +52 (55) 1451 8501   E-mail: jrios@ttslogistics.com.mx</div>
    <?php } else {?>
        <div data-options="region:'south',border:false" style="height:50px;background:#000000;padding:10px; text-align:center;">TTS Logistics todos los derechos reservados 2016   Tel. +52 (55) 1451 8501   E-mail: jrios@ttslogistics.com.mx</div>
    <?php } ?>

	<div id="centerPanel" data-options="region:'center',title:'Center'">

	</div>
</body>
</html>