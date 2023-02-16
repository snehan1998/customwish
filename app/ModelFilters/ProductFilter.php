<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];


    public function stock($stock)
    {
        return $this->whereIn('stock_status',explode(',', $stock));
    }

    public function attribute($attribute)
    {
        return $this->whereHas('variationn', function($que) use ($attribute)
        {
            return $que->whereIn('main_attr_value',explode(',', $attribute));
        });
    }

    public function price($id)
    {
        if ($id == 1) {
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [0, 2000]);
            });
        }elseif($id == 2){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000]);
            });
        }elseif($id == 3){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [4000,6000]);
            });
        }elseif($id == 4){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [6000,8000]);
            });
        }elseif($id == 5){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [8000,10000]);
            });
        }elseif($id == '1,2,3,4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [0, 2000])
                ->orwhereBetween('price', [2000, 4000])->orwhereBetween('price', [4000,6000])
                ->orwhereBetween('price', [6000,8000])->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '1,2,3,4'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price', [2000, 4000])->orwhereBetween('price', [4000,6000])
                ->orwhereBetween('price',[6000,8000]);
            });
        }elseif($id == '1,2,3,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price', [2000, 4000])->orwhereBetween('price', [4000,6000])
               ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '1,2,4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price', [2000, 4000])->orwhereBetween('price',[6000,8000])
               ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '1,3,4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price', [4000,6000])->orwhereBetween('price',[6000,8000])
               ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '2,3,4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000])
                ->orwhereBetween('price', [4000,6000])->orwhereBetween('price',[6000,8000])
               ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '2,3,4'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000])
                ->orwhereBetween('price', [4000,6000])->orwhereBetween('price',[6000,8000]);
            });
        }elseif($id == '2,3,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000])
                ->orwhereBetween('price', [4000,6000])->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '2,4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000])
                ->orwhereBetween('price',[6000,8000])->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '3,4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [4000,6000])
                ->orwhereBetween('price',[6000,8000])->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '1,2,3'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0,2000])->orwhereBetween('price', [2000,4000])
                ->orwhereBetween('price',[4000,6000]);
            });
        }elseif($id == '1,3,4'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price', [4000,6000])->orwhereBetween('price',[6000,8000]);
            });
        }elseif($id == '1,4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price',[6000,8000])->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '1,2,4'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])->orwhereBetween('price', [2000, 4000])
                ->orwhereBetween('price',[6000,8000]);
            });
        }elseif($id == '1,2,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])->orwhereBetween('price', [2000, 4000])
               ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '1,2'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price', [2000, 4000]);
            });
        }elseif($id == '1,3'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                ->orwhereBetween('price', [4000,6000]);
            });
        }elseif($id == '1,4'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
                 ->orwhereBetween('price',[6000,8000]);
            });
        }elseif($id == '1,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[0, 2000])
              ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '2,3'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000])
                ->orwhereBetween('price', [4000,6000]);
            });
        }elseif($id == '2,4'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000])
                ->orwhereBetween('price',[6000,8000]);
            });
        }elseif($id == '2,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [2000, 4000])
               ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '3,4'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [4000,6000])
                ->orwhereBetween('price',[6000,8000]);
            });
        }elseif($id == '3,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price', [4000,6000])
              ->orwhereBetween('price',[8000,10000]);
            });
        }elseif($id == '4,5'){
            return $this->whereHas('productprice', function ($query)  {
                return $query->whereBetween('price',[6000,8000])->orwhereBetween('price',[8000,10000]);
            });
        }

    }

}
