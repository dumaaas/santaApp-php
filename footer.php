<!-- Svaka stranica sadrzi ovaj kod, pa da bi smanjili dupliranje koda, odvajamo ga u poseban fajl i includujemo ga u ostale -->
        <audio id="audio" autoplay loop>
            <source src="Music/song.mp3">
        </audio>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            let audio = document.getElementById("audio");
            audio.volume = 0.02;
        </script>
    </body>
</html>
