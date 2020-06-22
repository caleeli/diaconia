#!/usr/bin/env php
<?php
function get_php_coverage() {
    $coverage = new DomDocument();
    $coverage->loadHTMLFile('coverage/index.html', LIBXML_NOERROR);
    $xpath = new DOMXpath($coverage);
    $percentage = $xpath->query('/html/body/div/div/table/tbody/tr[1]/td[3]/div')->item(0);
    return $percentage ? $percentage->nodeValue : 'ERROR';
}
$coverage = get_php_coverage();
echo "Cobertura código PHP: **{$coverage}**\n";

function get_js_coverage() {
    $coverage = new DomDocument();
    $coverage->loadHTMLFile('coverage/lcov-report/index.html', LIBXML_NOERROR);
    $xpath = new DOMXpath($coverage);
    $percentage = $xpath->query('/html/body/div[1]/div[1]/div/div[1]/span')->item(0);
    return $percentage ? trim($percentage->nodeValue) : 'error';
}
$coverage = get_js_coverage();
echo "Cobertura código JS: **{$coverage}**\n";
