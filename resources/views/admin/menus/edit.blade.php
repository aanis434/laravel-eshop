@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.menu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.menus.update", [$menu->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.menu.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $menu->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="route_name">{{ trans('cruds.menu.fields.route_name') }}</label>
                <input class="form-control {{ $errors->has('route_name') ? 'is-invalid' : '' }}" type="text" name="route_name" id="route_name" value="{{ old('route_name', $menu->route_name) }}">
                @if($errors->has('route_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('route_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.route_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.menu.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $menu->url) }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon_or_logo">{{ trans('cruds.menu.fields.icon_or_logo') }}</label>
                <input class="form-control {{ $errors->has('icon_or_logo') ? 'is-invalid' : '' }}" type="text" name="icon_or_logo" id="icon_or_logo" value="{{ old('icon_or_logo', $menu->icon_or_logo) }}">
                @if($errors->has('icon_or_logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon_or_logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.icon_or_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="menu_section_id">{{ trans('cruds.menu.fields.menu_section') }}</label>
                <select class="form-control select2 {{ $errors->has('menu_section') ? 'is-invalid' : '' }}" name="menu_section_id" id="menu_section_id">
                    @foreach($menu_sections as $id => $menu_section)
                        <option value="{{ $id }}" {{ (old('menu_section_id') ? old('menu_section_id') : $menu->menu_section->id ?? '') == $id ? 'selected' : '' }}>{{ $menu_section }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu_section'))
                    <div class="invalid-feedback">
                        {{ $errors->first('menu_section') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.menu_section_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_menu_id">{{ trans('cruds.menu.fields.parent_menu') }}</label>
                <select class="form-control select2 {{ $errors->has('parent_menu') ? 'is-invalid' : '' }}" name="parent_menu_id" id="parent_menu_id">
                    @foreach($parent_menus as $id => $parent_menu)
                        <option value="{{ $id }}" {{ (old('parent_menu_id') ? old('parent_menu_id') : $menu->parent_menu->id ?? '') == $id ? 'selected' : '' }}>{{ $parent_menu }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent_menu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent_menu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.menu.fields.parent_menu_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection