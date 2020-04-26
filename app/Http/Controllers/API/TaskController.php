<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Allow user to report about task shipment complete
     *
     * @return
     */
    public function report(Request $request, Task $task)
    {
        if($task->user_id != Auth::id()) {
            return response('You have not permission report current task', 403);
        }

        if ($request->get_items) {
            $task->shipments()
                   ->whereIn('id', $request->get_items)
                   ->where('is_for_give_out', false)
                   ->update(['complete' => true]);
        }

        if ($request->give_out_items) {
            foreach ($request->give_out_items as $itemId) {
                $taskShipment = $task->shipments()
                    ->where('id', $itemId)
                    ->where('is_for_give_out', true)
                    ->where('complete', false)
                    ->first();

                if($taskShipment && $taskShipment->checkGiveOutAbility()) {
                    $taskShipment->processGiveOut();
                }
            }
        }

        if ($request->get_items || $request->give_out_items) {
            $task->checkCompleteness();
        }

        return response('Task successfully reported');
    }
}
