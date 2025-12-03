<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LocationController extends Controller
{
    public function getLocation(Request $request)
    {
        // Get the user's IP address
        $ip = $request->ip(); // This works in most cases, use '123.456.789.123' for testing in local environments

        // If working locally or behind a proxy, you can set a default IP for testing:
        // $ip = '8.8.8.8'; // Google's public DNS server IP for example

        // Use Guzzle HTTP client to call the API
        $client = new Client();
        $response = $client->get('http://api.ipstack.com/' . $ip . '?access_key=a2d1f5a9921c1bf39c5418f95760c01a');

        // Decode the JSON response
        $locationData = json_decode($response->getBody()->getContents());

        return response()->json($locationData);
    }
}
