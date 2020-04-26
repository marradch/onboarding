<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TaskShipment extends Model
{
    protected $table = 'tasks_shipments';

    public function checkGiveOutAbility()
    {
        if (!$this->is_for_give_out) {
            return false;
        }

        $getItem = TaskShipment::where('shipment_id', $this->shipment_id)
            ->where('is_for_give_out', false)
            ->where('complete', true)
            ->first();

        if (!$getItem) {
            return false;
        }

        return true;
    }

    public function processGiveOut()
    {
        $shipmentCost = $this->shipment->cost;

        $user = User::find($this->task->user_id);
        $user->balance += $shipmentCost;
        $user->save();

        $transaction = new Transaction();
        $transaction->user_to = $this->task->user_id;
        $transaction->amount = $shipmentCost;
        $transaction->rest = $user->balance;
        $transaction->save();

        $this->complete = true;
        $this->save();
    }

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function shipment()
    {
        return $this->belongsTo('App\Shipment');
    }
}
