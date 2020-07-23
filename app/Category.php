<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string description
 */
class Category extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
