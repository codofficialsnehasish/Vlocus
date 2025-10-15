<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Shop extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'shop_number',
        'shop_name',
        'shop_address',
        'shop_contact_person_name',
        'shop_contact_person_phone',
        'shop_latitude',
        'shop_longitude',
        'is_visible',
    ];

    public function deliverySchedules()
    {
        return $this->belongsToMany(DeliverySchedule::class, 'delivery_schedule_shop');
    }
}
