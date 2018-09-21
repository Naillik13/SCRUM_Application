<?php

//session_start();

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";



use App\Entity\Document;

if (isset($_SESSION['isConnected']))
{

    $page = $_GET['page'] ?? 1;

    /** @var \App\Repository\DocumentRepository $repo */
    $repo     = $entityManager->getRepository(Document::class);
    if ($_SESSION['role'] === 'user'){
        $files = $repo->findBy(array('user' => $_SESSION['id']));
    }
     else {
         $files = $repo->loadAll(Document::MAX_PER_PAGE, ($page - 1) * 10);
    }


    $count    = $repo->count();
    $maxPagination  = (int)ceil($count / Document::MAX_PER_PAGE);
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

    echo $twig->render('user_space.html.twig', [
        'title' => 'Espace Utilisateurs',
        //'extract' => $extract,
        'currentPage' => $page,
        'maxPagination' => $maxPagination,
        'minPage' => $minPage,
        'maxPage' => $maxPage,
        'users' => $files,
        'isConnected' => isset($_SESSION['isConnected']),


    ]);

}
else
{
    header('Location:login.php');
}


