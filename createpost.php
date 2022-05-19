<?php 
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');

?>

<?php
    $idMembre = $_SESSION['membre']['id_membre'];
?>




<?php    if($_POST){

//var_dump($_POST);

        $pdo->exec("INSERT INTO event (id_membre, sport, ville, adresse, nom_event, date, heure, duree, nb_place, texte) 
        VALUES ('$idMembre','$_POST[sport]', '$_POST[ville]','$_POST[adresse]','$_POST[nom_event]','$_POST[date]','$_POST[heure]','$_POST[duree]','$_POST[nb_place]','$_POST[texte]') ");

}

?>

<body >
<h1>Créer un évenement</h1>
    <main>
        
        <form class="main-form" method="post">
            <div class="filters-container">
                <div class="filter-container">
                    <select name="sport" class="filter-sport">
                        <option value="fitness">fitness</option>
                        <option value="football">football</option>
                        <option value="basketball">basketball</option>
                        <option value="volleyball">volleyball</option>
                        <option value="badminton">badminton</option>
                        <option value="tennis">tennis</option>
                        <option value="golf">golf</option>
                        <option value="rugby">rugby</option>
                    </select>
                </div>
    
                <div class="filter-container">
                    <select name="ville" class="filter-area">
                        <option value="Paris">Paris</option>
                        <option value="Marseille">Marseille</option>
                        <option value="Lyon">Lyon</option>
                        <option value="Toulouse">Toulouse</option>
                        <option value="Nice">Nice</option>
                        <option value="Nantes">Nantes</option>
                        <option value="Strasbourg">Strasbourg</option>
                        <option value="Bordeaux">Bordeaux</option>
                    </select>
                </div>
            </div>
            <input class="main-input" type="text" name="adresse" id="event-address" placeholder="Adresse de l'événement" required>
            <input class="main-input" type="text" name="nom_event" id="event-name" placeholder="Nom de l'événement" required>
            <input class="main-input" type="date" name="date" id="event-date" placeholder="Date" required>
            <input class="main-input" type="time" name="heure" id="event-heure" placeholder="heure" required>
            <input class="main-input" type="time" name="duree" id="event-end" placeholder="Durée" required>
            <input class="main-input" type="number" name="nb_place" id="place-number" placeholder="Nombre de places" required>
            <input class="main-input" type="text" name="texte" id="event-info" placeholder="Info utile" required>
            <input class="main-btn" type="submit" value="Créer">
        </form>
    </main>

<?php include('footer.php');?>