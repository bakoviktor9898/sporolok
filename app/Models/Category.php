<?php

namespace App\Models;

use App\Concerns\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory, Filterable, HasRecursiveRelationships;

    public $timestamps = false;
    protected $fillable = ['name', 'parent_id'];

    /**
     * Get the parent Category associated with the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    /**
     * Get all of the Child Categories for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get how deep is this Category in the tree
     *
     * @return int
     */
    public function getDepthAttribute()
    {
        $count = 0;
        $parent = $this->parent;
        while ($parent)
        {
            $count += 1;
            $parent = $parent->parent;
        }
        return $count;
    }
}
