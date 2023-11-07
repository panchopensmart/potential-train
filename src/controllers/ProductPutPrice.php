<?php

class ProductPutPrice
{
    private ProductCollection $productModel;
    private ProductView $productView;

    public function __construct($productModel, $productView)
    {
        $this->productModel = $productModel;
        $this->productView = $productView;
    }

    public function putPrice(string $productId, int $price): string
    {
        try {
            $response = $this->productModel->putPrice($productId, $price);
            return $this->productView->JsonRouteResponce((array)$response);
        } catch (CustomException $e) {
            return $e->getCustomMessage();
        }
    }
}