<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;
use App\Models\Stock;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
        'secondary_category_id',
        'image1',
        'image2',
        'image3',
        'image4',
    ];


    public function shop()
    {
        return $this->belongsTo(Shop::class);

    }

    public function category()
    {
        return $this->belongsTo(SecondaryCategory::class, 'secondary_category_id');

    }

    public function imageFirst()
    {
        return $this->belongsTo(Image::class, 'image1', 'id');

    }

    public function imageSecond()
    {
        return $this->belongsTo(Image::class, 'image2', 'id');

    }

    public function imageThird()
    {
        return $this->belongsTo(Image::class, 'image3', 'id');

    }

    public function imageFourth()
    {
        return $this->belongsTo(Image::class, 'image4', 'id');

    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
    /*
        メソッド名をモデル名から変える場合は第２引数必要
        (カラム名と同じメソッドは指定できないので名称変更)
        第２引数で_id がつかない場合は 第３引数で指定必要
    */


    public function user()
    {
        return $this->belongsToMany(User::class, 'carts')->withPivot(['id', 'quantity']);
    }
}

