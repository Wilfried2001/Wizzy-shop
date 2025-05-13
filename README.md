
# Projet Laravel 10 avec Filament, TailwindCSS, Preline UI et Livewire

Ce projet est une application web construite avec Laravel 10, intégrant des outils modernes pour une gestion d'interface utilisateur efficace et une expérience de développement optimisée.

## Technologies utilisées

- **Laravel 10** : Framework PHP pour la gestion de l'application backend.
- **Filament 3.3** : Un panneau d'administration moderne et élégant pour Laravel.
- **TailwindCSS 3.4.17** : Framework CSS utilitaire pour la conception rapide d'interfaces.
- **Preline UI 2.0.0** : Une bibliothèque d'interface utilisateur pré-conçue pour les applications Laravel utilisant TailwindCSS.
- **Livewire 3** : Un framework full-stack pour Laravel permettant de rendre les composants interactifs sans écrire de JavaScript complexe.

## Prérequis

Avant de commencer, assurez-vous que vous avez installé les éléments suivants sur votre machine :

- **PHP** : Version 8.1 ou supérieure.
- **Composer** : Gestionnaire de dépendances PHP.
- **Node.js** : Version 16 ou supérieure.
- **NPM** ou **Yarn** : Gestionnaire de paquets JavaScript.

## Installation

### 1. Cloner le repository

```bash
git clone https://github.com/ton-utilisateur/ton-repository.git
cd ton-repository
```

### 2. Installer les dépendances PHP

Assurez-vous que vous êtes dans le dossier de votre projet, puis exécutez :

```bash
composer install
```

### 3. Installer les dépendances front-end

Installez les dépendances JavaScript en utilisant NPM ou Yarn :

```bash
npm install
```

Ou si vous utilisez Yarn :

```bash
yarn install
```

### 4. Configurer l'environnement

Copiez le fichier `.env.example` pour créer votre fichier `.env` :

```bash
cp .env.example .env
```

Puis, générez la clé d'application Laravel :

```bash
php artisan key:generate
```

### 5. Configurer la base de données

Modifiez votre fichier `.env` pour inclure les informations de votre base de données (par exemple, MySQL) :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base
DB_USERNAME=utilisateur
DB_PASSWORD=mot_de_passe
```

### 6. Exécuter les migrations

Appliquez les migrations pour configurer la base de données :

```bash
php artisan migrate
```

### 7. Compiler les assets front-end

Enfin, compilez les assets front-end en exécutant :

```bash
npm run dev
```

Ou si vous utilisez Yarn :

```bash
yarn dev
```

## Utilisation

Une fois que tout est configuré, vous pouvez démarrer le serveur de développement avec la commande suivante :

```bash
php artisan serve
```

Votre application sera disponible à l'adresse suivante : [http://localhost:8000](http://localhost:8000).

## Fonctionnalités principales

- **Panneau d'administration avec Filament 3.3** : Interface moderne pour gérer les données de l'application.
- **Composants réactifs avec Livewire 3** : Facilite la création d'interfaces dynamiques sans JavaScript complexe.
- **Design responsive avec TailwindCSS 3.4.17** : Utilisation des classes utilitaires pour un design flexible et réactif.
- **UI préconçue avec Preline UI 2.0.0** : Composants UI élégants et prêts à l'emploi pour accélérer le développement.

## Contribution

Les contributions sont les bienvenues ! Si vous avez des suggestions ou des améliorations à proposer, n'hésitez pas à ouvrir une *issue* ou à soumettre une *pull request*.

## Licence

Ce projet est sous licence [MIT](LICENSE).


📘 Filament Admin - Guide des Commandes Artisan

Ce projet utilise Filament pour construire une interface d’administration moderne et personnalisable avec Laravel.

📦 Installation de Filament

composer require filament/filament:"^3.3" -W
php artisan filament:install --panels

Pour créer un utilisateur:(Admin ou autre)
php artissan make:filament-user 


⚙️ Commandes Artisan Filament

📁 Ressources (CRUD automatique)

Créer une ressource complète (modèle, formulaire, table, pages) :

php artisan make:filament-resource NomDuModele

Exemple :

php artisan make:filament-resource Brand

🧹 Pages personnalisées

Créer une page personnalisée dans une ressource :

php artisan make:filament-page NomDeLaPage

Exemple :

php artisan make:filament-page Dashboard

🖁️ Relation Managers

Créer un gestionnaire de relation (ex: Produits liés à une Marque) :

php artisan make:filament-relation-manager NomRelation

Exemple :

php artisan make:filament-relation-manager ProductsRelationManager

🔐 Authentification (Facultatif)

Configurer l’authentification des administrateurs :

php artisan make:filament-user

🎨 Widgets

Créer un widget personnalisé (statistiques, graphiques, etc.) :

php artisan make:filament-widget NomWidget

Exemple :

php artisan make:filament-widget StatsOverview

🧱 Panels (Si multi-panels)

Créer un panneau distinct (par exemple : admin, vendeur, etc.) :

php artisan make:filament-panel NomDuPanel

🧪 Autres outils utiles

🔄 Publication des vues et configurations

php artisan vendor:publish --tag=filament-config
php artisan vendor:publish --tag=filament-views

🔍 Debug

Recharger le cache Filament :

php artisan optimize:clear

📚 Documentation

Documentation officielle : filamentphp.com/docs

Widgets tiers : filamentphp.com/plugins

✨ Exemple pratique

Pour créer une ressource Category :

php artisan make:filament-resource Category

Cela générera :

CategoryResource.php (Form & Table)

Pages : ListCategories, CreateCategory, EditCategory

Enregistrement automatique dans le panneau d'administration

Ce projet utilise Laravel x Filament pour offrir une expérience d'administration simple, rapide et personnalisée

# Livewire 3

Livewire est une bibliothèque pour Laravel qui permet de créer des interfaces dynamiques sans avoir besoin de JavaScript personnalisé. Elle permet d'ajouter des comportements interactifs à vos vues sans quitter le contexte de Laravel, en envoyant des requêtes HTTP via AJAX en arrière-plan. Dans ce projet, Livewire 3 est utilisé pour créer des composants interactifs et réactifs dans l'interface utilisateur.

## Installation de Livewire 3

### 1. Ajouter Livewire à votre projet Laravel

Pour installer Livewire, vous devez utiliser Composer. Exécutez la commande suivante pour l'ajouter à votre projet Laravel :

```bash
composer require livewire/livewire:^3.0 


# Preline UI 2.0.0

Preline UI est une bibliothèque de composants d'interface utilisateur pour Tailwind CSS. Elle permet de créer rapidement des interfaces modernes et réactives grâce à une collection de composants préconçus. Dans ce projet, nous avons utilisé Preline UI version 2.0.0 pour ajouter des composants interactifs et esthétiques, tout en conservant la flexibilité de Tailwind CSS.

## Installation de Preline UI

### 1. Ajouter Preline UI à votre projet

Pour installer Preline UI, vous devez d'abord ajouter le package à votre projet. Exécutez la commande suivante avec npm :

```bash
npm install preline



