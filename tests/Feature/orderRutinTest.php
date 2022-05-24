<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class orderRutinTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->json('POST', 'danliris_budget.store', 
                                ['date' => '2022-05-19', 
                                'budget_id' => '1', 
                                'danliris_permintaan_id' => '', 
                                'group' => 'hardware', 
                                'unit_id' => 'IT', 
                                'division_id' => '1', 
                                'category_id' => '1',
                                'assets_id' => '1',
                                'quantity' => '1',
                                'remind' => '1',
                                'unitPrice' => '1',
                                'description' => 'test',
                                'createdBy' => 'admin',
                                'createdUtc' => '2022-05-19 03:46:26'
                            ]);

        $response->assertStatus(200);
    }
}
