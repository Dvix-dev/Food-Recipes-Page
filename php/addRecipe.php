<?php
$id = 0;
$file = file("../recetas.txt");
if ($file > 0){
    foreach ($file as $line){
        $id = explode("\t",$line)[0];
        print($id);
    }
}

$id += 1;

$name = trim(htmlspecialchars($_POST['recipeName']));
$description = htmlspecialchars($_POST['recipeDescription']);

if (isset($_POST['recipeCategory'])){
    $categories = $_POST['recipeCategory'];
    $categoriesStr = "";
    if (count($categories) > 0){
        foreach ($categories as $index => $sigleCategory) {
            $categoriesStr .= $sigleCategory;
            if ($index != count($categories) - 1){
                $categoriesStr .= ", ";
            }
        }
    }
}

$thumbnail = $_FILES['recipeThumbnail'];
$thumbnailName = $thumbnail['name'];
$thumbnailTemp = $thumbnail['tmp_name'];
$thumbnailPath = "./images/" . basename($thumbnailName);
$thumbnailDest = "../images/" . basename($thumbnailName);

$pdf = $_FILES['recipeInstructions'];
$pdfName = $pdf['name'];
$pdfTemp = $pdf['tmp_name'];
$pdfPath = "./pdfs/" . basename($pdfName);
$pdfDest = "../pdfs/" . basename($pdfName);

if (!move_uploaded_file($thumbnailTemp, $thumbnailDest)) {
    echo "Error al cargar la imagen.";
    exit;
}

if (!move_uploaded_file($pdfTemp, $pdfDest)) {
    echo "Error al cargar el archivo PDF.";
    exit;
}

$file = fopen("../recetas.txt","a");

// $newRecipe = $name . "\t" . $description . "\t" . $categoriesStr . "\t" . $thumbnailPath . "\t" . $pdfPath . "\n";
$newRecipe = $id . "\t" . $name . "\t" . $description . "\t" . $categoriesStr . "\t" . $thumbnailPath . "\t" . $pdfPath . "\n";

fwrite($file, $newRecipe);

fclose($file);

header("Location: ../index.php");
exit;