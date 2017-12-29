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

if (isset($_SESSION['isConnected']))
{

    $id = $_GET['id'];

    if (isset($_GET['id']))
    {
        $repo = $entityManager->getRepository(Article::class);
        $article = $repo->find(['id'=>$id]);

        $entityManager->remove($article);
        //$entityManager->persist($article);
        $entityManager->flush();

        header('Location:admin_articles_list.php');

    } else

    {
        echo $twig->render('error.html.twig', [
            'title' => 'Erreur',
        ]);

        header('Location:index.php');
    }

}
else
{
    header('Location:login.php');
}