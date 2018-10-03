
@extends('layouts.app')
@section('title', 'Qualis Flow - Realtime Management Dashboard ')
@section('content')
<div class="m-portlet m-portlet--mobile  m-portlet--rounded" style="width: 100%;">
    <div class="m-portlet__head" style="width: 100%;">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Dashboard
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            @if(session('message'))
            {{session('message')}}
            @endif
            <form class="form-inline" method="POST" enctype="multipart/form-data" action="{{ URL::to('importexcel') }}">
                <div class="form-group">
                    <label>File:</label>
                    <input type="file" style="padding-left: 15px;" name="file" id="file">
                </div>
                <button class="btn btn-success" type="submit">Add</button>                                                                                                                                         
            </form>
        </div>
    </div>
    <div class = "col-md-12">
        <canvas id = "myChart" width = "800" height = "400"></canvas>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add</h4>
            </div>


            <form method="POST" enctype="multipart/form-data" action="{{ URL::to('importexcel') }}">
                <div class="modal-body">
                    <div class="form-group clearfix pull-in">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>File:</strong>
                                <input type="file" name="file" id="file">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button"  data-dismiss="modal">Close</button>    
                    <button class="btn btn-success" type="submit">Add</button>                                                                                                                                         
                </div>

            </form>


        </div>
    </div>
</div>

@endsection
