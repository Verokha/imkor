<?php

namespace App\Http\Controllers;

use App\Http\Services\HomeService;
use App\Mail\NotifyMail;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController
{
    public function submit(Request $request)
    {
        $settings = Settings::where('tech_name', 'home_settings')->first()->data;
        if (isset($settings['email_notify'])) {
            Mail::to($settings['email_notify'])->send(new NotifyMail($request->all()));
        }
        
        return view('components.сongratulation', []);
    }

    public function policy(HomeService $service)
    {
        $text = $service->policy();
        return view('components.policy', [
            'text'=> $text['policy'] ?? ""
        ]);
    }
}
