<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AnalyzeRelationshipController extends Controller
{

    private $mappings = [
        1 => 'No Relation',
        2 => 'Elaboration',
        3 => 'Redundancy',
        4 => 'Citation',
        5 => 'Shift-in-View'
    ];

    public function main(Request $request)
    {
        $sourceSent = $request->sourceSent;
        $targetSent = $request->targetSent;

        $url = "http://206.189.196.14:8080/sentence-feature-extractor/discourse/type";

        $body = '{"source-sent": "' . $sourceSent . '", "target-sent": "' . $targetSent . '"}';

        $client = new Client([
            'headers' => ['Content-Type' => 'text/plain']
        ]);
        $response = $client->post($url, ['body' => $body]);

        $response = json_decode($response->getBody(), true);
        $relationshipKey = $response['type'];

        $mapping = $this->mappings[$relationshipKey];

        return view('analyse-discourse-relationship-result', [
            'sourceSent' => $sourceSent,
            'targetSent' => $targetSent,
            'mapping' => $mapping
        ]);
    }

    public function ajax(Request $request)
    {
        $source_sentence = $request->source_sentence;
        $target_sentence = $request->target_sentence;

        $url = "http://206.189.196.14:8080/sentence-feature-extractor/discourse/type";

        $body = '{"source-sent": "' . $source_sentence . '", "target-sent": "' . $target_sentence . '"}';

        $client = new Client([
            'headers' => ['Content-Type' => 'text/plain']
        ]);
        $response = $client->post($url, ['body' => $body]);

        $response = json_decode($response->getBody(), true);
        $relationshipKey = $response['type'];

        $mapping = $this->mappings[$relationshipKey];

        echo $mapping;
    }
}
