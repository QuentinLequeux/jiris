<?php
if (file_exists(__DIR__ . '/database/database.php')) {
    require __DIR__ . '/database/database.php';
} else {
    die('Problème général de l’application');
}

$db = getPDO();
$statement = $db->query('SELECT * FROM jiris WHERE starting_at < now() ORDER BY starting_at DESC');
$passed_jiris = $statement->fetchAll();
$statement = $db->query('SELECT * FROM jiris WHERE starting_at > now() ORDER BY starting_at DESC');
$upcoming_jiris = $statement->fetchAll();


?>

<!--var_dump($jiris);-->
<!--print_r($jiris);-->
<!--array()-->

<!-- VIEW(VUE) -->
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jiris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<a class="sr-only" href="#main-menu">Aller au menu principal</a>
<div class="container mx-auto flex flex-col-reverse gap-6">
    <main class="flex flex-col gap-4">
        <h1 class="font-bold text-2xl">Jiris</h1>
        <section>
            <h2 class="font-bold text-xl">Jiris à venir</h2>
            <?php if (count($upcoming_jiris) !== 0): ?>
                <ol>
                    <?php foreach ($upcoming_jiris as $jiri): ?>
                        <li><a class="underline text-blue-500" href="/jiris/<?= $jiri->id ?>"><?= $jiri->name ?></a>
                        </li> <!--?id=1-->
                    <?php endforeach; ?>
                </ol>
            <?php endif; ?>
        </section>
        <section>
            <h2 class="font-bold text-xl">Jiris passés</h2>
            <?php if (count($passed_jiris) !== 0): ?>
                <ol>
                    <?php foreach ($passed_jiris as $jiri): ?>
                        <li><a class="underline text-blue-500" href="/jiris/<?= $jiri->id ?>"><?= $jiri->name ?></a>
                        </li> <!--?id=1-->
                    <?php endforeach; ?>
                </ol>
            <?php endif; ?>
        </section>
    </main>
    <nav id="main-menu">
        <h2 class="sr-only">Navigation principale</h2>
        <ul class="flex gap-4">
            <li class="underline text-blue-500"><a href="#">Jiris</a></li>
            <li class="underline text-blue-500"><a href="/contacts">Contacts</a></li>
            <li class="underline text-blue-500"><a href="/projects">Projets</a></li>
        </ul>
    </nav>
</div>
</body>
</html>
