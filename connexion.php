<?php include('link-bdd.php');?>

<?php 
if(isset($_SESSION['membre'])) {
    header('location:home.php');
}


if($_POST) {
        
    $r = $pdo->query("SELECT * FROM membre WHERE email = '$_POST[email]'");
    
    if($r->rowCount() >=1) {
            $membre = $r->fetch(PDO::FETCH_ASSOC);
                
                if(password_verify($_POST['mdp'], $membre['mdp'])){

                    $content .='<p>email+ MDP : OK</p>';
                    
                    $_SESSION['membre']['nom']= $membre['nom'];
                    $_SESSION['membre']['prenom']= $membre['prenom'];
                    $_SESSION['membre']['email']= $membre['email'];
                    $_SESSION['membre']['id_membre']= $membre['id_membre'];
                    
                    header('location:home.php');
                    
                }else {
                    $content .= '<p>Mot de passe incorrect.</p>';
                }

            } else {
                $content.='<p>Compte inexistant</p>';
        }
        
}
 
?>

<?php include('headers.php');?>

    <main>

        <?php 
            echo $content;
        ?>

<form class="main-form" method="post">
    <input class="main-input" type="email"name="email" id="email" placeholder="email" required>
    <input class="main-input" type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
    <input class="main-btn" type="submit" value="Se connecter">
    <div class="connexion-alt">
        <a href="#">mot de passe oublié ?</a>|<a href="inscription.php">créer un compte</a>
    </div>
</form>

</main>
</html>
