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

class StartDiskusi implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $kelompok_master;

    public function __construct(KelompokMaster $kelompok_master)
    {
        $this->kelompok_master = $kelompok_master;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return ['start-diskusi'];
        // hanya akan diterima oleh anggota kelas dari kelompok master yang dipilih
        return new PrivateChannel('kelas.'.$this->kelompok_master->kelas_id); 


         //call your name channel from env
        //  return config('test.channel');
    }
}
