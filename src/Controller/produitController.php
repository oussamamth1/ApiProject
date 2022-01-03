<?php
declare(strict_types=1);


namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Timestampable;


class produitController
{

public function  __invoke(Produits $data):Produits
{
    
//    $data-
// // dd($data);
    return $data;
}
}
