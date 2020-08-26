<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\KelompokMaster;

class EndDiskusi implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $kelompok_master;
    public function __construct(KelompokMaster $kelompok_master)
    {
        $this->kelompok_master = $kelompok_master;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('endDiskusiChannel.'.$this->kelompok_master->kelas_id);
    }
}
