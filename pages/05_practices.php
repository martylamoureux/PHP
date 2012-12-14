<?php echo $slidey->chapter('Bonnes pratiques', 'bonnes-pratiques', 5); ?>

<div class="slide">
<?php echo $slidey->part('Travailler proprement'); ?>
<h3>Introduction</h3>

<p>
    Le langage <b>PHP</b> peut être très vite maîtrisé. En revanche, l'apprentissage
des méthodes et l'organisation sont plus complexes et primordiales dans l'écriture
d'une application web.
</p>

<p>
    Dans cette partie, nous survolerons un ensemble de bonnes pratiques fortement liées 
au développement d'application <b>PHP</b>.
</p>
</div>

<div class="slide">
<h3>Encodage des caractères</h3>
<p class="textOnly">
    L'encodage utf-8 est actuellement le jeu d'encodage le plus répandu et recommandé,
surtout dans des applications multilingues.
 L'encodage des caractères doit être uniformisé dès le début, car il concerne autant les 
pages webs que le contenu de la base de données, et qu'une mauvaise gestion peut vite se
conclure par des problèmes d'affichages.
</p>
<p class="textOnly">
    Les développeurs qui travaillent sur un projet doivent s'assurer que leur encodage
est similaire, et spécifier cet encodage dans la balise <code>meta</code> des pages HTML&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/utf.php', 'html5'); ?>

<p class="textOnly">
    Notez que dans le cas d'une requête ajax, l'encodage des caractères n'est pas précisé
car la page HTML peut être partielle. Dans ce cas là, il est possible de le préciser dans 
les en-têtes HTTP&nbsp;:
</p>

<hr class="slideOnly" />
<?php echo $slidey->highlight('files/05/encoding.php', 'html'); ?>
</div>

<div class="slide">
<h3>Echappement</h3>

<img style="float:right" src="<?php echo $slidey->image('img/magicQuotes.gif')->jpeg(); ?>" />

<p class="textOnly">
    Pendant longtemps, <b>PHP</b> a comprit une option très controversée nommée 
les <em>magic quotes</em>. Ce système échappait automatiquement les données qui parvenaient
à l'application web concernée (en ajoutant des \ devant les "). 
</p>
<p class="textOnly">
    Mécanisme souvent à l'origine de problèmes qui se traduisent par l'apparition de \
involontaires, ce système se voulait protecteur contre les failles liées notamment aux
injections SQL. Aujourd'hui, il est obselète et désactivé par défaut, il est fortement
conseillé de le désactiver (php.ini)&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/quotes.php', 'ini'); ?>
</div>

<div class="slide">
<h3>Tests unitaires</h3>
<p class="textOnly">
    Entre autre grâce à <a href="http://www.phpunit.de/manual/current/en/">PHPUnit</a>,
il est très facile d'écrire des tests unitaires en <b>PHP</b>, ce qui permet&nbsp;:
</p>
<ul>
    <li class="discover">Assurer la non-regréssion d'un projet</li>
    <li class="discover">Empêcher les bugs de se reproduire</li>
    <li class="discover">Disposer d'un jeu de tests convaicant</li>
    <li class="discover">Tester l'environement d'une application (avant un déploiement en production par exemple)</li>
    <li class="discover">Sécuriser le développement en équipe</li>
    <li class="discover">Eprouver la robustesse de l'application</li>
</ul>
<p class="discover">
    Il est pour cela important de disposer de code <b>découpé en composants</b>. Ecrire les tests
pendant (voire avant) le développement est une bonne chose.
</p>
</div>

<div class="slide">
<h3 class="slideOnly">Tests unitaires: exemple</h3>
<p class="textOnly">
    Voici un exemple de test écrit avec PHPUnit&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/test.php'); ?>
</div>

<div class="slide">
<h3 class="slideOnly">Tests unitaires: exécution</h3>
<p class="textOnly">
    Pour l'exécuter, simplement lancer <code>phpunit</code>&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/phpunit.php', 'html'); ?>
</div>

<div class="slide">
<h3>Serveur d'intégration</h3>
<p>
    Un serveur d'intégration est une application généralement couplée au système de versionnement
(tels que <em>git</em> ou <em>svn</em>), et qui vérifie continuellement que les tests unitaires
et standards de codages sont respectés.
</p>
<p>
    Il permet de provoquer des alertes dans le cas d'une mauvaise manipulation et de sensibiliser
une équipe de développeurs à la fragilité de l'application.
</p>
</div>

<div class="slide">
<?php echo $slidey->part('Les performances'); ?>
<h3>Contexte</h3>
<p>
    N'oubliez pas que <b>PHP</b> est un langage interprété. Son utilisation doit donc
se limiter à des tâches de gestion. Il ne peut pas être utilisé pour faire du calcul
très rapide par exemple.
</p>
<p>
    <b>PHP</b> offre la possibilité d'écrire des extensions en C et de créer un <em>binding</em>,
