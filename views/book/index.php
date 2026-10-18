{# Liste de tous les livres (reçoit la variable books de BookController::index). #}

{{ include ('layouts/header.php', {title: 'Books'}) }}
        <div class="page-header">
            <h1>Books</h1>
            {# Bouton vers le formulaire d'ajout. #}
            <a href="{{base}}/book/create" class="btn">New Book</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
                {# Répète une ligne du tableau pour chaque livre de books. #}
                {% for book in books %}
                <tr>
                    {# Le titre est un lien vers le détail du livre (exemple: /book/show?id=3). #}
                    <td><a href="{{base}}/book/show?id={{book.id}}">{{ book.title }}</a></td>
                    <td>{{ book.isbn }}</td>
                    <td>{{ book.description }}</td>
                    <td>{{ book.price }} $</td>
                    <td>{{ book.author_name }}</td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
{{ include('layouts/footer.php') }}
