<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping\Entity as ORM;

/** 
 * @ORM/Entity 
 * */
class Book extends AbstractProduct
{
    protected array $data = [
        'weight' => null,
    ];

    public function setData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (key_exists($key, $this->data)) {
                $this->data[$key] = $value . ' KG';
            } else {
                continue;
            }
        }
    }
}
