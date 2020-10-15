<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'route_name',
        'url',
        'icon_or_logo',
        'menu_section_id',
        'parent_menu_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function menu_section()
    {
        return $this->belongsTo(MenuSection::class, 'menu_section_id');
    }

    public function parent_menu()
    {
        return $this->belongsTo(Menu::class, 'parent_menu_id');
    }
}
