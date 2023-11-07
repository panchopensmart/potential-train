<?php

class ProductController
{
    private ProductCollection $productModel;
    private ProductView $productView;

    public function __construct(ProductCollection $productModel, ProductView $productView)
    {
        $this->productModel = $productModel;
        $this->productView = $productView;
    }

    public function getProduct(string $productId): string
    {
        try {
            $dataModel = $this->productModel->getProduct($productId);
            return $this->productView->JsonRouteResponce($dataModel);
        } catch (CustomException $e) {
            return $e->callException();
        }
    }

    public function updateProduct(string $productId, array $product): string
    {
        try {
            $response = $this->productModel->updateProduct($productId, $product);
            return $this->productView->JsonRouteResponce((array)$response);
        } catch ( CustomException $e) {
            return $e->getMessage();
        }
    }

    public function deleteProduct(string $productId): string
    {
        try {
            $response = $this->productModel->deleteProduct($productId);
            return $this->productView->JsonRouteResponce((array)$response);
        } catch (CustomException $e) {
            return $e->getMessage();
        }
    }
}