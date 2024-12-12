<?php

namespace App\Http\Controllers\API\Messages;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesApp extends Controller
{
    public function show() {
        $messages = Message::orderBy('id', 'desc')->paginate(5);
        return $messages;
    }

    public function store() {

    }

    public function destroy() {

    }
}
