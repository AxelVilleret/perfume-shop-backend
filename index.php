<?php
require_once('src/controllers/autres/accueil.php');
require_once('src/controllers/client/gestion_clients.php');
require_once('src/controllers/client/ajout_client.php');
require_once('src/controllers/client/form_ajoutclient.php');
require_once('src/controllers/client/delete_client.php');
require_once('src/controllers/client/modifier_fiche_client.php');
require_once('src/controllers/client/form_modifier_fiche_client.php');
require_once('src/controllers/commande/gestion_commandes.php');
require_once('src/controllers/commande/export_csv.php');
require_once('src/controllers/client/consulter_fiche_client.php');
require_once('src/controllers/commande/ajout_commande.php');
require_once('src/controllers/commande/form_ajout_commande.php');
require_once('src/controllers/commande/form_modifier_fiche_commande.php');
require_once('src/controllers/commande/modifier_fiche_commande.php');
require_once('src/controllers/commande/consulter_commande.php');
require_once('src/controllers/commande/form_ajout_facture.php');
require_once('src/controllers/article/gestion_des_articles.php');
require_once('src/controllers/commande/ajout_facture.php');
require_once('src/controllers/article/form_ajout_article.php');
require_once('src/controllers/article/ajouter_article.php');
require_once('src/controllers/article/delete_article.php');
require_once('src/controllers/article/form_modifier_article.php');
require_once('src/controllers/article/modifier_fiche_article.php');
require_once('src/controllers/commande/search.php');
require_once('src/controllers/commande/delete_commande.php');
require_once('src/controllers/commande/ajout_article_commande.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'gestion_clients') {
            (new GestionClients())->execute();
        } else if ($_GET['action'] === 'form_ajoutclient') {
            (new FormAjoutClient())->execute();
        } else if ($_GET['action'] === 'ajout_client') {
            (new AjoutClient())->execute($_POST);
        } else if ($_GET['action'] === 'delete_client') {
            if (isset($_GET['id_client']) && $_GET['id_client'] > 0) {
                (new DeleteClient())->execute($_GET['id_client']);
            }
        } else if ($_GET['action'] === 'form_modifier_fiche_client') {
            if (isset($_GET['id_client']) && $_GET['id_client'] > 0) {
                (new FormModifClient())->execute($_GET['id_client']);
            }
        } else if ($_GET['action'] === 'modifier_fiche_client') {
            if (isset($_GET['id_client']) && $_GET['id_client'] > 0) {
                (new UpdateClient())->execute($_GET['id_client'], $_POST);
            }
        } else if ($_GET['action'] === 'gestion_commandes') {
            (new GestionCommandes())->execute();
        } else if ($_GET['action'] === 'export_csv') {
            (new ExportCSV())->execute();
        } else if ($_GET['action'] === 'consulter_fiche_client') {
            if (isset($_GET['id_client']) && $_GET['id_client'] > 0) {
                (new ConsulterFicheClient())->execute($_GET['id_client']);
            }
        }
        //commande
        else if ($_GET['action'] === 'form_ajoutCommande') {
            (new FormAjoutCommande())->execute();
        } else if ($_GET['action'] === 'ajout_commande') {
            print_r($_POST);
            (new AjoutCommande())->execute($_POST);
        } else if ($_GET['action'] === 'form_modifier_fiche_commande') {
            (new FormModifCommande())->execute($_GET['id_commande']);
        } else if ($_GET['action'] === 'modifier_fiche_commande') {
            if (isset($_GET['id_commande']) && $_GET['id_commande'] > 0) {
                (new UpdateCommande())->execute($_GET['id_commande'], $_POST);
            }
        } else if ($_GET['action'] === 'form_ajout_facture') {
            if (isset($_GET['id_commande']) && $_GET['id_commande'] > 0) {
                (new FormAjoutFacture())->execute($_GET['id_commande']);
            }
        } else if ($_GET['action'] === 'ajout_facture') {
            if (isset($_GET['id_commande']) && $_GET['id_commande'] > 0) {
                (new AjoutFacture())->execute($_GET['id_commande'], $_POST);
            }
        } else if ($_GET['action'] === 'consulter_commande') {
            if (isset($_GET['id_commande']) && $_GET['id_commande'] > 0) {
                (new ConsulterCommande())->execute($_GET['id_commande']);
            }
        }
        //delete commande
        else if ($_GET['action'] === 'delete_commande') {
            if (isset($_GET['id_commande']) && $_GET['id_commande'] > 0) {
                (new DeleteCommande())->execute($_GET['id_commande']);
            }
        }
        //ajout article dans une commande
        else if ($_GET['action'] === "search_article") {
            if (isset($_GET['id_commande']) && $_GET['id_commande'] > 0) {
                (new SearchArticle())->execute($_POST);
            }
        } else if ($_GET['action'] === "ajout_article_pour_commande") {
            if (isset($_GET['id_commande']) && $_GET['id_commande'] > 0) {
                (new AjoutArticleCommande())->execute($_GET['id_commande'], $_POST);
            }
        }

        ///article
        else if ($_GET['action'] === 'gestion_des_articles') {
            (new GestionArticles())->execute();
        } else if ($_GET['action'] === 'form_ajout_article') {
            (new FormAjoutArticle())->execute();
        } else if ($_GET['action'] === 'ajout_article') {
            (new AjoutArticle())->execute($_POST);
        } else if ($_GET['action'] === 'delete_article') {
            if (isset($_GET['id_article']) && $_GET['id_article'] > 0) {
                (new DeleteArticle())->execute($_GET['id_article']);
            }
        } else if ($_GET['action'] === 'form_modifier_fiche_article') {
            if (isset($_GET['id_article']) && $_GET['id_article'] > 0) {
                (new FormModifArticle())->execute($_GET['id_article']);
            }
        } else if ($_GET['action'] === 'modifier_fiche_article') {
            if (isset($_GET['id_article']) && $_GET['id_article'] > 0) {
                (new UpdateArticle())->execute($_GET['id_article'], $_POST);
            }
        } else {
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        (new Accueil())->execute();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('./templates/autres/error.php');
}
