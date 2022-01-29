<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT email, password, name, surname, users.id id FROM public.users
            JOIN public.users_details ON users.id_user_details = users_details.id
            WHERE email = :email
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['id']
        );
    }

    public function addUser(string $email, string $plain_password, string $name, string $surname): void {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users (email, password, id_user_details, id_user_role, created_at)
            VALUES (?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $email,
            password_hash($plain_password, PASSWORD_DEFAULT),
            $this->addUserDetails($name, $surname),
            $this->getUserRole('user'),
            $date->format('Y-m-d')
        ]);
    }

    private function addUserDetails(string $name, string $surname): int {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.users_details (name, surname)
            VALUES (?, ?)
            RETURNING id
        ');
        $stmt->execute([
            $name,
            $surname
        ]);

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        return $id['id'];

    }

    private function getUserRole(string $role): int {
        $stmt = $this->database->connect()->prepare('
            SELECT id FROM public.users_roles WHERE role_name = :role
        ');
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        return $role['id'];
    }


}