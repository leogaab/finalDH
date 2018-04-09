<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta lang="es">
        <meta name="author" content="DH, Coudeu, Baier, Gaab, Ojeda">
        <meta name="description" content="Huella Pet es tu Pet Shop amigo y lo mejor es que Online, no tenes que salir de tu casa, comprá lo que necesitas cuando queres.">
        <meta name="keywords" content="Huella Pet, pet shop, online, mascota, alimentos, perro">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Huella Pet</title>

        <link rel="stylesheet" type="text/css" href="./css/huellacss.css">
        <link href="./css/login.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    </head>

    <!-- Encabezado -->

    <body>
        <div class="container">
            <header>
        <div class="datosarribacontacto">
						<div class="dtc">
						<img src="images/iconoemail.png" alt="email"><p>ventas@huellapet.com</p>
						</div>
						<div class="dtc">
						<img src="images/iconowatsap.png" alt="email"><p>(011)1548352738</p>
						</div>
					</div>
					<div class="encabezado" id="alturaencabezado">
						<div class="logo">
							<img src="images/logo.png">
						</div>
						<nav class="navegadorprincipal">
								<ul>
									<li><a href="./index.php">Home</a></li>
									<li><a href="./registro.php">Registrate</a></li>
									
								</ul>
						</nav>
						<nav class="navegadorprincipalmobile">
		                    <div class="dropdown">
		                        <button class="dropbtn" onclick="desplegar(this)"><img src="images/logoMenu.png"></button>
		                        <div class="dropdown-content">
		                        	<a href="./index.php">Home</a>
		                            <a href="./registro.php">Registrate</a>
		                            
		                        </div>
		                    </div>
	                	</nav>
					</div>	 
            </header>

            <!-- Formulario -->
            <?php
               
			   $nombre=null;
			   $emaillogin=null;
			   $clavelogin=null;
				
				if(array_key_exists('emaillogin', $_POST) && $_POST['emaillogin']){
					
					$onlyconsonants=$_POST['emaillogin'];
					$nombreUsuario = str_replace(".", "", $onlyconsonants);
					$ext=".json";
					$nombreArchivoUsuario=$nombreUsuario.$ext;
					$ruta = dirname(__FILE__);
					$dir = $ruta."/php/".$nombreArchivoUsuario;
						
						if (file_exists($dir)) {
							$lectura=file_get_contents($dir);
							$mostrar = json_decode($lectura,true);
								
								if( $mostrar["email"]==$_POST['emaillogin'] ){
									if((array_key_exists('clavelogin', $_POST) && $_POST['clavelogin'])){
											
										$hash1 = $mostrar["clave"];
										$hash2 = $_POST["clavelogin"];
										if(password_verify($hash2, $hash1)){
											$_SESSION["nombre"] = $mostrar["nombre"];
											$_SESSION["apellido"] = $mostrar["apellido"];
											$_SESSION["email"] = $_POST["emaillogin"];
											$_SESSION["nacionalidad"] = $mostrar["nacionalidad"];
											$_SESSION["clave"] = $hasclave;
											$_SESSION["foto"] = $mostrar["foto"];
											
											header("Location:index.php");
										}elseif(!password_verify($hash1, $hash2)){ "<p>la clave es incorrecta</p>";}
									}
								}
						}elseif(!file_exists($dir)){echo "<p>Este email no esta registrado</p>"; }
				}

            ?>

            <div class="login-user">
                <h3><strong>¡Hola Pet Lover!</strong></h3>
                <form class="contact_form"  method="post">
                    <ul>
                        <li>
                          <input type="text" name="emaillogin" value='<?= array_key_exists('emaillogin', $_POST) && $_POST['emaillogin'] ? $_POST['emaillogin'] : null; ?>'
						  placeholder="Ingrese tu email" required/>
						  <?php if (array_key_exists('emaillogin', $_POST) && $_POST['emaillogin']==null ){
									echo"<p>Este dato es requerido</p>";
								}
						  ?>
                        </li>
                        <li>
                            <input type="password" name="clavelogin" value='<?= array_key_exists('clavelogin', $_POST) && $_POST['clavelogin'] ? $_POST['clavelogin'] : null; ?>' placeholder="Ingresa tu clave" required/>
							<?php if (array_key_exists('emaillogin', $_POST) && $_POST['emaillogin']==null ){
									echo"<p>Este dato es requerido</p>";
								}
						  ?>
						</li>
                        <li>
                            <label>Recordarme</label>
                            <input type="checkbox" name="remember" value="ok">
                        </li>
                    </ul>
                    <input type="submit" name="login" value="login" class="boton"><br>
              </form>
            </div>

       </div>    

  </body>

  </html>
