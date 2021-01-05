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

        //Validacija - ukoliko neko od polja ne ispunjava trazene uslove, redirectujemo korisnika na index.php
        if(!preg_match("/^[a-zA-Z ]*$/", $firstName) || !preg_match("/^[a-zA-Z ]*$/", $lastName) || empty($city) || empty($wish) || empty($good) || empty($firstName) || empty($lastName)) {
            header("location: ./index.php");
        } else {
            //napravimo asocijativni niz koji predstavlja novu zelju
            $new_wish = ['firstName' => $firstName, 'lastName' => $lastName, 'city' => $city, 'good' => $good, 'wish' => $wish, 'date' => date('d.m.Y H:i')];

            //enkodujemo ga u json string
            $json_new_wish = json_encode($new_wish);

            //dodamo zelju u tekstualni fajl u odgovarajucem folderu sa jedinstvenim naslovom (ImePrezimeWish-jedinstveniID)
            insertIntoDB(uniqid($firstName.$lastName.'Wish-'), $json_new_wish);

            //redirektujemo korisnika na zelja.poslata.html
            header("location: ./zelja_poslata.php");
        }
    } else {
        $e = new Exception('Method Not Allowed', 405);
        echo '<h1>'.$e->getCode().' '.$e->getMessage().'</h1>';
    }
