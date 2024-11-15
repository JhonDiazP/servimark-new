<?php

namespace App\Http\Controllers;

use App\Models\ImageService;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $service = Service::with('image_services', 'category');

        if (isset($request['search']) && $request['search'] != 'null' && !empty($request['search'])) {
            $search = $request['search'];
            $service->where(function ($query) use ($search) {
                $query->where('services.name', 'like', '%' . $search . '%')
                    ->orWhere('services.description', 'like', '%' . $search . '%');
            });
        }

        $service = $service->paginate(9);

        return response()->json([
            'status' => true,
            'message' => 'Servicios obtenidos exitosamente.',
            'data' => ['service' => $service]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'municipality_id' => 'required|exists:municipalities,id',
        ]);

        DB::beginTransaction();

        $service = new Service;
        $service->id = Uuid::generate()->string;
        $service->service_status_id = 1;
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->category_id = $request->category_id;
        $service->municipality_id = $request->municipality_id;
        $service->user_id = auth()->user()->id;
        $service->save();

        $path = Storage::disk('public')->put('images', $request->file('photo_principal'));

        $image_service = new ImageService;
        $image_service->service_id = $service->id;
        $image_service->path = $path;
        $image_service->save();

        if ($request->hasFile('photo_one')) {
            $path = Storage::disk('public')->put('images', $request->file('photo_one'));

            $image_service = new ImageService;
            $image_service->service_id = $service->id;
            $image_service->path = $path;
            $image_service->save();
        }

        if ($request->hasFile('photo_two')) {
            $path = Storage::disk('public')->put('images', $request->file('photo_two'));

            $image_service = new ImageService;
            $image_service->service_id = $service->id;
            $image_service->path = $path;
            $image_service->save();
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Servicio creado exitosamente.',
            'data' => null
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $service = Service::select('services.*')
            ->with('image_services', 'user', 'reviews', 'municipality')
            ->withAvg('reviews', 'rating')
            ->where('services.id', $id)
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'Servicio obtenido exitosamente.',
            'data' => ["service" => $service]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'region_id' => 'required|exists:regions,id',
        ]);

        $service = Service::find($id);
        $service->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Servicio actualizado exitosamente.',
            'data' => $service
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $service = Service::find($id);
        $service->delete();

        return response()->json([
            'status' => true,
            'message' => 'Servicio eliminado exitosamente.',
        ]);
    }

    public function hireService(Request $request): JsonResponse
    {
        $service = Service::find($request->service_id);

        // Obtener la hora del request y convertirla a un formato de Carbon para el día actual
        $requestedTime = Carbon::createFromFormat('H:i', $request->date);
        $todayDate = Carbon::today();  // Fecha de hoy sin hora

        // Combinar la fecha de hoy con la hora solicitada
        $fullRequestedDateTime = $todayDate->setTime($requestedTime->hour, $requestedTime->minute);

        // Definir el rango desde una hora antes hasta una hora después de la hora solicitada
        $startOfBlockedTime = $fullRequestedDateTime->copy()->subHour();
        $endOfBlockedTime = $fullRequestedDateTime->copy()->addHour();

        // Verificar si existe un pedido en el rango de una hora antes a una hora después
        $existingOrder = Order::whereBetween('order_date', [$startOfBlockedTime, $endOfBlockedTime])
            ->whereHas('orderServices', function ($query) use ($service) {
                $query->where('service_id', $service->id);
            })->first();

        if ($existingOrder) {
            return response()->json([
                'message' => 'Ya existe una orden para este servicio en el rango de tiempo solicitado. Intente después de una hora.'
            ], 400);
        }

        $order = new Order();
        $order->id = Uuid::generate()->string;
        $order->order_status_id = 1;
        $order->user_id = $request->user_id;
        $order->total_amount = $service->price;
        $order->order_date = $fullRequestedDateTime;
        $order->save();


        $order_service = new OrderService();
        $order_service->order_id = $order->id;
        $order_service->service_id = $service->id;
        $order_service->quantity = 1;
        $order_service->save();

        return response()->json([
            'status' => true,
            'message' => 'Servicio contratado exitosamente.',
            'data' => $service
        ]);
    }
}
