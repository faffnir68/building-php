<?php
namespace App\class\auth;

use PDO;
use App\class\auth\User;

class Auth {

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function user(): ?User
    {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['auth'] ?? null;
        if($id === null) {
            return null;
        }
        $req = "SELECT * FROM users WHERE id = :id";
        $sth = $this->pdo->prepare($req);
        $sth->setFetchMode(PDO::FETCH_CLASS, User::class);
        $sth->execute(array('id' => $id));
        $user = $sth->fetch();
        return $user ?: null;
    }

    public function login(string $username, string $password): ?User
    {            
        $req = "SELECT * FROM users WHERE username = :username";
        $sth = $this->pdo->prepare($req);
        $sth->setFetchMode(PDO::FETCH_CLASS, User::class);
        $sth->execute(array(':username' => $username));
        $user = $sth->fetch();

        if($user === false) {
            return null;
        }
        if(password_verify($password, $user->password)) {
            session_start();
            $_SESSION['auth'] = $user->id;
            return $user;
        }
        return null;
    }

    public function requireRole(string ...$roles): void
    {
        $user = $this->user();
        if($user === null || !in_array($user->role, $roles)) {
            header('Location: /?forbid=1');
            exit();
        }
    }

}