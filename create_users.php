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

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['username']) AND isset($_POST['password']) AND !empty($_POST['username']) AND !empty($_POST['password']))
{

    $repo = $entityManager->getRepository(User::class);

    $user = new User();

    $user->setUsername($username);
    $user->setPassword($password);

    $entityManager->persist($user);
    $entityManager->flush();

    header('Location:admin_users_list.php');

}else
{
    echo $twig->render('error.html.twig', [
        'title' => 'Erreur',
    ]);

    header('Location:index.php');
}