<?php
namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function handle()
    {
        $config = [];

        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        $botman = BotManFactory::create($config);

        $botman->hears('Hello', function (BotMan $bot) {
            $bot->reply('Hai, apa yang boleh saya bantu?');
        });

        $botman->hears('.*(pengasuh|penjaga|asuhan).*', function (BotMan $bot) {
            $bot->reply('Terdapat 5 pengasuh terlatih dan diiktiraf yang bertanggungjawab untuk menjaga kanak kanak di Taska Ihsan.');
        });

        $botman->fallback(function($bot) {
            // $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
            $bot->reply('Maaf, saya tidak dapat menjawab soalan tersebut. Anda boleh hantarkan pertanyaan anda melalui e-mel kepada rahmawatul@utm.my');
        });

        $botman->listen();
    }
}