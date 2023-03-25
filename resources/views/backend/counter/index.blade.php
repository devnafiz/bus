@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	  <button type="button" class="icon-btn ml-1 editBtn"
                                                data-toggle="modal" data-target="#addModal"
                                                
                                              
                                                data-original-title="@lang('Update')">
                                            <i class="la la-pen"></i> Add Counter
                                        </button>
       </div>
       <br>

        <table class="table table-dark table-hover table-bordered">
        	<thead>
        		<tr>
	        		<th>@lang('Name')</th>
	                <th>@lang('Mobile Number')</th>
	                <th>@lang('City')</th>
	                <th>@lang('Location')</th>
	                <th>@lang('Status')</th>
	                <th>@lang('Action')</th>
        		</tr>

        	</thead>
        	<tbody>
        		 @forelse($counters as $item)
        		<tr>
        			<td>{{__( $item->name)}}</td>
        			<td>{{ __($item->mobile) }}</td>
        			<td>{{ __($item->city) }}</td>
        			<td>{{ __($item->location) }}</td>
        			<td></td>
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
                    <h5 class="modal-title"> @lang('Add Counter')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.manage.counter.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Name')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Counter Name')" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('City')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter City Name')" name="city" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Location')</label>
                            <textarea name="location" class="form-control" placeholder="@lang('Enter Location')"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Mobile')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Counter Contact Number')" name="mobile">
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