<?php
include_once "../controllers/controllerUtilisateur.php";
include_once "../controllers/controllerProduit.php";
include_once "../controllers/controllerCommande.php";

$servername = "localhost";
$username = "root";
$password = "";
try {
    $connexion = new PDO("mysql:host=$servername;dbname=unicap", $username, $password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $modeleUtilisateur = new ModeleUtilisateur($connexion);
    $controllerUtilisateur = new ControllerUtilisateur($modeleUtilisateur);
    
    $modeleProduit = new ModeleProduit($connexion);
    $controllerProduit = new ControllerProduit($modeleProduit);

    $modeleCommande = new ModeleCommande($connexion);
    $controllerCommande = new controllerCommande($modeleCommande);
    

        

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'login':
                if (isset($_POST['email']) && isset($_POST['mot_de_passe'])) {
                    $email = $_POST['email'];
                    $mot_de_passe = $_POST['mot_de_passe'];
                    $utilisateur = $controllerUtilisateur->login($email, $mot_de_passe);
                    if ($utilisateur) {
                        session_start();
                        $_SESSION['utilisateur'] = $utilisateur;
                        header('Location: index.php?action=home');
                    } else {
                        echo "Email ou mot de passe incorrect.";
                    }
                }
                include "../views/vueLogin.php";
                break;
                case 'inscription':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['telephone'], $_POST['mot_de_passe'], $_POST['adresse'])) {
                        $nom = $_POST['nom'];
                        $prenom = $_POST['prenom'];
                        $email = $_POST['email'];
                        $telephone = $_POST['telephone'];
                        $mot_de_passe = $_POST['mot_de_passe'];
                        $adresse = $_POST['adresse'];
                                
                        $controllerUtilisateur->inscription($nom, $prenom, $email, $telephone, $mot_de_passe, $adresse);
                
                        header('Location: index.php?action=login');
                        exit;
                    }
                    include "../views/vueInscription.php";
                    break;
                
case 'home':
    $produits = $controllerProduit->getProduits();
    include "../views/vueHome.php";
    break;

