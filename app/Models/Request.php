<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $table = 'request', $primaryKey = 'id',
        $fillable = ['fullname', 'ci', 'exp', 'cellphone', 'type', 'mount', 'rental', 'credit_commercial', 'product', 'credit_finance'];
}
