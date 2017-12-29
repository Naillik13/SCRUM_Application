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

use App\Entity\User;

$id = $_GET['id'];
$username = $_GET['username'];
$password = $_GET['password'];


if (isset($_GET['id']) AND isset($_GET['password']) AND isset($_GET['username']) AND !empty($_GET['password']) AND !empty($_GET['username']))
{
    $repo = $entityManager->getRepository(User::class);
    $users = $repo->findOneBy(['id'=>$id]);

    $users->setUsername($username);
    $users->setPassword($password);

    $entityManager->persist($users);
    $entityManager->flush();

    header('Location:admin_users_list.php');

}else
{
    echo $twig->render('error.html.twig', [
        'title' => 'Erreur',
    ]);

    header('Location:index.php');
}