ou association entre le C et le <b>PHP</b>, cette option est vivement recommandée en cas
d'application à haute performance impliquant du calcul gourmand.
</p>
<p>
    La plupart des fonctions et bibliothèques standard bénéficient d'ailleurs d'une bonne
rapidité car sont écrites en C.
</p>
</div>

<div class="slide">
<h3>APC</h3>
<p>
    <b>APC</b> est un mécanisme de mise en cache du bytecode <b>PHP</b>.<span class="textOnly">
En clair, il permet d'éviter au serveur de relire et de ré-analyser le code source d'une application
à chaque requête en gardant un version condensée du script en mémoire.
</span>.
</p>
<p>
    Il est vivement conseillé d'utiliser <b>APC</b>, qui sera bientôt natif dans <b>PHP</b>, et qui
en augmente les performances quasi systématiquement sans surcoût de développement.
</p>
<p>
    Sous linux, il peut être installé via le paquet <code>php-apc</code>.
</p>
<p>
    <b>APC</b> offre également d'autre possibilités tels que le stockage de valeurs en cache (voir
ci-dessous).
</p>
</div>

<div class="slide">
<h3>Utilisation de cache</h3>
<p class="textOnly">
    Certaines opérations sont effectuées de manière réccurente (accès à la base de données,
à des fichiers, calculs etc.). Au lieu d'être recalculées à chaque fois, des données peuvent
être mises en cache à l'aide de mécanismes tels que <a href="http://php.net/apc">APC</a>
ou <a href="http://php.net/memcache">Memcache</a>. 
</p>
<p class="textOnly">
    Ces systèmes offrent un magasin de clé/valeur stocké directement dans la RAM, et disposant
