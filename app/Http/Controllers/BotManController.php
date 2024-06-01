<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('BotMan handle method called');
        
        $botman = app('botman');
        $responseMessages = [];

        $botman->hears('hello', function (BotMan $bot) use (&$responseMessages) {
            $response = 'Hello! How can I help you today?';
            $responseMessages[] = $response;
            $bot->reply($response);
        });

        $botman->hears('help', function (BotMan $bot) use (&$responseMessages) {
            $response = 'You can ask me about the child care center’s operating hours, enrollment process, location, and more.';
            $responseMessages[] = $response;
            $bot->reply($response);
        });

        $botman->fallback(function (BotMan $bot) use (&$responseMessages) {
            $response = 'Sorry, I did not understand these commands. Try typing help.';
            $responseMessages[] = $response;
            $bot->reply($response);
        });

        $botman->listen();

        return response()->json(['messages' => $responseMessages]);
    }
}
