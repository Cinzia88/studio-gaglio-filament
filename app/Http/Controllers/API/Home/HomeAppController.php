<?php

namespace App\Http\Controllers\API\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeAppController extends Controller
{
    public function show(): JsonResponse
    {
        $services = Service::limit(2)->get();
        $news = Post::limit(2)->get();

        return response()->json([
            'services' =>  $services,
            'news' => $news,
          ]);
    }
}
