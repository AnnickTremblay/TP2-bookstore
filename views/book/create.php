{# Formulaire d'ajout d'un livre (affiche aussi les erreurs de validation). #}

{{ include('layouts/header.php', {title: 'Add a book'}) }}

        <h1>Add a book</h1>
        <form method="POST">
            <label>Title
                {# value : remet la valeur saisie (book vient du contrôleur: $data). #}
                <input type="text" name="title" value="{{book.title}}">
            </label>
            {# Affiche l'erreur du champ si elle existe dans le tableau errors. #}
            {% if errors.title is defined %}
                <span class="error">{{ errors.title }}</span>
            {% endif %}
            <label>ISBN
                <input type="text" name="isbn" pattern="[0-9]{13}" maxlength="13" title="13 chiffres sans tirets" value="{{book.isbn}}">
            </label>
            {% if errors.isbn is defined %}
                <span class="error">{{ errors.isbn }}</span>
            {% endif %}
            <label>Description
                <input type="text" name="description" value="{{book.description}}">
            </label>
            {% if errors.description is defined %}
                <span class="error">{{ errors.description }}</span>
            {% endif %}
            <label>Price
                <input type="number" name="price" value="{{book.price}}" step="0.01">
            </label>
            {% if errors.price is defined %}
                <span class="error">{{ errors.price }}</span>
            {% endif %}
            <label>Author
                <select name="author_id">
                    <option value="">Select an Author</option>
                    {% for author in authors %}
                        {# selected : seulement pour l'auteur déjà choisi. #}
                        <option value="{{ author.id }}" {% if author.id == book.author_id %}selected{% endif %}>{{ author.name }}</option>
                    {% endfor %}
                </select>
            </label>
            {% if errors.author_id is defined %}
                <span class="error">{{ errors.author_id }}</span>
            {% endif %}

             <input type="submit" value="Save" class="btn">
        </form>

{{ include('layouts/footer.php') }}