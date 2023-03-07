<?php
    $directorio = preg_split('/\//',$_POST['nombre_archivo']);
    $acc = "";
    if(count($directorio) > 1){
        foreach ($directorio as $value){
            if($acc != ''){
                $acc = $acc . '/' . $value;               
            } else{
                $acc = $value;
            }            
            if($value != $directorio[count($directorio)-1]){
                if(!is_dir($acc)){
                    mkdir($acc);
                }
            }
        }
    } else{
        $acc = $_POST['nombre_archivo'];
    }

    $fp = fopen($acc, "w+");
    fwrite($fp, $_POST['texto']);
    fclose($fp);
?>
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
                            <li><button data-bs-toggle="modal" data-bs-target="#acerca" class="dropdown-item">Acerca de</button></li>
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
                <?php
                    $datos = pathinfo($_POST['nombre_archivo']);
                ?>
                <ul>
                    <li><b>Nombre:</b> 
                    <?php
                        echo $datos['basename'];                        
                    ?>
                </li>
                </ul>                    
                <hr>
                <ul>                    
                    <li><b>Tipo de Archivo:</b>
                        <?php
                            echo $datos['extension'];
                        ?> 
                    </li>
                    <li><b>Ubicación:</b>
                        <?php
                            echo $datos['dirname'] . '\\';
                        ?>                 
                    </li>
                    <li><b>Tamaño:</b> <?php 
                        echo stat($_POST['nombre_archivo'])[7];
                    ?> bytes</li>
                </ul>                    
                <hr>
                <ul>
                    <li><b>Última Modificación:</b> 
                    <?php
                        echo date('d/m/Y H:i:s', filectime($_POST['nombre_archivo']));
                    ?>
                    </li>
                    <li><b>Último Acceso:</b> 
                    <?php
                        echo date('d/m/Y H:i:s', fileatime($_POST['nombre_archivo']));
                    ?>
                    </li>
                </ul>
                <hr>
                <div class="d-flex justify-content-center">
                    <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Texto a buscar...">
                    <button id="buscar" class="btn btn-primary">Buscar</button>
                </div>                    
                <hr>
                <small><b>Precaución:</b> Todo lo que se haga en este notepad será guardado en un servidor privado. Evite colocar información sensible.</small>
            </div>
        </div>
        <div class="col-8 border">
            <textarea form="guardarForm" name="texto" id="texto"  rows="10" class="w-100 h-100 bg-dark text-white">
<?php
                    echo file_get_contents($_POST['nombre_archivo'])
                ?></textarea>    
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
                    Lista de Carpetas: <br>
                    <?php
                        function escanearCarpetas($directorio_inicial){
                            $directorio = scandir($directorio_inicial);
                            foreach ($directorio as $variable) {
                                if(!($variable[0] == '.'))
                                if(!(($variable == '.' || $variable == '..'))){
                                    // Verificar que sea un directorio
                                    if(!(strpos($variable, '.'))){
                                        echo "<ul>";
                                        echo '<li><a href="#" class="carpeta" data="' . $directorio_inicial . '/' . $variable . '/' . '">';
                                        echo $variable;
                                        echo '</a></li>';
                                        escanearCarpetas($directorio_inicial . '/' . $variable);
                                        echo '</ul>';
                                    }
                                    
                                }
                            }
                        }

                        escanearCarpetas('.');
                    ?>
                    El archivo será guardado en la ruta que ingrese aquí (se crearán las carpetas en caso de que no existan):
                    <form id="guardarForm" action="guardar.php" method="post">
                        <input class="form-control" pattern="(^[a-zA-Z0-9_.\-\(\)])([a-zA-Z0-9_.\-\(\)\/\\])+\.(.[\w]+)$" type="text" name="nombre_archivo" id="nombre_archivo" placeholder="Dirección del Archivo (colocar / para crear directorios y carpetas)">
                        <small><b>Ejemplo de rutas válidas:</b> texto.txt creará un archivo con ese nombre y extensión en la raíz, carpeta/texto.txt o ./carpeta/texto.txt creará una carpeta llamada carpeta y pondrá un archivo llamado texto.txt en ella.</small>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">Guardar Archivo</button>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Acerca -->
    <div class="modal fade" id="acerca" tabindex="-1" aria-labelledby="acerca" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acercalabel">Acerca De</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Este bloc de notas fue creado por Diego Faria para la asignatura "Programación Web". <br>

                    El desarrollo fue empezado el 2 de marzo y finalizado el 8 de marzo.
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
                            function escanearDirectorio($directorio_inicial, $flag, $acc){
                                $directorio = scandir($directorio_inicial);
                                foreach ($directorio as $variable) {
                                    if(!($variable[0] == '.'))
                                    if(!(($variable == '.' || $variable == '..'))){
                                        // Verificar que sea un directorio
                                        if(!(strpos($variable, '.'))){
                                                escanearDirectorio($directorio_inicial == './' ? $directorio_inicial . $variable : $directorio_inicial . '/' . $variable, 1, $acc != './' ? $acc . '/' . $variable : $acc . $variable);
                                        } elseif ($flag == 0 and file_exists($variable)){
                                            echo '<li><a href="#" class="archivo">';
                                            echo $variable;
                                            echo '</a></li>';
                                        } elseif(file_exists($acc. '/' . $variable)){
                                            echo '<li><a href="#" class="archivo">';
                                            echo $acc . '/' . $variable;
                                            echo '</a></li>';
                                        } else{
                                        	echo "error";
                                        }
                                        
                                    }
                                }
                            }

                            escanearDirectorio('./', 0, './');
                        ?>
                    </ul>
                    <form id="guardarForm" action="abrir.php" method="post" class="a">
                        <input class="form-control" type="text" name="nombre_archivo" id="nombre_archivo2" placeholder="Dé click en el archivo que desea abrir.">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit" id="abrirarch">Abrir Archivo</button>
                        </div>                        
                    </form>                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="crossorigin="anonymous"></script>
    <script>
        $(document).ready(() => {
            let lastIndex = 0;
            $('.archivo').click((e) => {
                console.log("A");
                $('#nombre_archivo2').val($(e.target).text());
            });

            $('form.a').submit(() => {
                if($('.archivo').toArray().some((e) => {console.log($(e).text()); return $(e).text() == $('#nombre_archivo2').val();})){
                    return true;
                } else{
                    console.log($('.archivo').toArray());
                    alert("La dirección no coincide con ninguna de las registradas.");                  
                    return false;
                }
            });

            $('#buscar').click(() => {
                let indice = $('#texto').val().indexOf($('#busqueda').val());
                if(indice == -1){
                    alert("No hay coincidencias");
                } else{
                    if(lastIndex >= indice && lastIndex != $('#texto').val().length)
                        if($('#texto').val().slice(lastIndex+$('#busqueda').val().length).indexOf($('#busqueda').val()) != -1)
                            indice = lastIndex + $('#texto').val().slice(lastIndex+$('#busqueda').val().length).indexOf($('#busqueda').val()) + $('#busqueda').val().length;
                    
                    $('#texto').prop('selectionEnd', indice);
                    $('#texto').prop('selectionStart', indice);
                    lastIndex = indice;
                    $('#texto').focus();
                }
                return false;
            });

            $('#texto').blur(() => {
                lastIndex = $('#texto').prop("selectionEnd");
            });

            $('.carpeta').click((e) => {
                console.log("AAAA");
                console.log($(e.target).attr('data'));
                $('#nombre_archivo').val($(e.target).attr('data'));
            });

            $('#texto').focus(() => {
                lastIndex = $('#texto').prop("selectionEnd");
            });
        });       
    </script>
</body>
</html> 