<?php
class ProductCollection
{
    private array $products;

    public function __construct()
    {
        $product1 = new ProductOne();
        $product2 = new ProductTwo();
        $product3 = new ProductThree();

        $this->products = array(
            $product1->getProduct(),
            $product2->getProduct(),
            $product3->getProduct()
        );
    }

    public function getAllProducts(): array
    {
        return $this->products;
    }
    /**
     * @throws CustomException
     */
    public function getProduct(string $productId)
    {
        if (isset($this->products[$productId])) {
            return $this->products[$productId];
        } else {
            throw new CustomException("Product is not exist");
        }
    }

    /**
     * @throws CustomException
     */
    public function updateProduct(string $productId, array $product): string
    {
        if ($this->products[$productId]) {
            $this->products[$productId] = $product;
            http_response_code(200);
            return 'CODE 200: is done';
        } else {
            throw new CustomException ("Product is not exist (id is undefined)");
        }
    }

    public function addProduct(array $newProduct): string
    {
        $this->products[] = $newProduct;
        return 'product is added';
    }

    /**
     * @throws CustomException
     */
    public function deleteProduct(string $productId): string
    {
        if (isset($this->products[$productId])) {
            unset($this->products[$productId]);
            http_response_code(200);
            return 'CODE 200: is deleted';
        } else {
            throw new CustomException('Products is nod delete (undefined product)');
        }
    }

    /**
     * @throws CustomException
     */
    public function putPrice(string $productId, int $price): string
    {
        if (isset($this->products[$productId]['price'])) {
            $this->products[$productId]['price'] = $price;
            http_response_code(200);
            return 'CODE 200: Price is uploaded';
        } else {
            throw new CustomException('Product is not defined');
        }
    }

    /**
     * @throws CustomException
     */
    public function putInStock(string $productId, bool $inStock): string
    {
        if (isset($this->products[$productId]['inStock'])) {
            $this->products[$productId]['inStock'] = $inStock;
            http_response_code(200);
            return 'CODE 200: InStock is uploaded';
        } else {
            throw new CustomException('Product is not defined');
        }
    }

    /**
     * @throws CustomException
     */
    public function putCount(string $productId, int $count): string
    {
        if (isset($this->products[$productId]['count'])) {
            $this->products[$productId]['count'] = $count;
            return 'CODE 200: Count is uploaded';
        } else {
            throw new CustomException('Product is not defined');
        }
    }
}