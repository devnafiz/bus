@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	  <button type="button" class="icon-btn ml-1 editBtn"
                                                data-toggle="modal" data-target="#addModal"
                                                
                                              
                                                data-original-title="@lang('Update')">
                                            <i class="la la-pen"></i> Add Vehicles
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
	                <th>@lang('Nick Name')</th>
                    <th>@lang('Reg. No.')</th>
                    <th>@lang('Engine No.')</th>
                    <th>@lang('Chasis No.')</th>
                    <th>@lang('Model No.')</th>
                    <th>@lang('Fleet Type.')</th>
                    <th>@lang('status.')</th>
	                
	                <th>@lang('Action')</th>
        		</tr>

        	</thead>
        	<tbody>
        		 @forelse($vehicles as $k=>$item)
        		<tr>
        			<td>{{__( $k+1)}}</td>
        			<td>{{ __($item->nick_name) }}</td>
                    <td>{{ __($item->register_no) }}</td>
                    <td>{{ __($item->engine_no) }}</td>
                    <td>{{ __($item->chasis_no) }}</td>
                    <td>{{ __($item->model_no) }}</td>
                    <td>{{ __($item->fleetType->seat_layout) }}</td>
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


    {{-- Add METHOD MODAL --}}
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Add Vehicle')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.fleet.vehicles.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Nick Name')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter nick name')" name="nick_name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Fleet Type')</label>
                            <select name="fleet_type" class="form-control">
                                <option value="">@lang('Select an option')</option>
                                @foreach ($fleetType as $item)
                                    <option value="{{ $item->id }}">{{ __($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Register No.')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Reg. No.')" name="register_no" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Engine No.')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Eng. No.')" name="engine_no" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Chasis No.')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Chasis No.')" name="chasis_no" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Model No.')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Model No.')" name="model_no" required>
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
@endsection