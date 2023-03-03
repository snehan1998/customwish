<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function subchildcategory()
    {
        return $this->hasMany(SubChildCategory::class,'childcategory_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'childcategory_id','id');
    }
    public function corporate()
    {
        return $this->hasMany(CorporateGift::class,'childcategory_id','id');
    }

}
