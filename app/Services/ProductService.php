<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\ConnectionException;

class ProductService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL', 'http://localhost:3000/api');
    }

    /**
     * Get all products from API
     * 
     * @return array
     */
    public function getAllProducts(): array
    {
        try {
            /** @var Response $response */
            $response = Http::timeout(10)->get("{$this->baseUrl}/product/");

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }

            Log::error('Failed to fetch products', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return [];
            
        } catch (ConnectionException $e) {
            Log::error('Connection error fetching products: ' . $e->getMessage());
            return [];
        } catch (\Exception $e) {
            Log::error('Error fetching products: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get product by ID from API
     * 
     * @param int $id
     * @return array|null
     */
    public function getProductById(int $id): ?array
    {
        try {
            /** @var Response $response */
            $response = Http::timeout(10)->get("{$this->baseUrl}/product/{$id}");

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? null;
            }

            Log::warning("Product not found: {$id}", [
                'status' => $response->status()
            ]);

            return null;
            
        } catch (ConnectionException $e) {
            Log::error("Connection error fetching product {$id}: " . $e->getMessage());
            return null;
        } catch (\Exception $e) {
            Log::error("Error fetching product {$id}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get products by category
     * 
     * @param string $category
     * @return array
     */
    public function getProductsByCategory(string $category): array
    {
        try {
            /** @var Response $response */
            $response = Http::timeout(10)->get("{$this->baseUrl}/product/", [
                'category' => $category
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }

            return [];
            
        } catch (\Exception $e) {
            Log::error("Error fetching products by category {$category}: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Search products
     * 
     * @param string $query
     * @return array
     */
    public function searchProducts(string $query): array
    {
        try {
            /** @var Response $response */
            $response = Http::timeout(10)->get("{$this->baseUrl}/product/search", [
                'q' => $query
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? [];
            }

            return [];
            
        } catch (\Exception $e) {
            Log::error("Error searching products with query '{$query}': " . $e->getMessage());
            return [];
        }
    }

    /**
     * Check if API is available
     * 
     * @return bool
     */
    public function isApiAvailable(): bool
    {
        try {
            /** @var Response $response */
            $response = Http::timeout(5)->get("{$this->baseUrl}/health");
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}