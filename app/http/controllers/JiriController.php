<?php

namespace App\Http\Controllers;

use Core\Database;
use Core\Exceptions\FileNotFoundException;

class JiriController
{
    private Database $db;

    public function __construct()
    {
        try {
            $this->db = new Database(base_path('.env.local.ini'));
        } catch (FileNotFoundException $exception) {
            die($exception->getMessage());
        }
    }

    public function index(): void
    {
        $search = $_GET['search'] ?? '';

        $sql_upcoming_jiris = <<<SQL
                SELECT * FROM jiris 
                         WHERE name LIKE :search  
                               AND starting_at > current_timestamp
                SQL;
        $statement_upcoming_jiris =
            $this->db->prepare($sql_upcoming_jiris);
        $statement_upcoming_jiris->bindValue(':search',"%{$search}%");
        $statement_upcoming_jiris->execute();
        $upcoming_jiris =
            $statement_upcoming_jiris->fetchAll();

        $sql_passed_jiris = <<<SQL
                SELECT * FROM jiris 
                         WHERE name LIKE :search
                             AND starting_at < current_timestamp
                SQL;
        $statement_passed_jiris =
            $this->db->prepare($sql_passed_jiris);
        $statement_passed_jiris->bindValue(':search',"%{$search}%");
        $statement_passed_jiris->execute();
        $passed_jiris =
            $statement_passed_jiris->fetchAll();

        view('jiris.index', compact('upcoming_jiris', 'passed_jiris'));
    }

    public function create()
    {
        echo "display a creation form for jiris";
    }
}