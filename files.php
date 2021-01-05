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
    function readFromDB() {
        global $db_folder;
        $wishes = array();

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
                $wishes[] = $wish;
                fclose($fp);
            }

            //poziva se funkcija za sortiranje niza zelja
            usort($wishes, 'date_compare');
            return $wishes;
        }
    }

    //funkcija za sortiranje zelja od najnovije ka najstarije
    function date_compare($a, $b)
    {
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t2 - $t1;
    }
