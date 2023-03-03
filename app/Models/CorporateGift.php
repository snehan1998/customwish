<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateGift extends Model
{
    use HasFactory;

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class,'childcategory_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
