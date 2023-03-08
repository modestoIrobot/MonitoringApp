<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'page_path',
        'value',
        'description',
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }

}
