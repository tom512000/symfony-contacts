# Symfony
## Auteur(s)
- Tom SIKORA (siko0001)

## Installation / Configuration
- `composer start` : Lance le serveur web de test.
- `composer test:cs` : Lance la commande de vérification du code par PHP CS Fixer.
- `composer fix:cs` : Lance la commande de correction du code par PHP CS Fixer.
- `composer test:codeception` : Nettoie le répertoire « _output » et le code généré par Codeception, initialise la base de données de test et lance les tests de Codeception.
- `composer test` : Teste la mise en forme du code et lance les tests avec Codeception.
- `composer bd` : Détruit et recrée la base de données, migre sa structure et regénère les données factices.

## Structure de la base de données

|id|firstname|lastname|email|
|:-:|:-:|:-:|:-:|
|int(11)|varchar(30)|varchar(40)|varchar(100)|
|x|utf8mb4_unicode_ci|utf8mb4_unicode_ci|utf8mb4_unicode_ci|
|Non Null|Non Null|Non Null|Non Null|
|Aucun(e) valeur par défaut|Aucun(e) valeur par défaut|Aucun(e) valeur par défaut|Aucun(e) valeur par défaut|
|Incrémentation automatique|x|x|x|

## Autres
- Les fichiers .env et .env.test sont ajoutés 
