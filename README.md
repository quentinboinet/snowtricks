# Snowtricks
Dépôt contenant le code du projet 6 du parcours développeur d'applications PHP - Symfony de OpenClassrooms

<a href="https://codeclimate.com/github/quentinboinet/snowtricks/maintainability"><img src="https://api.codeclimate.com/v1/badges/0d758c1f57a3b07ceabb/maintainability" /></a>

<h1>Instructions d'installation :</h1>

<p>
  <ol>
    <li>Clonez ou téléchargez le contenu du dépôt GitHub : <i>git clone https://github.com/quentinboinet/snowtricks.git</i></li>
    <li>Editez le fichier situé à la racine intitulé ".env" afin de remplacer les valeurs de paramétrage de la base de données et du serveur de mail.</li>
    <li>Installez les dépendances du projet avec : <i>composer install</i></li>
    <li>Créez la base de données avec la commande suivante : <i>php bin/console doctrine:database:create</i></li>
    <li>Importez ensuite le jeu de données initiales contenues dans le fichier "snowtricks.sql", avec : <i>php bin/console doctrine:database:import snowtricks.sql</i></li>
      <li>Afin de lancer le serveur, lancez la commande <i>php bin/console server:run</i></li>
      </ol>   
   Bravo, le projet Snowtricks est désormais accessible à l'adresse : localhost:8000 !
</p>
