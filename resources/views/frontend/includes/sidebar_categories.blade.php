<div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
    <!-- List -->
    @php

    $parent_category = config('categories');
    $categories = '';

    foreach ($parent_category as $key => $parent) {
    if (count($parent['sub_category']) > 0 ) {
    $categories .= "<li><a class=\"dropdown-toggle dropdown-toggle-collapse\" role=\"button\" href=\"javascript:;\" aria-expanded=\"false\" data-toggle=\"collapse\" aria-controls=\"sidebarNav_" . $parent['id'] . "\" data-target=\"#sidebarNav_" . $parent['id'] . "\">" . $parent['name'] . "</a>
        <div id=\"sidebarNav_" . $parent['id'] . "\" class=\"collapse\" data-parent=\"#sidebarNav\">
            <ul class=\"list-unstyled dropdown-list\" id=\"sidebar_" . $parent['id'] . "\">";

                $categories .= generate_shop_sub_categories($parent);
                $categories .= "</ul>
        </div>
    </li>";
    }else{
    $categories .= "<li><a class=\"dropdown-item\" href=\"" . route('categories', $parent['slug']) ."\">" . $parent['name'] . "</a></li>";
    }
    }

    function generate_shop_sub_categories($parent)
    {
    $sub_categories = '';

    foreach ($parent['sub_category'] as $key => $child) {
    if (count($child['sub_category']) > 0 ) {
    $sub_categories .= "<li><a href=\"javascript:void\" class=\"dropdown-item u-header-sidebar__sub-menu-title\">" . $child['name'] . "</a></li>";
    $sub_categories .= generate_shop_sub_categories($child);
    }else{
    $sub_categories .= "<li><a class=\"dropdown-item\" href=\"" . route('product-list', $child['slug']) ."\">" . $child['name'] . "</a></li>";
    }
    }

    return $sub_categories;

    }

    @endphp
    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar view-all">
        <li>
            <div class="dropdown-title">Browse Categories</div>
        </li>
        @isset($categories)
        {!! $categories !!}
        @endisset


    </ul>
    <!-- End List -->
</div>