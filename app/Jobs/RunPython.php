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

    public $script;
    public $inputs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($script, ...$inputs)
    {
        $this->script = Storage::disk('python_scripts')->path($script);
        $this->inputs = $inputs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->createInput($this->inputs);
        $res = $this->callPythonScript();
        return $res;
    }

    private function createInput(array $inputs)
    {
        $uniqueName = 'entrada.in';
        $content = array_reduce($inputs, function ($content, $item) {
            return $content . json_encode($item) . "\n";
        }, '');
        Storage::disk('run_python')->put($uniqueName, $content);
    }

    private function callPythonScript()
    {
        $ruta_entrada = Storage::disk('run_python')->path('entrada.in');
        $res = exec("python {$this->script}.py < {$ruta_entrada}", $arraySalida);
        return json_decode($res);
    }
}
