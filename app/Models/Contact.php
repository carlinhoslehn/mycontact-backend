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
    protected $dateFormat = 'd-m-Y H:i:s';
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
