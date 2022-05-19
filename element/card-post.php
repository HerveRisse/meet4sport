<?php include('link-bdd.php');?>





<?php
$sqlQuery = 'SELECT * FROM event ';
$eventStatement = $mysqlClient->prepare($sqlQuery);
$eventStatement->execute();
$events = $eventStatement->fetchAll();

foreach ($events as $event) {
?>
    <p><?php echo $recipe['nom_event']; ?></p>
<?php
}
?>

<?php
$sqlQuery = 'SELECT nom_event FROM event ';
$eventStatement = $mysqlClient->prepare($sqlQuery);
$eventStatement->execute();
echo $eventStatement;
?>


<ul>
<?php $number=1; ?>
    <li class="card-post cad-img"><?php $pdo->exec("SELECT nom_event FROM event WHERE id_event = 1 ");var_dump($pdo); ?></li>
    <li class="card-post card-title"></li>
    <li class="card-post card-description" ></li>
    <li class="card-post card-auteur"></li>
    <li class="card-post card-nb-participant"></li>
</ul>