<?php

namespace Domain\Entities;

use Domain\Enums\Commons\ValidationHelper;
use Domain\Enums\Commons\ValidationMessages;

class Product
{
    public function __construct(
        public int $id,
        public string $title,
        public string $image,
        public float $price,
        public float $review
    ) {
        if (ValidationHelper::validateTitle($this->title)) {
            throw new \Exception(implode(', ', array_map(fn($m) => $m->value, ValidationMessages::getTitleRequiredMessages())));
        }

        if (ValidationHelper::validatePrice($this->price)) {
            throw new \Exception(implode(', ', array_map(fn($m) => $m->value, ValidationMessages::getPriceRequiredMessages())));
        }
    }

    /*
    * set id
    * @param int $id
    */

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /*
    * set title
    * @param string $title
    */

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /*
    * set image
    * @param string $image
    */

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /*
    * set price
    * @param float $price
    */

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /*
    * set review
    * @param float $review
    */

    public function setReview(float $review): void
    {
        $this->review = $review;
    }

    /*
    * get id
    * @return int
    */

    public function getId(): int
    {
        return $this->id;
    }

    /*
    * get title
    * @return string
    */

    public function getTitle(): string
    {
        return $this->title;
    }

    /*
    * get image
    * @return string
    */

    public function getImage(): string
    {
        return $this->image;
    }

    /*
    * get price
    * @return float
    */

    public function getPrice(): float
    {
        return $this->price;
    }

    /*
    * get review
    * @return float
    */

    public function getReview(): float
    {
        return $this->review;
    }
}
