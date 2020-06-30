@extends('layouts.app')

@section('title', 'meal list')

@section('content')
@if(!isset($lang) || $lang == 'en')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Meal list </h3><br>
                    <a class="btn btn-primary" href="{{ action('FilterController@getFilters') }}">
                        <i class="fa fa-btn fa-plus"></i> 
                        Filter meals
                    </a>
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            <ul>						
                                <li>{{ $error }}</li>
                            </ul>
                        </div>
                        @endforeach
                    @endif
                </div>
                <br>
                <div class="panel-body">
                    <table class = "table table-striped">
                        <tr><th>Name</th><th>Ingredients</th><th>Description</th><th>Tags</th><th>Category</th></tr>
                        @foreach($meals as $meal)
                            <tr><td><b>{{ $meal->title }}</b></td>
                                <td> 
                                    @foreach($meal->ingredients as $ingr)                                                                                       
                                    <span class="badge badge-light">
                                        {{ $ingr->title }}
                                    </span>
                                    @endforeach
                                </td>
                                <td>{{ $meal->description }}</td>
                                <td>
                                    @foreach($meal->tags as $tag)                                                                 
                                    <span class="badge badge-success">
                                        {{ $tag->title }}
                                    </span>
                                    @endforeach                                          
                                </td>
                                @if($meal->category != null)
                                    <td><span class="badge badge-danger">{{ $meal->category->title }}</span></td>
                                @else
                                        <td><b>No Category</b></td>
                                @endif  
                            </tr>
                        @endforeach
                    </table>
                    @if($meals instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{ $meals->withQueryString()->links() }}
                    @endif  
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Meal list </h3><br>
                    <a class="btn btn-primary" href="{{ action('FilterController@getFilters') }}">
                        <i class="fa fa-btn fa-plus"></i> 
                        Filter meals
                    </a>
                </div>
                <br>
                <div class="panel-body">
                    <table class = "table table-striped">
                        <tr><th>Name</th><th>Ingredients</th><th>Description</th><th>Tags</th><th>Category</th></tr>
                        @foreach($meals as $meal)
                            <tr><td><b>{{ $meal->title }}</b></td>
                                <td> 
                                    @foreach($meal->ingredients as $ingr)
                                        @for($i = 0; $i < count($ingredients); $i++)
                                            @if($ingr->id == $ingredients[$i]->iId)                                                                                       
                                                <span class="badge badge-light">
                                                    {{ $ingredients[$i]->iTitle }}
                                                </span>
                                            @endif
                                        @endfor
                                    @endforeach
                                </td>
                                <td>{{ $meal->description }}</td>
                                <td>
                                @foreach($meal->tags as $tg)
                                        @for($i = 0; $i < count($tags); $i++)
                                            @if($tg->id == $tags[$i]->tId)                                                                                       
                                                <span class="badge badge-light">
                                                    {{ $tags[$i]->tTitle }}
                                                </span>
                                            @endif
                                        @endfor
                                    @endforeach                                         
                                </td>
                                @if($meal->category_id != null)
                                    @foreach($categories as $cat)
                                        @if($meal->category_id == $cat->cId)
                                            <td><span class="badge badge-danger">{{ $cat->cTitle }}</span></td>
                                            @endif
                                    @endforeach
                                @else
                                    @if(!isset($lang) && $lang == 'fr')
                                        <td><b>Aucune catégorie</b></td>
                                    @elseif($lang == 'de')
                                        <td><b>Keine Kategorie</b></td>
                                    @endif
                                @endif  
                            </tr>
                        @endforeach
                    </table>
                    @if($meals instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{ $meals->withQueryString()->links() }}
                    @endif                    
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

