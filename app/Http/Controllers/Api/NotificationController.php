<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Events\PublishNotification;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function publish(Request $request)
    {
        $creator = $request->input('creator') ?? 'Admin';
        $message = $request->input('message') ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam dolores repudiandae voluptatem nobis soluta a laborum ea iste facere similique.';

        PublishNotification::dispatch($creator, $message);
        return [];
    }
}
