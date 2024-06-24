<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BotManController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Handling bot request', ['request' => $request->all()]);

        $config = [];

        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        $botman = BotManFactory::create($config);

        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hai, apa yang boleh saya bantu?');
        });

        $botman->hears('.*salam.*', function (BotMan $bot) {
            $bot->reply('Waalaikummussalam');
        });

        $botman->hears('.*(pengasuh|penjaga|asuhan).*', function (BotMan $bot) {
            $reply = "<p>Terdapat 6 pengasuh terlatih dan diiktiraf yang bertanggungjawab untuk menjaga kanak-kanak di Taska Ihsan</p>"
                    . "<br/>"
                    . "<p>Setiap bilik akan dipantau oleh 2 orang pengasuh</p>"
                    . "<br/>"
                    . "<p>Pembahagian bilik adalah seperti berikut:</p>"
                    . "<br/>"
                    . "<p>Bilik 1 (2 bulan - 12 bulan): 6 orang</p>"
                    . "<p>Bilik 2 (1 tahun - 2 tahun) : 10 orang</p>"
                    . "<p>Bilik 3 (3 tahun - 4 tahun) : 20 orang</p>"
                    . "<br/>";

            $bot->reply($reply);
        });

        $botman->hears('.*waktu.*', function (BotMan $bot) {
            $reply = "<p>Waktu operasi <strong>Taska Ihsan</strong> adalah seperti berikut:</p>"
                   . "<br/>"
                   . "<p>Ahad - Rabu: 7.30 pagi - 5.30 petang</p>"
                   . "<p>Khamis: 7.30 pagi - 4.00 petang</p>"
                   . "<hr/>"
                   . "<p>Waktu operasi <strong>Tadika Ihsan</strong> adalah seperti berikut:</p>"
                   . "<br/>"
                   . "<p>Pakej sepenuh hari</p>"
                   . "<p>Ahad - Khamis: 8.00 pagi - 5.00 petang</p>"
                   . "<br/>"
                   . "<p>Pakej separuh hari</p>"
                   . "<p>Ahad - Khamis: 8.00 pagi - 12.00 tengahari</p>";
        
            $bot->reply($reply);
        });
        
        $botman->hears('.*(yuran|bayaran).*', function (BotMan $bot) {
            $reply = 
                    "<p>Bayaran yuran adalah secara bulanan</p>"
                   . "<br/>"
                   . "<p>Bayaran yuran <strong>Taska Ihsan</strong>:</p>"
                   . "<p>2 bulan - 12 bulan: RM 430</p>"
                   . "<p>1 tahun - 2 tahun: RM 400</p>"
                   . "<p>3 tahun - 4 tahun: RM 380</p>"
                   . "<hr/>"
                   . "<p>Bayaran yuran <strong>Tadika Ihsan</strong>:</p>"
                   . "<p>Pakej Sepenuh Hari: RM 380</p>"
                   . "<p>Pakej Separuh Hari: RM 340</p>"
                   . "<br/>";
        
            $bot->reply($reply);
        });

        $botman->hears('.*(contact|hubung).*', function (BotMan $bot) {
            $reply = 
                    "<p>Hubungi Taska & Tadika Ihsan di:</p>"
                   . "<br/>"
                   . "<p><b>Alamat Taska Ihsan:</b></p>"
                   . "<p>Taska Ihsan UTM</p>"
                   . "<p>Block U01C, Pejabat Tapak Stadium</p>"
                   . "<p>Universiti Teknologi Malaysia</p>"
                   . "<p>81310 Johor Bahru, Johor</p>"
                   . "<br/>"
                   . "<p><b>Alamat Tadika Ihsan:</b></p>"
                   . "<p>Tadika Ihsan UTM</p>"
                   . "<p>Jalan Kempas 1</p>"
                   . "<p>Universiti Teknologi Malaysia</p>"
                   . "<p>81310 Johor Bahru, Johor</p>"
                   . "<br/><hr/>"
                   . "<p><b>Telefon:</b> 07-5535649 / 37501 / 37529</p>"
                   . "<br/>"
                   . "<p><b>Emel:</b> ihsanpmiutm@gmial.com</p>"
                   . "<br/>"
                   . "<p><b>Facebook:</b> Tadika Ihsan PIUTM</p>"
                   . "<br/>";
        
            $bot->reply($reply);
        });

        $botman->fallback(function($bot) {
            $bot->reply('Maaf, saya tidak dapat menjawab soalan tersebut. Anda boleh hantarkan pertanyaan anda melalui e-mel kepada <b>rahmawatul@utm.my</b>');
        });

        $botman->listen();
    }

    // public function askName($botman){
    //     $botman->ask('Waalaikumussalam, siapakah nama anda?', function(Answer $answer, $conversation){
    //         $name = $answer->getText();

    //         if (empty($name)) {
    //             $conversation->repeat();
    //             return;
    //         }

    //         $conversation->store('name', $name);

    //         $conversation->say('Selamat datang ' . $name);

    //         $conversation->ask('Adakah pertanyaan anda mengenai Taska Ihsan atau Tadika Ihsan?', function(Answer $answer, $conversation) {
    //             $branch = strtolower($answer->getText());

    //             if (strpos($branch, 'taska') !== false) {
    //                 $this->taskaConversation($conversation);
    //             } else {
    //                 $conversation->say('Maaf, saya hanya boleh membantu mengenai Taska Ihsan atau Tadika Ihsan.');
    //             }
    //         });
    //     });
    // }

    // public function taskaConversation($botman) {
    //     $botman->ask('Apakah yang anda ingin tahu mengenai Taska Ihsan?', function(Answer $answer, $conversation) {
    //         $question = strtolower($answer->getText());

    //         // Process the question and provide relevant information
    //         if (strpos($question, 'waktu operasi') !== false) {
    //             $conversation->say('Waktu operasi Taska Ihsan adalah seperti berikut:
    //                 Ahad - Rabu: 7.30 pagi - 5.30 petang
    //                 Khamis: 7.30 pagi - 4.00 petang');
    //         } else {
    //             $conversation->say('Maaf, saya tidak dapat membantu dengan pertanyaan tersebut. Anda boleh hantarkan pertanyaan melalui e-mel kepada rahmawatul@utm.my');
    //         }
    //     });
    // }
}
