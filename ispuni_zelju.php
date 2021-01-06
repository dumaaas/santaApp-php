<?php

//skripta za ispunjavanje zelja. Na stranici sve_zelje.php, u tabeli je dodat prikaz kojoj djeci je zelja ispunjena i kojoj nije
//ukoliko zelja nije ispunjena, u koloni action pojavljuje se opcija "strik" na ciji se klik izvrsava ova skripta
//otvorimo fajl koji mjenjamo, i zamjenimo rijec Nope kako bi znali da je zelja ispunjena
//nakon ispunjavanja zelje, vratimo korisnika na stranicu sve_zelje.php

$db_folder = 'zelje_db';

if($_SERVER['REQUEST_METHOD'] == "GET") {
    if(isset($_GET['fulfill'])) {
        $fileName = trim($_GET['fulfill'], "'");
    }

    $file = file_get_contents($db_folder.'/'.$fileName);
    $file = str_replace("Nope", "Yep", $file);
    file_put_contents($db_folder.'/'.$fileName, $file);

    header("location: ./sve_zelje.php");
} else {
    $e = new Exception('Error', 222);
    echo '<h1>'.$e->getCode().' '.$e->getMessage().'</h1>';
}
