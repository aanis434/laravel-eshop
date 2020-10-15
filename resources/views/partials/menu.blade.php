<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href='{{ route("admin.home") }}' class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.userManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('permission_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.permissions.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.permission.title') }}
                    </a>
                </li>
                @endcan
                @can('role_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.roles.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.role.title') }}
                    </a>
                </li>
                @endcan
                @can('user_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.users.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('product_management_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.productManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('product_category_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.product-categories.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/product-categories') || request()->is('admin/product-categories/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.productCategory.title') }}
                    </a>
                </li>
                @endcan
                @can('product_tag_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.product-tags.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/product-tags') || request()->is('admin/product-tags/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.productTag.title') }}
                    </a>
                </li>
                @endcan
                @can('product_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.products.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.product.title') }}
                    </a>
                </li>
                @endcan
                @can('brand_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.brands.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/brands') || request()->is('admin/brands/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.brand.title') }}
                    </a>
                </li>
                @endcan
                @can('unit_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.units.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/units') || request()->is('admin/units/*') ? 'active' : '' }}">
                        <i class="fa-fw fab fa-uniregistry c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.unit.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('purchase_access')
        <li class="c-sidebar-nav-item">
            <a href='{{ route("admin.purchases.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/delivery-types') || request()->is('admin/delivery-types/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-sign-out-alt c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.purchase.title') }}
            </a>
        </li>
        @endcan
        @can('order_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-luggage-cart c-sidebar-nav-icon">

                </i>
                Orders Management
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.orders.index","status=Pending") }}' class="c-sidebar-nav-link {{ request()->is('admin/suppliers') || request()->is('admin/suppliers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-circle c-sidebar-nav-icon">

                        </i>
                        Requested Orders
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.orders.index","status=Approved") }}' class="c-sidebar-nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-check-circle c-sidebar-nav-icon">

                        </i>
                        Approved Orders
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.orders.index","status=Processing") }}' class="c-sidebar-nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-arrow-right c-sidebar-nav-icon">

                        </i>
                        Processing Orders
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.orders.index","status=Shipment") }}' class="c-sidebar-nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-truck c-sidebar-nav-icon">

                        </i>
                        Shipment Orders
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.orders.index","status=Canceled") }}' class="c-sidebar-nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-times-circle c-sidebar-nav-icon">

                        </i>
                        Canceled Orders
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.orders.index","status=Completed") }}' class="c-sidebar-nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-thumbs-up c-sidebar-nav-icon">

                        </i>
                        Completed Orders
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.orders.index","status=Returned") }}' class="c-sidebar-nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-times-circle c-sidebar-nav-icon">

                        </i>
                        Returned Orders
                    </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('report_access')
        <li class="c-sidebar-nav-item">
            <a href='{{ route("admin.reports.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/delivery-types') || request()->is('admin/delivery-types/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                </i>
                Reports
            </a>
        </li>
        @endcan
        @can('delivery_type_access')
        <li class="c-sidebar-nav-item">
            <a href='{{ route("admin.delivery-types.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/delivery-types') || request()->is('admin/delivery-types/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-shuttle-van c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.deliveryType.title') }}
            </a>
        </li>
        @endcan
        @can('setting_access')
        <li class="c-sidebar-nav-item">
            <a href='{{ route("admin.settings.create") }}' class="c-sidebar-nav-link {{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.setting.title') }}
            </a>
        </li>
        @endcan
        @can('client_management_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.clientManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('supplier_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.suppliers.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/suppliers') || request()->is('admin/suppliers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.supplier.title') }}
                    </a>
                </li>
                @endcan
                @can('customer_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.customers.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.customer.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('faq_management_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.faqManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('faq_category_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.faq-categories.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/faq-categories') || request()->is('admin/faq-categories/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.faqCategory.title') }}
                    </a>
                </li>
                @endcan
                @can('faq_question_access')
                <li class="c-sidebar-nav-item">
                    <a href='{{ route("admin.faq-questions.index") }}' class="c-sidebar-nav-link {{ request()->is('admin/faq-questions') || request()->is('admin/faq-questions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.faqQuestion.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
        @can('profile_password_edit')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                </i>
                {{ trans('global.change_password') }}
            </a>
        </li>
        @endcan
        @can('slider_access')
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "active" : "" }}">
                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.slider.title') }}
            </a>
        </li>
        @endcan
        @can('menu_management_access')
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.menuManagement.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @can('menu_section_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.menu-sections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-sections") || request()->is("admin/menu-sections/*") ? "active" : "" }}">
                        <i class="fa-fw fas fa-ellipsis-v c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.menuSection.title') }}
                    </a>
                </li>
                @endcan
                @can('menu_access')
                <li class="c-sidebar-nav-item">
                    <a href="{{ route("admin.menus.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menus") || request()->is("admin/menus/*") ? "active" : "" }}">
                        <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                        </i>
                        {{ trans('cruds.menu.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>