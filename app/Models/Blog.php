<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'author_id',
        'featured_image',
        'image_caption',
        'status',
        'is_featured',
        'is_recommended',
    ];

    /**
     * Relationships
     */

    // Blog belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class );
    }

    // Blog belongs to an author
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Accessors & Mutators
     */

    // Generate slug automatically from title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Return a URL for the featured image
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image 
            ? asset('storage/' . $this->featured_image) 
            : null;
    }

    /**
     * Scopes
     */

     public function scopeStatusFilter($query, $status)
    {
        if (in_array($status, ['published', 'draft', 'archived'])) {
            return $query->where('status', $status);
        }

        return $query;
    }

    // Scope for published blogs
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for draft blogs
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Scop for archived blogs
    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    // Scope for featured blogs
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for recommended blogs
    public function scopeRecommended($query)
    {
        return $query->where('is_recommended', true);
    }
}
