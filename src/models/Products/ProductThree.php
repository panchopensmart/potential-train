<?php

class ProductThree
{
    private array $product = [
        "productid" => "1321",
        "name" => "table2",
        "code" => 1233,
        "price" => 39590,
        "instock" => false,
        "description" => "description of table3",
        "count" => 0
    ];

    public function getProduct(): array
    {
        return $this->product;
    }
}