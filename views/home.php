{# Page d'accueil (vue statique, aucune donnée de la base à afficher). #}

{{ include('layouts/header.php', {title: 'Home'}) }}

<h1>Bookstore</h1>
<p>Welcome to my bookstore</p>

{{ include('layouts/footer.php') }}