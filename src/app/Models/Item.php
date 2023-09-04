<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image_url', 'price', 'category_id', 'child_category_id', 'condition_id', 'user_id', 'detail'];

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

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    //いいねされているかを判定するメソッド。
    public function isLikedBy($user_id): bool
    {
    // この店舗をお気に入り登録しているかを判定
    return $this->likes->contains('user_id', $user_id);
    }

    //検索用
    public function scopeShopsSearch($query, $category_id=null, $condition_id=null,  $keyword=null)
    {
        if($category_id){
            $query->where('category_id', $category_id);
        }

        if($condition_id){
            $query->where('condition_id', $condition_id);
        }

        if($keyword){
            $query->where('name','like', '%' . $keyword . '%');
        }

        return $query;
    }
}