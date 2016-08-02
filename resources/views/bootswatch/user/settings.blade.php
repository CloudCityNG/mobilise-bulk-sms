@extends('layouts.bootswatch.master')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1>Settings</h1>

            <div class="well clearfix">
                <h4>Notifications</h4>

                <form action="" class="form-horizontal">

                    <fieldset>

                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Send me a low balance alert
                                    </label>
                                </div>

                                <div class="input-group col-lg-6 col-md-6" style="margin-top:10px;">
                                    <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
                                    <div class="input-group-addon">Units</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            
                        </div>


                    </fieldset>

                </form>

            </div>
        </div>
    </div>
@endsection