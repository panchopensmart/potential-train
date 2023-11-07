<?php

class ProductTwo
{
    private array $product = [
        "productid" => "3221",
        "name" => "table1",
        "code" => 1232,
        "price" => 39902,
        "instock" => true,
        "description" => "description of table2",
        "count" => 12
    ];

    public function getProduct(): array
    {
        return $this->product;
    }

}
