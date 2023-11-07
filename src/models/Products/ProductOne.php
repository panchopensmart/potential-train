<?php

class ProductOne
{
    private array $product = [
        "productid" => "321",
        "name" => "table",
        "code" => 123,
        "price" => 3990,
        "instock" => true,
        "description" => "description of table1",
        "count" => 12
    ];

    public function getProduct(): array
    {
        return $this->product;
    }
}