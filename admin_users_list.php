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

use App\Entity\User;

if (isset($_SESSION['isConnected']))
{

    $page = $_GET['page'] ?? 1;

    /** @var \App\Repository\UserRepository $repo */
    $repo     = $entityManager->getRepository(User::class);
    $users = $repo->loadAll(User::MAX_PER_PAGE, ($page - 1) * 10);
    $count    = $repo->count();
    $maxPagination  = (int)ceil($count / User::MAX_PER_PAGE);
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

    echo $twig->render('admin_users_list.html.twig', [
        'title' => 'Admin - Liste d\'utilisateurs',
        //'extract' => $extract,
        'currentPage' => $page,
        'maxPagination' => $maxPagination,
        'minPage' => $minPage,
        'maxPage' => $maxPage,
        'users' => $users,
        'isConnected' => isset($_SESSION['isConnected']),


    ]);

}
else
{
    header('Location:login.php');
}