<?php
    require "./files.php";

    //ucitamo sve zelje preko funckije iz files.php
    $wishes = readFromDB();

    ?>

<?php include('header.php'); ?>

    <div class="container">
        <p>LIST OF WISHES</p>

        <!-- Ukoliko folder sa zeljama nije prazan prikazemo tabelu sa zeljama -->
        <?php if(!empty($wishes)) { ?>
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
                            <td><i class="fa fa-times trash" aria-hidden="true"></i></td>
                            <?php } else { ?>
                            <td><i class="fas fa-check trash"></i></td>
                            <?php } ?>
                            <td>
                                <?php if($wish['fulfilled'] == "Nope") { ?>
                                    <a href="ispuni_zelju.php?fulfill='<?php echo $wish['fileName']  ?>'"
                                        <i class="fas fa-check trash"></i>
                                    </a>
                                <?php }  ?>
                                <a href="delete_file.php?delete='<?php echo $wish['fileName'] ?>'"
                                    <i class="fas fa-trash-alt trash"></i>
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

