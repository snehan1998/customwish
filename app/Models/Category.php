<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategory()
    {
        return $this->hasMany(Subcategory::class,'category_id','id');
    }
    public function childcategory()
    {
        return $this->hasMany(ChildCategory::class,'category_id','id');
    }
    public function subchildcategory()
    {
        return $this->hasMany(SubChildCategory::class,'category_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function corporate()
    {
        return $this->hasMany(CorporateGift::class,'category_id','id');
    }
}
