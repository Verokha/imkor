<?php

namespace App\Http\Controllers;

use App\Http\Services\CarService;
use App\Http\Services\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(Request $request, CarService $carService, HomeService $homeService)
    {
        
        $filterType = $request->get('filterType', 'all');
        $pagiantion = $carService->listItems(
            page: $request->get('page', 1),
            perPage: 9,
            path: $request->url(),
            query: $request->query(),
            filterType: $filterType
        );
        list($faqItems, $categories, $caseItems, $seoItems, $settings) = $homeService->requiredData();
        View::share('seoItems', $seoItems);
        return view('home.index', [
            'faqItems' => $faqItems,
            'categories' => $categories,
            'carItems' => $pagiantion,
            'filterType' => $filterType,
            'caseItems' => $caseItems,
            'settings' => $settings,
        ]);
    }
}
