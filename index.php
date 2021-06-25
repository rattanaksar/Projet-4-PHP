<?php
define('XML_SOURCE_FILE','source.xml');

// Le fichier source DOIT être accessible
if (file_exists(XML_SOURCE_FILE)) 
{
    // Si page est présent c'est que l'utilisateur à cliquer sur une option
    if (isset($_GET['page']))
    {
        $pageNumber= intval(htmlspecialchars($_GET['page']));
    } 
    else 
    {
        // C'est la première fois que le script est lancé. On prend la page d'acceuil par défaut
        $pageNumber= 0;
    }
    $xmlFile= simplexml_load_file(XML_SOURCE_FILE);
    $pageNumberMax= count($xmlFile->page);
    if ($pageNumber >= $pageNumberMax)
    {
        echo 'Numéro de page inconnu';
        exit();        
    }
    // préparons le titre de la page qui sera affiché
    $title= $xmlFile->page[$pageNumber]->title;
}
else
{
    // Oops !
    echo 'Pas de fichier source.xml';
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                for ($i = 0; $i < $pageNumberMax; $i++) 
                {
                    $menu = $xmlFile->page[$i]->menu;
                    $display= '<a class="nav-link ml-5" href="index.php?page='.$i.'">'.$menu.'</a>';
                    echo $display;
                }
            ?>        
        </nav>
        <!-- Affichage du contenu correspondant à la page souhaitée -->
        <div class="container content-page">
            <?= $xmlFile->page[$pageNumber]->content; ?>
        </div>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>
</html>