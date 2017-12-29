<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 21/12/2017
 * Time: 12:33
 */

require __DIR__ . "/bootstrap.php";

session_destroy();

header('Location:index.php');