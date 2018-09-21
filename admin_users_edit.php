<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 28/12/2017
 * Time: 15:29
 */

error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";

if (isset($_SESSION['isConnected']) && $admin == "admin" )
{

    $id = $_GET['id'];
    $username = $_GET['username'];
    $password = $_GET['password'];


    if (isset($_GET['id']) AND isset($_GET['username']) AND isset($_GET['password']) AND !empty($_GET['username']) AND !empty($_GET['password']))
    {
        echo $twig->render('admin_users_edit.html.twig', [
            'title' => 'Modification d\'Utilisateurs',
            'id' => $id,
            'username' => $username,
            'password' => $password,

            'isConnected' => isset($_SESSION['isConnected']),
        ]);
    }else
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