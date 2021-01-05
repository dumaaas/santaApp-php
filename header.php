<!-- Svaka stranica sadrzi ovaj kod, pa da bi smanjili dupliranje koda, odvajamo ga u poseban fajl i includujemo ga u ostale -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make A Wish</title>
    <link rel="stylesheet" type="text/css" href="Style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

    <!-- Animacija pahuljica -->
    <div class="snowflakes" aria-hidden="true">
        <?php for($i=0; $i<10; $i++) { ?>
            <div class="snowflake"> ❆ </div>
        <?php } ?>
    </div>