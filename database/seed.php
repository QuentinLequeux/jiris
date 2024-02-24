<?php

echo 'seeding jiris' . PHP_EOL;

$jiris = [
    ['id' => 1, 'name' => 'Projets Web 2024', 'starting_at' => '2024-01-19 08:30:00'],
    ['id' => 2, 'name' => 'Projets Web 2025', 'starting_at' => '2025-01-19 08:30:00'],
    ['id' => 3, 'name' => 'Design Web 2024', 'starting_at' => '2024-06-19 08:30:00'],
    ['id' => 4, 'name' => 'Design Web 2023', 'starting_at' => '2023-06-19 08:30:00']];

$insert_jiris_sql = <<<SQL
INSERT INTO jiris(name, starting_at) VALUES (:name, :starting_at);
SQL;

$insert_jiris_statement = $db->prepare($insert_jiris_sql);

foreach ($jiris as $jiri) {
    $insert_jiris_statement->bindValue(':name', $jiri['name']);
    $insert_jiris_statement->bindValue(':starting_at', $jiri['starting_at']);
    $insert_jiris_statement->execute();
}
$count_jiris = count($jiris);
echo "jiris seeded with {$count_jiris} jiris" . PHP_EOL;