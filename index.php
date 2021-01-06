<?php include('header.php'); ?>

<?php
    $cities = ['Andrijevica', 'Bar', 'Berane', 'Bijelo Polje', 'Budva', 'Cetinje', 'Danilovgrad', 'Herceg Novi', 'Kolašin', 'Kotor',
        'Mojkovac', 'Nikšić', 'Plav', 'Plužine', 'Pljevlja', 'Podgorica', 'Šavnik', 'Tivat', 'Ulcinj', 'Žabljak'];
?>

<div class="container">
        <p>MAKE A WISH</p>

        <div class="row">
            <div class="col-sm wish">
                <form action="sacuvaj_zelju.php" method="POST" class="wish-form">
                    <div class="form-group">
                        <label>FIRST NAME</label>
                        <input type="text" name="firstName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>LAST NAME</label>
                        <input type="text" name="lastName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="mr-sm-2">CITY</label>
                        <select name="city" class="custom-select mr-sm-2">
                            <option value=" " selected disabled>Choose...</option>
                            <?php foreach ($cities as $city) { ?>
                                <option value="<?php echo $city; ?>">
                                    <?php echo $city; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>WERE YOU GOOD? :)</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="good" value="Good">
                            <label class="form-check-label">
                                YES
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="good" value="Bad">
                            <label class="form-check-label">
                                NO
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>MAKE YOUR WISH</label>
                        <textarea name="wish" class="form-control" rows="3" ></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mb-2">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-sm">
                <img src="Images/jelka.png" class="treeImg" alt="ChristmasTree">
            </div>
        </div>

<?php include('footer.php'); ?>

