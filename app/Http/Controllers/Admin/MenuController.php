<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMenuRequest;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Menu;
use App\MenuSection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('menu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menus = Menu::all();

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        abort_if(Gate::denies('menu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_sections = MenuSection::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parent_menus = Menu::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.menus.create', compact('menu_sections', 'parent_menus'));
    }

    public function store(StoreMenuRequest $request)
    {
        $menu = Menu::create($request->all());

        return redirect()->route('admin.menus.index');
    }

    public function edit(Menu $menu)
    {
        abort_if(Gate::denies('menu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_sections = MenuSection::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parent_menus = Menu::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu->load('menu_section', 'parent_menu');

        return view('admin.menus.edit', compact('menu_sections', 'parent_menus', 'menu'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->update($request->all());

        return redirect()->route('admin.menus.index');
    }

    public function show(Menu $menu)
    {
        abort_if(Gate::denies('menu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->load('menu_section', 'parent_menu');

        return view('admin.menus.show', compact('menu'));
    }

    public function destroy(Menu $menu)
    {
        abort_if(Gate::denies('menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuRequest $request)
    {
        Menu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
