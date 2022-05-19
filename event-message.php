<?php 
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');

?>

<?php

$idMembre = $_SESSION['membre']['id_membre'];
$infoEvent = $_GET['id'];

if(isset($_POST['envoyer']) && !empty($_POST['message'])) {

    $message = addslashes($_POST['message']);

    echo $message;

    $commentaire=$pdo->exec("INSERT INTO comment (id_membre, id_event, date, text) VALUES('$idMembre', '$infoEvent', NOW(),'$message')");
    
}
?>

<section class="com-container">
<?php
$r = $pdo->query('SELECT * FROM comment c,membre m WHERE c.id_membre = m.id_membre AND c.id_event = "'.$infoEvent.'" ');
while($comment = $r->fetch(PDO::FETCH_ASSOC)) {
    
    if($idMembre == $comment['id_membre']){
        echo
        '<ul class="card-com-container-actif">'.
            '<li class="card-com-pseudo">' . $comment['pseudo'] .':'. '</li>' .
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