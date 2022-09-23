<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping\Entity as ORM;

require_once dirname(__DIR__,3).'/vendor/autoload.php';

/** 
 * @ORM/Entity 
 * */
class Furniture extends AbstractProduct
{
    protected array $data = [
        'dimension' => '',
    ];
   
    public function setData(array $data): void
    {
        foreach ($data as $key => $value) {
            if ($key ==='height'|| $key ==='width' || $key ==='length') {
                $this->data['dimension'] .= $value.'x';
            } else {
                continue;
            }
        }
    }
}