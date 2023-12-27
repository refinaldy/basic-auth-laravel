<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class LinkService.
 */
class LinkService
{

  public function crawlerFaviconFromUrl($url){
    try {
      $response = Http::get($url);
      $html = $response->body();
      
       $crawler = new Crawler($html);

       $faviconLink = $crawler->filter('link[rel="icon"], link[rel="shortcut icon"]')->first();
       $faviconUrl = $faviconLink ? $faviconLink->attr('href') : null;

       if (!$faviconUrl) {
           return null;
       }

       return $faviconUrl;
    } catch (\Exception $e) {
        // Handle errors
        return response()->json(['error' => 'Error fetching favicon'], 500);
    }
  }

}
