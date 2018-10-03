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
                                <h3 class="m-portlet__head-text text-center">
                                    {{$moviesdetails->name}}
                                    <div class="alert alert-danger text-center" id="error">
                                        <strong ></strong>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="container">
                            <div class="row">
                                <img src="{{$moviesdetails->photo}}" class="col-md-12"  style="padding-bottom: 20px;"/>
                                <p class="col-md-12"> <b>Description </b>:  {{$moviesdetails->description}}</p>
                                <p class="col-md-12"><b>Release Date </b>: {{$moviesdetails->release_date}}</p>
                                <p class="col-md-12"><b>Ticket Price </b>: {{$moviesdetails->ticket_price}}</p>
                                <p class="col-md-12"><b>Country </b>: {{$moviesdetails->country}}</p>

                            </div>

                            <div class="row">
                                <!--<p class="text-center col-md-4"><b>Comments</b></p>-->
                                <form class="form-horizontal col-md-12" action="/comments" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="name">Name:</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="pwd">Comments:</label>
                                        <div class="col-md-6"> 
                                            <textarea class="form-control" name="comments" id="description" placeholder="Enter Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Submit</button>
                                        </div>
                                    </div>
                                </form>
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
