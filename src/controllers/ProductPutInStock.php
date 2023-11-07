<?php

class ProductPutInStock
{
    private ProductCollection $productModel;
    private ProductView $productView;
    public function __construct($productModel, $productView)
    {
        $this->productModel = $productModel;
        $this->productView = $productView;
    }

    public function putInStock(string $productId, bool $inStock) : string
    {
        try {
            $response = $this->productModel->putInStock($productId, $inStock);
            return $this->productView->JsonRouteResponce((array)$response);
        } catch (CustomException $e) {
            return $e->getMessage();
        }
    }
}