<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Solicitar Servicio</title>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
      <script src="../js/jquery.min.js"></script>
   </head>
   <body>
      <?php
         if (!isset($_GET["id_persona"])) {
         
         
         	echo '<div class="col-md-6 col-md-offset-3 alert alert-danger"><h2><b>Por favor Seleccione a una persona</b></h2></div>';
         	header ('refresh:3; url=../servicios/getListPersonas.php');
         
         }else{

         	require_once "../connect/config.php";
         	$fecha = date("Y/m/d");
         	$id_persona = $_GET["id_persona"];

			$data ="SELECT
			users.id,
			personas.id_persona,
			CONCAT(personas.nombre,' ',personas.apellido) as nombre,
			personas.direccion,
			personas.formacion,
			personas.experiencia,
			personas.celular,
			personas.email,
			barrios.nombre as barrio,
			ciudad.nombre as ciudad,
			profesion.nombre as profesion
			FROM personas
			INNER JOIN users ON users.id = personas.id
			INNER JOIN barrios ON barrios.id_barrio = personas.id_barrio
			INNER JOIN ciudad ON ciudad.id_ciudad = barrios.id_ciudad
			INNER JOIN profesion ON profesion.id_profesion = personas.id_profesion
			WHERE personas.id_persona = $id_persona";

			$result = $cn->query($data);

		      while($row = $result->fetch_assoc()) {

		          $id = $row["id_persona"];
		          $nombre = $row["nombre"];
		          $direccion = $row["direccion"];
		          $formacion = $row["formacion"];
		          $experiencia = $row["experiencia"];
		          $celular = $row["celular"];
		          $email = $row["email"];
		          $barrio = $row["barrio"];
		          $ciudad = $row["ciudad"];
		          $profesion = $row["profesion"];

		      }

         ?>
      <div class="container emp-profile">
         <form method="post">
            <div class="row">
               <div class="col-md-4">
                  <div class="profile-img">
                     <?php 
                        $/*extension = array('JPG','png','jpeg');
                        
                        foreach ($extension as $key => $value) {
                        
                        
                               $img = $id.".".$value;
                               $file = 'photos/'.$img;
                        
                               if (is_readable($file)) {
                                  /*
                                  * is_readable esta funcion sirve para validar qwue existe 
                                  * un archivo
                                  */
                                  /*echo "<img src='$file'  style=''height:200px;>";
                                }
                        }*/
                              $id_persona =$_GET["id_persona"];
      echo "hola persona numero".$id_persona;
                        ?>
                     <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="profile-head">
                     <h5>
                        <?= $nombre; ?>
                     </h5>
                     <h6>
                        <?= $fecha; ?>
                     </h6>
                     <!--<p class="proile-rating">RANKINGS : <span>8/10</span></p>-->
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Experiencia |</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tiempo Disponible</a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-2">
                  <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editar Perfil"/>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="profile-work">
                     <p>INFORMACIÓN DE CONTACTO</p>
                     <a href="">Ciudad: <?= $ciudad;?></a><br/>
                     <a href="">Barrio: <?= $barrio;?></a><br/>
                     <a href="">Celular: <?= $celular;?></a><br/>
                     <a href="">Email: <?= $email;?> </a><br/>
                     <p>INFORMACIÓN LABORAL</p>
                     <a href="">Profesión: <?= $profesion;?> </a><br/>
                     <a href="">Web Developer</a><br/>
                     <a href="">WordPress</a><br/>
                     <a href="">WooCommerce</a><br/>
                     <a href="">PHP, .Net</a><br/>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="tab-content profile-tab" id="myTabContent">
                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                           <div class="col-md-6">
                              <label>User Id</label>
                           </div>
                           <div class="col-md-6">
                              <p>Kshiti123</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Name</label>
                           </div>
                           <div class="col-md-6">
                              <p>Kshiti Ghelani</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Email</label>
                           </div>
                           <div class="col-md-6">
                              <p>kshitighelani@gmail.com</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Phone</label>
                           </div>
                           <div class="col-md-6">
                              <p>123 456 7890</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Profession</label>
                           </div>
                           <div class="col-md-6">
                              <p>Web Developer and Designer</p>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                           <div class="col-md-6">
                              <label>Experience</label>
                           </div>
                           <div class="col-md-6">
                              <p>Expert</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Hourly Rate</label>
                           </div>
                           <div class="col-md-6">
                              <p>10$/hr</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Total Projects</label>
                           </div>
                           <div class="col-md-6">
                              <p>230</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>English Level</label>
                           </div>
                           <div class="col-md-6">
                              <p>Expert</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <label>Availability</label>
                           </div>
                           <div class="col-md-6">
                              <p>6 months</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <label>Your Bio</label><br/>
                              <p>Your detail description</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
      <?php
         }
         ?>
      </script>
   </body>
</html>