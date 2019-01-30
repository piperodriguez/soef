<?php
  /**
 * Autor: Rodrigo Chambi Q.
 * Mail:  filvovmax@gmail.com
 * web:   www.gitmedio.com
 * Paginador datos para PHP y Mysql, HTML5
 */
$CantidadMostrar=5;
//Conexion  al servidor mysql
require("../../../connect/config.php");
                    // Validado  la variable GET
    $compag         =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag']; 
	$TotalReg       =$cn->query("SELECT * FROM barrios");
	//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
	$TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
	echo "<b>La cantidad de resgistro se dividio a: </b>".$TotalRegistro." para mostrar 5 en 5<br>";
	//Consulta SQL
    $consultavistas ="SELECT
                        nombre
                        FROM
                        barrios
                        ORDER BY
                        nombre ASC
                        LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
                       // echo $consultavistas;
	$consulta=$cn->query($consultavistas);
         echo "<table><tr>><th>Nombre</th></tr>";
	while ($lista=$consulta->fetch_row()) {
	     echo "<tr><td>".$lista[0]."</td></tr>";
	}  
	    echo "</table>";
     
    /*Sector de Paginacion */
    
    //Operacion matematica para boton siguiente y atras 
	$IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
  
	echo "<ul><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">◀</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de 
    //numeros  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);
     
     //Se valida
     $Desde=($Desde<1)?1: $Desde;
     $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
     //Se muestra los numeros de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
     	//Se valida la paginacion total
     	//de registros
     	if($i<=$TotalRegistro){
     		//Validamos la pag activo
     	  if($i==$compag){
           echo "<li class=\"active\"><a href=\"?pag=".$i."\">".$i."</a></li>";
     	  }else {
     	  	echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";
     	  }     		
     	}
     }
	echo "<li class=\"btn\"><a href=\"?pag=".$IncrimentNum."\">▶</a></li></ul>";
  

?>

    <style type="text/css">
    table{
        width: 450px;
    }
    table th{
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+0,2989d8+50,7db9e8+100 */
background: rgb(30,87,153); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(30,87,153,1) 0%, rgba(41,137,216,1) 50%, rgba(125,185,232,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(125,185,232,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom,  rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(125,185,232,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
color: #FFFFFF;
height: 30px;
    }
       .active > a{
        background: rgb(255,116,0); 
       }
      ul{
        margin-left: 0px;
            padding: 0px;
      } 
      ul > li{
        list-style: none;
        display: inline-block;
        margin-right:7px;
      }
      ul > li > a {
        color: #FFFFFF;
        text-decoration: none;
        padding: 5px 10px 5px 10px;
        display: block;
        background: #1e5799; /* Old browsers */
        border-radius: 20px;

      }
      .btn > a{
        padding: 2px;
        background: #1e5799; /* Old browsers */
         border-radius: 2px;
         text-align: center;
         width:30px;
      }
      table{
        border: solid 1px #7E7C7C;
        border-collapse: collapse;
      }
td , th{
        border: solid 1px #7E7C7C;
        padding: 2px;
        text-align: center;
      }
    </style>