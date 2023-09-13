<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'email',
      'phone',
      'category_id'
    ];
    protected $date = ['created_at','updated_at'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
