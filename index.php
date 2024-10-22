<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz</title>
</head>
<body>
    <h1>Matematyka</h1>
    <form action="index.php" method="POST" name="Formularz">
        
        <input type="text" name="name" placeholder="Imię"><br><br>
        <input type="text" name="surname" placeholder="Nazwisko"><br><br>
        <input type="number" name="grade" placeholder="Ocena"><br><br>
        
        <button type="submit" value="dodaj" name="dodaj">Zapisz</button><br><br>
    </form>

    <table border="1">
        
        <tr>
            <th>ID</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Ocena</th>
        </tr>

    <?php
        $polaczenie = mysqli_connect('localhost', 'root', '', 'szkola');

        if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['grade'])) {
        
            $imie = $_POST['name'];
            $nazwisko = $_POST['surname'];
            $ocena = $_POST['grade'];

            $dodajdane = "INSERT INTO `matematyka` (`Imie`, `Nazwisko`, `Ocena`) VALUES ('$imie', '$nazwisko', '$ocena')";
            
            mysqli_query($polaczenie, $dodajdane);
        }    
        $zapytanie = "SELECT * FROM `matematyka`";

        $wynik = mysqli_query($polaczenie, $zapytanie);

        while ($wiersz = mysqli_fetch_assoc($wynik)) {
            echo "<tr><td>" . $wiersz['ID'] . "</td><td>" . $wiersz['Imie'] . "</td><td>" . $wiersz['Nazwisko'] . "</td><td>" . $wiersz['Ocena'] . "</td></tr>";
        }

        mysqli_close($polaczenie);
    ?>
    </table>
    
    <br><br><br><br>
    
    <h1>Wyszukiwarka nazwisk</h1>
    
    <form action="index.php" method="POST" name="formularz">
        <input type="text" name="nazwisko" placeholder="Nazwisko"><br><br>
        <button type="submit" value="szukaj" name="szukaj">Szukaj</button>
    
    </form>
    <ul>
    <?php
        if (isset($_POST['nazwisko'])) {
            $nazwisko = $_POST['nazwisko'];
            $polaczenie = mysqli_connect('localhost','root','','szkola');
            $zapytanie2 = "SELECT `Imie`, `Nazwisko`, `Ocena` FROM `matematyka` WHERE `Nazwisko` = '$nazwisko'";
        }
            $wynik2 = mysqli_query($polaczenie, $zapytanie2);
        

            while ($wiersz = mysqli_fetch_assoc($wynik2)) {
                echo "<li>" . $wiersz['Imie'] . "</li><li> " . $wiersz['Nazwisko'] . "</li>";
            }
    ?>
    </ul>
</body>
</html>