d'un temps d'accès extrêmement faible. Ainsi, il est par exemple possible de stocker une valeur
et d'y accéder plus tard. Cependant, ce stockage est totalement volatile et nous ne sommes pas
sûr de pouvoir récupérer notre valeur (il ne s'agit que de cache). Aussi, il est important de
faire attention aux inconsistences que ces systèmes peuvent provoquer, les données n'étant
plus récupérées depuis la base de données par exemple. Voici un exemple d'utilisation du
magasin <b>APC</b>&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/cache.php'); ?>
</div>

<div class="slide">
<?php echo $slidey->part('Sécurité'); ?>
<h3>HTTPS</h3>

<img style="float:right" src="<?php echo $slidey->image('img/cadenas.jpg')->resize('40%'); ?>" />

<p class="textOnly">
    Comme vous le savez, les données transmises via <b>HTTP</b> sont envoyées en clair sur le
réseau. Ces données peuvent éventuellement être interceptées à l'aide de plusieurs attaques et
du sniffing réseau. Un attaquant peut ainsi récupérer les mots de passes, mais aussi les
cookies de ses victimes, c'est à dire leur jeton d'identification. Il peut ainsi se faire passer
pour eux. <b>HTTPS</b> est une solution transparente puisqu'elle ne change en rien le code <b>PHP</b>.
</p>
</div>

<div class="slide">
<h3>Visibilité des fichiers</h3>

<p class="textOnly">
    Parfois, il arrive que votre serveur web soit temporairement mal configuré, lors par exemple
d'une migration ou d'un bug. A ce moment là, les fichiers sources de votre code <b>PHP</b> pourraient
par exemple ne pas être interprétés et être téléchargeables par les visiteurs tel quels. Cela pose
évidemment d'énorme problèmes car ces fichiers contiennent le mot de passe pour accéder à la base
de données, et beaucoup de choses secrètes. Pour minimiser ce risque, il est conseillé d'aborder
une architecture de répértoire séparant le code <b>PHP</b> pur et dur de la partie visible par vos
visiteurs&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/architecture.php', 'html'); ?>
</div>

<div class="slide">
<h3>Upload de fichiers</h3>
<p class="textOnly">
    Certaines application web autorisent l'upload de fichier, pour récupérer des photos, vidéos etc.
Cette pratique doit être scrupuleusement surveillée car une faille dans l'upload pourrait permettre
à un attaquant d'exécuter du code <b>PHP</b> arbitraire. Et il faut faire attention, car le code
<b>PHP</b> a très souvent le droit d'accéder au système via <a href="http://php.net/shell_exec"><code>shell_exec()</code></a>
par exemple. Si l'utilisateur upload le fichier suivant :
</p>

<?php echo $slidey->highlight('files/05/upload.php'); ?>

<p class="textOnly">
    Dans ce cas là, il est recommandé de&nbsp;:
</p>

<ul>
    <li class="discover">Vérifier que le contenu du fichier a bien une forme attendu</li>
    <li class="discover">Nommer les fichiers automatiquement à partir de valeurs aléatoire et d'extension imposées</li>
    <li class="discover">Désactiver l'interpreteur <b>PHP</b> dans les endroits sensibles</li>
</ul>

<p class="warning discover">
    Attention aux extensions multiples, un fichier nommé "a.php.jpeg" sera interprété!
</p>

<p class="textOnly">
    Il aura alors accès à un véritable shell miniature et pourra prendre le contrôle du serveur.
</p>
</div>

<div class="slide">
<h3>Atention à l'inclusion</h3>
<p class="textOnly">
    Sur des petits site web, il arrive parfois que le routeur soit fait de manière très artisanale de cette
manière&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/include.php'); ?>

<p class="textOnly">
    Cette manière de faire est dangereuse. Elle permet à l'utilisateur d'inclure n'importe quel fichier
présent sur le serveur, voire d'interpréter du code arbitraire. Il faut dans ce cas exercer un contrôle 
très précis sur le nom de la page.
</p>

</div>

<div class="slide">
<h3>Failles XSS</h3>
<p class="textOnly">
    Imaginons le formulaire suivant&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/xss.php'); ?>

<p class="textOnly">
    L'utilisateur pourra saisir n'importe quelle valeur, elle sera affichée dans la page. Le problème, c'est que 
le code HTML sera lui aussi interprété. Par exemple, si l'utilisateur saisit <code>&lt;u&gt;test&lt;/u&gt;</code>,
le mot "<u>test</u>" apparaîtra en souligné. Ainsi, un utilisateur mal intentionné pourra par exemple injecter du code
Javascript dans la page, et aura accès entre autre à la variable <code>document.cookie</code> qui contient le
cookie du navigateur exécutant le code. En s'arrangeant pour qu'une victime se rende sur son lien, il pourra alors
récupérer son cookie et s'identifier à sa place.
</p>

<p class="textOnly">
    La solution est d'échapper systématiquement toutes les variables affichées à l'aide de la fonction
<a href="http://php.net/htmlspecialchars"><code>htmlspecialchars()</code></a>. Cette opération est fastidieuse
et risquée, car le moindre oubli pourrait ouvrir une brèche sur l'application ainsi créée. Pour palier à cela,
certains moteurs de templates offrent la possibilité d'échapper tout par défaut.
</p>

</div>

<div class="slide">
<h3>Failles CSRF</h3>
<p class="textOnly">
    Imaginez la page suivant&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/csrf.php', 'html5'); ?>

<p class="textOnly">
    Et si, à l'instar de l'attaquant XSS, quelqu'un vous envoyait un e-mail ou vous faisait cliquer sur un lien,
via un autre site dont il a le contrôle, pointant vers <code>destroy.php</code>? Vous détruiriez votre compte
sans même vous en aperçevoir. C'est ce que l'on apelle une faille CSRF (Corss Site ReFerencing). Les formulaires
soumis à l'aide de POST peuvent également être victime de ces attaques.
</p>
<p class="textOnly">
    Pour éviter cela, il est nécessaire de générer un jeton CSRF et de le stocker dans la session, puis de le
placer dans un champ caché (<em>input hidden</em>) du formulaire. Au moment de la requête, si le jeton fournit 
par l'utilisateur est égal à celui contenu dans la session, c'est bien qu'il est passé par le site pour obtenir 
son formulaire.
</p>
</div>

<div class="slide">
<h3>Injection SQL</h3>
<p class="textOnly">
    Comme il a été expliqué plus tôt, dans le chapitre sur la base de données, il est très mauvais de créer
des requêtes SQL par concaténation de chaîne de caractères. Prenons par exemple&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/sql.php'); ?>


<div class="discover">
<p>
    Si l'utilisateur saisit le mot de passe suivant&nbsp;
</p>

<p>
<code>
" OR "1"="1
</code>
</p>
</div>

<div class="discover">
<p>
    La requête deviendra alors&nbsp;:
</p>

<p>
<code>
SELECT * FROM users WHERE login="admin" AND password="<span style="color:red">" OR "1"="1</span>"
</code>
</p>
</div>

<p class="textOnly">
    Ce qui est toujours vrai. Il faut donc éviter absolument de générer des requêtes à la main et toujours
utiliser le mécanisme de préparation des requêtes.
</p>

</div>

<div class="slide">
<h3>Hachage des mots de passes</h3>

<p class="textOnly">
    Il faut parfois penser au pire, et même au jour ou votre base de données aura été piratée et
téléchargée par un utilisateur mal intentionné. Si les mots de passe des utilisateurs sont stockés
en clair, il sera facile pour un attaquant d'essayer d'utiliser ces mots de passe pour accéder à la
messagerie, au compte bancaire ou à tout autre service sur lesquels vos utilisateurs sont inscrits.
Pour vous protéger, vous pouvez utiliser une fonction de hachage&nbsp;:
</p>

<?php echo $slidey->highlight('files/05/md5.php'); ?>

<p class="textOnly">
    Dans cet exemple, le mot de passe (admin) n'apparaît pas en clair dans le code source et ne
peut d'ailleurs être retrouvé que par force brute.
</p>
</div>
