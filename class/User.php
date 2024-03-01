<?php
class User {
    private $id;
    private $name;
    private $username;
    private $email;
    private $role;
    private $password;

    public function __construct($id, $name, $username, $email, $password, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function verifMDP(string $mdp): bool {
        return $this->password !== null && password_verify($mdp, $this->password);
    }

    public function getId() {
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }


    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
        return $this;
    }
}
?>
