# Système de Gestion de Commandes

Application web PHP pour la gestion complète des commandes, clients et articles avec interface d'administration.

## 📋 Description

Ce projet est un système de gestion de commandes développé en PHP qui permet de :
- Gérer les articles (ajout, modification, suppression)
- Gérer les clients
- Créer et gérer les commandes
- Afficher les détails des commandes
- Contacter via un formulaire de contact
- Authentification des utilisateurs avec session

## 🛠️ Technologies Utilisées

- **PHP** - Langage de programmation backend
- **MySQL** - Base de données relationnelle
- **PDO** - Interface d'accès aux données
- **Bootstrap 5** - Framework CSS pour l'interface utilisateur
- **jQuery** - Bibliothèque JavaScript
- **DataTables** - Plugin pour les tableaux interactifs
- **Font Awesome** - Icônes
- **Owl Carousel** - Carrousel d'images

## 📦 Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP** (version 7.4 ou supérieure)
- **MySQL** (version 5.7 ou supérieure) ou **MariaDB**
- **Serveur web** (Apache, Nginx) ou serveur de développement intégré PHP
- **Composer** (optionnel, pour la gestion des dépendances)

## 🚀 Installation

### 1. Cloner le dépôt

```bash
git clone <url-du-depot>
cd projet
```

### 2. Configuration de la base de données

#### Créer la base de données

Connectez-vous à MySQL et exécutez :

```sql
CREATE DATABASE gestioncommandes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Créer les tables

Vous devrez créer les tables suivantes dans votre base de données :

```sql
-- Table des utilisateurs
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Table des clients
CREATE TABLE client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    ville VARCHAR(255),
    telephone VARCHAR(50)
);

-- Table des articles
CREATE TABLE article (
    id_article INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    prix_unitaire DECIMAL(10, 2)
);

-- Table des images
CREATE TABLE image (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    nom_img VARCHAR(255),
    chemin_img VARCHAR(255),
    taille_img INT,
    id_article INT,
    FOREIGN KEY (id_article) REFERENCES article(id_article)
);

-- Table des commandes
CREATE TABLE commande (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    date DATE,
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

-- Table des lignes de commande
CREATE TABLE ligne_commande (
    id_ligne INT AUTO_INCREMENT PRIMARY KEY,
    id_article INT,
    id_commande INT,
    quantité INT,
    FOREIGN KEY (id_article) REFERENCES article(id_article),
    FOREIGN KEY (id_commande) REFERENCES commande(id_commande)
);

-- Table de contact
CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### Créer un utilisateur par défaut

```sql
INSERT INTO user (username, password) VALUES ('admin', 'mot_de_passe');
```

**⚠️ Important** : Changez le mot de passe par défaut avant la mise en production !

### 3. Configuration de la connexion

Modifiez le fichier `connexion.php` avec vos paramètres de base de données :

```php
const HOST="localhost";
const DB="gestioncommandes";
const USER="root";
const PSW="";  // Votre mot de passe MySQL
```

### 4. Configuration du serveur web

#### Avec Laragon / XAMPP / WAMP

1. Placez le projet dans le dossier `www` (Laragon) ou `htdocs` (XAMPP/WAMP)
2. Assurez-vous que Apache et MySQL sont démarrés
3. Accédez à `http://localhost/projet`

#### Avec le serveur PHP intégré

```bash
php -S localhost:8000
```

Puis accédez à `http://localhost:8000`

## 📁 Structure du Projet

```
projet/
│
├── css/                 # Feuilles de style CSS
│   ├── style.css
│   ├── main.css
│   ├── animate.css
│   └── owl.carousel.min.css
│
├── js/                  # Scripts JavaScript
│   ├── custom.js
│   ├── animate.js
│   └── owl.carousel.min.js
│
├── images/              # Images et ressources
│
├── header.php           # En-tête commun
├── footer.php           # Pied de page commun
├── main.php             # Conteneur principal et connexion BDD
├── connexion.php        # Classe de connexion PDO
│
├── index.php            # Page de connexion
├── accueil.php          # Page d'accueil après connexion
├── home.php             # Page d'accueil publique
├── aboutus.php          # Page À propos
├── contact.php          # Formulaire de contact
│
├── articles.php         # Liste des articles
├── addarticle.php       # Ajout d'article
├── modifarticle.php     # Modification d'article
│
├── clients.php          # Liste des clients
├── addclient.php        # Ajout de client
├── modifclient.php      # Modification de client
│
├── commandes.php        # Liste des commandes
├── addcommande.php      # Ajout de commande
├── modifcommande.php    # Modification de commande
├── details.php          # Détails d'une commande
│
├── loggin.php           # Traitement de connexion
├── logout.php           # Déconnexion
├── delete.php           # Suppression d'éléments
│
└── README.md            # Ce fichier
```

## 🔑 Utilisation

### Connexion

1. Accédez à la page de connexion (`index.php`)
2. Entrez vos identifiants (username et password)
3. Optionnel : cochez "Se souvenir de moi" pour rester connecté

### Gestion des Articles

- **Voir les articles** : Accédez à `articles.php`
- **Ajouter un article** : Utilisez le formulaire dans `addarticle.php`
- **Modifier un article** : Accédez à `modifarticle.php?id=X`
- **Supprimer un article** : Utilisez `delete.php` avec les paramètres appropriés

### Gestion des Clients

- **Voir les clients** : Accédez à `clients.php`
- **Ajouter un client** : Utilisez le formulaire dans `addclient.php`
- **Modifier un client** : Accédez à `modifclient.php?id=X`
- **Supprimer un client** : Utilisez `delete.php`

### Gestion des Commandes

- **Voir les commandes** : Accédez à `commandes.php`
- **Créer une commande** : Utilisez le formulaire dans `addcommande.php`
- **Modifier une commande** : Accédez à `modifcommande.php?id=X`
- **Voir les détails** : Accédez à `details.php?id=X`

## 🔒 Sécurité

⚠️ **Note importante** : Ce projet est destiné à un usage éducatif ou de développement. Pour la production, veuillez :

1. **Ne jamais stocker les mots de passe en clair** - Utilisez le hachage avec `password_hash()` et `password_verify()`
2. **Préparer les requêtes SQL** - Utilisez toujours des requêtes préparées (déjà implémenté avec PDO)
3. **Valider les entrées** - Ajoutez une validation côté serveur
4. **Protéger contre les injections SQL** - Utilisez les requêtes préparées (déjà fait)
5. **Utiliser HTTPS** - En production, utilisez un certificat SSL
6. **Configurer correctement les sessions** - Utilisez des sessions sécurisées
7. **Gérer les erreurs** - Ne pas afficher les erreurs sensibles en production
8. **Séparer les identifiants** - Ne pas mettre les identifiants de BDD dans le code source (utilisez des variables d'environnement)

## 🐛 Dépannage

### Erreur de connexion à la base de données

- Vérifiez que MySQL est démarré
- Vérifiez les identifiants dans `connexion.php`
- Vérifiez que la base de données existe

### Page blanche

- Activez l'affichage des erreurs PHP dans `php.ini` :
  ```ini
  display_errors = On
  error_reporting = E_ALL
  ```
- Vérifiez les logs d'erreur Apache/PHP

### Problèmes de session

- Vérifiez que `session_start()` est appelé au début de chaque page
- Vérifiez les permissions d'écriture du dossier de sessions

## 📝 License

Ce projet est fourni tel quel pour un usage éducatif et de développement.

## 👥 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :
1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📧 Contact

Pour toute question ou suggestion, utilisez le formulaire de contact dans l'application.

---

**Développé avec ❤️ en PHP**

