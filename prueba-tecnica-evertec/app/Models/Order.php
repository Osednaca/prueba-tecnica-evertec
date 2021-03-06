<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'customer_name',
    'customer_document_type',
    'customer_document',
    'customer_last_name',
    'customer_email',
    'customer_mobile',
    'price',
    'status',
    'reference',
    'description',
    ];
}
