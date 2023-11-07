<?php

class ProductsController
{
    private ProductCollection $productModel;
    private ProductView $productView;

    public function __construct(ProductCollection $productModel, ProductView $productView)
    {
        $this->productModel = $productModel;
        $this->productView = $productView;
    }

    public function getAllProducts() : string
    {
        $dataModel = $this->productModel->getAllProducts();
        return $this->productView->JsonRouteResponce($dataModel);
    }

    public function createProduct(array $newProduct): void
    {
        $this->productModel->addProduct($newProduct);
    }
}