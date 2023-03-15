<?php

namespace App\Models;

use App\ModelFilters\ProductFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    private static $whiteListFilter =['*'];

    public function productrequired()
    {
        return $this->hasOne(ProductRequired::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class,'childcategory_id');
    }
    public function subchildcategory()
    {
        return $this->belongsTo(SubChildCategory::class,'subchildcategory_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }


    public function productprice()
    {
        return $this->hasMany(ProductPrice::class,'product_id','id');
    }

    public function variation()
    {
        return $this->hasMany(AddSubVariation::class,'product_id','id');
    }
    public function variationn()
    {
        return $this->hasMany(Addsubvariationn::class,'product_id','id');
    }

    public function modelFilter()
    {
        return $this->provideFilter(ProductFilter::class);
    }

    public function scopegetTableName(): string
    {
        return $this->getTable();
    }

}
