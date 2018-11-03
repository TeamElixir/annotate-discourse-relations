<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AnalyzeRelationshipController extends Controller
{
    public function main(Request $request)
    {
        $sourceSent = $request->sourceSent;
        $targetSent = $request->targetSent;

        $url = "http://206.189.196.14:8080/sentence-feature-extractor/discourse/type";

        $body = '{"source-sent": "' . $sourceSent . '", "target-sent": "' . $targetSent . '"}';
//        $body = json_encode($body, JSON_FORCE_OBJECT);

//        dd($body);

        $client = new Client([
//            'headers' => ['Content-Type' => 'application/json']
            'headers' => ['Content-Type' => 'text/plain']
        ]);
        $response = $client->post($url, ['body' => $body]);

//        $response = json_decode($response->getBody(), true);

        dd($response);

    }

    private function encodeToJSON($sourceSent, $targetSent)
    {
        $data = array();
        $data['source-sent'] = $sourceSent;
        $data['target-sent'] = $targetSent;
        $params[] = $data;
//        $body = json_encode($params);
        $body = json_encode($params, JSON_FORCE_OBJECT);
    }
}
