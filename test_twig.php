<?php

use Twig\Environment;
use Twig\Loader\ArrayLoader;

require_once __DIR__ . '/vendor/autoload.php';

$vars = [
    'name'          => 'Lorenzo',
    'todo_complete' => [
        ['impegno' => 'Prova', 'data' => '20/01/2021'],
    ],
    'session' => $_SESSION
];

$loader = new ArrayLoader([
                                           'index' => <<<HTML
Hello {{ name }}!
<pre>
{{ dump(todo_complete) }}
</pre>
<h2>SESSIONE</h2>
<pre>
{{ dump(session) }}
</pre>
HTML,
                                       ]);
$twig = new Environment($loader,
[
    'debug' => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

echo $twig->render('index', $vars);
