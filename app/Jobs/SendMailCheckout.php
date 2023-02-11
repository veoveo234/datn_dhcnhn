<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailCheckout;
use Nexmo\Laravel\Facade\Nexmo;
use App\Models\User\ShoppingCart\Order;
use App\Models\User\Member\Member;
use App\Models\User\ShoppingCart\OrderDetail;


class SendMailCheckout implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::find($this->order_id);
        $user = Member::find($order->member_id);
        // dd($user);
        $order_detail = OrderDetail::select('order_id', 'product_id', 'name_size', 'quantity')->where('order_id', '=', $order->id)->get()->toArray();

        // Nexmo::message()->send([
        //     'to'   => '+84879152813',
        //     'from' => '+84946825001',
        //     'text' => 'Chuc mung ban da dat hang thanh cong.'
        // ]);
        $email = new MailCheckout($order, $user, $order_detail);
        Mail::to($user->email)->send($email);
    }
}
