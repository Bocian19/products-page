<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping\Entity as ORM;

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
            if ($key ==='height') {
                $this->data['dimension'] .= $value.'x';
            } elseif ($key ==='width') {
                $this->data['dimension'] .= $value.'x';
            } elseif ($key ==='length') {
                $this->data['dimension'] .= $value;
            } else {
                continue;
            }
        }
    }
}