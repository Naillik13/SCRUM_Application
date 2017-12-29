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

$id = $_GET['id'];
$name = $_GET['name'];
$content = $_GET['content'];


if (isset($_GET['id']) AND isset($_GET['content']) AND isset($_GET['name']) AND !empty($_GET['content']) AND !empty($_GET['name']))
{
    $repo = $entityManager->getRepository(Article::class);
    //$articles = $repo->findAll();

    //$article = Doctrine_Core::getTable('Article')->find($id);
    $article = $repo->findOneBy(['id'=>$id]);

    $article->setName($name);
    $article->setContent($content);

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