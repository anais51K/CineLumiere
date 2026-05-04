<?php

class ContactRepository
{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }
    public function ajouterContact($contact){
        $sql = "INSERT INTO contact VALUES (:email,:message)";
        $stmt = $this->connexionBdd->prepare($sql);
        $stmt->bindParam(':email', $contact->getEmail());
        $stmt->bindParam(':message', $contact->getMessage());
        $stmt->execute();
    }
    public function supprimerContact($idContact){
        $sql = "DELETE FROM contact WHERE email = :email";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':email', $idContact);
        $req->execute();
    }
}