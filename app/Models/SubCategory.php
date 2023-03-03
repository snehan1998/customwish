<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function childcategory()
    {
        return $this->hasMany(ChildCategory::class,'subcategory_id','id');
    }
    public function subchildcategory()
    {
        return $this->hasMany(SubChildCategory::class,'subcategory_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'subcategory_id','id');
    }

    public function corporate()
    {
        return $this->hasMany(CorporateGift::class,'subcategory_id','id');
    }
}
