<?php

namespace Manadinho\FastDebugger;

use WebSocket\Client;
use DOMDocument;

class Fast{
    protected $data = [];
    protected $flag = null;
    protected $meta = '';
    protected $filePath = '';
    protected $lineNumber = '';

    public function __construct(Array $args, $filePath, $lineNumber)
    {
        $debugData = [];
        foreach ($args as $arg) {   
            ob_start();
            dump($arg);
            $debugData[] = $this->generateDebugData(ob_get_clean());
        }
        $this->data = $debugData;
        $this->filePath = $filePath;
        $this->lineNumber = $lineNumber;
    }

    public function flag($flag)
    {
        if(in_array(getType($flag), ['string', 'integer']))
        {
            $this->flag = $flag;
        }
        return $this;
    }

    public function __destruct() {
        $this->send();
    }

    public function send()
    {
        try {
            $client = new Client("ws://127.0.0.1:23518");
            $client->send(json_encode(['logType' => 'laravel', 'flag' => $this->flag, 'meta' => $this->meta, 'data' => $this->data, 'filePath' => $this->filePath, 'lineNumber' => $this->lineNumber]));
        } catch (\Throwable $th) {
            
        }
    }

    private function generateDebugData(String $rawHtml)
    {
        preg_match_all('/<script[^>]*>(.*?)<\/script>/is', $rawHtml, $scripts);
        preg_match_all('/<pre[^>]*>(.*?)<\/pre>/is', $rawHtml, $pres);
        $html = $pres[0][0];
        $doc = new DOMDocument();
        $doc->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $spans = $doc->getElementsByTagName('span');
        foreach ($spans as $span) {
            if (strpos($span->textContent, '// vendor/manadinho/fast-debugger/src/Fast.php') !== false) {
                $span->parentNode->removeChild($span);
            }
        } 
        $modifiedHtml = $doc->saveHTML();
        return $scripts[0][1].$modifiedHtml;
    }
}