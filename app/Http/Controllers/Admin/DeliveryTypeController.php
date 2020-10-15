<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDeliveryTypeRequest;
use App\Http\Requests\StoreDeliveryTypeRequest;
use App\Http\Requests\UpdateDeliveryTypeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('delivery_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryTypes = DeliveryType::all();

        return view('admin.deliveryTypes.index', compact('deliveryTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('delivery_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.deliveryTypes.create');
    }

    public function store(StoreDeliveryTypeRequest $request)
    {
        $deliveryType = DeliveryType::create($request->all());

        return redirect()->route('admin.delivery-types.index');
    }

    public function edit(DeliveryType $deliveryType)
    {
        abort_if(Gate::denies('delivery_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.deliveryTypes.edit', compact('deliveryType'));
    }

    public function update(UpdateDeliveryTypeRequest $request, DeliveryType $deliveryType)
    {
        $deliveryType->update($request->all());

        return redirect()->route('admin.delivery-types.index');
    }

    public function show(DeliveryType $deliveryType)
    {
        abort_if(Gate::denies('delivery_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.deliveryTypes.show', compact('deliveryType'));
    }

    public function destroy(DeliveryType $deliveryType)
    {
        abort_if(Gate::denies('delivery_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryType->delete();

        return back();
    }

    public function massDestroy(MassDestroyDeliveryTypeRequest $request)
    {
        DeliveryType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
