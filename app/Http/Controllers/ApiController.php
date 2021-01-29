<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyType;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    /* Went with Guzzle as I've used it before. With more time would have used Laravel built in functionality */
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function apiImport()
    {
        $client = new Client(['base_uri' => 'https://trialapi.craig.mtcdevserver.com/']);

        $request = $client->request('GET', '/api/properties', ['query' => ['api_key' => env('API_KEY'), 'page[size]' => 100]]);
        $response = json_decode($request->getBody()->getContents());

        $currentPage = $response->current_page;
        $lastPage = $response->last_page;

        while ($currentPage < $lastPage) {
            $pageRequest = $client->request('GET', '/api/properties', ['query' => ['api_key' => env('API_KEY'), 'page[number]' => $currentPage, 'page[size]' => 100]]);
            $pageResponse = json_decode($pageRequest->getBody()->getContents());

            $currentPage = ++$pageResponse->current_page;
            $properties = $pageResponse->data;

            foreach ($properties as $propertyData) {
                $propertyType = PropertyType::find($propertyData->property_type_id);

                if (empty($propertyType)) {
                    $propertyType = new PropertyType;

                    $propertyType->id = $propertyData->property_type->id;
                    $propertyType->title = $propertyData->property_type->title;
                    $propertyType->description = $propertyData->property_type->description;

                    $propertyType->save();
                }

                $property = Property::firstOrNew(['uuid' => $propertyData->uuid]);

                $property->county = $propertyData->county;
                $property->country = $propertyData->country;
                $property->town = $propertyData->town;
                $property->description = $propertyData->description;
                $property->address = $propertyData->address;
                $property->image_full = $propertyData->image_full;
                $property->image_thumbnail = $propertyData->image_thumbnail;
                $property->latitude = $propertyData->latitude;
                $property->longitude = $propertyData->longitude;
                $property->num_bedrooms = $propertyData->num_bedrooms;
                $property->num_bathrooms = $propertyData->num_bathrooms;
                $property->price = $propertyData->price;
                $property->type = $propertyData->type;
                $property->property_type_id = $propertyData->property_type_id;

                $property->save();
            }
        }

        return redirect('/')->with('status', 'API Data Imported');
    }
}
