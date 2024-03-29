<?php 
    require '../config/Conexion_MTD.php';
    
    $por_pagina=4;
    
    if(isset($_GET['pagina'])){
        $pagina=$_GET['pagina'];
    }else{
        $pagina= 1;
    }
    
    $empieza=($pagina-1)*$por_pagina;
    
    $query = "SELECT ID_titulo, enlace, titulo, categoria, Year(fecha) ,Month(fecha), Day(fecha), descripcion FROM dtblog LIMIT $empieza, $por_pagina";


    if(isset($_POST['buscar'])){
        $q=$_POST['busqueda'];
        $query="SELECT ID_titulo, enlace, titulo, categoria, Year(fecha) ,Month(fecha), Day(fecha), descripcion FROM dtblog 
                    WHERE  titulo LIKE '%".$q."%' OR Month(fecha) LIKE '%".$q."%' OR categoria LIKE '%".$q."%'
                        LIMIT $empieza, $por_pagina";
    }

    $resultado= $conexion->query($query);

    if($resultado->num_rows > 0){
        
        $resultado= $conexion->query($query);
        ?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../public/css/main_b.css">
    <link rel="stylesheet" href="../public/css/normalize.css">
    <title>Container</title>
</head>
<body>
    <div class="container">
        <header class="header">
            <!-- contenedor -->
            <div class="container_header">
                <!-- logo -->
                <figure class="logo">
                    <img src="../public/img/Blanco800x346.png" alt="logo">
                </figure>
                <!-- nav -->
                <nav class="menu">
                    <ul>
                        <li><a class="cool-link" href="../vistas/index.php">Inicio</a></li>
                        <li><a class="cool-link" href="../vistas/core.php">Core</a></li>
                        <li><a class="cool-link" href="../vistas/eventos.php">Eventos</a></li>
                        <li><a class="cool-link" href="../vistas/blog.php">Blogs</a></li>
                        <li><a class="button-link" href="#">Conocenos</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <section class="post">
        <?php while ($row = $resultado->fetch_assoc()){ ?>
            <article class="post-preview">
                <figure class="miniature-preview">
                    <a href="../vistas/blogseleccionado.php?ID_titulo=<?php echo $row['ID_titulo']; ?>">
                        
                        <img src="https://img.youtube.com/vi/<?php echo $row['enlace'];?>/maxresdefault.jpg" alt="">
                    </a>
                </figure> 
                <div class="content-preview">
                    <a href="../vistas/blogseleccionado.php?ID_titulo=<?php echo $row['ID_titulo']; ?>"><?php echo $row['categoria']; ?></a>
                    <h2><?php echo $row['titulo']; ?></h2>
                    <p>Publicado el&nbsp;<span><?php require 'FechaB.php'; ?></span></p>
                    <p class="content-p"><?php echo $row['descripcion']; ?></p>
                    <div class="others-preview">
                        <figure class="perfil-post">
                            <img src="../public/img/perfil_core2.jpg" alt="">
                        </figure>
                        <a class="name-perfil" href="#">Daniela Galindo Maldonado</a>
                        <div class="icon-preview">
                            <i class="far fa-heart"></i>
                            <span class="heart-number">23</span>
                            <i class="fas fa-comment"></i>
                            <span class="comment-number">12</span>
                        </div>
                    </div>
                </div>
            </article>
            <?php   }?> 
        </section>
        <aside class="aside">
            <div class="container-search">
                <h3>Búsqueda</h3>
                <div class="container-align">
                    <form action="../modelos/BlogB.php" method="POST">
                        <input name="busqueda" id="busqueda" type="search" class="search" placeholder="Buscar por ..." value="">
                        <input type="submit" name="buscar" id="buscar" class="buscar"  name="buscar" value="Go!">
                    </form>
                </div>
            </div>
            <div class="container-aside">
                <div class="line-aside"></div>
                <h3>Lo más leido</h3>
                <article class="blog-post">
                    <figure class="miniature">
                        <img src="../public/img/blog_post1.png" alt="">
                    </figure>
                    <p class="content-post">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </article>
                <article class="blog-post">
                    <figure class="miniature">
                        <img src="../public/img/blog_post1.png" alt="">
                    </figure>
                    <p class="content-post">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </article>
                <article class="blog-post">
                    <figure class="miniature">
                        <img src="../public/img/blog_post1.png" alt="">
                    </figure>
                    <p class="content-post">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </article>
                <article class="blog-post">
                    <figure class="miniature">
                        <img src="../public/img/blog_post1.png" alt="">
                    </figure>
                    <p class="content-post">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                </article>
            </div>
            <div class="container-categories">
                <div class="tag-categories">Categorías</div>        
                <div class="background-categories">
                    <div class="items-categories">
                        <a href="">Web Design</a>
                        <a href="">Visual Studio</a>
                        <a href="">HTML5</a>
                        <a href="">JavaScript</a>
                        <a href="">Azure</a>
                        <a href="">CSS3</a>
                    </div>
                </div>            
            </div>
        </aside>
        
        <footer class="footer">
            <!-- logo -->
            <figure class="logo_footer">
                    <img src="../public/img/Blanco800x346.png" alt="logo">
                </figure>
                <div class="info_footer">
                    <p>Design with 💕by 
                        <a href="#">@DanPipa</a>
                        <a href="#">@Karlxs</a>
                        <a href="#">@TheJeus</a>
                        <a href="#">@Arnolín</a>
                    </p>
                </div>
        </footer>
    </div>
</body>
</html>              
    <?php }else{
        
    }   
?>