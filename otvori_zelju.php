<?php

    //otvorimo zeljeni fajl i sacuvamo njegove podatke u promjenjivoj $wish koju koristimo da ispisemo rezultate na stranici

    $db_folder = 'zelje_db';
    if(isset($_GET['open'])) {
        $file = trim($_GET['open'],"'");
    } else {
        header("location: ./sve_zelje.php");
    }

    if(file_exists($db_folder.'/'.$file)) {
        $fp = fopen($db_folder.'/'.$file, 'r');
        $wish_json = fread($fp, filesize($db_folder.'/'.$file));
        $wish = json_decode($wish_json, true);

        fclose($fp);
    } else {
        $e = new Exception('Letter does not exist', 222);
        exit('<h1>'.$e->getCode().' - '.$e->getMessage().'</h1>');
    }

?>

<?php include('header.php'); ?>
    <div class="container">
        <img src="Images/pismo.jpg" class="letterImg" alt="ChristmasTree">
        <div class="letter-first">
            My name is <?php echo $wish['firstName'].' '.$wish['lastName'] ?>.
        </div>
        <div class="letter-second">
            I am from <?php echo $wish['city'] ?>, Montenegro.
        </div>
        <div class="letter-third">
            This year I was a <?php echo $wish['good'] ?> kid.
        </div>
        <div class="letter-fourth">
            This year I wish for <?php echo $wish['wish'] ?>!
        </div>
        <div class="letter-fifth">
            <?php echo $wish['firstName'].' '.$wish['lastName'] ?>, <?php echo $wish['date'] ?>
        </div>
        <?php if($wish['fulfilled'] == "Nope") { ?>
            <div class="letter-seventh">
                <i class="fa fa-times trash" aria-hidden="true"></i>
            </div>
        <?php } else { ?>
            <div class="letter-sixth">
                <i class="fas fa-check"></i>
            </div>
        <?php } ?>

<?php include('footer.php'); ?>
