<?php 
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');
?>

<?php
    $idMembre = $_SESSION['membre']['id_membre'];
?>

<h1>Evenement disponible</h1>
<section class="card-section">
    
    <?php
$r = $pdo->query('SELECT * FROM event e, membre m WHERE e.id_membre = m.id_membre');

while($event = $r->fetch(PDO::FETCH_ASSOC)) {
    $idAuthor = $event['id_membre'];
    $idEvent = $event['id_event'];
    echo
    '<ul class="card-container">'.
    '<li class="card-img">' . $event['sport'] . '</li>' .
    '<li class="card-title">' . $event['nom_event'] . '</li>' .
    '<li class="card-area">'.
    '<div class="card-ville">' . $event['ville'] . '</div>' .
    '<div class="card-adresse">' . $event['adresse'] . '</div>' .
    '</li>'.
    '<li class="card-content">' . $event['texte'] . '</li>' .
    '<li class="card-footer">'.
    '<a href="profile.php?id='.$idAuthor.'" class="card-author">' . $event['pseudo'] . '</a>' .
    '<div class="card-nb-participant">' . $event['nb_participant'] . '/' . $event['nb_place'] .'</div>' .
    '</li>'.
    '<div class="card-buttons">' .
    '<a href="event-message.php?id='.$idEvent.'"><img src="media/message.svg" alt="message"></a>' .
    '<form action="" method="post">' .
    '<input class="main-btn" type="submit" value="Je participe">' .
    '</form>' .
    '</div>' .
    '</ul>';
}
?>

</section>

</body>
<?php include('footer.php');?>