<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 27/12/2017
 * Time: 16:36
 */

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";


use App\Entity\Article;

if (isset($_SESSION['isConnected']))
{
//echo $_SESSION['isConnected'];


$page = $_GET['page'] ?? 1;

/** @var \App\Repository\ArticleRepository $repo */
$repo     = $entityManager->getRepository(Article::class);
//$articles = $repo->findAll();
$articles = $repo->loadAll(Article::MAX_PER_PAGE, ($page - 1) * 10);
$count    = $repo->count();
$maxPagination  = (int)ceil($count / Article::MAX_PER_PAGE);
$minPage = (int) max(1, ($page-5));
$maxPage = (int) max($maxPagination, ($page+5));
$max = 0;

while(abs($minPage - $maxPage) < 10){

    if ($minPage > 1)
    {
        $minPage--;
    }

    if ($maxPage < $maxPagination)
    {
        $maxPage++;
    }

    $max++;

    if ($max > 10)
    {
        break;
    }
}

echo $twig->render('admin_articles_list.html.twig', [
    'title' => 'Admin - Liste d\'Articles',
    //'extract' => $extract,
    'currentPage' => $page,
    'maxPagination' => $maxPagination,
    'minPage' => $minPage,
    'maxPage' => $maxPage,
    'articles' => $articles,
    'isConnected' => isset($_SESSION['isConnected']),


]);

}
else
{
    header('Location:login.php');
}