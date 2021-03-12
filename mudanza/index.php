<!DOCTYPE html>
<html>

<head>
  <link rel=" icon" href="./img/compu.ico" type="image/x-icon">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <title>Mudanza de Equipos</title>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <nav>
    <div class="nav-wrapper amber darken-4">
      <span><a href="index.php" class="brand-logo center">Mudanza de Equipos</a></span>

    </div>
  </nav>
  <div class="container">
    <div class="row">
      <form action="index.php" method="POST" enctype="multipart/form-data">

        <?php

        //controlar el error
        error_reporting(0);
        //$_POST = array();
        $campos = array();
        $para = 'mudanzadeequipos@gmail.com';
        $asunto = 'Mudanza de Equipos - Estamos trabajando en tu solicitud';
        $opciones = "";
        $opcionesArray = array();
        $otro = "";
        $usuario = "";
        $responsable = "";
        $mailSoli = "";
        $mailResponsable = "";
        $prioridad = "";
        $textoPrioridad = "";
        $ubicacion = "";
        $celular = "";
        $retira = "";
        $respuestaSi = "";
        $respuestaNo = "";

        if (isset($_POST['usuario'])) {

          //validaciones
          if (isset($_POST['group1'])) {
            $prioridad = $_POST['group1'];
          }

          if (isset($_POST['opciones'])) {
            $opcionesArray = $_POST['opciones'];
            $opciones = implode('<br>', $_POST['opciones']);
          } else {
            $opcionesArray = [];
          }

          $otro = $_POST['otro'];
          $usuario = $_POST['usuario'];
          $responsable = $_POST['responsable'];
          $mailSoli = $_POST['mailSoli'];
          $mailResponsable = $_POST['mailResponsable'];

          $textoPrioridad = $_POST['textoPrioridad'];
          $ubicacion = $_POST['ubicacion'];
          $celular = $_POST['celular'];

          if (isset($_POST['retira'])) {
            $retira = $_POST['retira'];
          }
          $respuestaSi = $_POST['respuestaSi'];
          $respuestaNo = $_POST['respuestaNo'];

          if ($opciones == "") {
            array_push($campos, "Selecciona al menos un dispositivo");
          }

          if ($prioridad == "") {
            array_push($campos, "Selecciona al menos tipo de Prioridad");
          }

          if ($retira == "") {
            array_push($campos, "Selecciona si retira equipo");
          }

          if (count($campos) > 0) {
            echo "<div class='col l10 card-panel red darken-4 offset-l1'>";
            for ($i = 0; $i < count($campos); $i++) {
              echo "<p>" . $campos[$i] . "</p>";
            }
          } else {
            echo "<div class='col l10 card-panel green accent-3 offset-l1'>";
            echo "<p>Datos Correctos</p>";
          }
          echo "</div>";



          $contenido = "<h3>Tu solicitud de Mudanza de Equipo se registro correctamente, a la brevedad le estaremos brindando gestión.<br>Saluda <br>Atte.
          <br>Mesa de Ayuda</h3>
    
          <table class=\"striped\">
                
                  <tbody>
                    <tr>
                      <td><h4>Selecciona de la siguiente lista los dispositivos <br>que necesitas que sean reubicados:</h4></td>
                      <td>" . $opciones . "<br>" . $otro . "</td>
                    </tr>
                    <tr>
                      <td><h4>Nombre y Apellido del usuario solicitante:</h4></td>
                      <td>" . $usuario . "</td>
                    </tr>
                    <tr>
                      <td><h4>Nombre y Apellido del Responsable Autorizante:</h4></td>
                      <td>" . $responsable . "</td>
                    </tr>
                    <tr>
                      <td><h4>Email de usuario solicitante:</h4></td>
                      <td>" . $mailSoli . "</td>
                    </tr>
                    <tr>
                      <td><h4>Email de Responsable solicitante:</h4></td>
                      <td>" . $mailResponsable . "</td>
                    </tr>
                    <tr>
                      <td><h4>Indique Prioridad:</h4></td>
                      <td>" . $prioridad . "</td>
                    </tr>
                    <tr>
                      <td><h4>Ubicación física del equipo:</h4></td>
                      <td>" . $ubicacion . "</td>
                    </tr>
                    <tr>
                      <td><h4>Celular de contacto:</h4></td>
                      <td>" . $celular . "</td>
                    </tr>
                    <tr>
                      <td><h4>Retira el usuario?</h4></td>
                      <td>" . $retira . "</td>
                    </tr>
                    <tr>
                      <td><h4>\nSi la respuesta anterior fue \"SI\" indicanos nombre,<br>
                      apellido y DNI de quien retira (si fue \"NO\" indique \"NO APLICA\").<br>
                      Estos datos serán verificados para validar la identidad al momento de<br>
                        retirar el equipo :</h4></td>
                      <td>" . $respuestaSi . "</td>
                    </tr>
                    <tr>
                      <td><h4>Si la respuesta anterior fue \"NO\" indicanos la dirección del envío<br> 
                      (si fue \"SI\" indique \"NO APLICA\"):</h4></td>
                      <td>" . $respuestaNo . "</td>
                    </tr>
                  </tbody>
                </table>";
          $enviar = $_POST['btnEnviar'];
        }
        if (isset($_POST['usuario'])) {

          if (count($campos) == 0) {

            //recorremos el arrays de archvivos y enviamos de a uno por el indice en la clave


            $nameFile = $_FILES['archivo']['name'];
            $sizeFile = $_FILES['archivo']['size'];
            $typeFile = $_FILES['archivo']['type'];
            $tempFile = $_FILES["archivo"]["tmp_name"];


            // -> mensaje en formato Multipart MIME
            $cabecera = "MIME-VERSION: 1.0\r\n";
            $cabecera .= "Content-type: multipart/mixed;";
            $cabecera .= "boundary=\"=C=T=L=\"\r\n";
            $cabecera .= "From: {$para}" . "\r\n";
            //$cabeceras .= "To: {$mailSoli}" . "\r\n";

            //Primera parte del mensaje (texto plano)
            //    -> encabezado de la parte
            $mensaje = "--=C=T=L=\r\n";
            $mensaje .= "Content-type: text/html; charset=iso-8859-1\r\n";
            //$mensaje .= "charset=utf-8\r\n";
            //$mensaje .= "Content-Transfer-Encoding: 8bit\r\n";
            $mensaje .= "\r\n"; // línea vacía
            $mensaje .= $contenido;

            $mensaje .= "\r\n"; // línea vacía


            // -> segunda parte del mensaje (archivo adjunto)
            //    -> encabezado de la parte
            $mensaje .= "--=C=T=L=\r\n";
            $mensaje .= "Content-Type: application/octet-stream; ";
            $mensaje .= "name=" . $nameFile . "\r\n";
            $mensaje .= "Content-Transfer-Encoding: base64\r\n";
            $mensaje .= "Content-Disposition: attachment; ";
            $mensaje .= "filename=" . $nameFile . "\r\n";
            $mensaje .= "\r\n"; // línea vacía


            $fp = fopen($tempFile, "rb");
            $file = fread($fp, $sizeFile);
            $file = chunk_split(base64_encode($file));

            $mensaje .= "$file\r\n";
            $mensaje .= "\r\n"; // línea vacía

            $mensaje .= "--=C=T=L=--\r\n";

            if (isset($enviar)) {

              if (mail($para . ', ' . $mailSoli . ', ' . $mailResponsable, $asunto, $mensaje, $cabecera)) {
                header("Status: 301 Moved Permanently");
                header("Location:enviado.php");
                echo "<script language='javascript'>window.location='enviado.php'</script>;";
                exit();
              } else {
                echo "no se envio";
              }
            }
          }
        }

        ?>



        <div class="col l10 m12 s12 card-panel  amber darken-2 offset-l1">
          <div class="col l12">
            <h6>A continuación te solicitamos que nos brindes unos datos para poder gestionar tu pedido.
              <br><br>
              El nombre y la foto asociados a tu cuenta de Google se registrarán cuando subas archivos
              y envíes este formulario.<br><br>
            </h6>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 ">
            <h6>Selecciona de la siguiente lista los dispositivos que necesitas que sean reubicados:</h6>

            <p>
              <input type="checkbox" id="test5" name="opciones[]" value="CPU" <?php if (in_array("CPU", $opcionesArray)) {
                                                                                echo "checked";
                                                                              } ?>>
              <label for="test5">CPU</label>
            </p>
            <p>
              <input type="checkbox" id="test6" name="opciones[]" value="MONITOR" <?php if (in_array("MONITOR", $opcionesArray)) {
                                                                                    echo "checked";
                                                                                  } ?> />
              <label for="test6">MONITOR</label>
            </p>
            <p>
              <input type="checkbox" id="test7" name="opciones[]" value="MOUSE" <?php if (in_array("MOUSE", $opcionesArray)) {
                                                                                  echo "checked";
                                                                                } ?> />
              <label for="test7">MOUSE</label>
            </p>
            <p>
              <input type="checkbox" id="test8" name="opciones[]" value="TECLADO" <?php if (in_array("TECLADO", $opcionesArray)) {
                                                                                    echo "checked";
                                                                                  } ?> />
              <label for="test8">TECLADO</label>
            </p>
            <p>
              <input type="checkbox" id="test9" name="opciones[]" value="VINCHA" <?php if (in_array("VINCHA", $opcionesArray)) {
                                                                                    echo "checked";
                                                                                  } ?> />
              <label for="test9">VINCHA</label>
            </p>
            <p>
              <input type="checkbox" id="test10" name="opciones[]" value="NOTEBOOK" <?php if (in_array("NOTEBOOK", $opcionesArray)) {
                                                                                      echo "checked";
                                                                                    } ?> />
              <label for="test10">NOTEBOOK</label>
            </p>
            <p>
              <input type="checkbox" id="test11" name="opciones[]" value="OTRO" <?php if (in_array("OTRO", $opcionesArray)) {
                                                                                  echo "checked";
                                                                                } ?> />
              <label for="test11">OTRO:</label>
            <div class="input-field">
              <input name="otro" type="text" class="validate">
              <label class="active" for="otro"></label>
            </div>
            </p>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field">
              <h6>Nombre y Apellido del usuario solicitante:</h6>
              <input name="usuario" type="text" class="validate" required>
              <label class="active" for="usuario"></label>
            </div>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field col s12">
              <h6>Nombre y Apellido del Responsable Autorizante: </h6>
              <input name="responsable" type="text" class="validate" required>
              <label class="active" for="responsable"></label>
            </div>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field col s12">
              <h6>Email de usuario solicitante</h6>
              <input name="mailSoli" type="email" class="validate" required>
              <label class="active" for="mailSoli"></label>
            </div>

            <div class="input-field col s12">
              <h6>Email de Responsable Autorizante</h6>
              <input name="mailResponsable" type="email" class="validate" required>
              <label class="active" for="mailResponsable"></label>
            </div>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">
            <h6>Indique Prioridad </h6>
            <p>
              <input class="with-gap" name="group1" value="Alta" type="radio" id="test1" <?php if ($prioridad == "Alta") {
                                                                                            echo "checked";
                                                                                          } ?> />
              <label for="test1">Alta</label>
            </p>
            <p>
              <input class="with-gap" name="group1" value="Media" type="radio" id="test2" <?php if ($prioridad == "Media") {
                                                                                            echo "checked";
                                                                                          } ?> />
              <label for="test2">Media</label>
            </p>
            <p>
              <input class="with-gap" name="group1" value="Baja" type="radio" id="test3" <?php if ($prioridad == "Baja") {
                                                                                            echo "checked";
                                                                                          } ?> />
              <label for="test3">Baja</label>
            </p>
            <br>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field col s12">
              <h6>En caso de seleccionar ALTA, indicar las tareas que la justifican
                y la fecha comprometida</h6>
              <textarea name="textoPrioridad" class="materialize-textarea"></textarea>
              <label for="textoPrioridad"></label>
            </div>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field">
              <h6>Ubicación física del equipo:</h6>
              <input name="ubicacion" type="text" class="validate" required>
              <label class="active" for="ubicacion"></label>
            </div>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">
            <h6>Adjuntar mapa o croquis</h6>
            <div class="file-field input-field">
              <div class="btn amber darken-4">
                <span>Archivo</span>
                <input type="file" name="archivo" multiple>
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>
        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field">
              <h6>Celular de contacto:</h6>
              <input name="celular" type="text" class="validate" required>
              <label class="active" for="celular"></label>
            </div>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">
            <h6>Retira el usuario?</h6>
            <p>
              <input class="with-gap" name="retira" type="radio" value="Si" id="test4" <?php if ($retira == "Si") {
                                                                                          echo "checked";
                                                                                        } ?> />
              <label for="test4">Si</label>
            </p>
            <p>
              <input class="with-gap" name="retira" type="radio" value="No" id="test20" <?php if ($retira == "No") {
                                                                                          echo "checked";
                                                                                        } ?> />
              <label for="test20">No</label>
            </p>
            <br>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field">
              <h6>Si la respuesta anterior fue "SI" indicanos nombre, apellido y
                DNI de quien retira (si fue "NO" indique "NO APLICA").
                Estos datos serán verificados para validar la identidad
                al momento de retirar el equipo :</h6>
              <input name="respuestaSi" type="text" class="validate" required>
              <label class="active" for="respuestaSi"></label>
            </div>
          </div>

        </div>

        <div class="col l10 m12 s12 card-panel amber darken-2 offset-l1">
          <div class="col l12 s12">

            <div class="input-field">
              <h6>Si la respuesta anterior fue "NO" indicanos la
                dirección del envío (si fue "SI" indique "NO APLICA"):
              </h6>
              <input name="respuestaNo" type="text" class="validate" required>
              <label class="active" for="respuestaNo"></label>
            </div>
          </div>
        </div>



    </div>

    <div class="input-field col  s12 ">
      <button class="btn waves-effect waves-light  amber darken-4" type="submit" name="btnEnviar">Enviar
      </button>

    </div>
    <br>
    <br>

    </form>
  </div>

  </div>

  <footer class="page-footer grey darken-4">

    <div class="footer-copyright">
      <div class="container center"><a href="http://www.luisprado.ml/" target="_blank">© Copyright 2021 - Luis Prado Desarrollador Web</a>

        <a class="grey-text text-lighten-4 right" href="#!"></a>
      </div>
    </div>
  </footer>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/animaciones.js"></script>
</body>

</html>