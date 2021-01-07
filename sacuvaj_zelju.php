<?php

    require "./files.php";

    //provjerimo da li je request method = POST i ukoliko nije prikazemo gresku
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        //pokupimo potrebne informacije sa index.php
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $wish = $_POST['wish'];

        if(isset($_POST['city'])) {
            $city = $_POST['city'];
        }
        if(isset($_POST['good'])) {
            $good = $_POST['good'];
        }

        //Validacija - ukoliko neko od polja ne ispunjava trazene uslove dodamo ga u niz errors
        $errors = array();

        if(!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
            $errors += ["firstNameErr" => "Only letters allowed!"];
        }
        if(!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
            $errors += ["lastNameErr" => "Only letters allowed!"];
        }
        if(empty($city)) {
            $errors += ["cityErr" => "You must select city!"];
        }
        if(empty($wish)) {
            $errors += ["wishErr" => "Wish can not be empty!"];
        }
        if(empty($good)) {
            $errors += ["goodErr" => "You must check one option!"];
        }
        if(empty($firstName)) {
            $errors += ["firstNameErr1" => "First name can not be empty!"];
        }
        if(empty($lastName)) {
            $errors += ["lastNameErr1" => "Last name can not be empty!!"];
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
