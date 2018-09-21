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
require_once 'vendor/autoload.php';



use App\Entity\User;

$username = $_POST['username'];
$role = $_POST['role'];


if (isset($_POST['role']) AND !empty($_POST['role']) AND isset($_POST['username']) AND !empty($_POST['username']) AND filter_var( $_POST['username'], FILTER_VALIDATE_EMAIL) )
{

    $repo = $entityManager->getRepository(User::class);

    $user = new User();

    $user->setUsername($username);
    $password = genererChaineAleatoire();
    $user->setPassword($password);
    $user->setRole($role);
   sendPassword($username, $password);

    $entityManager->persist($user);
    $entityManager->flush();
    
    header('Location:admin_users_list.php');

}else
{
    echo $twig->render('error.html.twig', [
        'title' => 'Erreur',
    ]);

    
}


function genererChaineAleatoire($longueur = 20, $listeCar = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
 $chaine = '';
 $max = mb_strlen($listeCar, '8bit') - 1;
 for ($i = 0; $i < $longueur; ++$i) {
 $chaine .= $listeCar[random_int(0, $max)];
 }
 
 return $chaine;
}
function sendPassword($email, $password){
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.orange.fr', 25))
    ->setUsername('killian.galea0@orange.fr')
    ->setPassword('KGALEA2112')
  ;


// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('MDP - SCRUM App'))
->setFrom(['noreply@appscrum.com' => 'Application Scrum'])
->setTo([$email])
->setBody('MDP : ' . $password)
;

// Send the message
$result = $mailer->send($message);
}