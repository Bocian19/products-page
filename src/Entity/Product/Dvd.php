<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping\Entity as ORM;

require_once dirname(__DIR__, 3).'/vendor/autoload.php';

/** 
 * @ORM/Entity 
 * */
class Dvd extends AbstractProduct
{
    protected array $data = [
        'size' => null
    ];

    public function setData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (key_exists($key, $this->data)) {
                $this->data[$key] = $value.' MB';
            } else {
                continue;
            }
        }
    }
}