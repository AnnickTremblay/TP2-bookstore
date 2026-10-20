{# Page des statistiques (affiche le nombre de lignes de chaque table). #}

{{ include('layouts/header.php', {title: 'Statistics'}) }}

<h1>Statistics</h1>

{# Une carte par table (nbBooks, nbAuthors, etc. viennent du HomeController). #}
<div class="stats">
    <div class="stat-card">
        <span class="stat-number">{{ nbBooks }}</span>
        <span class="stat-label">Books</span>
    </div>
    <div class="stat-card">
        <span class="stat-number">{{ nbAuthors }}</span>
        <span class="stat-label">Authors</span>
    </div>
    <div class="stat-card">
        <span class="stat-number">{{ nbClients }}</span>
        <span class="stat-label">Clients</span>
    </div>
    <div class="stat-card">
        <span class="stat-number">{{ nbSales }}</span>
        <span class="stat-label">Sales</span>
    </div>
</div>

{{ include('layouts/footer.php') }}
