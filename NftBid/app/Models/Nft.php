<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Nft extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable=[
        'name','description','base_price','img','token_id', 'token_standar',
        'blockchain_type','metadata','likes','id_category','id_user'
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
