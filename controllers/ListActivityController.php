<?php
require(__ROOT__.'/controllers/Controller.php');

class ListActivityController extends Controller {
    // cette fonction permet de récupérer la liste des activités de l'utilisateur connecté
    public function get($request) {
        // Vérifie si l'utilisateur est connecté
        session_start();
        if (isset($_SESSION['userId'])) {
            // L'utilisateur est connecté, récupérez la liste des activités de l'utilisateur depuis la base de données
            $activityDAO = ActivityDAO::getInstance(); // Assurez-vous d'avoir une classe ActivityDAO pour accéder à la base de données
            $userId = $_SESSION['userId'];
            $activities = $activityDAO->findByIdUser($userId);

            // Affiche la liste des activités
            $this->render('list_activities', ['activities' => $activities]);
        } else {
            // L'utilisateur n'est pas connecté, redirige l'utilisateur vers la page de connexion
            $this->render('user_connect_form', []);
        }
    }
}
