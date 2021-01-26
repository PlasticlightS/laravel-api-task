<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function guzzleGet()
    {
        $client = new Client(['base_uri' => 'https://trialapi.craig.mtcdevserver.com/']);

        $request = $client->request('GET', '/api/properties', ['query' => ['api_key' => env('API_KEY'), 'page[size]' => 100]]);
        $response = json_decode($request->getBody()->getContents());

        $currentPage = $response->current_page;
        $lastPage = $response->last_page;

        while ($currentPage < 3) {
            $pageRequest = $client->request('GET', '/api/properties', ['query' => ['api_key' => env('API_KEY'), 'page[number]' => $currentPage, 'page[size]' => 100]]);
            $pageResponse = json_decode($pageRequest->getBody()->getContents());

            $currentPage = ++$pageResponse->current_page;
            dd($pageResponse);
        }
    }
}
