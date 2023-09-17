<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_url', 'price', 'category_id', 'child_category_id', 'condition_id','brand_id', 'user_id', 'detail'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function sale()
    {
    return $this->hasOne(Sale::class, 'item_id');
    }

    //いいねされているかを判定するメソッド。
    public function isLikedBy($userId): bool
    {
    // この店舗をお気に入り登録しているかを判定
    return $this->likes->contains('user_id', $userId);
    }

    //検索用
    public function scopeItemsSearch($query, $categoryId=null, $brandId=null,  $keyword=null)
    {
        if($categoryId){
            $query->where('category_id', $categoryId);
        }

        if($brandId){
            $query->where('brand_id', $brandId);
        }

        if($keyword){
            $query->where('name','like', '%' . $keyword . '%');
        }

        return $query;
    }
}