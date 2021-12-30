<?php
declare(strict_types=1);


namespace App\Controller;

use App\Entity\Artical;
use App\Entity\Timestampable;


class ArticalsUpdatedAtController
{

public function  __invoke(Artical $data):Artical
{
    
   $data->setUpdatetAt(new \DateTimeImmutable("tomorrow"));
// dd($data);
    return $data;
}
}
