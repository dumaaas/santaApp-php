<?php

    require "./files.php";

    //provjerimo da li je request method = POST i ukoliko nije prikazemo gresku
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $errors = array();

        //pokupimo potrebne informacije sa index.php i odmah dodamo u niz errors sve elemente koji su prazni
        isset($_POST['firstName']) && ($_POST['firstName']) != '' ? $firstName = $_POST['firstName'] : $errors += ["firstNameErr1" => "First name can not be empty!"];
        isset($_POST['lastName']) && ($_POST['lastName']) != '' ? $lastName = $_POST['lastName'] : $errors += ["lastNameErr1" => "Last name can not be empty!"];
        isset($_POST['wish']) && ($_POST['wish']) != '' ? $wish = $_POST['wish'] : $errors += ["wishErr" => "Wish can not be empty!"];
        isset($_POST['city']) && ($_POST['city']) != '' ? $wish = $_POST['city'] : $errors += ["cityErr" => "You must select city!"];
        isset($_POST['good']) && ($_POST['good']) != '' ? $good = $_POST['good'] : $errors += ["goodErr" => "You must check one option!"];

        //ukoliko firstName i lastName ne sadrze samo slova dodamo ih u niz errors
        if(!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
            $errors += ["firstNameErr" => "Only letters allowed!"];
        }
        if(!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
            $errors += ["lastNameErr" => "Only letters allowed!"];
        }

        //ukoliko imamo gresaka, vratimo se na stranicu index.php sa greskama
        //ukoliko nemamo snimimo zelju kao fajl i proslijedimo korisnika na odgovarajucu stranicu
        if(!empty($errors)) {

            //posaljemo niz gresaka kao parametar u URL-u
            header("location: ./index.php?".http_build_query($errors));

        } else {

            //napravimo asocijativni niz koji predstavlja novu zelju
            $new_wish = ['firstName' => $firstName, 'lastName' => $lastName, 'city' => $city, 'good' => $good, 'wish' => $wish, 'date' => date('d.m.Y H:i'), 'fulfilled' => 'Nope'];

            //enkodujemo ga u json string
            $json_new_wish = json_encode($new_wish);

            //dodamo zelju u tekstualni fajl u odgovarajucem folderu sa jedinstvenim naslovom (ImePrezimeWish-jedinstveniID)
            insertIntoDB(uniqid($firstName.$lastName.'Wish-'), $json_new_wish);

            //redirektujemo korisnika na zelja_poslata.html
            header("location: ./zelja_poslata.php");
        }
    } else {
        $e = new Exception('Method Not Allowed', 405);
        echo '<h1>'.$e->getCode().' '.$e->getMessage().'</h1>';
    }
