<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Support\Arr;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Item::class;

    public function definition()
    {
        $image_url = 'https://loremflickr.com/640/480?lock=' . $this->faker->numberBetween(1,100);
        //ダミーイメージはloremflickrから取得する
        $category = Category::find($this->faker->numberBetween(1, 8));
        $childCategoryIds = ChildCategory::where('category_id', $category->id)->pluck('id')->toArray();
        //childCategoryは親のcategory_idを検索したのち取得

        return [
            'name' => $this->faker->word,
            'image_url' => $image_url,
            'price' => $this->faker->numberBetween(300,100000),
            'category_id' => $category->id,
            'child_category_id' => Arr::random($childCategoryIds),
            'condition_id' => $this->faker->numberBetween(1,6),
            'brand_id' => $this->faker->numberBetween(1,10),
            'user_id' => $this->faker->numberBetween(1,5),
            'detail' => $this->faker->realText(200),
        ];
    }
}