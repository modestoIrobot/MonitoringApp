<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class widget extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fonction',
        'description',
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }

}
