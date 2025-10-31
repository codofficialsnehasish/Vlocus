<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Driver extends Model implements HasMedia
{
    //
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'driving_license_number',
        'vehicle_type',
        'driving_exprience',
        'company_id',
        'vehicle_id',
        'is_online',
        'ride_mode',
        'latitude',
        'longitude',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id','id');
    }
    public function locations()
    {
        return $this->hasMany(DriverLocation::class, 'driver_id');
    }

    public function currentActiveDelivery()
    {
        return $this->hasOne(DeliverySchedule::class, 'driver_id', 'user_id')
            ->where('is_completed', '!=', 1)
            ->latestOfMany('delivery_date');
    }
}
