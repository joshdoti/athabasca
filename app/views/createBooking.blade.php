@extends('layouts.default')
@section('content')
<?php
    $rec = Session::get('rec',NULL);
    $kits = DB::table('kitType')->lists('kitType');
    $users = DB::table('users')->lists('email');
?>

<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Select a Date Range</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker("option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  $(function() { $("#to" ).datepicker( "option", "dateFormat", "D dd M yy" )});
  $(function() { $("#from" ).datepicker( "option", "dateFormat", "D dd M yy" )});
  $(function() { $( "#from" ).datepicker( "setDate", +4 )});
  $(function() { $( "#to" ).datepicker( "setDate", +4 )});
  if($.datepicker.formatDate('DD', new Date()) == "Saterday"){
  $(function() { $( "#from" ).datepicker( "option", "minDate", "+4d" )});
  $(function() { $( "#to" ).datepicker( "option", "minDate", "+4d" )});
  } else if($.datepicker.formatDate('DD', new Date()) == "Friday"){
  $(function() { $( "#from" ).datepicker( "option", "minDate", "+3d" )});
  $(function() { $( "#to" ).datepicker( "option", "minDate", "+3d" )});
  } else{
  $(function() { $( "#from" ).datepicker( "option", "minDate", "+2d" )});
  $(function() { $( "#to" ).datepicker( "option", "minDate", "+2d" )});
  }
  </script>
  </head>

  <h2 style="color:#79C33A">Create a booking now (All fields are required)</h2>
  {{Form::open(['url' => 'createbooking']) }}

  <?php if(Session::get('errors',NULL)!=NULL): ?>
   <div class="alert alert-warning" role="alert">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    <span class="sr-only">Message:</span>
    {{$errors}}
   </div>
   <?php endif; ?>

  <p>  </p>
  <div class ="row">
  <div class="col-md-4">
    {{Form::label('desKit', 'Select Kit Type: ')}}
    {{Form::select('desKit', $kits,$kit,['class' => 'form-control']) }}
  </div>
  </div>
  <p>  </p>
  <div class ="row">
  <div class="col-md-4">

    {{Form::label('branch', 'Booking Location:  ')}}
    {{Form::select('desBranch', array('ABB'=>'Abbottsfield - Penny McKee Branch', 'CAL'=>'Calder Branch','CPL'=>'Capilano Branch','CSD'=>'Castle Downs Branch','CLV'=>'Clareview Branch','HIG'=>'Highlands Branch','IDY'=>'Idylwylde Branch','JPL'=>'Jasper Place Branch','LHL'=>'Lois Hole Library','LON'=>'Londonderry Branch','MEA'=>'Meadows Branch','MLW'=>'Mill Woods Branch','RIV'=>'Riverbend Branch','SPW'=>'Sprucewood Branch','MNA'=>'Stanley A. Milner Library','STR'=>'Strathcona Branch','WMC'=>'Whitemud Crossing Branch','WOO'=>'Woodcroft Branch'),null,['class' => 'form-control']) }}
  </div>
  </div>
  <p>  </p>

  <div class ="row">
  <div class="col-md-4">
    {{Form::label('eName', 'Event Name:  ')}}
    {{Form::text('eName',null,['class' => 'form-control'])}}
  </div>
  </div>
   <p>  </p>
    <div>
    {{Form::label('start', 'Booking Start Date:  ')}}
    <input type="text" id="from" name="from" readOnly="true">

    {{Form::label('end', '    Booking End Date: ')}}

    <input type="text" id="to" name="to" readOnly="true">
    </div>
    <p>  </p>

    <div class ="row">
    @for($i = 1; $i <= $rec; $i++)
      <div class="col-sm-3">
        {{Form::label($i, 'Additional Recipients: ')}}
        {{Form::select($i, $users, null, ['class' => 'form-control']) }}
      </div>
      @endfor
   </div>
   <p>  </p>
   <div>
   <input type="submit" name="add"  value="Add Another Recipients">
   <input type="submit" name="remove"  value="Remove the last Recipient">
   </div>
   <p>  </p>
   <div>
   <input type="submit" name="create"  value="Create Booking" class = "createbook">
   {{Form::close()}}
   </div>
   </div>

</div>
@stop
