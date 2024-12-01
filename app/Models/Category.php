<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'slug',
        'parent_category_id',
        'description',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    /*
     * Get the sub-categories of this category.
     */
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    /**
     * Get the blogs for the category.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getRouteKeyName()
    {
        return 'slug'; // Use the 'slug' column for route model binding
    }
}
