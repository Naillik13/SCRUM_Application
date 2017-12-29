<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 21/12/2017
 * Time: 11:07
 */

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";

use App\Entity\Article;

$name = $_GET['title'];
$content = $_GET['content'];
$date = $_GET['date'];

if (isset($_GET['title']) AND isset($_GET['content']) AND isset($_GET['date']))
{
    echo $twig->render('article.html.twig', [
    'title' => 'Article',
    'name' => $name,
    'content' => $content,
    'date' => $date,
        'isConnected' => isset($_SESSION['isConnected']),
    ]);
}else
{
    echo $twig->render('error.html.twig', [
        'title' => 'Erreur',
        ]);

    header('Location:index.php');
}