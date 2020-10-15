<?php

namespace Tests\Feature;

use App\Jobs\RunPython;
use Tests\TestCase;

class RunPythonTest extends TestCase
{
    /**
     * Run python sychronously.
     *
     * @return void
     */
    public function test_run_python_sychronously()
    {
        $sum = RunPython::dispatchNow('example', 1, 2);
        $this->assertEquals(3, $sum);

        $sum = RunPython::dispatchNow('example', 1, 2, 3);
        $this->assertEquals(6, $sum);
    }
}
