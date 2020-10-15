<?php

namespace App\Providers;

use App\Menu;
use App\ProductCategory;
use App\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        if (Schema::hasTable('settings')) {
            foreach (Setting::all() as $setting) {
                Config::set('settings.' . $setting->name, $setting->value);
            }
        }

        if (Schema::hasTable('product_categories')) {

            $parentCategory = ProductCategory::getParentCategory()->active()->select('id', 'name', 'slug')->get();

            $categories = [];
            foreach ($parentCategory as $key => $category) {

                $categories[$key]['id'] =  $category->id;
                $categories[$key]['name'] =  $category->name;
                $categories[$key]['slug'] =  $category->slug;
                $categories[$key]['sub_category'] = findSubCategory($category->id);
            }

            Config::set('categories', $categories);
        }

        if (Schema::hasTable('menus')) {

            $get_menus = Menu::orderBy('name', 'asc')->select('name', 'route_name', 'url', 'icon_or_logo', 'menu_section_id')->get();

            $menus = [];

            foreach ($get_menus as $key => $item) {
                $menus[$key]['name'] = $item->name;
                $menus[$key]['route_name'] = $item->route_name;
                $menus[$key]['url'] = $item->url;
                $menus[$key]['icon_or_logo'] = $item->icon_or_logo;
                $menus[$key]['menu_section_id'] = $item->menu_section_id;
                $menus[$key]['menu_section_name'] = $item->menu_section->name;
            }

            Config::set('menus', $menus);
        }
    }
}
