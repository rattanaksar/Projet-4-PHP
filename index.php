
<?php
// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
/*
SimpleXMLElement Object ( [page] => Array ( [0] => SimpleXMLElement Object ( [@attributes] => Array ( [id] => 1 ) [menu] => Accueil [title] => Accueil - Maçonnerie Ocordo [content] => SimpleXMLElement Object ( ) ) [1] => SimpleXMLElement Object ( [@attributes] => Array ( [id] => 2 ) [menu] => Qui sommes nous? [title] => En apprendre plus sur nous - Maçonnerie Ocordo [content] => SimpleXMLElement Object ( ) ) [2] => SimpleXMLElement Object ( [@attributes] => Array ( [id] => 3 ) [menu] => Nos clients témoignent [title] => Avis clients - Maçonnerie Ocordo [content] => SimpleXMLElement Object ( ) ) [3] => SimpleXMLElement Object ( [@attributes] => Array ( [id] => 4 ) [menu] => Contact [title] => Contactez nous - Maçonnerie Ocordo [content] => SimpleXMLElement Object ( ) ) ) ) 

D:\z_LaManu\website\c_2021_06_09_PHP\php_projet_commun\index.php:11:
object(SimpleXMLElement)[1]
  public 'page' => 
    array (size=4)
      0 => 
        object(SimpleXMLElement)[5]
          public '@attributes' => 
            array (size=1)
              ...
          public 'menu' => string 'Accueil' (length=7)
          public 'title' => string 'Accueil - Maçonnerie Ocordo' (length=28)
          public 'content' => 
            object(SimpleXMLElement)[6]
              ...
      1 => 
        object(SimpleXMLElement)[4]
          public '@attributes' => 
            array (size=1)
              ...
          public 'menu' => string 'Qui sommes nous?' (length=16)
          public 'title' => string 'En apprendre plus sur nous - Maçonnerie Ocordo' (length=47)
          public 'content' => 
            object(SimpleXMLElement)[6]
              ...
      2 => 
        object(SimpleXMLElement)[3]
          public '@attributes' => 
            array (size=1)
              ...
          public 'menu' => string 'Nos clients témoignent' (length=23)
          public 'title' => string 'Avis clients - Maçonnerie Ocordo' (length=33)
          public 'content' => 
            object(SimpleXMLElement)[6]
              ...
      3 => 
        object(SimpleXMLElement)[2]
          public '@attributes' => 
            array (size=1)
              ...
          public 'menu' => string 'Contact' (length=7)
          public 'title' => string 'Contactez nous - Maçonnerie Ocordo' (length=35)
          public 'content' => 
            object(SimpleXMLElement)[6]
              ...
*/
if (file_exists('source.xml')) {
    $xml = simplexml_load_file('source.xml');
    //print_r($xml);
    //var_dump($xml);
    echo "@attributes: <br>";
    foreach($xml->page[0]->attributes() as $attributName => $attributeValue) 
    {
        echo $attributName,'="',$attributeValue,"\"<br>";
    }
    //var_dump($xml->page[0]->attributes );
    echo "menu: ".$xml->page[0]->menu."<br>";
    echo "title: ".$xml->page[0]->title."<br>";
    echo "content: ".$xml->page[0]->content."<br>";
} else {
    exit('Failed to open source.xml.');
}
?>
