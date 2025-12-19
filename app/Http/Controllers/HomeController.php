<?php

namespace App\Http\Controllers;

use App\Services\ProductService;


class HomeController extends Controller
{
    
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
    
        
        // Transform data untuk frontend
        $transformedProducts = $this->transformProducts($products);
        
        return view('pages.home', [
            'products' => $transformedProducts
        ]);
    }

    private function transformProducts($products)
    {
        return collect($products)->map(function ($product) {
            // Ambil harga dari variant pertama atau set default
            $price = isset($product['Variants'][0]) 
                ? floatval($product['Variants'][0]['price']) 
                : 0;

            // Ambil gambar pertama
            $image = isset($product['Media'][0]) 
                ? $product['Media'][0]['media_url'] 
                : '/images/placeholder.jpg';

            return [
                'id' => $product['id'],
                'name' => $product['product_name'],
                'category' => strtolower($product['Category']['category_name'] ?? 'other'),
                'brand' => $product['Brand']['brand_name'] ?? '',
                'price' => $price,
                'originalPrice' => null, // Bisa ditambahkan jika ada field discount
                'badge' => $this->getBadge($product),
                'image' => $image,
                'description' => $product['description'] ?? '',
                'variants' => $product['Variants'] ?? [],
                'slug' => $product['slug'] ?? ''
            ];
        })->toArray();
    }

    private function getBadge($product)
    {
        // Logic untuk badge berdasarkan data
        $createdAt = strtotime($product['created_at']);
        $daysSinceCreated = (time() - $createdAt) / (60 * 60 * 24);

        if ($daysSinceCreated <= 30) {
            return 'New';
        }

        if (count($product['Variants']) > 5) {
            return 'Popular';
        }

        return null;
    }
}