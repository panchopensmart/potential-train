<?php

class ProductPutCount
{
    private ProductCollection $productModel;
    private ProductView $productView;
    public function __construct($productModel, $productView)
    {
        $this->productModel = $productModel;
        $this->productView = $productView;
    }

    public function putCount(string $productId, int $count): string
    {
        try {
            $response = $this->productModel->putCount($productId, $count);
            return $this->productView->JsonRouteResponce((array)$response);
        } catch (CustomException $e) {
            return $e->getMessage();
        }
    }
}