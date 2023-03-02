<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        Título: Web NotePad (Actividad 3)    
        Autor: Diego Faria V-29.714.067
        Cátedra: Programación Web (N1013)
        Empezado: 01/03/2023
        Finalizado: 08/03/2023
    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotePad - Diego Faria N1013</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">NotePad</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="archivo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Archivo
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="archivo">
                            <li><a class="dropdown-item" href="#">Nuevo</a></li>
                            <li><a class="dropdown-item" href="index.php/" target="_blank">Nueva ventana</a></li>
                            <li><a class="dropdown-item" href="#">Abrir...</a></li>
                            <li><a class="dropdown-item" href="#">Guardar</a></li>
                            <li><a class="dropdown-item" href="#">Guardar como...</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="edicion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Edición
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="edicion">
                            <li><a class="dropdown-item" href="#">Deshacer</a></li>
                            <li><hr></li>
                            <li><a class="dropdown-item" href="index.php/" target="_blank">Cortar</a></li>
                            <li><a class="dropdown-item" href="#">Copiar</a></li>
                            <li><a class="dropdown-item" href="#">Pegar</a></li>
                            <li><a class="dropdown-item" href="#">Eliminar</a></li>
                            <li><hr></li>
                            <li><a class="dropdown-item" href="index.php/" target="_blank">Seleccionar todo</a></li>
                            <li><a class="dropdown-item" href="#">Hora y fecha</a></li>                      
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="ayuda" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ayuda
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ayuda">
                            <li><a class="dropdown-item" href="#">Acerca de</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row g-1 d-flex justify-content-center mt-2" style="max-width: 100%;">
        <div class="col-3 border">
            <div class="card bg-dark text-white" style="min-height:80vh;">
                <h4 class="text-center">Información Archivo</h4>
                <ul>
                    <li><b>Nombre:</b> </li>
                </ul>                    
                <hr>
                <ul>                    
                    <li><b>Tipo de Archivo:</b> </li>
                    <li><b>Ubicación:</b> </li>
                    <li><b>Tamaño:</b> </li>
                    <li><b>Tamaño en disco:</b></li>
                </ul>                    
                <hr>
                <ul>
                    <li><b>Creado:</b> </li>
                    <li><b>Modificado:</b> </li>
                    <li><b>Último Acceso:</b> </li>
                </ul>
                <hr>
                <small><b>Precaución:</b> Todo lo que se haga en este notepad será guardado en un servidor privado. Evite colocar información sensible.</small>
            </div>
        </div>
        <div class="col-8 border">
            <textarea name="texto" id="texto" cols="30" rows="10" class="w-100 h-100 bg-dark text-white"></textarea>    
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <form class="txt-area-input" action="" method="post">
                    <div class="form-group">
                        <label class="txtLabel" for="txtName" class="form-control">Ver Archivo</label>
                        <input class="txtNameInput" type="text" name="txtName">

                        <button class="searchTxt" type="submit" name="txtSubmit1">Ver</button>
                    </div>

                    <br>

                    <textarea name="txtFile" cols="30" rows="8"><?php

                            if(isset($_POST['txtSubmit1'])){
                                
                                if($_POST['txtName'] != null){
                                    $fileName = $_POST['txtName'];
                                    $fileTrueName = $fileName.".txt";
                                    if(file_exists($fileTrueName)){

                                        $file = $fileTrueName;

                                        $current = file_get_contents($file);
                                        echo $current;

                                    }else{
                                        $errorMsg = "El archivo no existe, crealo primero.";
                                        echo $errorMsg;
                                    }

                                }

                            }
                            
                        ?>
                    </textarea>
                </form>

            </div>

        </div>

        <div class="col-md-4">
            <div class="card card-body">
                <form class="txt-area-input" action="" method="post">
                    <label class="txtLabel" for="txtName">Editar Archivo</label>
                    <input class="txtNameInput" type="text" name="txtName">

                    <button class="searchTxt" type="submit" name="txtSubmit">Editar</button>
                    <br>

                    <textarea name="txtFile" cols="30" rows="8"><?php
                    
                    if(isset($_POST['txtSubmit'])){

                        if($_POST['txtName'] != null){
                            $file = $_POST['txtName'];
                            $fileTrueName = $file.".txt";
                            $comment = $_POST['txtFile'];
                            echo "Archivo editado y guardado!";
                            file_put_contents($fileTrueName, $comment);
                        }
                    }
                    
                    ?></textarea>
                </form>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>



    <div class="col-md-8 offset-md-2">

        <div class="card card-body">
            <?php

                $errorMsg = null;
                function displayList(){
                    if ($handle = opendir(".")) {

                        while (false !== ($entry = readdir($handle))) {
                        
                            if ($entry != "." && $entry != "..") {
                        
                                echo "$entry\n <br>";
                            }
                        }
                        
                        echo "<br><br>";

                        closedir($handle);
                    }
                }

                function changeList(){
                    $path = 'carpetadeprueba';
                    if ($handle = opendir($path)) {

                        while (false !== ($entry = readdir($handle))) {
                        
                            if ($entry != "." && $entry != "..") {
                        
                                echo "$entry\n <br>";
                            }
                        }
                        
                        echo "<br><br>";

                        closedir($handle);
                    }
                }

                if (!isset($_POST['submit'])) {

                    displayList();
                    
                }

                if(isset($_POST['submit'])){
                    $folderName = $_POST['folderName'];
                    if($folderName != null){
                        if(file_exists($folderName)){
                            $errorMsg = "La carpeta ya existe!";
                            echo $errorMsg;
                        }else{
                            mkdir($folderName);
                            displayList();
                        }
                    
                    }

                    $fileName = $_POST['fileName'];
                    if($fileName != null){
                        if(file_exists($fileName.".txt")){
                            $errorMsg = "El archivo ya existe!";
                            echo $errorMsg;
                        }else{
                            $createFile = fopen("$fileName.txt", "w");
                            displayList();
                        }
                        
                    }

                    
                    
                }

                if(isset($_POST['txtDone'])){
                    echo "aaaaaaaaaaaaa";
                    $comment = $_POST['txtFile'];
                    echo "$comment";
                    file_put_contents($fileTrueName, $comment);
                }

                if(isset($_POST['refresh'])){
                    require_once('reload.php');
                }

                if(isset($_POST['carpeta'])){
                    changeList();
                }

            ?>
        </div>
    </div> -->

</body>
</html> 