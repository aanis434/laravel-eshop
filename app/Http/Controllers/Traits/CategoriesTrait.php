<?php

namespace App\Http\Controllers\Traits;

use App\ProductCategory;

trait CategoriesTrait 
{
	public function generate_categories()
    {
        $parent_category = ProductCategory::with('childrenRecursive')->where(['parent_category_id' => Null, 'status' => 'Active'])->get();
        $categories = '';

        foreach ($parent_category as $key => $parent) {
            if (count($parent['childrenRecursive']) > 0 ) {
                $categories .= "<li class=\"u-has-submenu u-header-collapse__submenu\"><a class=\"u-header-collapse__nav-link u-header-collapse__nav-pointer\" href=\"javascript:;\" data-toggle=\"collapse\" aria-controls=\"header_category_" . $parent['id'] . "\" data-target=\"#header_category_" . $parent['id'] . "\">" . $parent['name'] . "</a><div id=\"header_category_" . $parent['id'] . "\" class=\"collapse\" data-parent=\"#headerSidebarContent\"><ul class=\"u-header-collapse__nav-list\">";

                $categories .= $this->generate_sub_categories($parent);
                $categories .= "</ul></div></li>";
            }else{
                $categories .= "<li><a class=\"u-header-collapse__submenu-nav-link\" href=\"../home/index.html\">" . $parent['name'] . "</a></li>";
            }
        }
        
        return($categories);
    }

    public function generate_sub_categories($parent)
    {
        $sub_categories = '';

        foreach ($parent['childrenRecursive'] as $key => $child) {
            if (count($child['childrenRecursive']) > 0 ) {
                $sub_categories .= "<li><span class=\"u-header-sidebar__sub-menu-title\">" . $child['name'] . "</span></li>";
                $sub_categories .= $this->generate_sub_categories($child);
            }else{
                $sub_categories .= "<li><a class=\"u-header-collapse__submenu-nav-link\" href=\"../home/index.html\">" . $child['name'] . "</a></li>";
            }
        }

       return $sub_categories;

    }
}