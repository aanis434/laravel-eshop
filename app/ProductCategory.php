<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class ProductCategory extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $appends = [
        'photo',
    ];

    public $table = 'product_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        'Active'   => 'Active',
        'Inactive' => 'Inactive',
    ];

    protected $fillable = [
        'name',
        'uuid',
        'slug',
        'description',
        'parent_category_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function parentCateogry()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_category_id');
    }

    public function childrenCategory()
    {
        return $this->hasMany(ProductCategory::class, 'parent_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', "Active");
    }

    public function scopeGetParentCategory($query)
    {
        return $query->where('parent_category_id', null);
    }

    public function scopeGetSubCategory($query, $parent = null)
    {
        return $query->where('parent_category_id', $parent);
    }

    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->childrenCategory()->with('childrenRecursive');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_product_category');
    }

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = Str::uuid();
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] =  Str::slug($value, '-');
    }
}
