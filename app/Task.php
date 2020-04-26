<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function shipments()
    {
        return $this->hasMany('App\TaskShipment');
    }

    public function checkCompleteness()
    {
        if ($this->complete) {
            return;
        }

        if ($this->shipments->count() == $this->shipments->where('complete', true)->count()) {
            $this->complete = true;
            $this->save();
        }
    }
}
