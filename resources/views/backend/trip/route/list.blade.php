@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	 <a href="{{ route('admin.trip.route.create') }}" class="btn btn-sm btn--primary box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
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
	                <th>@lang('Name')</th>
                    <th>@lang('Starting Point')</th>
                    <th>@lang('Ending Point.')</th>
                    <th>@lang('Distance')</th>
                    <th>@lang('Time.')</th>
                    
                    <th>@lang('status.')</th>
	                
	                <th>@lang('Action')</th>
        		</tr>

        	</thead>
        	<tbody>
        		 @forelse($routes as $k=>$item)
        		<tr>
        			<td>{{__( $k+1)}}</td>
        			<td>{{ __($item->name) }}</td>
                    <td>{{ __($item->start_from) }}</td>
                    <td>{{ __($item->end_to) }}</td>
                    <td>{{ __($item->distance) }}</td>
                    <td>{{ __($item->time) }}</td>
                  
                    <td>{{ __($item->status) }}</td>
        			
        			<td></td>
        		</tr>
        		 @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
        		@endforelse

        	</tbody>
 
         </table>


   
@endsection