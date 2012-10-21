<?php
function Conecta()
{
if (!($link=mysql_connect("localhost","nombreusuario","miclave")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db("Basededatos",$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link; 	
}

function frase_random () {
	$query = mysql_query("select * from frase") or die(mysql_error());
	$i = 0;
	while ($fila = mysql_fetch_array($query)){
		$array[$i] = $fila;
		$i++;
	}
	//$array_tablafrase=mysql_fetch_array($query);
	$tamaño = count($array);
	//return $tamaño;
	//return $array[0]['frase'];
	$valor = rand(0, $tamaño-1);
	return $array[$valor];

}


