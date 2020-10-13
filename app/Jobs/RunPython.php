<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

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
    public function __construct($a, $b, $script)
    {
        $this->a = $a;
        $this->b = $b;
        $this->script = $script;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->createInput(['a' => $this->a, 'b' => $this->b]);
        $this->callPythonScript();
    }

    public function createInput($input)
    {
        $uniqueName = 'entrada.in';
        Storage::disk('run_python')->put($uniqueName, json_encode($input));
    }

    public function callPythonScript()
    {
        $ruta_entrada = storage_path() . "\\run_python\\entrada.in";
        $res = exec("python {$this->script}.py < {$ruta_entrada}", $arraySalida);
        dump($res);
    }
}
