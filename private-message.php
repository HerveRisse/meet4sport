<?php 
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');

?>

<?php
$idMembre = $_SESSION['membre']['id_membre'];
$idAmi = $_GET['id'];

if(isset($_POST['envoyer']) && !empty($_POST['message'])) {

    $message = addslashes($_POST['message']);

    $commentaire=$pdo->exec("INSERT INTO message (id_envoyeur, id_receveur, date, text) VALUES('$idMembre', '$idAmi', NOW(),'$message')");
    
}
?>


<section class="com-container">
<?php
$r = $pdo->query("SELECT * FROM message t, contact c 
WHERE ((t.id_envoyeur = $idMembre AND t.id_receveur = $idAmi) OR (t.id_envoyeur = $idAmi AND t.id_receveur = $idMembre)) 
AND c.statut = 2 ");
while($comment = $r->fetch(PDO::FETCH_ASSOC)) {
    
    if($idMembre == $comment['id_envoyeur']){
        echo
        '<ul class="card-com-container-actif">'.
            '<li class="card-com-pseudo">' . $comment['pseudo'] . '</li>' .
            '<li class="card-com-text">' . $comment['text'] . '</li>' .
            '<li class="card-com-date">' . $comment['date'] . '</li>' .
        '</ul>';
    }else{
        echo
        '<ul class="card-com-container">'.
            '<li class="card-com-pseudo">' . $comment['pseudo'] .':'. '</li>' .
            '<li class="card-com-text">' . $comment['text'] . '</li>' .
            '<li class="card-com-date">' . $comment['date'] . '</li>' .
        '</ul>';

    }
}
?>

<form class="com-form" method="post">
    <textarea class="com-text" name="message" id="message" placeholder="Votre message"></textarea>
    <input class="main-btn" type="submit" name="envoyer" value="Envoyer">
</form>

</section>
</body>
<?php include('footer.php');?>