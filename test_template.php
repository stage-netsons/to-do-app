<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/vendor/autoload.php';

//caricamento engine
$loader = new FilesystemLoader(__DIR__ . '/templates/');
$twig = new Environment($loader, [
    //    'cache' => __DIR__ . '/templates_c', //cache template compilati
    'cache' => false,
]);

//caricamento template
$template = $twig->load('index.html.twig');

//LOGICA
$users = [
    ['name' => 'Chiara Cerrone', 'email' => 'chiara@cerrone.it'],
    ['name' => 'Lorenzo Leccese', 'email' => 'lorenzo@leccese.it'],
];


//variabili template
$vars = [
    'page_title'    => 'Accedi alla tua To-do list',
    'users'         => $users,
    'username'      => 'chiara',
    'logged_in'     => true, //false
    'todo_complete' => [
        ['impegno' => 'git pull', 'data' => '20/02/2021']
    ]
];

echo $template->render($vars);

