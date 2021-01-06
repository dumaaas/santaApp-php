<?php
    //globalna promjenjiva direktorijuma
    $db_folder = 'zelje_db';

    //funckija za unos zelje u fajl
    function insertIntoDB($table, $value) {
        global $db_folder;

        //ukoliko direktorijum ne postoji, napravi ga
        if(!file_exists($db_folder)) {
            mkdir($db_folder);
        }

        //otvorimo fajl, upisemo zelju i zatvorimo ga
        $h = fopen($db_folder.'/'.$table.'.txt', 'a+');
        fwrite($h, $value);
        fclose($h);
    }

    //funkcija za citanje zelja
    function readFromDB($param) {
        global $db_folder;
        $wishes = array();
        $wishesGood = array();

        //ukoliko ne postoji direktorijum - prikazemo gresku
        //ukoliko postoji, pomocu funkcije scandir pronadjemo sve fajlove koji se nalaze u njemu
        if(!file_exists($db_folder)) {
            $e = new Exception('Directory not found', 222);
            exit('<h1>'.$e->getCode().' '.$e->getMessage().'</h1>');
        } else {
            //scandir pokupi dva fajla koji nam nisu potrebni (., ..), pa uz pomoc funkcije array_diff ih ne pokupimo u nas niz
            $files = array_diff(scandir($db_folder), array(".", ".."));

            //prodjemo kroz niz fajlova koji smo dobili.. svaki element tog niza predstavlja ime jednog od nasih fajlova
            foreach ($files as $file) {
                //otvaramo redom fajlove, citamo podatke iz njih, dekodiramo json i dodamo ih u niz $wishes koji koristimo kako bi prikazali tabelu svih zelja
                $fp = fopen($db_folder.'/'.$file, 'r');
                $wish_json = fread($fp, filesize($db_folder.'/'.$file));
                $wish = json_decode($wish_json, true);
                $wish += ["fileName" => $file];

                //ukoliko je korisnik izabrao 'Good' ili 'Bad' opciju u selectu dodavamo u niz $wishesGood samo zeljene elemente
                //ukoliko je tek usao na stranicu ili izabrao 'All' sve zelje se dodavaju u niz $wishes
                if($wish['good'] == $param) {
                    $wishesGood[] = $wish;
                } else {
                    $wishes[] = $wish;
                }

                fclose($fp);
            }

            //na osnovu toga da li je korisnik tek usao na stranicu ili izabrao odredjenu opciju u selectu vracemo odgovarajuce rezultate
            //poziva se funkcija za sortiranje niza zelja
            if($param == 'All') {
                usort($wishes, 'date_compare');
                return $wishes;
            } else {
                usort($wishesGood, 'date_compare');
                return $wishesGood;
            }
        }
    }

    //funkcija za sortiranje zelja od najnovije ka najstarije
    function date_compare($a, $b)
    {
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t2 - $t1;
    }
