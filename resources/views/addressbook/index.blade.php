@extends('layouts._master')

@section('content')

<div class="module">
    <div class="module-head"><h3>Addressbook</h3></div>
        <div class="module-body clearfix">

                <ul class="nav nav-tabs" id="myTab">
                  <li class="active"><a href="#home" data-target="home">Home</a></li>
                  <li><a href="#manageContacts" data-target="manageContacts">Manage Contacts</a></li>
                  <li><a href="#importContacts">Import Contacts</a></li>
                  <li><a href="#manageGroups">Manage Groups</a></li>
                </ul>

                <div class="tab-content clearfix">
                  <div class="tab-pane active" id="home" data-toggle="tab">home content here</div>
                  <div class="tab-pane" id="manageContacts" data-toggle="tab">

                    <div class="alert-message"></div>

                    <div class="well form-inline">
                        <input type="text" id="search" class="input-medium" placeholder="Search...">
                        <button type="button" class="btn" id="searchFilter">Filter</button>

                        <a href="#contactModal" role="button" class="btn btn-primary" data-toggle="modal" id="newContact">New Contact</a>

                        <button type="button" class="btn btn-danger" id="newContact">Delete All</button>

                        <div class="pull-right">
                        <div class="label">Export to</div>
                            <button type="button" class="btn">Excel</button>
                            <button type="button" class="btn">CSV</button>
                        </div>

                    </div>
                    <table class="table" id="contacts-table">
                        <tbody>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>GSM</th>
                                <th>Operation</th>
                            </tr>
                            <tr>
                                <td>Adebayo</td>
                                <td>Tamuno</td>
                                <td>adebayo@gmail.com</td>
                                <td>08188697770</td>
                                <td>
                                    <div class="btn-group">
                                      <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                        Operation
                                        <span class="caret"></span>
                                      </a>
                                      <ul class="dropdown-menu">
                                        <li><a href="#">Edit</a></li>
                                        <li><a href="#">Delete</a></li>
                                      </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                  </div>
                  <div class="tab-pane" id="importContacts" data-toggle="tab">messages content here</div>

                  <!-- Group stuffs here -->
                  <div class="tab-pane" id="manageGroups" data-toggle="tab">
                    <div class="well form-inline">
                        <a href="#groupModal" role="button" class="btn btn-small btn-primary" data-toggle="modal" id="newgroup">New Group</a>
                    </div>
                    <div class="span6">
                        <table id="groupTable" class="table table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th>Group Name</th>
                                    <th>Action</th>
                                </tr>
                                @foreach( $data as $d )
                                <tr>
                                    <td>{{$d->group_name}}</td>
                                    <td>{{$d->id}}</td>
                                </tr>
                                @endforeach
                            </thead>
                        </table>
                        <?php echo $data->render(); ?>
                    </div>
                  </div>
                </div>

        </div>
</div>
@stop


