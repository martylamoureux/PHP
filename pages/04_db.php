<?php echo $slidey->chapter('Bases de données', 'base-de-donnees', 4); ?>

<div class="slide">
<?php echo $slidey->part('Introduction'); ?>

<img src="<?php echo $slidey->image('img/db.png')->resize('50%')->png(); ?>" style="float:right" />

<p>
    Les bases de données représentent un point clé de l'organisation d'une application
web. <b>PHP</b> propose des extensions pour piloter les bases les plus courantes :
</p>

<ul>
    <li>MySQL</li>
    <li>Postgres</li>
    <li>SQLite</li>
    <li>Oracle</li>
</ul>

<p class="textOnly">
    Pour ce cours, nous considérerons que vous avez déjà des notions de bases de données,
et ne parlerons que de l'intégration des bases de données dans du code <b>PHP</b>. Notez que
nous nous focaliserons sur les bases de données relationelles, mais qu'il existe également
d'autre type de bases.
</p>
</div>

<div class="slide">
<?php echo $slidey->part('Le requêtage'); ?>

<h3>Présentation</h3>
<p class="textOnly">
    L'interêt du requêtage est d'intéragir dynamiquement avec la base de données,
c'est à dire (entre autre) :
</p>

<ul>
    <li class="discover">Effectuer des requêtes à paramètres dynamiques</li>
    <li class="discover">Modifier la base de données selon des formulaires</li>
    <li class="discover">Itérer parmis des réultats</li>
    <li class="discover"><b>Etablir une correspondance entre le monde objet et le monde relationnel</b></li>
</ul>

</div>

<div class="slide">
<h3>PDO</h3>
<p>
    <b>PHP</b> propose une interface générique pour accéder aux bases de différents types: 
<a href="http://php.net/PDO"><b>PDO</b></a>, pour <b>PHP Data Object</b>.
</p>

<p>
    L'utilité est de faire abstraction du type de la base de données utilisée.
</p>
</div>

<div class="slide">
<h3>Connexion</h3>

<p class="textOnly">
    La connexion peut être établie en instanciant un <code>PDO</code> comme cela&nbsp;:
</p>

<?php echo $slidey->highlight('files/04/connection.php'); ?>

<p class="textOnly">
    Les trois paramètres sont le nom de la source des données -et par conséquent le nom
du type de la base de données utilisée-, le nom d'utilisateur et le mot de passe. En cas
d'échec, une exception de type <code>PDOException</code> sera levée.
</p>

</div>

<div class="slide">
<h3>Requêtage simple</h3>

<p class="textOnly">
    Voici un exemple de requêtage utilisant le <b>PDO</b>&nbsp;:
</p>

<?php echo $slidey->highlight('files/04/list.php'); ?>
</div>

<div class="slide">
<h3>Préparation de requêtes</h3>
<p class="textOnly">
    Auparavant, il arivait souvent que les requêtes soient générées à la main par concaténation
avec des variables provenant du reste de l'application puis executées comme dans l'exemple précédent.
Cette méthode pose cependant plusieurs problèmes :
</p>
<ul class="textOnly">
    <li>Code parfois illisible et complexe</li>
    <li>Difficultés liées à la sécurité (échappement)</li>
    <li>Problème de performance, car si la même requête est exécutée avec des paramètres différents,
certaines bases de données peuvent améliorer les performances</li>
</ul>
<p class="textOnly">
    Pour palier à ces défauts, la préparation de requêtes est maintenant employée&nbsp;:
</p>

<?php echo $slidey->highlight('files/04/age.php'); ?>

</div>

<div class="slide">
<h3>Insertion</h3>

<p class="textOnly">
    L'insertion peut se faire de la même manière que le requêtage&nbsp;:
</p>

<?php echo $slidey->highlight('files/04/insert.php'); ?>
</div>

<div class="slide">
<h3>Les transactions</h3>

<p class="textOnly">
    Le système de <code>PDO</code> supporte le requêtage transactionnel, c'est à dire 
qui permet d'effectuer des actions puis de les intégrer, ou de tout annuler de manière
atomique&nbsp;:
</p>

<?php echo $slidey->highlight('files/04/transaction.php'); ?>

<p class="textOnly">
    De cette manière, si quelque chose se passe mal, les requêtes seront toutes annulées,
et les états incohérents pourront être évités.
</p>
</div>

<?php echo $slidey->part('Les ORM'); ?>

<p>
    A venir
</p>
