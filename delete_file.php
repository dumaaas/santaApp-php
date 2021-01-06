<?php

    //skripta za brisanje fajla iz direktorijuma
    //ovo nije siguran nacin za brisanje, testirano u Postmanu, bilo ko moze da pogodi ime fajla i da ga automtaski izbrise iz direktorijuma
    //uradjeno samo radi testiranja rada sa fajlovima i za lakse brisanje fajlova za testiranje prikaza stranice sve_zelje.php kad nema nijedne zelje
    $db_folder = 'zelje_db';

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        if(isset($_GET['delete'])) {
            $fileName = trim($_GET['delete'], "'");
        }
        if(!unlink($db_folder.'/'.$fileName)) {
            echo ("$fileName cannot be deleted due to an error");
        } else {
            header("location: ./sve_zelje.php");
        }
    } else {
        $e = new Exception('Error', 222);
        echo '<h1>'.$e->getCode().' '.$e->getMessage().'</h1>';
    }
