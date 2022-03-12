<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','description','base_price','img','token_id', 'token_standar',
        'blockchain_type','metadata','likes','id_category','id_user'
    ];

}
