<?php
class ProductView
{
    private array $successAddProductResponce = [
        "success" => true,
        "description" => "successfully added product in list products"
    ];

    public function JsonRouteResponce(array $dataModel): string
    {
        return json_encode($dataModel);
    }

    public function successAddProduct(): string
    {
        return json_encode($this->successAddProductResponce);
    }
}