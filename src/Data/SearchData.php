<?php


namespace App\Data;

use App\Entity\Category;

class SearchData
{
    /**
     * @var Category $category
     */
    public $category;

    /**
     * @var User $owner
     */
    public $owner;

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }
}
