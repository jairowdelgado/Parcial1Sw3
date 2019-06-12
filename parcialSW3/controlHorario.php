
<!DOCTYPE html>
<?php 
    include 'materias.php';
    function crearArchivoJson($code){
         #codigo crear archivos json
       // $arr_materias = array('nombre'=> 'Jose', 'edad'=> '20', 'genero'=> 'masculino',
        //'email'=> 'correodejose@dominio.com', 'localidad'=> 'Madrid', 'telefono'=> '91000000');
        $arr_materias=crearMateriaDefecto();
        //Creamos el JSON
        $ruta ="archivosJson/";
        $json_string = json_encode($arr_materias);
        $file =$ruta.$code.".json";
        file_put_contents($file, $json_string);
    }
    
    function buscarArchivoJson($code)
    {
        #codigo para buscar archivos JSON
        $bandera=FALSE;
        $host= $_SERVER["HTTP_HOST"];
        $path  = '../parcialSW3/archivosJson/';
        // Arreglo con todos los nombres de los archivos
        $files = array_diff(scandir($path), array('.', '..')); 
        #Luego recorres el arreglo y le haces un simple explode a cada elemento
        // Obtienes tu variable mediante GET
        foreach($files as $filed){
            // Divides en dos el nombre de tu archivo utilizando el . 
            $data = explode(".", $filed);
            // Nombre del archivo
            if(!empty($data[1])){
                $fileName      = $data[0];
                // Extensión del archivo 
                $fileExtension = $data[1];

                if($fileExtension == 'json' ){
                    if($code == $fileName){
                    $bandera=TRUE;
                    // Realizamos un break para que el ciclo se interrumpa
                    break;
                    }
                }
            }
        }
        #TODO mensaje de carpeta vacia
        return $bandera;
    }

    function crearMateriaDefecto(){
       
        // Read JSON file
        $json = file_get_contents('materias.json');
       
     
        $array;
        //Decode JSON
        $materias = json_decode($json,true);
        for ($i=0; $i <= 20; $i++) { 
            # code...
            $m = Materia::createFromArray($materias[$i]);    
            $array[$i]=$m;

        }
        
        return $array;
    }

    function cargarMateriasJson($code,$semestre){
        $array;
        if (buscarArchivoJson($code)==TRUE){
            // Read JSON file
            $json = file_get_contents('./archivosJson/'.$code.'.json');
        
            $j=0;
            
            //Decode JSON
            $materias = json_decode($json,true);
            for ($i=0; $i <= 20; $i++) { 
                # code...
                $m = Materia::createFromArray($materias[$i]);
                if($m->getSemestre()==$semestre){
                    
                    //echo json_encode($m);
                    $array[$j]=$m;
                    $j++;

                }      

            }  
        }
        return $array;
    }

    function mostrarMateriasJson($code,$semestre){
        $array=cargarMateriasJson($code,$semestre);
        ?><table class="mi-table mi-table-hover"><?php

        echo '<tr  align="center">';
        echo '<td>Codigo</td>';
        echo '<td>Nombre</td>';
        
        echo'</tr>';
        $j=0;
        $color="#FFF";
        while($j<count($array)){

            if ($array[$j]->getEstadoMaterias()==0){
              $color="#908E8D";
            }
           
            ?> <tr background='<?php $color ?>'  onDblclick="this.style.background='#908E8D' <?php $v=1;?>" onclick="this.style.background='#FFF' <?php $v=0;?>" >
            <?php
            echo '<td>'.$array[$j]->getCodigo().'</td>';
            echo '<td>'.$array[$j]->getNombreMateria().'</td>';   
            ?> </tr> <?php
            $j++;

               
        }

     
    ?> </table> <?php

    }
    $v=3;
    $code=$_POST['code'];
    
    if (buscarArchivoJson($code)==FALSE){
        #crear materias
        crearArchivoJson($code);
    }
    echo "var ".$v;

?>


<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Subject control</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/EstilosPropios.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#">Universidad del Cauca</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">Semestre I</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Semestre II</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Semestre III</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contac">Semestre IV</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#conta">Semestre V</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Welcome to Subject control</h1>
      <p class="lead">This are your subjests for Systems Engineenring</p>
    </div>
  </header>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Semestre I</h2>
         
            <?php 
                mostrarMateriasJson($code,1);                    
            ?>
            
        </div>
      </div>
    </div>
  </section>

  <section id="services" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Semestre II</h2>
            <?php 
                mostrarMateriasJson($code,2);                    
            ?>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Semestre III</h2>
            <?php 
                mostrarMateriasJson($code,3);                    
            ?>
        </div>
      </div>
    </div>
  </section>

  <section id="contac">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Semestre IV</h2>
            <?php 
                mostrarMateriasJson($code,4);                    
            ?>
        </div>
        </div>
      </div>
    </section>

  <section id="conta">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>Semestre V</h2>
            <?php 
                mostrarMateriasJson($code,5);                    
            ?>
            </div>
          </div>
        </div>
      </section>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Quesada and Delgado 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="cambioColor.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

</body>




</html>
