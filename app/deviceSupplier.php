<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
class deviceSupplier extends Model
{
    // use HasFactory;
    // protected $connection = 'marketing';
    protected $connection = 'dms';

    protected $table = 'device_suppliers';
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','code' ,'duration'
    ];
}
