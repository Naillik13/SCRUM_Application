<?php

//session_start();

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";

echo $twig->render('homepage.html.twig', [
    'title' => 'Accueil - Articles',
    'password' => $password,
    'isConnected' => isset($_SESSION['isConnected']),
    //'username' => $_SESSION['username'],
]);
