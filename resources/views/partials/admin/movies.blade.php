@extends('layouts.app')
@section('title', 'Qualis Flow - Dust Table')
@section('content')
<style>
    .thumbnail {
        height: 295px;
        overflow: hidden;
    }
</style>
<div class = "panel">
    <div class = "panel-body container-fluid">
        <div class = "row row-lg">
            <div class = "col-md-12">
                <div class="m-portlet m-portlet--mobile  m-portlet--rounded">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Movies
                                    <div class="alert alert-danger text-left" id="error">
                                        <strong ></strong>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="container">
                            <div class="row">
                                @foreach ($movies as $key => $val)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="/{{$val['slug']}}">
                                            <img src="{{$val['photo']}}" alt="Lights" style="width:100%">
                                            <div class="caption">
                                                <p>{{$val['name']}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
