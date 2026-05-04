<?php

class UtilisateurRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getUtilisateur($idUtilisateur)
    {
        $sql = "SELECT * FROM Utilisateur WHERE id_utilisateur = :idUtilisateur";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idUtilisateur', $idUtilisateur);
        $req->execute();
        $result = $req->fetch();
        $utilisateur = new Utilisateur(
            $result["id_utilisateur"],
            $result["nom"],
            $result["prenom"],
            $result["date_naissance"],
            $result["email"],
            $result["telephone"],
            $result["adresse"],
            $result["mot_de_passe"],
            $result["statut"],
            $result["gestion"]
        );
        return $utilisateur;
    }

    public function getUtilisateurByEmail($email)
    {
        $sql = "SELECT * FROM Utilisateur WHERE email = :email";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':email', $email);
        $req->execute();
        $result = $req->fetch();
        if (!$result) return null;
        $utilisateur = new Utilisateur(
            $result["id_utilisateur"],
            $result["nom"],
            $result["prenom"],
            $result["date_naissance"],
            $result["email"],
            $result["telephone"],
            $result["adresse"],
            $result["mot_de_passe"],
            $result["statut"],
            $result["gestion"]
        );
        return $utilisateur;
    }

    public function getAllUtilisateurs()
    {
        $sql = "SELECT * FROM Utilisateur";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabUtilisateurs = array();
        foreach ($results as $result) {
            $utilisateur = new Utilisateur(
                $result["id_utilisateur"],
                $result["nom"],
                $result["prenom"],
                $result["date_naissance"],
                $result["email"],
                $result["telephone"],
                $result["adresse"],
                $result["mot_de_passe"],
                $result["statut"],
                $result["gestion"]
            );
            $tabUtilisateurs[] = $utilisateur;
        }
        return $tabUtilisateurs;
    }

    public function ajouterUtilisateur(Utilisateur $utilisateur)
    {
        $sql = "INSERT INTO Utilisateur (nom, prenom, date_naissance, email, telephone, adresse, mot_de_passe, statut, gestion)
                VALUES (:nom, :prenom, :dateNaissance, :email, :telephone, :adresse, :motDePasse, :statut, :gestion)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':nom', $utilisateur->getNom());
        $req->bindValue(':prenom', $utilisateur->getPrenom());
        $req->bindValue(':dateNaissance', $utilisateur->getDateNaissance());
        $req->bindValue(':email', $utilisateur->getEmail());
        $req->bindValue(':telephone', $utilisateur->getTelephone());
        $req->bindValue(':adresse', $utilisateur->getAdresse());
        $req->bindValue(':motDePasse', $utilisateur->getMotDePasse());
        $req->bindValue(':statut', $utilisateur->getStatus());
        $req->bindValue(':gestion', $utilisateur->getGestion());
        $req->execute();
    }

    public function modifierUtilisateur(Utilisateur $utilisateur)
    {
        $sql = "UPDATE Utilisateur
                SET nom = :nom,
                    prenom = :prenom,
                    date_naissance = :dateNaissance,
                    email = :email,
                    telephone = :telephone,
                    adresse = :adresse,
                    mot_de_passe = :motDePasse,
                    statut = :statut,
                    gestion = :gestion
                WHERE id_utilisateur = :idUtilisateur";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':nom', $utilisateur->getNom());
        $req->bindValue(':prenom', $utilisateur->getPrenom());
        $req->bindValue(':dateNaissance', $utilisateur->getDateNaissance());
        $req->bindValue(':email', $utilisateur->getEmail());
        $req->bindValue(':telephone', $utilisateur->getTelephone());
        $req->bindValue(':adresse', $utilisateur->getAdresse());
        $req->bindValue(':motDePasse', $utilisateur->getMotDePasse());
        $req->bindValue(':statut', $utilisateur->getStatus());
        $req->bindValue(':gestion', $utilisateur->getGestion());
        $req->bindValue(':idUtilisateur', $utilisateur->getIdUtilisateur());
        $req->execute();
    }

    public function supprimerUtilisateur($idUtilisateur)
    {
        $sql = "DELETE FROM Utilisateur WHERE id_utilisateur = :idUtilisateur";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idUtilisateur', $idUtilisateur);
        $req->execute();
    }
}