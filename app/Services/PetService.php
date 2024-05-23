<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetService
{
    protected $baseUri = 'https://petstore.swagger.io/v2';

    public function findByStatus($status)
    {
        $response = Http::get("{$this->baseUri}/pet/findByStatus", ['status' => $status]);

        if ($response->failed()) {
            throw new \Exception('Error fetching pets by status');
        }

        return $response->json();
    }

    public function createPet($data)
    {
        $response = Http::post("{$this->baseUri}/pet", $data);

        if ($response->failed()) {
            throw new \Exception('Error creating pet');
        }

        return $response->json();
    }

    public function getPetById($id)
    {
        $response = Http::get("{$this->baseUri}/pet/{$id}");

        if ($response->failed()) {
            throw new \Exception('Error fetching pet by ID');
        }

        return $response->json();
        }


    public function updatePet($data)
    {
        $response = Http::withHeaders([
          'Content-Type' => 'application/json',
        ])->put("{$this->baseUri}/pet", $data);

        if ($response->failed()) {
            throw new \Exception('Error updating pet');
        }

        return $response->json();
    }

    public function deletePet($id)
    {
        $response = Http::delete("{$this->baseUri}/pet/{$id}");

        if ($response->failed()) {
            throw new \Exception('Error deleting pet');
        }

        return $response->json();
    }
}
