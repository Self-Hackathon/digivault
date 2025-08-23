<?php

namespace App\Actions\Products;

use App\Models\Product;

class ListProducts
{
    public function execute($limit = 10): array
    {
        return Product::limit($limit)->get()->toArray();
    }
}
