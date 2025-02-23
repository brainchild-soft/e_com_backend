<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $primaryKey = 'shop_id';

    protected $fillable = [
        'seller_id',
        'shop_name',
        'shop_slug',
        'logo_id',
        'shop_address',
        'phone_no',
        'shop_email',
        'shop_category',
        'banner_id',
        'min_deli_day',
        'max_deli_day',
    ];

    public function seller(){
        return $this->belongsTo(Seller::class, 'seller_id', 'seller_id');
    }

    public function shopLogo(){
        return $this->hasOne(Attachment::class, 'attachment_id','logo_id');
    }

    public function banner(){

        return $this->hasOne(Attachment::class, 'attachment_id','banner_id');
    }
}
