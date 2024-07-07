<?php

namespace App\Http\Services;

use App\Models\CarItem;
use App\Models\CaseItem;
use App\Models\FaqItem;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeService
{
    public function requiredData()
    {
        $faqItems = $this->faqItems();

        $caseItems = $this->caseItems();

        return [
            $faqItems, 
            CarItem::CATEGORIES, 
            $caseItems,
            $this->seoItems(),
            $this->settings(),
        ];
    }

    protected function faqItems()
    {
        return Cache::rememberForever(FaqItem::class, function () {
            return DB::table('faq_items', 'fi')
                ->select([
                    'fi.question',
                    'fi.answer'
                ])
                ->get();
        });
    }

    protected function caseItems()
    {
        return Cache::rememberForever(CaseItem::class, function () {
            $cases = [];
            CaseItem::chunk(50, function($caseItems) use (&$cases) {
                foreach($caseItems as $caseItem) {
                    $cases[] = [
                        'title' => $caseItem->title,
                        'description' => $caseItem->description,
                        'img' => $caseItem->attachment->first()->url(),
                    ];
                }
            });
            return $cases;
        });
    }

    protected function seoItems()
    {
        $key = Settings::class.'_seo_';
        return Cache::rememberForever($key, function () {
            $settings = Settings::where('tech_name', 'seo')->first()->data;
            $settings['description'] = trim(str_replace("\r\n", "", $settings['description'] ?? ""));
            $settings['keywords'] = trim(str_replace("\r\n", "", $settings['keywords'] ?? ""));
            $settings['footer_code'] = trim(str_replace("\r\n", "", $settings['footer_code'] ?? ""));
            $settings['headers_code'] = trim(str_replace("\r\n", "", $settings['headers_code'] ?? ""));
            return $settings;
        });
    }

    protected function settings()
    {
        $key = Settings::class.'_home_settings_';
        return Cache::rememberForever($key, function () {
            return Settings::where('tech_name', 'home_settings')->first()->data;
        });   
    }

    public function policy()
    {
        $key = Settings::class.'_advantages_';
        return Cache::rememberForever($key, function () {
            return Settings::where('tech_name', 'advantages')->first()->data;
        }); 
    }
}
