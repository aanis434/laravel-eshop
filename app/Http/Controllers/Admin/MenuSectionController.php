<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMenuSectionRequest;
use App\Http\Requests\StoreMenuSectionRequest;
use App\Http\Requests\UpdateMenuSectionRequest;
use App\MenuSection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuSectionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('menu_section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuSections = MenuSection::all();

        return view('admin.menuSections.index', compact('menuSections'));
    }

    public function create()
    {
        abort_if(Gate::denies('menu_section_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.menuSections.create');
    }

    public function store(StoreMenuSectionRequest $request)
    {
        $menuSection = MenuSection::create($request->all());

        return redirect()->route('admin.menu-sections.index');
    }

    public function edit(MenuSection $menuSection)
    {
        abort_if(Gate::denies('menu_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.menuSections.edit', compact('menuSection'));
    }

    public function update(UpdateMenuSectionRequest $request, MenuSection $menuSection)
    {
        $menuSection->update($request->all());

        return redirect()->route('admin.menu-sections.index');
    }

    public function show(MenuSection $menuSection)
    {
        abort_if(Gate::denies('menu_section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.menuSections.show', compact('menuSection'));
    }

    public function destroy(MenuSection $menuSection)
    {
        abort_if(Gate::denies('menu_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuSection->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuSectionRequest $request)
    {
        MenuSection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
