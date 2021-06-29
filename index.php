<?php
if (file_exists('source.xml')) 
{
     $xml = simplexml_load_file('source.xml'); //simplexml_load_file — Convertit un fichier XML en objet
    $pageNumberMax= count($xml->page); // La fonction count() compte les enfants d'un nœud spécifié.
    $pageNumber= 0;
    $title='Ocordo';
    if (isset($_GET['id'])) 
    {
        $idNumber = htmlspecialchars($_GET['id']);
        $pageNumber= intval($idNumber) -1;
    }
    $pageNumberMax = count($xml->page); // La fonction count() compte les enfants d'un nœud spécifié.
    if ($pageNumber >= $pageNumberMax) {
        echo 'Numéro de page inconnu';
    }
    $title = $xml->page[$pageNumber]->title;
} else {
    echo 'Pas de fichier source.xml';
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title><?= $title ?></title>
</head>

<body>
    <nav class="navbar sticky-top navbar-light navbar-expand-lg mb-5 fs-5" style="background-image: linear-gradient(to right, #F09819 0%, #EDDE5D  51%, #F09819  100%);">

        <a class="navbar-brand ms-5" href="index.php?page=0">
            <img src="assets/img/logo.png" alt="logo Ocordo" width="100" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- on génère les différentes pages du site -->
        <?php
        for ($i = 0; $i < $pageNumberMax; $i++) 
        {
            $menu = $xml->page[$i]->menu; 
            ?>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <a class="nav-link text-secondary ms-5" href="<?= $xml->page[$i]['id'] ?>.html"><?= $menu ?></a>
            </div>
        <?php
        } 
        ?>
    </nav>
    <div class=" container content-page">
        <?= $xml->page[$pageNumber]->content; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>