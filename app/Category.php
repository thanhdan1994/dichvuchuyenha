<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string description
 * @property string thumbnail
 */
class Category extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