case 'detailProduit':
    if (isset($_GET['id_Produit'])) {
        $id_Produit = $_GET['id_Produit'];
        $produit = $controllerProduit->getProduitById($id_Produit);
        include "../views/vueDetailProduit.php";
    }
    break;
    
    case 'modifierProduit':
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole() == 'admin') {
        if (isset($_GET['id_Produit'])) {
            $id_Produit = $_GET['id_Produit'];
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nom = $_POST['nom'];
                $prix = $_POST['prix'];
                $description = $_POST['description'];
                $courte_description = $_POST['courte_description'];
                $quantite = $_POST['quantite'];
    
                $chemin_image = null;
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $chemin_image = "uploads/" . basename($_FILES['image']['name']);
                    move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image);
                }
    
                $result = $controllerProduit->modifierProduit($id_Produit, $nom, $prix, $description, $courte_description, $quantite, $chemin_image);
    
                if ($result) {
                    header('Location: index.php?action=gestionProduits'); 
                    exit;
                } else {
                    echo "<p>Erreur lors de la modification du produit.</p>";
                }
            } else {
                $produit = $controllerProduit->getProduitById($id_Produit);
                if ($produit) {
                    include "../views/modifierProduit.php";
                } else {
                    echo "<p>Produit introuvable.</p>";
                }
            }
        } else {
            echo "<p>ID du produit manquant dans l'URL.</p>";
        }
    } else {
        header('Location: index.php?action=home');
    }
    break;
    case 'supprimerCommande':
        if (isset($_GET['id_Commande'])) {
            $id_Commande = $_GET['id_Commande'];
            $modeleCommande->supprimerCommande($id_Commande);
            header('Location: index.php?action=home');
        }break;
    
    case 'modifierUtilisateurC':
        if (isset($_SESSION['utilisateur']) && ($_SESSION['utilisateur']->getRole() == 'client' || $_SESSION['utilisateur']->getRole() == 'admin')) {
        if (isset($_GET['id_utilisateur'])) {
            $id_utilisateur = $_GET['id_utilisateur'];
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $telephone = $_POST['telephone'];
                $adresse = $_POST['adresse'];
                $role = ($_SESSION['utilisateur']->getRole() === 'admin') ? $_POST['role'] : 'client';
              
                $result = $controllerUtilisateur->modifierUtilisateur($id_utilisateur, $nom, $prenom, $email, $telephone, $adresse,$role);
                
                if ($result) {
                    if ($_SESSION['utilisateur']->getIdUtilisateur() == $id_utilisateur) {
                        $_SESSION['utilisateur'] = $controllerUtilisateur->getUtilisateurById($id_utilisateur);
                    }

                    header('Location: index.php?action=gestionUtilisateurs');
                    exit;
                } else {
                    echo "<p>Erreur lors de la modification de l'utilisateur.</p>";
                }
            } else {
                $utilisateur = $controllerUtilisateur->getUtilisateurById($id_utilisateur);
                if ($utilisateur) {
                    include "../views/modifierUtilisateur.php";
                } else {
                    echo "<p>Utilisateur introuvable.</p>";
                }
            }
        } else {
            echo "<p>ID de l'utilisateur manquant dans l'URL.</p>";
        }
    } else {
        header('Location: index.php?action=monCompte');
    }
    break;
        
            case 'enregistrerCommande':
                if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole() == 'client') {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_SESSION['panier'])) {
                    $panier = $_SESSION['panier'] ?? [];
                    $utilisateur = $_SESSION['utilisateur'];
                    if ($utilisateur) {
                        $result = $controllerCommande->enregistrerCommande($panier, $utilisateur);
                        if ($result) {
                            unset($_SESSION['panier']);
                            echo "<p>Commande enregistrée avec succès.</p>";
                            header('Location: index.php?action=monCompte');
                            exit;
                        } else {
                            echo "<p>Erreur lors de l'enregistrement de la commande.</p>";
                        }
                    } else {
                        echo "Veuillez vous connecter pour finaliser la commande.";
                    }
                }
            } else {
                header('Location: index.php?action=login');
            }
            break;
            
            
            
            case 'ajouterPanier':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id_produit = $_POST['id_produit'];
                    $nom = $_POST['nom'];
                    $prix = $_POST['prix'];
                    $quantite = $_POST['quantite'];
            
                    if (!isset($_SESSION['panier'])) {
                        $_SESSION['panier'] = [];
                    }
            
                    $produitExistant = false;
                    foreach ($_SESSION['panier'] as &$item) {
                        if ($item['id_produit'] == $id_produit) {
                            $item['quantite'] += $quantite;
                            $produitExistant = true;
                            break;
                        }
                    }
                    if (!$produitExistant) {
                        $_SESSION['panier'][] = [
                            'id_produit' => $id_produit,
                            'nom' => $nom,
                            'prix' => $prix,
                            'quantite' => $quantite
                        ];
                    }
            
                    header('Location: index.php?action=home');
                    exit;
                }
                break;
                    case 'afficherPanier':
                        if (!isset($_SESSION['utilisateur'])) {
                            header('Location: index.php?action=login');
                            exit;
                        }
                    
                        $id_utilisateur = $_SESSION['utilisateur']->getIdUtilisateur();
                        $adresses = $controllerUtilisateur->getAdressesByUtilisateur($id_utilisateur);
                        include "../views/vuePanier.php";
                        break;
                    
                    case 'retirerPanier':
                        if (isset($_GET['id_produit'])) {
                            $id_produit = $_GET['id_produit'];
                    
                            foreach ($_SESSION['panier'] as $key => $item) {
                                if ($item['id_produit'] == $id_produit) {
                                    unset($_SESSION['panier'][$key]);
                                    break;
                                }
                            }
                    
                            $_SESSION['panier'] = array_values($_SESSION['panier']);
                            header('Location: index.php?action=afficherPanier');
                            exit;
                        }
                        break;
                    
            case 'supprimerUtilisateur':
                if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole() == 'admin') {
                if (isset($_GET['id_utilisateur'])) {
                    $id_utilisateur = $_GET['id_utilisateur'];
            
                    $result = $controllerUtilisateur->supprimerUtilisateur($id_utilisateur);
            
                    if ($result) {
                        header('Location: index.php?action=gestionUtilisateurs');
                        exit;
                    } else {
                        echo "<p>Erreur lors de la suppression de l'utilisateur.</p>";
                    }
                } else {
                    echo "<p>ID de l'utilisateur manquant dans l'URL.</p>";
                }
            } else {
                header('Location: index.php?action=home');
            }
            break;
                    
    
                case 'supprimerProduit':
                    if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole() == 'admin') {
                    if (isset($_GET['id_Produit'])) {
                        $id_Produit = $_GET['id_Produit'];
                        $modeleProduit->supprimerProduit($id_Produit);
                        header('Location: index.php?action=home');
                    }
                } else {
                    header('Location: index.php?action=home');
                }
                break;
                    
    case 'ajouterProduit':
        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole() == 'admin') {
        if (isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['description']) && isset($_POST['courte_description']) && isset($_POST['quantite']) && isset($_FILES['chemin_image'])) {
            $nom = $_POST['nom'];
            $prix = $_POST['prix'];
            $description = $_POST['description'];
            $courte_description = $_POST['courte_description'];
            $quantite = $_POST['quantite'];
            $chemin_image = "uploads/" . basename($_FILES['chemin_image']['name']);
            move_uploaded_file($_FILES['chemin_image']['tmp_name'], $chemin_image);
            $controllerProduit->ajouterProduit($nom, $prix, $description, $courte_description, $quantite, $chemin_image);
            header('Location: index.php?action=home');
        }
        include "../views/vueAjouterProduit.php";
    } else {
        header('Location: index.php?action=home');
    }
        break;
        case 'logout':
            session_destroy();
            header('Location: index.php?action=login');
            break;

        case 'monCompte':
            if (isset($_SESSION['utilisateur'])) {
                $utilisateur = $_SESSION['utilisateur'];
                $commandes = $controllerUtilisateur->getCommandesUtilisateur($utilisateur->getIdUtilisateur());
                include "../views/vueMonCompte.php";
            } else {
                header('Location: index.php?action=login');
            }
            break;
            case 'gestionUtilisateurs':
                if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole() == 'admin') {
                    $utilisateurs = $controllerUtilisateur->getUtilisateurs();
                    include "../views/vueGestionUtilisateurs.php";
                } else {
                    header('Location: index.php?action=home');
                }
                break;
            
                case 'gestionProduits':
                    if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole()=='admin') {
                        $produits = $controllerProduit->getProduits();
                        include "../views/vueGestionProduits.php";
                    } else {
                        header('Location: index.php?action=home');
                    }
                    break;
                    case 'gestionCommandes':
                        if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getRole()=='admin') {
                            $commandes = $controllerCommande->getCommandes();
                            include "../views/vueGestionCommandes.php";
                        } else {
                            header('Location: index.php?action=home');
                        }
                        break;
                


default:
include "../views/vueHome.php";
}
} else {
header('Location: index.php?action=login');
}
} catch (PDOException $e) {
echo "Erreur: " . $e->getMessage();
}
    ?>
    