<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\DeliveryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryTypeRequest;
use App\Http\Requests\UpdateDeliveryTypeRequest;
use App\Http\Resources\Admin\DeliveryTypeResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('delivery_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryTypeResource(DeliveryType::all());
    }

    public function store(StoreDeliveryTypeRequest $request)
    {
        $deliveryType = DeliveryType::create($request->all());

        return (new DeliveryTypeResource($deliveryType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DeliveryType $deliveryType)
    {
        abort_if(Gate::denies('delivery_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeliveryTypeResource($deliveryType);
    }

    public function update(UpdateDeliveryTypeRequest $request, DeliveryType $deliveryType)
    {
        $deliveryType->update($request->all());

        return (new DeliveryTypeResource($deliveryType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DeliveryType $deliveryType)
    {
        abort_if(Gate::denies('delivery_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deliveryType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
