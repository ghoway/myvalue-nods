<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'url', 'icon', 'parent_id', 'role', 'header'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
