<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::paginate(15);

        return view('property.index')
            ->with('properties', $properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $propertyTypes = PropertyType::all();

        return view('property.edit')
            ->with('propertyTypes', $propertyTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProperty = $request->validate([
            'county' => 'required',
            'country' => 'required',
            'town' => 'required',
            'postcode' => 'nullable',
            'description' => 'required',
            'address' => 'required',
            'num_bedrooms' => 'required|integer',
            'num_bathrooms' => 'required|integer',
            'price' => 'required|integer',
            'type' => 'required',
            'property_type_id' => 'required|integer',
        ]);

        $property = new Property;

        $property->county = $newProperty['county'];
        $property->country = $newProperty['country'];
        $property->town = $newProperty['town'];
        $property->postcode = $newProperty['postcode'];
        $property->description = $newProperty['description'];
        $property->address = $newProperty['address'];
        $property->num_bedrooms = $newProperty['num_bedrooms'];
        $property->num_bathrooms = $newProperty['num_bathrooms'];
        $property->price = $newProperty['price'];
        $property->type = $newProperty['type'];
        $property->property_type_id = $newProperty['property_type_id'];

        $property->save();

        return redirect("properties/{$property->id}/edit")->with('status', 'Property Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $propertyTypes = PropertyType::all();

        return view('property.edit')
            ->with('property', $property)
            ->with('propertyTypes', $propertyTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Property $property)
    {
        $updatedProperty = $request->validate([
            'county' => 'required',
            'country' => 'required',
            'town' => 'required',
            'postcode' => 'nullable',
            'description' => 'required',
            'address' => 'required',
            'num_bedrooms' => 'required|integer',
            'num_bathrooms' => 'required|integer',
            'price' => 'required|integer',
            'type' => 'required',
            'property_type_id' => 'required|integer',
        ]);

        $property->county = $updatedProperty['county'];
        $property->country = $updatedProperty['country'];
        $property->town = $updatedProperty['town'];
        $property->postcode = $updatedProperty['postcode'];
        $property->description = $updatedProperty['description'];
        $property->address = $updatedProperty['address'];
        $property->num_bedrooms = $updatedProperty['num_bedrooms'];
        $property->num_bathrooms = $updatedProperty['num_bathrooms'];
        $property->price = $updatedProperty['price'];
        $property->type = $updatedProperty['type'];
        $property->property_type_id = $updatedProperty['property_type_id'];

        $property->save();

        return redirect("properties/{$property->id}/edit")->with('status', 'Property Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect('/')->with('status', 'Property Deleted');
    }
}
