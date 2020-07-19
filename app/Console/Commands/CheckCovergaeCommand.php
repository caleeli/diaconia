<?php

namespace App\Console\Commands;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Console\Command;

/**
 * @codeCoverageIgnore
 */
class CheckCovergaeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:check-coverage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $coverage1 = $this->get_php_coverage();
        $this->info("Cobertura código PHP: **{$coverage1}**");
        $coverage2 = $this->get_js_coverage();
        $this->info("Cobertura código JS: **{$coverage2}**");
        if ($coverage1 !== '100.00%' || $coverage2 !== '100.00%') {
            $this->info("\nCompletar la cobertura de\n----");
            $this->getIncompleteCoveragePHP('coverage/index.html');
            $this->getIncompleteCoverageJS('coverage/lcov-report/index.html');
        }
    }

    private function getIncompleteCoveragePHP($file)
    {
        if (!file_exists($file)) {
            return;
        }
        $coverage = new DOMDocument();
        $coverage->loadHTMLFile($file, LIBXML_NOERROR);
        $xpath = new DOMXPath($coverage);
        $percentages = $xpath->query('/html/body/div/div/table/tbody/tr/td[3]');
        $names = $xpath->query('/html/body/div/div/table/tbody/tr/td[1]');
        foreach ($percentages as $index => $p) {
            $nameTd = $names->item($index);
            $value = trim($p->textContent);
            $floatValue = floatval($value);
            if ($value !=='n/a' && $this->isFile($nameTd) && $floatValue < 100) {
                $name = 'app/' . substr($file, 9, -10) . trim($nameTd->textContent);
                $this->info("$name -> $value");
            } elseif ($this->isDir($nameTd)) {
                $next = substr($file, 0, -10) . $this->getLink($nameTd);
                $this->getIncompleteCoveragePHP($next);
            }
        }
    }

    private function getIncompleteCoverageJS($file)
    {
        if (!file_exists($file)) {
            return;
        }
        $coverage = new DOMDocument();
        $coverage->loadHTMLFile($file, LIBXML_NOERROR);
        $xpath = new DOMXPath($coverage);
        $percentages = $xpath->query('/html/body/div[1]/div[3]/table/tbody/tr/td[3]');
        $names = $xpath->query('/html/body/div[1]/div[3]/table/tbody/tr/td[1]');
        foreach ($percentages as $index => $p) {
            $nameTd = $names->item($index);
            $value = trim($p->textContent);
            $floatValue = floatval($value);
            if ($value !=='n/a' && strpos($nameTd->textContent, '.') !== false && $floatValue < 100) {
                $name = 'resources/' . substr($file, 21, -10) . trim($nameTd->textContent);
                $this->info("$name -> $value");
            }
            $next = substr($file, 0, -10) . $this->getLink($nameTd);
            $this->getIncompleteCoverageJS($next);
        }
    }

    private function isFile(DOMElement $td)
    {
        return strpos($td->ownerDocument->saveHTML($td), 'file-code') !== false;
    }

    private function isDir(DOMElement $td)
    {
        return strpos($td->ownerDocument->saveHTML($td), 'file-directory') !== false;
    }

    private function getLink(DOMElement $td)
    {
        return $td->getElementsByTagName('a')->item(0)->getAttribute('href');
    }

    public function get_php_coverage()
    {
        $coverage = new DOMDocument();
        $coverage->loadHTMLFile('coverage/index.html', LIBXML_NOERROR);
        $xpath = new DOMXPath($coverage);
        $percentage = $xpath->query('/html/body/div/div/table/tbody/tr[1]/td[3]/div')->item(0);
        return $percentage ? number_format(floatval($percentage->nodeValue), 2) . '%' : 'ERROR';
    }

    public function get_js_coverage()
    {
        $coverage = new DomDocument();
        $coverage->loadHTMLFile('coverage/lcov-report/index.html', LIBXML_NOERROR);
        $xpath = new DOMXpath($coverage);
        $percentage = $xpath->query('/html/body/div[1]/div[1]/div/div[1]/span')->item(0);
        return $percentage ? number_format(floatval(trim($percentage->nodeValue)), 2) . '%' : 'ERROR';
    }
}
