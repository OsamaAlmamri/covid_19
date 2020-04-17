<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class ChangeOrderStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $order;
    public $status;

    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = $status;
//        $this->message = 'new order from' . $order->user_id;
    }


    public function broadcastAs()
    {
        switch ($this->status) {
            case 'search':
                return 'order_search_event';
                break;

            case 'accept':
                return 'order_accept_event';
                break;

            case 'assignByAdmin':
                return 'order_assignByAdmin_event';
                break;

            case 'cancelByAdmin':
                return 'order_cancelByAdmin_event';
                break;

            case 'cancelByUser':
                return 'order_cancelByUser_event';
                break;

            case 'CompleteByAdmin':
                return 'order_CompleteByAdmin_event';
                break;

            case 'ConfirmByUser':
                return 'order_ConfirmByUser_event';
                break;

            case 'cancel':
                return 'order_cancel_event';
                break;

            case 'found':
                return 'order_found_event';
                break;

            case 'notFound':
                return 'order_notFound_event';
                break;
            case 'incoming':
                return 'order_incoming_event';
                break;
            case 'reached':
                return 'order_reached_event';
                break;
            case 'delivery':
                return 'order_delivery_event';
                break;
            case 'notPaid':
                return 'order_notPaid_event';
                break;
            case 'toConfirmeCompleteOrder':
                return 'order_toConfirmeCompleteOrder_event';
                break;
            case 'toConfirmeCompleteOrderByAdmin':
                return 'order_toConfirmeCompleteOrderByAdmin_event';
                break;
        }
        return '';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        switch ($this->status) {
            case 'search':
                return ['order_search'];
                break;

            case 'accept':
                return ['order_accept'];
                break;

            case 'assignByAdmin':
                return ['order_assignByAdmin'];
                break;

            case 'cancelByAdmin':
                return ['order_cancelByAdmin'];
                break;

            case 'cancelByUser':
                return ['order_cancelByUser'];
                break;

            case 'CompleteByAdmin':
                return ['order_CompleteByAdmin'];
                break;

            case 'ConfirmByUser':
                return ['order_ConfirmByUser'];
                break;

            case 'cancel':
                return ['order_cancel'];
                break;

            case 'found':
                return ['order_found'];
                break;

            case 'notFound':
                return ['order_notFound'];
                break;
            case 'incoming':
                return ['order_incoming'];
                break;
            case 'reached':
                return ['order_reached'];
                break;
            case 'delivery':
                return ['order_delivery'];
                break;
            case 'notPaid':
                return ['order_notPaid'];
                break;
            case 'toConfirmeCompleteOrder':
                return ['order_toConfirmeCompleteOrder'];
                break;
            case 'toConfirmeCompleteOrderByAdmin':
                return ['order_toConfirmeCompleteOrderByAdmin'];
                break;
        }
        return [];
    }

}



