<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\LinkService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        protected LinkService $linkService,
    ){

    }

    public function show($username) {
        $user = User::with('profile', 'user_links', 'products', 'products.images')->where('username', $username)->firstOrFail();
        
        foreach($user->user_links as $link){
            $faviconUrl = $this->linkService->crawlerFaviconFromUrl($link->url);
            if(!$faviconUrl){
                $link->favicon_url = 'assets/img/avatar/avatar-2.png';
            } else {
                $link->favicon_url = $faviconUrl;
            }
        }

        foreach($user->products as $product){
            $product->image_url = $product->images->first()->path;
        }

        return view('profile.show', compact('user'));
    }

    public function getFaviconFromUrl(Request $request){
        $url = request('url');
        
        $faviconUrl = 'assets/img/avatar/avatar-2.png';
        if(!$this->linkService->crawlerFaviconFromUrl($url) === null){
            $faviconUrl = $this->linkService->crawlerFaviconFromUrl($url);
        } 

        return response()->json(['faviconUrl' => $faviconUrl]);
    }
}
