<?php

namespace App\Http\Controllers\API\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsApp extends Controller
{
    public function show() {
        $news = NewsApp::orderBy('id', 'desc')->paginate(5);
        return $news;
    }



}
