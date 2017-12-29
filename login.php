<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 21/12/2017
 * Time: 11:07
 */
/*
session_start();

$_SESSION['username'] = 'Jean';
$_SESSION['password'] = 'Dupont';*/

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";

use App\Entity\Article;



    echo $twig->render('connect.html.twig', [
        'title' => 'Connexion',
    ]);

