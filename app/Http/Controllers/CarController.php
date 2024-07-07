<?php

namespace App\Http\Controllers;

use App\Http\Services\CarService;
use App\Models\CarItem;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;

class CarController extends Controller
{
    public function filter(Request $request, CarService $service)
    {
        $filterType = $request->get('filterType', 'all');
        $pagiantion = $service->listItems(
            page: $request->get('page', 1),
            perPage: 9,
            path: $request->url(),
            query: $request->query(),
            filterType: $filterType
        );
        return view('components.car-items', [
            'carItems' => $pagiantion,
        ]);
    }

    public function show (CarItem $car)
    {
        $car = [
            'title' => $car->title,
            'year' => $car->year,
            'milleage' => number_format($car->milleage, 0, ',', ' '),
            'engine' => $car->engine,
            'transmission' => $car->transmission,
            'drive_unit' => $car->drive_unit,
            'images' => $car->attachment('list_photo')->get()->map(function (Attachment $attachment) {
                return $attachment->url();
            }),
            'url' => $car->url
        ];
        return view('components.car-modal', [
            'car' => $car
        ]);
    }
}
