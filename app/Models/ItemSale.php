<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'item_id',
        'sales_date',
        'car_plate',
        'quantity',
        'per_cost_price',
        'total_cost_price',
        'total_sale_price',
        'profit',
        'sa_commission',
        'issue_pv_date',
        'sales_commission',
        'work_commission',
        'net_profit',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function workers()
    {
        return $this->hasMany('App\Models\ItemSaleDt')->where('type','work');
    }

    public function salePersons()
    {
        return $this->hasMany('App\Models\ItemSaleDt')->where('type', 'sale');
    }

    public function getWorkerIdsAttribute()
    {
        return $this->workers()->pluck('worker_id')->toArray();
    }

    public function getSalePersonIdsAttribute()
    {
        return $this->salePersons()->pluck('worker_id')->toArray();
    }
}
