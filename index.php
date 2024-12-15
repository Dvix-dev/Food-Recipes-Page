<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3565/3565418.png" type="image/x-icon">
    <title>Recetas de Cocina</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<?php
    if (file_exists("recetas.txt")){
        $fp = fopen("recetas.txt","r");
    } else {
        $reciencreado = true;
        $create = fopen("recetas.txt","w");
        $fp = fopen("recetas.txt","r");
    }

    $recipes = file("recetas.txt", FILE_IGNORE_NEW_LINES);

    if (count($recipes) == 0){
        $vacio = true;
    } else {
        $vacio = false;
    }
?>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <h1>Recetas de cocina</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Recetas</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <!-- Sección principal -->
    <main>
        <div class="main-content">
            <section class="main-form-container">
                <h2>Explora y Comparte Recetas de Cocina</h2>
                <div class="buttons-container">
                    <button id="filterBtn" class="btn">Filtrar Recetas</button>
                    <button id="addRecipeBtn" class="btn">Añadir Receta</button>
                </div>
            </section>
            <hr class="separator">
            <section class="recipes">
                <h2>Recetas</h2>
                <div class="recipes-container">
                    <?php
                        if (!$vacio){
                            foreach ($recipes as $recipe){
                                $arrayRecipe = explode("\t",$recipe);
                                print ('<article class="recipe" style="background-image: url('. $arrayRecipe[4] .');">');
                                    if ($arrayRecipe[3] != ""){
                                        print('<div class="recipe-categories">');
                                            print('<div class="recipe-category"><img src="https://cdn-icons-png.flaticon.com/512/4007/4007511.png" width="20px"><span>'. $arrayRecipe[3] .'</span></div>');
                                        print('</div>');
                                    }
                                    print ('<div class="recipe-data">');
                                        print ('<h4>'. $arrayRecipe[1] .'</h4>');
                                        print ('<p>'. $arrayRecipe[2] .'</p>');
                                        print ('<a href="'. $arrayRecipe[5] .'" target="_blank"><button>Ver PDF</button></a>');
                                    print ('</div>');
                                print ('</article>');
                            }
                        } else {
                            echo ("<h3 style='margin: auto'>No hay recetas para mostrar 😵‍💫</h3>");
                        }
                    ?>
                </div>
            </section>
        </div>

        <!-- Modal para Añadir Receta -->
        <div id="addRecipeModal" class="modal">
            <div class="modal-content">
                <span id="closeModalBtn" class="close">&times;</span>
                <h2>Añadir Nueva Receta</h2>
                <form id="recipeForm" action="php/addRecipe.php" method="post" enctype="multipart/form-data">
                    <label for="recipeName">Nombre de la receta:</label>
                    <input type="text" id="recipeName" name="recipeName" required>

                    <label for="recipeDescription">Descripción breve:</label>
                    <textarea id="recipeDescription" name="recipeDescription" maxlength="60" required></textarea>

                    <label for="recipeCategory">Tipo(s):</label>
                    <div class="category-container">
                        <div class="add_category">
                            <input type="checkbox" class="recipeCategory" name="recipeCategory[]" value="Verduras"><span>Verduras</span>
                        </div>
                        <div class="add_category">
                            <input type="checkbox" class="recipeCategory" name="recipeCategory[]" value="Guisos"><span>Guisos</span>
                        </div>
                        <div class="add_category">
                            <input type="checkbox" class="recipeCategory" name="recipeCategory[]" value="Arroces"><span>Arroces</span>
                        </div>
                        <div class="add_category">
                            <input type="checkbox" class="recipeCategory" name="recipeCategory[]" value="Postres"><span>Postres</span>
                        </div>
                        <div class="add_category">
                            <input type="checkbox" class="recipeCategory" name="recipeCategory[]" value="Bebidas"><span>Bebidas</span>
                        </div>
                    </div>
                    
                    <label for="recipeThumbnail">Imagen:</label>
                    <input type="file" accept=".jpg,.png,.jpeg" id="recipeThumbnail" name="recipeThumbnail" required></input>

                    <label for="recipeInstructions">PDF Instrucciones:</label>
                    <input type="file" accept=".pdf" id="recipeInstructions" name="recipeInstructions" required></input>


                    <button type="submit" class="btn">Añadir Receta</button>
                </form>
            </div>
        </div>

        <!-- Modal para Filtrar Recetas -->
        <div id="filterModal" class="modal">
            <div class="modal-content">
                <span id="closeFilterModalBtn" class="close">&times;</span>
                <h2>Filtrar Recetas</h2>
                <form id="filterForm">
                    <label for="ingredientFilter">Nombre:</label>
                    <input type="text" id="ingredientFilter" name="ingredientFilter" placeholder="Ej. Tortilla de patatas">
                    <label for="categoryFilter">Tipo:</label>
                    <select id="categoryFilter" name="categoryFilter">
                        <option value="" disabled selected>-- Selecciona una categoria --</option>
                        <option value="verduras">Verduras</option>
                        <option value="guisos">Almuerzo</option>
                        <option value="arroces">Arroces</option>
                        <option value="postres">Postres</option>
                        <option value="bebidas">Bebidas</option>
                    </select>

                    <button type="submit" class="btn">Aplicar Filtros</button>
                </form>
            </div>
        </div>
    </main> 

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; Recetas de cocina by Dvix-dev - 2024 </p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
