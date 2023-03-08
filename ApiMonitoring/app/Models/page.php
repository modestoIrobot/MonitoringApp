<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'type_page',
        'uri',
        'description',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function fonctions()
    {
        return $this->hasMany(Fonction::class);
    }

    public function variables()
    {
        return $this->hasMany(Variable::class);
    }

    public function widgets()
    {
        return $this->hasMany(Widget::class);
    }

}
