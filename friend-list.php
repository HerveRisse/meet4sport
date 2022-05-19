<?php 
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');

?>

<h1>Amis</h1>

<?php
$idMembre = $_SESSION['membre']['id_membre'];

$r = $pdo->query("SELECT * FROM membre WHERE (id_membre IN (SELECT id_demandeur FROM contact WHERE id_receveur = $idMembre AND statut = 2)) OR (id_membre IN (SELECT id_receveur FROM contact WHERE id_demandeur = $idMembre AND statut = 2))");

while($amis = $r->fetch(PDO::FETCH_ASSOC)) {
    
    echo
    '<ul class="card-container-secondary">'.
        '<li class="card-ami-lien">'.
            '<a href="profile.php?id='.$amis['id_membre'].'" class="card-author">' . $amis['pseudo'] . '</a>' .
        '</li>'.
        '<li class="card-buttons">' .
            '<a href="private-message.php?id='.$amis['id_membre'].'"><img src="media/message.svg" alt="message"></a>' .
        '</li>' .
    '</ul>';

}

?>

</body>
<?php include('footer.php');?>