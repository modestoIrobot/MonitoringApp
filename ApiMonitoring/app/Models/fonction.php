<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fonction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'workflow',
        'description',
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }

}
