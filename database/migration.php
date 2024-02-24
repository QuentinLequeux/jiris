<?php

use Core\Database;

try {
    $db = new Core\Database(BASE_PATH . '/.env.local.ini');
} catch (\Core\Exceptions\FileNotFoundException $e) {
    die($e->getMessage());
}

// dropper les tables existantes

echo 'dropping all tables' . PHP_EOL;

$db->dropTables();

// recréer les tables

echo 'creating jiris tables' . PHP_EOL;

$db->exec(<<<SQL
    CREATE TABLE jiris(
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        starting_at TIMESTAMP NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
SQL
);

// alimenter les tables
