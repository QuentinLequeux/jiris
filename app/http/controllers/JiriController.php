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
            $this->db = new Database(BASE_PATH . '/.env.local.ini');
        } catch (FileNotFoundException $e) {
            die($e->getMessage());
        }
    }

    public function index(): void
    {
        $statement =
            $this->db->query('SELECT * FROM jiris WHERE starting_at < now() ORDER BY starting_at DESC');
        $passed_jiris = $statement->fetchAll();
        //dd($passed_jiris);
        $statement =
            $this->db->query('SELECT * FROM jiris WHERE starting_at > now() ORDER BY starting_at DESC');
        $upcoming_jiris = $statement->fetchAll();
        //dd($upcoming_jiris,$passed_jiris);

        view("jiris.index",
            compact('upcoming_jiris', 'passed_jiris')
        );
    }
}

//compact()