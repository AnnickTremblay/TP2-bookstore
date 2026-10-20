{# Haut de page commun à toutes les vues (inclus avec {{ include('layouts/header.php', {title: '...'}) }}). #}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {# asset : chemin du dossier public (défini dans config.php). #}
    <link rel="stylesheet" href="{{ asset }}/css/style.css">
    {# title : le titre envoyé par chaque vue. #}
    <title>{{ title }}</title>
</head>
<body>
    <header>
        {# Menu de navigation (base : début des adresses, défini dans config.php). #}
        <nav>
            <ul>
                <li><a href="{{ base }}/">Home</a></li>
                <li><a href="{{ base }}/books">Books</a></li>
                <li><a href="{{ base }}/stats">Statistics</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">