<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 23/04/2018
 * Time: 15:44
 */


error_reporting(E_ALL);                     //Pas mettre en temps normal, juste pour afficher les erreurs sur mac, rien à voir avec composer
ini_set('display_errors', 1);   // Idem

require __DIR__ . "/bootstrap.php";

use App\Entity\Document;

$titledoc = $_POST['title_document'];

$maxsize = 10000000;
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'odt', 'odf', 'xdt', 'xml', 'pdf', 'doc', 'docx' );

if (isset($titledoc) && !empty($titledoc) && isset($_FILES['document']) && !empty($_FILES['document']))
{
    if ($_FILES['document']['error'] > 0)
    {
        $erreur = "Erreur lors du transfert";
    } else
    {
        if ($_FILES['document']['size'] > $maxsize)
        {
            $erreur = "Le fichier est trop gros";
        } else
        {
            $extension_upload = strtolower(  substr(  strrchr($_FILES['document']['name'], '.')  ,1)  );
            if ( in_array($extension_upload,$extensions_valides) )
            {
                echo "Extension correcte";

                /*mkdir('fichier/1/', 0777, true); *//*Pour créer un fichier*/
                //Créer un identifiant difficile à deviner
                $nom = md5(uniqid(rand(), true));
                $nom = "Resources/{$nom}{$_SESSION['id']}.{$extension_upload}";
                $resultat = move_uploaded_file($_FILES['document']['tmp_name'],$nom);

                if ($resultat) echo "Transfert réussi";

                $repo = $entityManager->getRepository(Document::class);

                $document = new Document();

                $document->setName($titledoc);
                $document->setFile($nom);
                $document->setType($_FILES['document']['type']);

                $entityManager->persist($document);
                $entityManager->flush();

                header('Location:admin_download.php');

            } else
            {
                $erreur = "Extension incorrecte";
            }
        }

    }
} else
{
    echo 'Il manque le nom du fichier ou le fichier';
}