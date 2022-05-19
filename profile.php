<?php
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');

?>

<?php
$idMembre = $_SESSION['membre']['id_membre'];
?>

<?php
$r = $pdo->prepare('SELECT * FROM membre WHERE id_membre = ?');
$r->execute(array(
    $_GET['id']
));
$infoMember = $r->fetch(PDO::FETCH_ASSOC);


switch (true) {
    case isset($_POST['add-member']):
        $a = $pdo->prepare('SELECT id_contact FROM contact WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)');
        $a->execute(array(
            $_SESSION['membre']['id_membre'],
            $_GET['id'],
            $_GET['id'],
            $_SESSION['membre']['id_membre']
        ));

        $checkContact = $a->fetch();

        if (empty($checkContact)) {
            $do = $pdo->prepare("INSERT INTO contact (id_demandeur, id_receveur, statut) VALUES (?, ?, ?)");
            $do->execute(array(
                $_SESSION['membre']['id_membre'],
                $_GET['id'],
                1
            ));
        }
        break;
    case isset($_POST['delete-member']):
        $a = $pdo->prepare('DELETE FROM contact WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)');
        $a->execute(array(
            $_SESSION['membre']['id_membre'],
            $_GET['id'],
            $_GET['id'],
            $_SESSION['membre']['id_membre']
        ));
        break;
    case isset($_POST['block-member']):
        $a = $pdo->prepare('DELETE FROM contact WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)');
        $a->execute(array(
            $_SESSION['membre']['id_membre'],
            $_GET['id'],
            $_GET['id'],
            $_SESSION['membre']['id_membre']
        ));

        $do = $pdo->prepare("INSERT INTO contact (id_demandeur, id_receveur, statut, id_bloquer) VALUES (?, ?, ?, ?)");
        $do->execute(array(
            $_SESSION['membre']['id_membre'],
            $_GET['id'],
            3,
            $_GET['id']
        ));
        break;
    case isset($_POST['unblock-member']):
        $a = $pdo->prepare('DELETE FROM contact WHERE (id_receveur = ? AND id_demandeur = ?) OR (id_receveur = ? AND id_demandeur = ?)');
        $a->execute(array(
            $_SESSION['membre']['id_membre'],
            $_GET['id'],
            $_GET['id'],
            $_SESSION['membre']['id_membre']
        ));
        break;
    default:
        break;
}
?>
<h1>Profil</h1>
<section class="profile-section">

    <ul>
        <li class='profile-prenom'><?php echo 'Nom'.':'.$infoMember['prenom']; ?></li>
        <li class='profile-nom'><?php echo 'Prénom'.':'.$infoMember['nom']; ?></li>
        <li class='profile-pseudo'><?php echo 'Pseudo'.':'.$infoMember['pseudo']; ?></li>
    </ul>

    <form method="post">
        <?php
        $c = $pdo->prepare('SELECT * FROM contact WHERE (id_demandeur = ? AND id_receveur = ?) OR (id_demandeur = ? AND id_receveur = ?)');
        $c->execute(array(
            $_SESSION['membre']['id_membre'],
            $_GET['id'],
            $_GET['id'],
            $_SESSION['membre']['id_membre']
        ));
        $infoContact = $c->fetch(PDO::FETCH_ASSOC);

        if (!isset($infoContact['statut'])) {
        ?>
            <input type="submit" name="add-member" value="Ajouter">
        <?php
        } else if (isset($infoContact['statut']) && $infoContact['id_demandeur'] == $_SESSION['membre']['id_membre'] && $infoContact['statut'] < 3) {
        ?>
            <p>Demande en attente</p>
        <?php
        } else if (isset($infoContact['statut']) && $infoContact['id_receveur'] == $_SESSION['membre']['id_membre'] && $infoContact['statut'] < 3) {
        ?>
            <p>Vous avez une demande à accepter</p>
        <?php
        }
        if (isset($infoContact['statut']) && $infoContact['statut'] < 3 && $infoContact['id_demandeur'] == $idMembre) {
        ?>
            <input type="submit" name="delete-member" value="Supprimer">
        <?php
        }
        if ((isset($infoContact['statut']) || $infoContact['statut'] == NULL) && $infoContact['statut'] < 3) {
        ?>
            <input type="submit" name="block-member" value="Bloquer">
        <?php
        } elseif (isset($infoContact['id_bloquer']) && $infoContact['id_bloquer'] <> $_SESSION['membre']['id_membre']) {
        ?>
            <input type="submit" name="unblock-member" value="Débloquer">
        <?php
        } else {
        ?>
            <p>Vous avez été bloquer par cet utilisateur</p>
        <?php
        }
        ?>

    </form>

</section>

</body>
<?php include('footer.php'); ?>