<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="generator" content="Oaxaca Digital | www.oaxaca-digital.com" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Urielmania Challenge Phrase</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="icon" type="image/x-icon" href="images/favicon.ico" />

<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css"  href="css/colorbox.css" media="screen"/>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	
	$('#top_ten').click(function() {
	  $("#principal").slideToggle();	
	  $("#content_top").slideToggle();

	  return false;
	});
	
  });

</script>
<script src="js/jquery.colorbox.js"></script>
<script>
		$(document).ready(function(){

			$(".participa").colorbox({width:500, height:400, inline:true, href:"#participeishon"});
			$(".que_es").colorbox({width:500, height:400, inline:true, href:"#que_es"});
			$(".privacidad").colorbox({width:600, height:400, inline:true, href:"#privacidad"});
			
			
		});
	</script>
	
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-573395-21']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<div id="top_menu">
	<div id="menu_container">
    <div id="logo">
      <a href="http://urielmania.com.mx"><img src="images/logourielmania.png" alt="" width="305" height="69" /></a>
    </div>	
    <ul id="menu">
	  <li><a href="que-es.html"  class='que_es'>¿Qu&eacute; es?</a></li>
		  <li><a href="participa.html"  class='participa' >Participa</a></li>	
		  </ul>
    </div>
</div>
<div id="contenedor_top">	   	
        <div id="contenedor_middle">
          <div id="main">
          <div id="principal">
              <div id="descripcion">
                    Hola!<br /><br />
    "¡Atr&eacute;vete a <span>twittear</span> cualquiera de las frases para sumar puntos, ser el primer lugar y ganar excelentes premios!"
                </div>
              <div id="tweet">
                    Tu Tweet es:<br><br>
                    </div>
                <div id="frase">
                    <?php 
				include("conexion.php");
				Conecta();
				$hola= frase_random();
				$_SESSION['frase']= $hola[frase];
				$_SESSION['valor']= $hola[valor];
				$_SESSION['id_frase']= $hola[id_frase];
				echo $_SESSION['frase'];
				?>
                </div>
                    <div id="participa">
                    Quiero Participar!
                  </div>
                    <div id="twitter">   
                    
                    <?php
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
  echo '<div class="twitter1"><a href="./redirect.php"></a></div>';
}
else{
 echo '<div class="twitter1"><a href="./twittear.php"></a></div>';
}
?>
			<div class="twitter2"><a href="#" ></a></div>
			</div>
<br />

			</div>
            <div id="content_top">
            	<div id="column" class="left">
				<?php
					$contador = 1;
					$sql = mysql_query("SELECT * FROM participante ORDER BY puntos DESC LIMIT 0 , 5");
					while ($mostrar = mysql_fetch_array($sql)){
					if ($contador <= 5)
						{
							?>
					<div id="posicion">
                    	<div id="usuario">
							<div id="concurso">
								<div id="imagen_user">
									<img src="<?php echo $mostrar[foto_twitter ];?>" alt="" width="50" height="50" />
								</div>
								<h5 class="i<?php echo $contador;?>"><?php echo $contador;?></h5>                            
							</div>
                            <div id="info_usuario">                            	
                                <h6>@<?php echo $mostrar[usuario_twitter ];?> - <?php echo $mostrar[puntos ];?> Pts</h6>
                                <p><?php 
                                $id_participante=$mostrar[id_participante ];
                                $sql2 = mysql_query("select * from participante_frase WHERE id_participante = '$id_participante' LIMIT 0, 30 ");
                                $busqueda = mysql_fetch_array($sql2);
                                $id_frase=	$busqueda[id_frase];
                                $sql3 = mysql_query("select * from frase WHERE id_frase = '$id_frase' LIMIT 0, 30 ");
                                $frase=mysql_fetch_array($sql3);
                                echo $frase[frase];
                                ?></p>
                            </div>
						</div>
					</div>
                   	<?php
                	$contador++;
					}
				}
					?>
					 </div>
					 
                <div id="column" class="right">
                	<?php
					$contador = 1;
					$sql = mysql_query("SELECT * FROM participante ORDER BY puntos DESC LIMIT 0 , 10");
					while ($mostrar = mysql_fetch_array($sql)){
					if ($contador >= 6)
						{
							?>
                	<div id="posicion">
                    	<div id="usuario">
                   		  <div id="concurso">
                          	<div id="imagen_user">
                            <img src="<?php echo $mostrar[foto_twitter ];?>" alt="" width="50" height="50" />
                            </div>
                            <h5><?php echo $contador;?></h5>                            
                          </div>
                            <div id="info_usuario">                            	
                               <h6>@<?php echo $mostrar[usuario_twitter ];?> - <?php echo $mostrar[puntos ];?> Pts</h6>
                                <p>
                                <?php 
                                $id_participante=$mostrar[id_participante ];
                                $sql2 = mysql_query("select * from participante_frase WHERE id_participante = '$id_participante' LIMIT 0, 30 ");
                                $busqueda = mysql_fetch_array($sql2);
                                $id_frase=	$busqueda[id_frase];
                                $sql3 = mysql_query("select * from frase WHERE id_frase = '$id_frase' LIMIT 0, 30 ");
                                $frase=mysql_fetch_array($sql3);
                                echo $frase[frase];
                                
                                ?>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                            		<?php
                		}
                		$contador++;
				}
					?>
				
                </div>  
                	      	
          	</div>           
          </div>
                  
		</div>
