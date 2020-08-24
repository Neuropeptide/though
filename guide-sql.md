# Aide mémoire MySQL


**Documentation officielle :** [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/) 

## Vocabulaire

Une **base de données** MySQL est un ensemble de **tables**.
Une table comprend des colonnes, appelées **champs**, et des lignes appelées **entrées**.

Les champs correspondent donc à la **structure** des données, et les **entrées** sont les données en elles-mêmes.

| id  | prenom  | nom            | age |
| --- | ------- | -------------- | --- |
| 1   | jacques | dupond         | 42  |
| 2   | marie   | durand         | 17  |
| 3   | alice   | De la fontaine | 74  |
| 4   | jean    | Aymard         | 32  |


## Sélectionner des données :

```sql
SELECT field1, field2 FROM tableName
```

On utilise la clause `SELECT` pour choisir les champs à sélectionner.
On utilise la clause `FROM` pour définir la table à utiliser.

Si on veut récupérer tous les champs d'une table, on peut utiliser le raccourci `*`.

```sql
SELECT * FROM users
```
> Récupère tous les champs de toutes les entrées de la table `users`


> **ATTENTION**:  
    L'astérisque ne veut pas dire "toute les lignes", mais bien **toutes les colonnes**. 

### Filtrer les données :

On peut ajouter une clause pour ne sélectionner que les entrées qui respectent une (ou plusieurs) conditions(s)

```sql
SELECT * FROM users WHERE age > 18
```
> Touver les utilisateurs majeurs

```sql
SELECT * FROM products WHERE promotion = true AND price < 100
```
> Trouver les produits en solde et pas chers

```sql
SELECT * FROM users WHERE country = "france" OR country = "belgique" OR country = "canada"
```
> Trouver les utilisateurs francophones


### Trier les données
On peut demander à MySQL de trier les résultats sur une (ou plusieurs) colonnes

```sql
SELECT * FROM users ORDER BY users.name
```
> Trier les utilisateurs par ordre alphabétique

```sql
SELECT * FROM users ORDER BY users.name DESC, age ASC
```
> Trier les utilisateurs par ordre alphabétique inverse, puis par age, du plus jeune au plus vieux


### Limiter le nombre des données récupérées
Quand on a beaucoup de données, il est souvent judicieux de limiter le jeu de résultats associés à une requête.
On se sert de ça pour mettre une place un système de pagination par exemple.

```sql
SELECT * FROM products LIMIT 100
```
> Trouver les 100 premiers produits de la table 

### Jointures entre tables 

On peut récupérer des données venant de plusieurs tables en une seule requête.
Pour cela on utilise le mot clé `JOIN` pour joindre les **tables**, et le mot clé `ON` pour préciser sur quels **champs** 
faire la jointure.


```sql
SELECT field1, field2, field3 FROM t1 JOIN table2 ON t1.id = t2.fk_id
```

#### Utiliser des alias

Il arrive souvent qu'un même nom de champ soit utilisé dans plusieurs table (ex: le champ `id`), et cela pose problème lors des jointures :

```sql
SELECT id FROM projects JOIN category ON id = category_id
```
> Mais de quelle `id` parle-t-on ici ? Celle des projets, celles des categories ? MySQL levera une erreur en disant que la clause.

Pour lever l'ambiguité, on doit préciser le nom de la table devant la colonne :

```sql
SELECT projects.id FROM projects JOIN category ON category.id = category_id
```

Comme cela peut vite devenir fastidieux à écrire, il est courant d'utiliser des **alias** pour le nom des tables.
(En général, on prend la première lettre de la table)

```sql
SELECT p.id FROM projects as p JOIN category as c ON c.id = p.category_id
```

#### Jointures externes

Par défaut, la clause `JOIN` ne sélectionne que les résultats correspondant à la condition de jointure `ON`
Dans la requête ci dessus, on n'obtient que les projets appartenant à une catégorie. 
Les projets n'ayant pas de catégorie ne sont pas sélectionnés, ni les catégories n'ayant pas de projets.

