<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int category_id
 */
class Post extends Model
{
    protected $fillable = [
        'name',
        'description',
        'content',
        'category_id',
        'priority',
        'status',
        'slug',
        'thumbnail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
