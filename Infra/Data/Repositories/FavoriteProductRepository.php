<?php

namespace Infra\Data\Repositories;

use Application\Interfaces\IFavoriteProductRepository;
use Infra\Data\Interfaces\Database\IDatabase;
use Domain\Entities\FavoriteProduct;
use PDO;

class FavoriteProductRepository implements IFavoriteProductRepository
{
    private IDatabase $database;

    public function __construct(IDatabase $database)
    {
        $this->database = $database;
    }

    /*
    * create favorite product
    * @param FavoriteProduct $favoriteProduct
    * @return void
    */

    public function create(FavoriteProduct $favoriteProduct): void
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO favorite_products (product_id, customer_id) VALUES (?, ?)");
        $stmt->execute([$favoriteProduct->productId, $favoriteProduct->customerId]);
    }

    /*
    * check if favorite product exists
    * @param int $productId
    * @param int $customerId
    * @return bool
    */

    public function exists(int $productId, int $customerId): bool
    {
        $stmt = $this->database->getConnection()->prepare("SELECT COUNT(*) FROM favorite_products WHERE product_id = ? AND customer_id = ?");
        $stmt->execute([$productId, $customerId]);

        return $stmt->fetchColumn() > 0;
    }

    /*
    * get favorite products by customer id
    * @param string $customerId
    * @return array
    */

    public function getByCustomerId(string $customerId): array
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM favorite_products WHERE customer_id = ?");
        $stmt->execute([$customerId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    * delete favorite product
    * @param string $id
    * @return void
    */

    public function delete(string $id): void
    {
        $stmt = $this->database->getConnection()->prepare("DELETE FROM favorite_products WHERE id = ?");
        $stmt->execute([$id]);
    }
}
