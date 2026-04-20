# Mini LinkedIn - API Backend

## Description
API REST d'une plateforme de recrutement développée avec Laravel.

## Prérequis
- PHP >= 8.1
- Composer
- MySQL
- Laravel 11

## Installation

### 1. Cloner le projet
```bash
git clone https://github.com/votre-repo/mini-linkedin.git
cd mini-linkedin
```

### 2. Installer les dépendances
```bash
composer install
```

### 3. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurer la base de données
Dans `.env` :
DB_DATABASE=nom_de_votre_db
DB_USERNAME=ton_db_username
DB_PASSWORD=

### 5. Générer la clé JWT
```bash
php artisan jwt:secret
```

### 6. Lancer les migrations et seeders
```bash
php artisan migrate:fresh --seed
```

### 7. Lancer le serveur
```bash
php artisan serve
```

## Routes

### Authentification
| Méthode | Route | Description | Auth |
|---------|-------|-------------|------|
| POST | /api/register | Inscription | 
| POST | /api/login | Connexion | 
| POST | /api/logout | Déconnexion |
| GET | /api/me | Profil connecté | 

### Profil Candidat
| Méthode | Route | Description | Auth |
|---------|-------|-------------|------|
| POST | /api/profil | Créer profil | candidat |
| GET | /api/profil | Voir profil | candidat |
| PUT | /api/profil | Modifier profil | candidat |
| POST | /api/profil/competences | Ajouter compétence | candidat |
| DELETE | /api/profil/competences/{competence} | Supprimer compétence | candidat |

### Offres
| Méthode | Route | Description | Auth |
|---------|-------|-------------|------|
| GET | /api/offres | Liste des offres | 
| GET | /api/offres/{offre} | Détail offre | 
| POST | /api/offres | Créer offre | recruteur |
| PUT | /api/offres/{offre} | Modifier offre | recruteur |
| DELETE | /api/offres/{offre} | Supprimer offre | recruteur |

### Candidatures
| Méthode | Route | Description | Auth |
|---------|-------|-------------|------|
| POST | /api/offres/{offre}/candidater | Postuler | candidat |
| GET | /api/mes-candidatures | Mes candidatures | candidat |
| GET | /api/offres/{offre}/candidatures | Candidatures reçues | recruteur |
| PATCH | /api/candidatures/{candidature}/statut | Changer statut | recruteur |

### Administration
| Méthode | Route | Description | Auth |
|---------|-------|-------------|------|
| GET | /api/admin/users | Liste utilisateurs | admin |
| DELETE | /api/admin/users/{user} | Supprimer compte | admin |
| PATCH | /api/admin/offres/{offre} | Activer/désactiver offre | admin |

## Events & Listeners
| Event | Listener | Trigger |
|-------|----------|---------|
| CandidatureDeposee | LogCandidatureDeposee | Quand le postule |
| StatutCandidatureMis | LogStatutCandidatureMis | Quand le recruteur modifie statut |

## Team
- BELLOUS Aya : Authenfication, Profil du candidat avec ses competences, 1 Event & Listener
- EL-JEZZAR Ibtissame : Offres, Candidature, Administration, 1 Event & Listener