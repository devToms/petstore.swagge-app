<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestCase;
use App\Services\PetService;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PetControllerTest extends TestCase
{
    protected $petService;

    public function setUp(): void
    {
        parent::setUp();
        $this->petService = Mockery::mock(PetService::class);
    }

}
