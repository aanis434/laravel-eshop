<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Setting;
use App\Settings;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = Setting::all();

        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        abort_if(Gate::denies('setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = Setting::all()->pluck('value', 'name');
        // dd($settings['name']);

        return view('admin.settings.create', compact('settings'));
    }

    public function store(Request $request)
    {
        $inputs = $request->except('_token');

        $old_logo = Setting::where('name', 'logo')->firstOrFail();

        if ($request->hasFile('logo')) {

            if (file_exists($old_logo->value)) {
                unlink($old_logo->value);
            }

            $id_photo = $request->file('logo');

            $destinationPath = 'logo/'; // upload path
            $logo_image = date('YmdHis') . "." . $id_photo->getClientOriginalExtension();
            $upload = $id_photo->move($destinationPath, $logo_image);

            if (!$upload) {
                $status = ['type' => 'danger', 'message' => 'Image Must be JPG, JPEG, PNG, GIF'];
                return back()->with('status', $status);
            }
            $inputs['logo'] = $upload;
        }


        foreach ($inputs as $key => $value) {
            $saveSettings = Setting::firstOrNew(array('name' => $key));
            $saveSettings->name = $key;
            $saveSettings->value = $value;
            $saveSettings->save();
        }

        $status = ['type' => 'success', 'message' => 'Settings Added Successfully'];

        return back()->with('status', $status);
    }

    public function edit(Setting $setting)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $setting->update($request->all());

        return redirect()->route('admin.settings.index');
    }

    public function show(Setting $setting)
    {
        abort_if(Gate::denies('setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.show', compact('setting'));
    }

    public function destroy(Setting $setting)
    {
        abort_if(Gate::denies('setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setting->delete();

        return back();
    }

    public function massDestroy(MassDestroySettingRequest $request)
    {
        Setting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
