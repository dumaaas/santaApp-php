<?php
    require "./files.php";

    //ucitamo sve zelje preko funckije iz files.php
    //ubacena je i kategorizacija elemenata tabele po tome da li je dijete bilo dobro ili nije
    //kada korisnik tek udje u stranicu bice prikazani svi elementi tabele
    //zatim na osnovu od toga sta je izabrao salje se razliciti parametar funkciji readFromDB i dobijaju se zeljeni podaci
    if(isset($_GET['good'])) {
        $good = $_GET['good'];
    } else {
        $good = "All";
    }
    if($good == 'Good') {
        $wishes = readFromDB('Good');
    } else if($good == 'Bad') {
        $wishes = readFromDB('Bad');
    } else {
        $wishes = readFromDB('All');
    };

    ?>

<?php include('header.php'); ?>

    <div class="container">
        <p>LIST OF WISHES</p>

        <form action="sve_zelje.php" class="wish-list-form">
                <div class="form-group">
                    <select name="good" class="custom-select mr-sm-2 wish-select">
                        <option value=" " selected disabled>Choose...</option>
                            <option value="Good">
                                Good
                            </option>
                            <option value="Bad">
                                Bad
                            </option>
                            <option value="All">
                                All
                            </option>
                    </select>
                </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mb-2 wish-list-btn">Submit</button>
            </div>
        </form>

        <!-- Ukoliko folder sa zeljama nije prazan prikazemo tabelu sa zeljama -->
        <?php if(!empty($wishes)) { ?>
            <p class="total-results"> Total results: <?php echo count($wishes) ?> </p>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">City</th>
                    <th scope="col">Good?</th>
                    <th scope="col">Wish</th>
                    <th scope="col">Date</th>
                    <th scope="col">Fulfilled?</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    <!-- Prodjemo kroz sve zelje i prikazujemo informacije jedne po jedne u tabeli -->
                    <?php foreach ($wishes as $wish) { ?>
                        <tr>
                            <td><?php echo $wish['firstName']; ?></td>
                            <td><?php echo $wish['lastName']; ?></td>
                            <td><?php echo $wish['city']; ?></td>
                            <td><?php echo $wish['good']; ?></td>
                            <td><?php echo $wish['wish']; ?></td>
                            <td><?php echo $wish['date']; ?></td>
                            <?php if($wish['fulfilled'] == "Nope") { ?>
                            <td style="text-align:center;"><i class="fa fa-times trash" aria-hidden="true"></i></td>
                            <?php } else { ?>
                            <td style="text-align:center;"><i class="fas fa-check trash"></i></td>
                            <?php } ?>
                            <td style="text-align:center;">
                                <?php if($wish['fulfilled'] == "Nope") { ?>
                                    <a href="ispuni_zelju.php?fulfill='<?php echo $wish['fileName']  ?>'"
                                        <i class="fas fa-check trash"></i>
                                    </a>
                                <?php }  ?>
                                <a href="delete_file.php?delete='<?php echo $wish['fileName'] ?>'"
                                    <i class="fas fa-trash-alt trash"></i>
                                </a>
                                <a href="otvori_zelju.php?open='<?php echo $wish['fileName'] ?>'"
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <!-- Ukoliko je prazan ne prikazujemo tabelu, vec odgovarajucu poruku -->
            <img src="Images/santa.png" class="treeImg" alt="ChristmasTree">
            <p>NO NEW WISHES!</p>
        <?php } ?>

<?php include('footer.php'); ?>

