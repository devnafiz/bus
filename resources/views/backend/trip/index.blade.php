@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
         <button type="button" class="icon-btn ml-1 editBtn"
                                                data-toggle="modal" data-target="#addModal"
                                                
                                              
                                                data-original-title="@lang('Update')">
                                            <i class="la la-pen"></i> Add trip
                                        </button>
              
       </div>
       <br>
       <div class="pull-left">

         <form action="{{route('admin.fleet.vehicles.search') }}" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
        <div class="input-group has_append  ">
            <input type="text" name="search" class="form-control" placeholder="@lang('Reg. No.')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
           
       </div>

        <table class="table table-dark table-hover table-bordered">
        	<thead>
        		<tr>
	        		<th>@lang('Title')</th>
                    <th>@lang('AC / Non-AC')</th>
                    <th>@lang('Day Off')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>
        		</tr>

        	</thead>
        	<tbody>
        		 @forelse($trips as $k=>$item)
        		<tr>
        			<td>{{__( $item->title)}}</td>
        			<td>{{ __($item->fleetType->has_ac =1 ? 'Ac' :'no ac') }}</td>
                    <td>{{ __($item->day_off) }}</td>
                   
                    
                  
        			<td></td>
        		</tr>
        		 @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
        		@endforelse

        	</tbody>
 
         </table>


         <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Add Trip')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.trip.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Title')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Title')" name="title" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Fleet Type')</label>
                            <select name="fleet_type" class="select2-basic fleet_type1 form-control" required>
                                <option value="">@lang('Select an option')</option>
                                @foreach ($fleetTypes as $item)
                                    <option value="{{ $item->id }}" data-name="{{$item->name}}">{{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Route')</label>
                            <select name="route" class="select2-basic route1 form-control" required>
                                <option value="">@lang('Select an option')</option>
                                @foreach ($routes as $item)
                                    <option value="{{ $item->id }}"  data-name="{{$item->name}}">{{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Schedule')</label>
                            <select name="schedule" class=" form-control select2-basic schedule1" required>
                                <option value="">@lang('Select an option')</option>
                                @foreach ($schedules as $item)
                                    <option value="{{ $item->id }}" data-name="{{ showDateTime($item->start_from, 'h:i a').' - '. showDateTime($item->end_to, 'h:i a') }}">{{ __(showDateTime($item->start_from, 'h:i a').' - '. showDateTime($item->end_to, 'h:i a')) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Start From')</label>
                            <select name="start_from" class="select2-basic start_form1 form-control" required>
                                <option value="">@lang('Select an option')</option>
                                @foreach ($stoppages as $item)
                                    <option value="{{ $item->id }}" data-name="{{$item->name}}">{{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('End To')</label>
                            <select name="end_to" class="select2-basic end_to1 form-control" required>
                                <option value="">@lang('Select an option')</option>
                                @foreach ($stoppages as $item)
                                    <option value="{{ $item->id }}" data-name="{{$item->name}}">{{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold" for="day_off">@lang('Day Off')</label>
                            <select class="select2-basic form-control js-example-basic-multiple" name="day_off[]" id="day_off"  multiple="multiple" required>
                                <option value="0">@lang('Sunday')</option>
                                <option value="1">@lang('Monday')</option>
                                <option value="2">@lang('Tuesday')</option>
                                <option value="3">@lang('Wednesday')</option>
                                <option value="4">@lang('Thursday')</option>
                                <option value="5">@lang('Friday')</option>
                                <option value="6">@lang('Saturday')</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/clock-picker.min.css') }}"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/nice-select.css') }}">      

<script src="{{ asset('js/clock-picker.min.js') }}"></script>    
    <script type="text/javascript">
        <script src="{{ asset('js/select.min.js') }}"></script>    
    <script type="text/javascript">


jQuery(function($) {    
    $('.clockpicker').clockpicker({
    placement: 'top',
    align: 'left',
    donetext: 'Done'
  });
});

function makeTitle(modalName){
                var modal = $('#'+ modalName);
                var data1 = modal.find('select[name="fleet_type"]').find("option:selected").data('name');
                var data2 = modal.find('select[name="start_from"]').find("option:selected").data('name');
                var data3 = modal.find('select[name="end_to"]').find("option:selected").data('name');
                var data  = [];
                var title = '';
                if(data1 != undefined){
                    data.push(data1);
                }
                if(data2 != undefined)
                    data.push(data2);
                if(data3 != undefined)
                    data.push(data3);
                if(data1 != undefined && data2 != undefined && data3 != undefined) {
                    var fleet_type_id = modal.find('select[name="fleet_type"]').val();
                    var vehicle_route_id = modal.find('select[name="route"]').val();

                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.trip.ticket.check_price') }}",
                        data: {
                            "fleet_type_id" : fleet_type_id,
                            "vehicle_route_id" : vehicle_route_id
                        },
                        success: function (response) {
                            if(response.error){
                                modal.find('input').val('');
                                modal.find('select').val('').trigger('change');
                                modal.modal('hide');
                                var alertModal = $('#alertModal');
                                alertModal.find('.container-fluid').text(response.error);
                                alertModal.modal('show');
                            }
                        }
                    });
                }

                $.each(data, function (index, value) {
                    if(index > 0){
                        if(index > 3)
                            title += ' to ';
                        else
                            title += ' - ';
                    }
                    title += value;
                });
                $('input[name="title"]').val(title);
            }

$(document).ready(function() {
    $('.select2-basic').select2();
});

</script>
   
@endsection