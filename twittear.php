<?php 
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
include("conexion.php");
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];
/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
/* If method is set change API call made. Test is called by default. */
//$contenido = $connection->get('users/show', array('screen_name' => 'vhstrejo'));
$contenido = $connection->get('account/verify_credentials');
//print_r($contenido);
//echo '<img src="'.$contenido->profile_image_url.'" />';
$nombre = $contenido->screen_name;
$foto = $contenido->profile_image_url;
$id_usuario = $contenido->id;
$mensaje=$_SESSION['frase'].' http://goo.gl/OTNSg' ; 
$puntos=$_SESSION['valor'];
$id_frase=$_SESSION['id_frase'];
$fecha = date("Y-m-d");
$bandera=0;
Conecta();
if($nombre) {
$sql = mysql_query("select * from participante WHERE  usuario_twitter LIKE '$nombre' LIMIT 0, 30 ");		
		if($row = mysql_num_rows($sql))
			{	
		$sql2 = mysql_query("select * from participante_frase WHERE id_participante = '$id_usuario' AND fecha = '$fecha' LIMIT 0, 30 ");	
		$row2 = mysql_num_rows($sql2);
			if($row2<3){	
				$campo = mysql_fetch_array($sql);
				$valor= $campo["puntos"] + $puntos;
				//$id_participante =$campo["id_participante"];
				$insert=mysql_query("INSERT INTO participante_frase (id_participante, id_frase, fecha) VALUES ('$id_usuario','$id_frase','$fecha')");
				mysql_query("UPDATE participante SET puntos  = '$valor' WHERE usuario_twitter ='$nombre';");
				$twitter=$connection->post('statuses/update', array('status' =>utf8_encode($mensaje)));
				$bandera=1;
					}
			 else{
				 	$twitter=$connection->post('statuses/update', array('status' =>utf8_encode($mensaje)));
					$bandera=1;
					}	
			}
		else
			{
				
		$insert=mysql_query("INSERT INTO participante_frase (id_participante, id_frase, fecha) VALUES ('$id_usuario','$id_frase','$fecha')");
		mysql_query("INSERT INTO participante (id_participante, usuario_twitter, foto_twitter , puntos) VALUES ('$id_usuario','$nombre','$foto','$puntos')");
		
		$twitter=$connection->post('statuses/update', array('status' =>utf8_encode($mensaje)));
		$bandera=1;
			}
}else{
header ("Location: index.php"); 
}
if($bandera==1)
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="generator" content="Oaxaca Digital | www.oaxaca-digital.com" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Urielmania Challenge Phrase</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta http-equiv="Refresh" content="5; url=http://urielmania.com.mx/retos/">

<link rel="icon" type="image/x-icon" href="images/logo_ico.png" />

<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

<script type="text/javascript" src="js/jquery.min.js"></script>

</head>

<body>
<div id="top_menu">
	<div id="menu_container">
    <div id="logo">
      <img src="images/logourielmania.png" alt="" width="305" height="69" />
    </div>	
    <ul id="menu">
		 
		</ul>
    </div>
</div>
<div id="contenedor_top">	   	
        <div id="contenedor_middle">
          <div id="main">
          <div id="principal">
              <div id="descripcion">
                   Gracias por participar!!<br /><br />
                   La frase ha sido twitteada con exito, sigue participando, recuerda que tienes un limite de 3 tweets contabilizados por dia, todavia tienes oportunidad de ganar! <br />
<br />
<br />

          </div>
              <div id="tweet">
                    El Tweet que enviaste fue:
        </div>
                <div id="frase">
                    "<?php echo $_SESSION['frase']; ?>"
                </div>
                    <div id="participa">
                  Seras redirigido en los proximos 5 segundos, o bien puedes dar click <a href="http://urielmania.com.mx/retos/">aqui</a></div>
                    
			</div>
                       
          </div>
                  
		</div>
</div>
<div id="contenedor_bottom">

</div>
<div id="footer">
<br>
<center> <a href="http://oaxaca-digital.com/" target="_blank"><img src="images/minilogo.png" border=0></a><br>
Oaxaca Digital. 2010 | Derechos Reservados. </center>
</div>

</body>
</html>
<?php } ?>
