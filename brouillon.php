
<?php
if(isset($_POST['envoyer'])) {
    if(!empty($_POST['message'])){

    $_POST['message'] = addslashes($_POST['message']);

    $env = $pdo->prepare("INSERT INTO comment (id_membre, id_event, date, text) VALUES(?, ?, ?, ?)");
    $env->execute(array(
        $_SESSION['membre']['id_membre'],
        $_GET['id'],
        NOW(),
        $_POST['message']
    ));

    }
}
?>






$idMembre = $_SESSION['membre']['id_membre'];
    var_dump($idMembre);
    
    if(isset($_POST['accepter'])){
        $a = $pdo->prepare('SELECT id_contact
        FROM contact 
        WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)
        ');
        $a->execute(array(
            $_SESSION['membre']['id_membre'],
            $_GET['id'],
            $_GET['id'],
            $_SESSION['membre']['id_membre']
        ));
    
        $checkContact = $a->fetch();
    
        if(empty($checkContact)){
            $do = $pdo->prepare("INSERT INTO contact (id_demandeur, id_receveur, statut) VALUES (?, ?, ?)");
            $do->execute(array(
                $_SESSION['membre']['id_membre'],
                $_GET['id'],
                1
            ));
        }
    
    } else 
    if(isset($_POST['refuser'])){
        var_dump($idMembre);
        var_dump($demandeur[0]);
        $a = $pdo->prepare('DELETE
        FROM contact 
        WHERE id_receveur = ? AND id_demandeur = ?
        ');
        $a->execute(array(
            $idMembre,
            $demandeur[0]
        ));
    }


    <?php 
include('link-bdd.php');
include('headers.php');
?>

<?php
    $idMembre = $_SESSION['membre']['id_membre'];
    var_dump($idMembre);

$r = $pdo->prepare('SELECT * FROM event WHERE id_event = ?');
$r->execute(array($_GET['id']));
$infoEvent = $r->fetch(PDO::FETCH_ASSOC);

var_dump($_GET['id']);

if(isset($_POST['envoyer'])) {
    if(!empty($_POST['message'])){

    $_POST['message'] = addslashes($_POST['message']);

    $pdo->exec("INSERT INTO comment (id_membre, id_event, date, text) VALUES('$idMembre','$infoEvent', NOW(),'$_POST[message]' )");
    }
}

// On affiche les commentaires :
$r = $pdo->query('SELECT * FROM comment');
while($comment = $r->fetch(PDO::FETCH_ASSOC)) {
    $idcom = $comment['id_membre'];
    $pseudo = $pdo->query("SELECT pseudo FROM membre WHERE id_membre = $idcom");

    echo $pseudo . ' > ' . $comment['message'] . ' > ' . $comment['date'] . '<br>';
}
?>

<section class="profile-section">
<form method="post">
    <label for="message">Message</label>
    <textarea name="message" id="message" placeholder="Votre message"></textarea>
    <input type="submit" value="Envoyer">
</form>
</section>

</body>
<?php include('footer.php');?>


$do = $pdo->prepare("INSERT INTO contact (id_demandeur, id_receveur, statut, id_bloquer) VALUES (?, ?, ?, ?)");
    $do->execute(array(
        $_SESSION['membre']['id_membre'],
        $_GET['id'],
        3,
        $_GET['id']
    ));

    $commentaire=$pdo->exec("INSERT INTO comment (id_membre, id_event, date, text) VALUES($idMembre, $infoEvent, NOW(),'$_POST[message]')");
        var_dump($commentaire);


        <?php 
include('link-bdd.php');
include('headers.php');?>
<body>

<select name="filter-sport" class="filter-sport">
</select>
<select name="filter-area" class="filter-area">

</select>


<section class="card-section">

<?php
$r = $pdo->query('SELECT * FROM event');
while($event = $r->fetch(PDO::FETCH_ASSOC)) {
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
        '<div class="card-author">' . $event['nom_event'] . '</div>' .
        '<div class="card-nb-participant">' . $event['nb_participant'] . '/' . $event['nb_place'] . '</div>' .
    '</li>'.
'</ul>';
}
?>

</section>

</body>
<?php include('footer.php');?>
