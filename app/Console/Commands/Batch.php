<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reserve;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Batch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '予約確認メールの送信';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today =new Carbon('today');
        $tomorrow = new Carbon('tomorrow');
        
        $reserves = Reserve::where('date_time','>=',$today->format('Y-m-d'))
        ->where('date_time','<',$tomorrow->format('Y-m-d'))->get();



        foreach ($reserves as $reserve) {

            Mail::send('mail.remind_mail', ['reserve' => $reserve],function ($message) use ($reserve) {
                $message->to($reserve->user->email)
                        ->subject('ご予約の確認')
                        ->setBody($reserve, 'text/html');
            });
        }
    }
}
