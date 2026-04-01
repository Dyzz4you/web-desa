<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreMessageRequest;
use App\Models\Message;

class ContactMessageController extends Controller
{
    public function store(StoreMessageRequest $request)
    {
        Message::create($request->validated());

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}