<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class ProductRepository
{
    public function getAll(): array
    {
        /** @var Response $response */
        $response = Http::get('http://localhost:3000/api/product');

        if ($response->status() !== 200) {
            return [];
        }

        return $response->json('data') ?? [];
    }
}