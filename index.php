<?php
if (file_exists('source.xml')) {
    /* autre solution : 
    header('Location: /Error404.php', TRUE, 404);*/
    $xml = simplexml_load_file('source.xml'); //simplexml_load_file — Convertit un fichier XML en objet
    $pageNumberMax = count($xml->page); // La fonction count() compte les enfants d'un nœud spécifié.
    if (isset($_GET['id'])) {
        $idNumber = htmlspecialchars($_GET['id']);
        $pageNumber = intval($idNumber) - 1; //intval — Retourne la valeur numérique entière équivalente d'une variable

        // cas de figure où la page recherchée n'existe pas
        if ($pageNumber >= $pageNumberMax) {
            http_response_code(404);
            include("Error404.php");
            $pageNumber = 0;
            exit(); // on sort de ce cas de figure
        }
    } else {
        $pageNumber = 0;
    }
    $title = $xml->page[$pageNumber]->title;
} else {
    // cas de figure où le fichier XML n'existe pas
    // on définit un code de réponse 
    http_response_code(404);
    include("Error404.php"); // on exécute notre fichier Error 404
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Reem+Kufi&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title><?= $title ?></title>
</head>

<body class="bg-light">
    <nav class="navbar sticky-top navbar-light navbar-expand-lg mb-5 fs-5" style="background-color: #f7e9c5">
        <a class="navbar-brand ms-5" href="1.html">
            <img src="assets/img/logo.png" alt="logo Ocordo" width="100" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- on génère les différentes pages du site -->
        <?php
        for ($i = 0; $i < $pageNumberMax; $i++) {
            $menu = $xml->page[$i]->menu; ?>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <a class="nav-link text-dark ms-5" href="<?= $xml->page[$i]['id'] ?>.html"><?= $menu ?></a>
            </div>
        <?php
        } ?>
    </nav>
    <div class=" container content-page">
        <?= $xml->page[$pageNumber]->content; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>