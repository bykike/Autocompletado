<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AutoCompletar con jQuery, PHP y MySQL</title>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery-ui.js" type="text/javascript"></script>
<link href="jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
<script>

<?php

$con = mysql_connect("localhost", "", "") or  
    	die("Sin conexión: " . mysql_error());  
	mysql_select_db("");

$sql = "select razon from clientes order by razon";
$res = mysql_query($sql);
$arreglo_php = array();
if(mysql_num_rows($res)==0)
   array_push($arreglo_php, "No hay datos");
else{
  while($palabras = mysql_fetch_array($res)){
    array_push($arreglo_php, $palabras["razon"]);
  }
}
?>

  $(function(){
    var autocompletar = new Array();
    <?php 
     for($p = 0;$p < count($arreglo_php); $p++){ //count para saber cuantos elementos hay ?>
       autocompletar.push('<?php echo $arreglo_php[$p]; ?>');
     <?php } ?>
     $("#buscar").autocomplete({ //ID de la caja de texto donde lo queremos
       source: autocompletar //indicamos que nuestra fuente es el arreglo
     });
  });
</script>


<style>
a{
	text-decoration: none;
	color: #930;
}
a:hover{
	background-color: #930;
	color: #FFF;
}
</style>
</head>
<body>


<div style="margin: 40px auto; width: 400px; text-align: center; height: 200px; background-color: #F7F7F7; font-family: Verdana, Geneva, sans-serif;">
<h2>Autocompletar</h2>
<p>Escribir hasta que aparezcan los datos seleccionables</p>
<p><input type="text" id="buscar" /></p>
</div>
</body>
</html>