@extends('layouts.app')

@section('title', 'meal list filter')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><b>Filter</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ action('FilterController@filter') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="perPage" class="col-md-3 col-form-label"><b> Meals per page: </b></label>

                            <div class="col-md-6">
                                <input id="perPage" type="number" class="form-control" name="perPage" min="1" max="200">
                            </div>
                        </div>
                        <br>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="lang"><b>Choose a language: </b></label>
                                <select id="lang" name="lang" class="form-controll">
                                    @foreach($languages as $language)
                                        <option value="{{ $language->slug }}">{{ $language->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <br>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection