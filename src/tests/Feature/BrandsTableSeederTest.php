<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Brand;

class BrandsTableSeederTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function it_creates_brands()
    {
        // ブランドのSeederを実行
        $this->seed(\BrandsTableSeeder::class);

        // データベースにブランドが正しく挿入されたことを確認
        $brands = Brand::all();
        $this->assertCount(11, $brands); // ブランドが11個あることを確認
        $this->assertEquals('その他', $brands->last()->name); // 最後のブランドが「その他」であることを確認
    }
}