On peut modifier la clause JOIN pour inclure ce qui nous intéresse :
```sql
SELECT p.id FROM projects as p LEFT JOIN category as c ON c.id = p.category_id
```
> Selectionne **TOUS** les projets, même ceux qui n'ont pas de categories 

```sql
SELECT p.id FROM projects as p RIGHT JOIN category as c ON c.id = p.category_id
```
> Selectionne **TOUTES** les categories, même ceux qui n'ont pas de projets 


(Si on veut les deux, il faudrait une clause `FULL JOIN`, mais elle n'est pas supportée par MySQL, il faudra alors faire une `UNION` des deux requêtes ci dessus)


### Grouper les données

Parfois, on veut grouper les données récupérées. 
Par exemple dans un blog, pour savoir combien d'articles sont associés à chaque catégorie, on pourrait être tenté de faire la requêtes suivante

```sql
SELECT COUNT(posts.id) as total FROM posts JOIN category ON category.id = posts.category_id
```

> 100, car on a 100 projets au total.

On n'est pas très avancés... On peut alors imaginer faire une requete par catégorie, autant de fois qu'il y a des catégories.

```sql
SELECT COUNT(posts.id) as total FROM posts JOIN category ON category.id = posts.category_id WHERE category.id = 1
SELECT COUNT(posts.id) as total FROM posts JOIN category ON category.id = posts.category_id WHERE category.id = 2
# etc... 
```
> Si on additionne les résultats, on va retomber sur 100 (le nombre total de projets).

Mais évidemment c'est loin d'être idéal. MySQL peut faire beaucoup mieux et sortir les résultats attendus en une seule requête.
Pour cela on utilise la clause `GROUP BY`.


```sql
SELECT category.name , COUNT(posts.id) as total FROM posts JOIN category ON category.id = posts.category_id GROUP BY category.id
```
On obtient quelques chose comme :

| name         | total |
| ------------ | ----- |
| cuisine      | 24    |
| art de vivre | 32    |
| jardin       | 26    |
| sport        | 18    |


### Utiliser des fonctions SQL

Il existe tout un tas de fonctions très utiles dans SQL, qui peuvent être utilisées pour sélectionner des données (`SELECT`), mais également pour leur contenu (`INSERT, UPDATE`)

```sql
SELECT COUNT(*) FROM projects WHERE published = true
```
> Compte le nombre de projets publiés 


```sql
SELECT AVG(price) FROM products
```
> Calcule le prix moyen de tous les produits  

```sql
UPDATE user SET lucky_number = CEIL(RAND() * 1000)
```
> Définit un nombre aléatoire (entre 0 et 1000) pour le champ "lucky_number"



## Insérer des données


```sql
INSERT INTO tableName (fieldName1, fieldName2, ...) VALUES
(entry1.value1, entry1.value2, ...),
(entry2.value1, entry2.value2, ...),
(entry3.value1, entry3.value2, ...),

```
**Exemple**
```sql
INSERT INTO services (`name`) VALUES 
("interior"), 
("concept"),
("residential"),
("hospitality"),
```
> Créer 4 lignes de une colonne

**Exemple**
```sql
INSERT INTO users (username, password, email) VALUES 
("toto", "azeaze", "toto@mail.com"), 
("jon", "azerty", "jon@webmail.io"), 
("zozor_du_33", "mdp", "jean.delatour@mail.com"), 
```
> Créer 3 utilisateurs


## Mettre à jour des données

```sql
UPDATE tableName SET field1 = value1, field2 = value2, ...
```

> **ATTENTION**: Par défaut la clause `UPDATE` met à jour toutes les lignes de la table ! 

Si on ne veut mettre à jour que certaines lignes, il faut la combiner à la clause `WHERE`


```sql
UPDATE users SET email = "new-adress@mail.io" WHERE id = 42
```
> Met à jour l'email de l'utilisateur 42 uniquement