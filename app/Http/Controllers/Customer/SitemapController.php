<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Customer\BaseController;
use Illuminate\Support\Facades\Storage;

class SitemapController extends BaseController
{
    /**
     * Initialization
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * About us page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $routes = [
            'customer.home',
            'customer.about',
            'customer.services',
            'customer.pricing',
            'customer.serviced_locations',
            'customer.verify',
            'customer.completed_services',
            'customer.faq',
            'customer.privacy_policy',
            'customer.terms',
            'customer.work_with_us',
            'customer.contact',
            'customer.booking',
        ];

        foreach ($routes as $route) {
            $xml .= '<url>';
                $xml .= '<loc>' . lroute($route) . '</loc>';
                $xml .= '<lastmod>2020-08-20T00:00:00+00:00</lastmod>';
                $xml .= '<changefreq>monthly</changefreq>';
                $xml .= '<priority>1.0</priority>';
            $xml .= '</url>';
        }
        $xml .= '</urlset>';

        file_put_contents(public_path('sitemap.xml'), $xml);

        return view('customer.sitemap.index');
    }
}
