<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RunPython implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;
    public $param1;
    public $param2;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path, $objeto, $param2, User $user)
    {
        $this->path = $path;
        $this->objeto_id = $objeto->id;
        $this->param2 = $param2;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$objeto = ClaseObjeto::getInstanceById($this->objeto_id);
        //Mail::send(....);
        //file_put_contents($this->path, $body);
    }
}
