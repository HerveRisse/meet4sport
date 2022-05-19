<?php
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');


$idMembre = $_SESSION['membre']['id_membre'];;

if (isset($_POST['accepter'])) {

    $id_demandeur = $_POST['id_demandeur'];

    $a = $pdo->prepare('SELECT id_contact
        FROM contact 
        WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)
        ');
    $a->execute(array(
        $idMembre,
        $id_demandeur,
        $id_demandeur,
        $idMembre
    ));

    $checkContact = $a->fetch();

    if (!empty($checkContact)) {
        $do = $pdo->prepare("UPDATE contact SET statut = ? WHERE id_demandeur = ? AND id_receveur = ?");
        $do->execute(array(
            2,
            $id_demandeur,
            $idMembre
        ));
    }
} else if (isset($_POST['refuser'])) {

    $id_demandeur = $_POST['id_demandeur'];
    
    $a = $pdo->prepare('DELETE
        FROM contact 
        WHERE id_receveur = ? AND id_demandeur = ?
        ');
    $a->execute(array(
        $idMembre,
        $id_demandeur
    ));
}

$r = $pdo->prepare('SELECT * FROM membre WHERE id_membre = ?');
$r->execute(array($idMembre));
$event = $r->fetch(PDO::FETCH_ASSOC);
?>
<h1>Profil</h1>
<section class="profile-section">
    <ul>
        <li class='profile-prenom'><?php echo 'Nom'.':'.$event['prenom']; ?></li>
        <li class='profile-nom'><?php echo 'Prénom'.':'.$event['nom']; ?></li>
        <li class='profile-pseudo'><?php echo 'Pseudo'.':'.$event['pseudo']; ?></li>
        <a href="edit-profile.php">Modifier mon profil</a>
    </ul>
</section>

<?php
$r = $pdo->query("SELECT * FROM membre m, contact c  WHERE m.id_membre = c.id_demandeur AND c.id_receveur = $idMembre AND c.statut = 1");
while ($demande = $r->fetch(PDO::FETCH_ASSOC)) { ?>
    <ul class="card-container-secondary">
        <li class="profile-pseudo"><?php echo $demande['pseudo'] ?></li>
        <div class="card-buttons">
            <form method="post">
                <input class="main-btn" type="submit" name="accepter" value="Accepter">
                <input class="main-btn" type="submit" name="refuser" value="Refuser">
                <input type="hidden" name="id_demandeur" value="<?php echo $demande['id_demandeur'] ?>">
            </form>
        </div>
    </ul>
<?php
    // ,$demande['id_membre'],$demande['statut'].'<br>';
};

?>


</body>

<?php include('footer.php'); ?>