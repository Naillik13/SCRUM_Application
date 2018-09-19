<?php

//session_start();

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";

use App\Entity\Document;



/** @var \App\Repository\UserRepository $repoDoc */
$repoDoc     = $entityManager->getRepository(Document::class);
$documents = $repoDoc->loadAll(100, 0);


echo $twig->render('admin_download.html.twig', [
    'title' => 'Upload de fichier',/*
    'documents' => $documents,*/

    'isConnected' => isset($_SESSION['isConnected']),
    //'username' => $_SESSION['username'],
]);
