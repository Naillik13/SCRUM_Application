<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 28/12/2017
 * Time: 16:39
 */

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";

use App\Entity\Article;

$name = $_POST['name'];
$content = $_POST['content'];
$date = $_POST['date'];
$status = $_POST['status'];

if (isset($_POST['name']) AND isset($_POST['content']) AND isset($_POST['date']) AND isset($_POST['status']) AND !empty($_POST['name']) AND !empty($_POST['content']) AND !empty($_POST['date']))
{
    $repo = $entityManager->getRepository(Article::class);

    $article = new Article();

    $article->setName($name);
    $article->setContent($content);
    $article->setDate($date);
    $article->setStatus($status);

    $entityManager->persist($article);
    $entityManager->flush();

    header('Location:admin_articles_list.php');

}else
{
    echo $twig->render('error.html.twig', [
        'title' => 'Erreur',
    ]);

    header('Location:index.php');
}