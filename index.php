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
<body style="background: black;">
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
                            <li><a class="dropdown-item" href="index.php" target="_blank">Nueva ventana</a></li>
                            <li><button data-bs-toggle="modal" data-bs-target="#abrir" class="dropdown-item">Abrir</button></li>
                            <li><button data-bs-toggle="modal" data-bs-target="#exampleModal" class="dropdown-item">Guardar</button></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="ayuda" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ayuda
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ayuda">
                            <li><a class="dropdown-item" href="#">Acerca de</a></li>
                            <li><a class="dropdown-item" href="#">Buscar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row g-1 d-flex justify-content-center mt-2" style="max-width: 100%;">
        <div class="col-3">
            <div class="card bg-dark text-white border" style="min-height:80vh;">
                <h4 class="text-center">Información Archivo</h4>
                <ul>
                    <li><b>Nombre:</b> N/A</li>
                </ul>                    
                <hr>
                <ul>                    
                    <li><b>Tipo de Archivo:</b> N/A </li>
                    <li><b>Ubicación:</b> N/A </li>
                    <li><b>Tamaño:</b> N/A </li>
                    <li><b>Tamaño en disco:</b>N/A </li>
                </ul>                    
                <hr>
                <ul>
                    <li><b>Creado:</b> N/A </li>
                    <li><b>Modificado:</b> N/A </li>
                    <li><b>Último Acceso:</b> N/A </li>
                </ul>
                <hr>
                <small><b>Precaución:</b> Todo lo que se haga en este notepad será guardado en un servidor privado. Evite colocar información sensible.</small>
            </div>
        </div>
        <div class="col-8 border">
            <textarea form="guardarForm" name="texto" id="texto" cols="30" rows="10" class="w-100 h-100 bg-dark text-white"></textarea>    
        </div>
    </div>

    <!-- Modal de Guardado -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Guardar Archivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    El archivo será guardado en la ruta que ingrese aquí (se crearán las carpetas en caso de que no existan):
                    <form id="guardarForm" action="guardar.php" method="post">
                        <input class="form-control" type="text" name="nombre_archivo" id="nombre_archivo" placeholder="Nombre del Archivo (colocar / para crear directorios y carpetas)">
                        <small><b>Ejemplo:</b> texto.txt creará un archivo con ese nombre y extensión en la raíz, carpeta/texto.txt creará una carpeta llamada carpeta y pondrá un archivo llamado texto.txt en ella.</small>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">Guardar Archivo</button>
                        </div>                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Abrir -->
    <div class="modal fade" id="abrir" tabindex="-1" aria-labelledby="abrir" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Abrir Archivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lista de Archivos:
                    <ul>
<?php
                            function escanearDirectorio($directorio_inicial, $flag){
                                $directorio = scandir($directorio_inicial);
                                foreach ($directorio as $variable) {
                                    if(!((strlen($variable) == 1 || strlen($variable) == 2) && ($variable == '.' || $variable == '..'))){
                                        // Verificar que sea un directorio
                                        if(!(str_contains($variable, '.'))){
                                            escanearDirectorio($directorio_inicial . '\\' . $variable, 1);
                                        } elseif ($flag == 0){
                                            echo '<li>';
                                            echo $variable;
                                            echo "\r\n";
                                            echo '</li>';
                                        } else{
                                            echo '<li>';
                                            echo $directorio_inicial . '\\' . $variable;
                                            echo "\r\n";
                                            echo '</li>';
                                        }
                                        
                                    }
                                }
                            }

                            escanearDirectorio(getcwd(), 0);
                        ?>
                    </ul>
                    <form id="guardarForm" action="abrir.php" method="post">
                        <input class="form-control" type="text" name="nombre_archivo" id="nombre_archivo" placeholder="Copie y pegue la ruta del archivo que desee abrir.">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">Abrir Archivo</button>
                        </div>                        
                    </form>                    
                </div>
            </div>
        </div>
    </div>

</body>
</html> 