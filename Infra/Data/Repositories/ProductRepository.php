<?php

namespace Infra\Data\Repositories;

use Application\Interfaces\IProductRepository;
use Infra\Data\Interfaces\Database\IDatabase;
use Domain\Entities\Product;
use PDO;

class ProductRepository implements IProductRepository
{
    private IDatabase $database;

    public function __construct(IDatabase $database)
    {
        $this->database = $database;
    }

    /*
    * create product
    * @param Product $product
    * @return Product
    */

    public function create(Product $product): Product
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO products (id, title, image, price, review) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product->id, $product->title, $product->image, $product->price, $product->review]);

        // set id to the product after create
        $product->setId($this->database->getConnection()->lastInsertId());
        return $product;
    }

    /*
    * get product by id
    * @param int $id
    * @return Product
    */

    public function getById(int $id): Product
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product ? new Product($product['id'], $product['title'], $product['image'], $product['price'], $product['review']) : null;
    }

    /*
    * get products by customer id
    * @param int $customerId
    * @return array
    */

    public function getByCustomerId(int $customerId): array
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM products INNER JOIN favorite_products ON products.id = favorite_products.product_id WHERE favorite_products.customer_id = ?");
        $stmt->execute([$customerId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTitle(string $title): array
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM products WHERE title = ?");
        $stmt->execute([$title]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    * get all products
    * @return array
    */

    public function getAll(): array
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM products");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    * update product
    * @param Product $product
    * @return void
    */

    public function update(Product $product): void
    {
        $stmt = $this->database->getConnection()->prepare("UPDATE products SET title = ?, image = ?, price = ?, review = ? WHERE id = ?");
        $stmt->execute([$product->title, $product->image, $product->price, $product->review, $product->id]);
    }

    /*
    * delete product
    * @param int $id
    * @return void
    */

    public function delete(int $id): void
    {
        $stmt = $this->database->getConnection()->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }
}
