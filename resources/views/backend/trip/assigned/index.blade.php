@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	   <button type="button" class="icon-btn ml-1 editBtn"
                                                data-toggle="modal" data-target="#addModal"
                                                
                                              
                                                data-original-title="@lang('Update')">
                                            <i class="la la-pen"></i> Add assigned vehicale
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
	        		<th>@lang('ID')</th>
	                <th>@lang('Trip')</th>
                    <th>@lang('Vehicle Name')</th>
                    <th>@lang('Reg. No')</th>
                    <th>@lang('status')</th>
                    <th>@lang('Action')</th>
        		</tr>

        	</thead>
        	<tbody>
        		 @forelse($assignedVehicles as $k=>$item)
        		<tr>
        			<td>{{__( $k+1)}}</td>
        			<td>{{ __($item->trip->title) }}</td>
                    <td>{{ __($item->vehicle->nick_name) }}</td>
                    <td>{{__($item->vehicle->register_no)}}</td>
                    <td>  @if($item->status == 1)
                                        <span class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                        @else
                                        <span class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                        @endif</td>
                    
                  
        			<td></td>
        		</tr>
        		 @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
        		@endforelse

        	</tbody>
 
         </table>


         {{-- Add METHOD MODAL --}}
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Assign Vehicle')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.trip.vehicle.assign')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Trip')</label>
                            <div class="input-group">
                                <select class="select2-basic form-control tirp" name="trip" >
                                    <option value="">@lang('Select an option')</option>
                                    @foreach ($trips as $item)
                                        <option value="{{ $item->id }}" data-vehicles="{{ $item->fleetType->activeVehicles }}">{{ __($item->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Vehicle')</label>
                            <select class="select2-basic form-control" name="vehicle">
                                <option value="">@lang('Select an option')</option>
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

<script src="{{ asset('js/clock-picker.min.js') }}"></script>    
    <script type="text/javascript">


jQuery(function($) {    
    $('.clockpicker').clockpicker({
    placement: 'top',
    align: 'left',
    donetext: 'Done'
  });
});
$(document).on('change','.tirp', function () {
   
                var vehicles   = $(this).parents('.modal-body').find('select[name="trip"]').find("option:selected").data('vehicles');
                // alert(vehicles);
                var options = `<option selected value="">@lang('Select an option')</option>`

                $.each(vehicles, function (i, v) {
                    options += `<option value="${v.id}" data-name="${v.register_no}"> ${v.nick_name} (${v.register_no}) </option>`
                });

                $(this).parents('.modal-body').find('select[name=vehicle]').html(options);

            });

</script>
   
@endsection