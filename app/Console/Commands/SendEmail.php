<?php

namespace App\Console\Commands;

use App\Models\GiftCardBuy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //       return Command::SUCCESS;
        $users = GiftCardBuy::whereMonth('delivery_date',date('m'))->whereDay('delivery_date',date('d'))
        ->whereYear('delivery_date',date('Y'))->where('mail_sent','notsent')->get();
        //dd($users);
        if ($users->count() > 0) {
            foreach ($users as $user) {
                $dataa = array(
                    'giftcard_price' => $user->giftcard_price,
                    'generated_code' => $user->generated_code,
                    'to_email' => $user->to_email,
                    'from_name' => $user->from_name,
                    'messages' => $user->message,
                    );

                Mail::send(['html'=>'mail.giftvochercode'], $dataa, function($message) use ($dataa) {
                    $message->to($dataa['to_email'])->subject
                        ('Customwish Gift Voucher');
                    $message->from('sneha@telcopl.com','Customwish');
                });
                //dd($km);

                $gif = GiftCardBuy::where('id',$user->id)->update(['mail_sent'=>'sent']);
            }
        }
        return 0;

    }
}
