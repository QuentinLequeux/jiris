<?php

namespace Core;

use Core\Exceptions\FileNotFoundException;
use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private PDO $pdo;

    public function __construct(string $ini_path)
    {
        if (!file_exists($ini_path)) {
            throw new FileNotFoundException('Le fichier d\'environement n\'a pas été trouvé');
            die();
        }
        $config = parse_ini_file($ini_path, true);

        $dsn = sprintf('%s:host=%s;port=%s;dbname=%s',
            $config['database']['DB_DRIVER'],
            $config['database']['DB_HOST'],
            $config['database']['DB_PORT'],
            $config['database']['DB_NAME']
        );

        $username = $config['database']['DB_USERNAME'];
        $password = $config['database']['DB_PASSWORD'];
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $exception) {
            die('Accès à la base de données impossible');
        }
    }

    public function dropTables(): void
    {
        $tables = $this->pdo->query('SHOW TABLES;')->fetchAll();
        foreach ($tables as $table) {
            $this->pdo->exec('DROP TABLE' . $table->Tables_in_jiris);

        }
    }

    public function truncateTables(): void
    {
        $tables = $this->pdo->query('SHOW TABLES;')->fetchAll();
        foreach ($tables as $table) {
            $this->pdo->exec('TRUNCATE TABLE' . $table->Tables_in_jiris);
        }
    }

    public function exec(string $sql_statement): int|false
    {
        return $this->pdo->exec($sql_statement);
    }

    public function prepare(string $sql): PDOStatement|false
    {
        return $this->pdo->prepare($sql);
    }

    public function query(string $sql): PDOStatement|false
    {
        return $this->pdo->query($sql);
    }
}