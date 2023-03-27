@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	  <button type="button" class="icon-btn ml-1 editBtn"
                                                data-toggle="modal" data-target="#addModal"
                                                
                                              
                                                data-original-title="@lang('Update')">
                                            <i class="la la-pen"></i> Add Seat Layout
                                        </button>
       </div>
       <br>

        <table class="table table-dark table-hover table-bordered">
        	<thead>
        		<tr>
	        		<th>@lang('ID')</th>
	                <th>@lang('layout')</th>
	                
	                <th>@lang('Action')</th>
        		</tr>

        	</thead>
        	<tbody>
        		 @forelse($layouts as $k=>$item)
        		<tr>
        			<td>{{__( $k+1)}}</td>
        			<td>{{ __($item->layout) }}</td>
        			
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
                    <h5 class="modal-title"> @lang('Add Seat Layouts')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.fleet.seat.layouts.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Layout')</label>
                            <input type="text" class="form-control" placeholder="@lang('2 x 3')" name="layout" required>
                            <small class="text-primary">@lang('Just type left and right value, a seperator (x) will be added automatically')</small>
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