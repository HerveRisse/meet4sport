<?php 
include('link-bdd.php');
include('headers.php');
include('nav-bar.php');
include('redirect-login.php');

?>

<?php
    $idMembre = $_SESSION['membre']['id_membre'];
    var_dump($idMembre);
?>


<?php
if($_POST){
    
    $erreur = '';
    
    if(strlen($_POST['prenom']) < 2  || strlen($_POST['prenom']) > 21) {
        $erreur .= '<p>Taille de prénom invalide.</p>';
    }
    
    if(strlen($_POST['nom']) < 2  || strlen($_POST['nom']) > 21) {
        $erreur .= '<p>Taille de nom invalide.</p>';
    }
    
    if(strlen($_POST['pseudo']) < 2  || strlen($_POST['pseudo']) > 21) {
        $erreur .= '<p>Taille de pseudo invalide.</p>';
    }
    
    
    if(!preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['prenom'])) {
        $erreur .= '<p>Format de prénom invalide.</p>';
    }
    
    if(!preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['nom'])) {
        $erreur .= '<p>Format de nom invalide.</p>';
    }
    
    if(!preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo'])) {
        $erreur .= '<p>Format de pseudo invalide.</p>';
    }
    
    $r = $pdo->query("SELECT * FROM membre WHERE email = '$_POST[email]' ");
    if($r->rowCount() >= 1) {
        $erreur .= '<p>Email déjà utilisé.</p>';
    }
    
    $p = $pdo->query("SELECT * FROM membre WHERE email = '$_POST[pseudo]' ");
    if($p->rowCount() >= 1) {
        $erreur .= '<p>Pseudo déjà utilisé.</p>';
    }
    
    foreach($_POST as $indice => $valeur) {
        $_POST[$indice] = addslashes($valeur);
    }
    
    if(empty($erreur)) {
        $up = $pdo->prepare("UPDATE membre SET nom = ?,prenom = ?, pseudo = ?, email = ? WHERE id_membre = ? ");
        $up->execute(array(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['pseudo'],
            $_POST['email'],
            $_SESSION['membre']['id_membre']
        ));
        $content .= '<p> Modification validée !</p>';
    }
    
    $content .=$erreur;
    
}

if($content == '<p> Modification validée !</p>') {
    header('location:private-profile.php');
}

?>

<?php
$r = $pdo->prepare('SELECT * FROM membre WHERE id_membre = ?');
$r->execute(array($_SESSION['membre']['id_membre']));

$event = $r->fetch(PDO::FETCH_ASSOC);

?>

<section class="profile-section">
    
    <form class="main-form" method="post">
        <div>
            <input class="main-input" type="text" name="nom" id="nom" placeholder="<?php echo $event['nom'];?>" required>
            <input class="main-input" type="text" name="prenom" id="prenom" placeholder="<?php echo $event['prenom'];?>" required>
        </div>
            <input class="main-input" type="email" name="email" id="email" placeholder="<?php echo $event['email'];?>" required>
            <input class="main-input" type="text" name="pseudo" id="pseudo" placeholder="<?php echo $event['pseudo'];?>" required>
        <input class="main-btn" type="submit" value="Enregistrer les modification">
        <a class="connexion-link" href="private-profile.php">Retour</a>
    </form>

</section>

</body>
<?php include('footer.php');?>