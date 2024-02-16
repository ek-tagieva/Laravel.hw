<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'about',
        'price',
        'photo'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getImageUrl()
    {
        return  url('public/storage/app/public/img/plants') . '/plant-' . $this->id . '.ipg';
    }

}
