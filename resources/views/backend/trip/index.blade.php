@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	<a  href="{{route('admin.trip.ticket.price.create')}}" class="badge badge_info">Add trip</a>
              
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
        			<td>{{__( $item+title)}}</td>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Add Schedule')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.trip.schedule.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Start From')</label>
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" placeholder="--:--" name="start_from" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('End At')</label>
                            <div class="input-group clockpicker">
                                <input type="text" class="form-control" placeholder="--:--" name="end_at" autocomplete="off" required>
                            </div>
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

</script>
   
@endsection