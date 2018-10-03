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
                                    Add Movies
                                    <div class="alert alert-danger text-center" id="error">
                                        <strong ></strong>
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="container-fluid">
                            <div class="row">
                                <form class="form-horizontal col-md-12" action="/add_movie" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="email">Name:</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="pwd">Description:</label>
                                        <div class="col-md-6"> 
                                            <textarea class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="pwd">Photo:</label>
                                        <div class="col-md-6"> 
                                            <input type="file" id="photo" name="photo"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="email">Ticket Price</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="ticket_price" id="ticket_price" placeholder="Enter Ticket Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="email">Country</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="country" id="ticket_price" placeholder="Enter Country">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-2" for="email">Genre</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="genre" id="genre" placeholder="Enter genre">
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
