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

if (isset($_SESSION['isConnected']))
{

    $id = $_GET['id'];
    $name = $_GET['name'];
    $content = $_GET['content'];


    if (isset($_GET['id']) AND isset($_GET['content']) AND isset($_GET['name']) AND !empty($_GET['content']) AND !empty($_GET['name']))
    {
        echo $twig->render('admin_articles_edit.html.twig', [
            'title' => 'Modification d\'Article',
            'id' => $id,
            'name' => $name,
            'content' => $content,

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