</div>
<div id="contenedor_bottom">
<div id="top_ten"><a href="#">Top 10</a></div>
</div>
<div id="footer">
<br>
<center> <a href="http://oaxaca-digital.com/" target="_blank"><img src="images/minilogo.png" border=0></a><br>
Oaxaca Digital. 2010 | Derechos Reservados. | <a href="privacidad.html"  class='privacidad' >Políticas de Privacidad</a> </center>
</div>

<div id="opciones">
<div id="participeishon" class="op">
<h2>&iexcl;&iexcl;Participa!!</h2>

<p>
Te agrada el proyecto, o deseas participar para hacer mas grande la comunidad xD <br />
bueno, podr&iacute;as invitarnos una taza de t&eacute;, contratarnos para un proyecto
o simplemente invitar a tus amigos a usar la aplicaci&oacute;n.<br />
</p><br /><br />

<p>
<strong>&iquest;Te interesa promocionar tu marca?</strong><br />

&iexcl;Puedes hacerlo patrocinando este proyecto!
Solo m&aacute;ndanos un correo con tus datos de contacto a <a href ="mailto:ventas@oaxaca-digital.com">ventas@oaxaca-digital.com</a>  

</p>
<br /><br />
<p>
<strong>Pr&oacute;ximamente:</strong>
<ol>
<li>Participa agregando tus frases favoritas para que otros las retwitteen, gana puntos e invita a tus amigos a participar.</li>
<li>Podr&aacute;s crear tus propias aplicaciones, dandote la oportunidad de divertirte con tus amigos y/o promocionar tus sitios web</li>
</ol>
</p>
</div>

<div id="que_es" class="op">
<h2> &nbsp;¿Qu&eacute; es?&nbsp;</h2>
<strong>Concurso</strong>
<p>
El concurso es bastante simple. Debes twittear alguna de las frases que aparecen, cada una de estas frases tiene un valor asignado.
Autom&aacute;ticamente el sistema mantendr&aacute; un conteo de tus puntos por cada frase que twittees. Puedes twittear cuantas frases desees al día, pero SOLO LAS PRIMERAS 3 CUENTAN en tu puntuación.
</p>
<p>Las fechas para el concurso y entrega de premios ser&aacute;n dadas a conocer proximamente</p>
<br /><br />

<p><strong>Los Premios:</strong></p>
<ul id="premios">
<li><strong>Licencia Office 2010</strong> Adquiere una licencia para usar esta famosa suite de  Ofimática</li>
<br>
<li><strong>Licencia Panda</strong> Protege tu Sistema Operativo Windows con este estupendo antivirus</li>
<br>
<li><strong>Playera Loop</strong> Viste como todo un geek con tu playera de Pacman </li>

</ul>

</div>
<div id="privacidad" class="op">
<h2> &nbsp;Política de Privacidad&nbsp;</h2>
    	<br>
    	 	<strong>Información del usuario:</strong>

<p>
	Garantizamos la protección absoluta de los datos proporcionados por los usuarios en el Momento del OAuth.
    
	Por tal motivo, ninguno de los datos será publicado, vendido, cedido o utilizado para ningún otro propósito que no sea la actualización de su cuenta en Twitter única y exclusivamente a través del sistema.
    (tal vez te demos follow despues xD)...
    
    En el sistema solo se guardan datos publicos, por tal motivo el usuario es el único responsable de mantener la confidencialidad de su contraseña de Twitter.

</p>



<p><strong>De las modificaciones a las políticas de privacidad</strong></p>

<p>
	Se podrán realizar las modificaciones que consideremos pertinentes a esta política de privacidad  para ajustarla a servicios nuevos o mejoras que afecten al uso de la información personal proporcionada por nuestros usuarios o para adaptarla a nuevos requerimientos en materia de legislación, jurisprudencia o técnica.

	Estas actualizaciones serán publicadas mediante un anuncio en la página principal. 
 
   Si tienes alguna duda, sugerencia o comentario acerca te invitamos a ponerte en contacto con nosotros a través de nuestro correo electrÃ³nico de atención a clientes : contacto@urielmania.com.mx
</p>

</div>

</div>


</body>
</html>
