@extends('layouts.app')

@isset($property)
    @section('title', 'Edit')
@else
    @section('title', 'Create')
@endif

@section('content')
    <div class="card text-center mt-4">
        <div class="card-header">
            @isset($property)
                {{ $property->address }}
            @else
                Add Property
            @endif
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-primary text-left" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-left">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-sm text-left">
                    <form method="POST" action="@isset($property){{ url("properties/{$property->id}") }} @else {{ url('properties') }} @endisset">
                        @csrf
                        @isset($property)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <label for="county">County</label>
                            <input type="text" class="form-control @error('county') is-invalid @enderror" id="county"
                                   value="@isset($property){{ $property->county }}@endisset"
                                   name="county">
                            @error('county')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                                   value="@isset($property){{ $property->country }}@endisset"
                                   name="country">
                            @error('country')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="town">Town</label>
                            <input type="text" class="form-control @error('town') is-invalid @enderror" id="town"
                                   value="@isset($property){{ $property->town }}@endisset" name="town">
                            @error('town')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                                   id="postcode" value="@isset($property){{ $property->postcode }}@endisset"
                                   name="postcode">
                            @error('postcode')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                      rows="3" name="description">@isset($property){{ $property->description }}@endisset</textarea>
                        </div>
                        {{--<div class="form-group">
                            @isset($property)<img src="{{ $property->image_thumbnail }}">@endif
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image">
                        </div>--}}
                        {{--Should really find max number from db and loop options from that, but running out of time--}}
                        <div class="form-group">
                            <label for="num_bathrooms">Number of Bathrooms</label>
                            <select class="form-control" id="num_bathrooms" name="num_bathrooms">
                                <option @isset($property)@if($property->num_bathrooms === 1) selected @endif @endisset>1</option>
                                <option @isset($property)@if($property->num_bathrooms === 2) selected @endif @endisset>2</option>
                                <option @isset($property)@if($property->num_bathrooms === 3) selected @endif @endisset>3</option>
                                <option @isset($property)@if($property->num_bathrooms === 4) selected @endif @endisset>4</option>
                                <option @isset($property)@if($property->num_bathrooms === 5) selected @endif @endisset>5</option>
                                <option @isset($property)@if($property->num_bathrooms === 6) selected @endif @endisset>6</option>
                                <option @isset($property)@if($property->num_bathrooms === 7) selected @endif @endisset>7</option>
                                <option @isset($property)@if($property->num_bathrooms === 8) selected @endif @endisset>8</option>
                                <option @isset($property)@if($property->num_bathrooms === 9) selected @endif @endisset>9</option>
                                <option @isset($property)@if($property->num_bathrooms === 10) selected @endif @endisset>10</option>
                                <option @isset($property)@if($property->num_bathrooms === 11) selected @endif @endisset>11</option>
                                <option @isset($property)@if($property->num_bathrooms === 12) selected @endif @endisset>12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="num_bedrooms">Number of Bedrooms</label>
                            <select class="form-control" id="num_bedrooms" name="num_bedrooms">
                                <option @isset($property)@if($property->num_bedrooms === 1) selected @endif @endisset>1</option>
                                <option @isset($property)@if($property->num_bedrooms === 2) selected @endif @endisset>2</option>
                                <option @isset($property)@if($property->num_bedrooms === 3) selected @endif @endisset>3</option>
                                <option @isset($property)@if($property->num_bedrooms === 4) selected @endif @endisset>4</option>
                                <option @isset($property)@if($property->num_bedrooms === 5) selected @endif @endisset>5</option>
                                <option @isset($property)@if($property->num_bedrooms === 6) selected @endif @endisset>6</option>
                                <option @isset($property)@if($property->num_bedrooms === 7) selected @endif @endisset>7</option>
                                <option @isset($property)@if($property->num_bedrooms === 8) selected @endif @endisset>8</option>
                                <option @isset($property)@if($property->num_bedrooms === 9) selected @endif @endisset>9</option>
                                <option @isset($property)@if($property->num_bedrooms === 10) selected @endif @endisset>10</option>
                                <option @isset($property)@if($property->num_bedrooms === 11) selected @endif @endisset>11</option>
                                <option @isset($property)@if($property->num_bedrooms === 12) selected @endif @endisset>12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Displayable Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                   value="@isset($property){{ $property->address }}@endisset"
                                   name="address">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                                   value="@isset($property){{ $property->price }}@endisset"
                                   name="price">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="property_type_id">Number of Bedrooms</label>
                            <select class="form-control" id="property_type_id" name="property_type_id">
                                @foreach($propertyTypes as $propertyType)
                                    <option value="{{ $propertyType->id }}" @isset($property)@if($property->property_type_id === $propertyType->id) selected @endif @endisset>{{ $propertyType->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type1" value="sale"
                                   @isset($property)
                                   @if($property->type === 'sale')
                                   checked
                                @endif
                                @endisset>
                            <label class="form-check-label" for="type1">
                                For Sale
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="type2" value="rent"
                                   @isset($property)
                                   @if($property->type === 'sale')
                                   checked
                                @endif
                                @endisset>
                            <label class="form-check-label" for="type2">
                                For Rent
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