@section('head')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link type="text/css" href="/css/bootstrap/bootstrap-datepicker.min.css" rel="stylesheet">
<link type="text/css" href="/css/datatables/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('foot')
@parent
<script src="/js/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="/js/bootstrap/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
    //databale for groups

    $('#contacts-table').dataTable();

    $('#groupTable_length select').addClass('span1');

    $('button#newContactSubmit').click(function(){
        //disable submit button
        $('form#newContact').submit();
    });
    $('button#newGroupSubmit').click(function(){
        //diisable submit button
        $('form#newGroup').submit();

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('form#newGroup').on('submit', function(event){
        event.preventDefault();
        alert($('form#newGroup').serialize());
        var jqXHR = $.get("address-book/new-group", $('form#newGroup').serialize());
        jqXHR.done(function(data){
            alert('pass ' + data);
        });
        jqXHR.fail(function(data){
            alert('fail '+data);
        });
        getGroup();
    });

    $('form#newContact').on("submit", function(event){
        event.preventDefault();
        var jqxhr = $.post("address-book/new", $('#newContact').serialize());

        jqxhr.done(function(data){
            alert('done');
            resetForm("form#newContact");
            closeModal();
            alert_('success', "Contact Added successfully.");
        });

        jqxhr.fail(function(data){
            var error = $.parseJSON(data.responseText);
            $('.errors #error-ul').empty();
            $('.errors').show();
            $.each(error, function(idx, el){
                //el is an array. run through it
               $.each(el, function(idx1, el1){
                    //try to split the errors response with a comma
                    var out = el1.split(",");

                    //if an array is returned, then there is more than one error for the index. spit all out
                    if ( $.isArray(out) ) {

                        $.each(out, function(index, element){
                            $('.errors #error-ul').append(
                                "<li>" + element + "</li>"
                            );
                        });
                    } else {
                    //else its just one error returned for the associated index. show it
                        $('.errors #error-ul').append(
                            "<li>" + el + "</li>"
                        );

                    }
               });
            });
//            $.each(data.responseText, function(index, element) {
//                console.log(index)
//            })
        });

        jqxhr.always(function(data){
            alert('always');
        });
    });


});
//function to refresh group table
function getGroup()
{
    var jqXHR = $.get('address-book/get-group');
    jqXHR.done(function(data){
        console.log(data)
    });
}

//reset the modal form
function resetForm(formID){
    $(formID).trigger("reset");
}

//close the modal
function closeModal()
{
    $('#contactModal').modal('hide')
}

//javascript alert
function alert_(alertType, msg) {
    obj = $('div.alert-message');
    obj.empty();
    obj.append(
        '<div class="alert alert-'+ alertType +'">' +
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        msg +
        '</div>'
    );

}

$('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
$('input#birthdate').datepicker({
    format: "yyyy/mm/dd",
    startView: 2,
    autoclose: true,
    orientation: "top auto"
});


// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
}

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})

</script>
@stop


@section('modal')
<!-- Button to trigger modal -->

<!-- Contact Modal -->
<div id="groupModal" class="modal hide fade clearfix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">New Group</h3>
  </div>
  <div class="modal-body">
    <form id="newGroup" class="form-horizontal">
    <div class="errors" style="display:none;">
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4>Form Errors!</h4>
          <ul id="error-ul"></ul>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="control-group">
        <label class="control-label" for="GSM">Group Name*</label>
        <div class="controls">
          <input type="text" name="group_name" id="group_name" placeholder="Group Name">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="email">Group Description</label>
        <div class="controls">
          <input type="text" name="group_description" id="group_description" placeholder="Group Description">
        </div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button id="newGroupSubmit" class="btn btn-primary">Save</button>
  </div>
</div>

<!-- Contact Modal -->
<div id="contactModal" class="modal hide fade clearfix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">New Contact</h3>
  </div>
  <div class="modal-body">
    <form id="newContact" class="form-horizontal">
    <div class="errors" style="display:none;">
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4>Form Errors!</h4>
          <ul id="error-ul"></ul>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="control-group">
        <label class="control-label" for="GSM">GSM*</label>
        <div class="controls">
          <input type="text" name="gsm" id="GSM" placeholder="GSM">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
          <input type="text" name="email" id="email" placeholder="Email">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="firstame">FirstName</label>
        <div class="controls">
          <input type="text" name="firstname" id="firstname" placeholder="FirstName">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="lastname">LastName</label>
        <div class="controls">
          <input type="text" name="lastname" id="lastname" placeholder="LastName">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="street">Street</label>
        <div class="controls">
          <input type="text" name="street" id="street" placeholder="Street">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="region">Region</label>
        <div class="controls">
          <input type="text" name="region" id="region" placeholder="Region">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="postcode">PostCode</label>
        <div class="controls">
          <input type="text" name="postcode" id="postcode" placeholder="PostCode">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="birthdate">BirthDate</label>
        <div class="controls">
          <input type="text" name="birthdate" id="birthdate" placeholder="Birthdate">
        </div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button id="newContactSubmit" class="btn btn-primary">Save</button>
  </div>
</div>
@stop