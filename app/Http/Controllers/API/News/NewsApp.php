<?php

namespace App\Http\Controllers\API\News;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class NewsApp extends Controller
{
    public function show() {
        $news = Post::orderBy('id', 'desc')->paginate(5);
        return $news;
    }



}
