@extends('backend.layouts.app')

@section('title', __('Fleet'))


@section('content')
        <div class="pull-left">
        	
        	  <button type="button" class="icon-btn ml-1 editBtn"
                                                data-toggle="modal" data-target="#addModal"
                                                
                                              
                                                data-original-title="@lang('Update')">
                                            <i class="la la-pen"></i> Add Fleet
                                        </button>
       </div>
       <br>

        <table class="table table-dark table-hover table-bordered">
        	<thead>
        		<tr>
	        		<th>@lang('Name')</th>
                                    <th>@lang('Seat Layout')</th>
                                    <th>@lang('No of Deck')</th>
                                    <th>@lang('Total Seat')</th>
                                    <th>@lang('Facilities')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
        		</tr>

        	</thead>
        	<tbody>
        		 @forelse($fleetType as $k=>$item)
        		<tr>
        			<td>{{__( $k+1)}}</td>
        			<td>{{ __($item->name) }}</td>
        			
        			<td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                    <h5 class="modal-title"> @lang('Add Fleet Type')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.fleet.type.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Name')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Fleet Name')" name="name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('Seat Layout')</label>
                            <select name="seat_layout" class="form-control">
                                <option value="">@lang('Select an option')</option>
                                @foreach ($seatLayouts as $item)
                                    <option value="{{ $item->layout }}">{{ __($item->layout) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> @lang('No of Deck')</label>
                            <input type="number" min="0" class="form-control" placeholder="@lang('Enter Number of Deck')" name="deck" id="deck" required>
                        </div>
                        <div class="showSeat"></div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold" for="facilities">@lang('Facilities')</label>
                            <select class="select2-auto-tokenize" name="facilities[]" id="facilities" multiple="multiple">
                                @foreach ($facilities as $item)
                                <option value="{{ $item->data_values->title }}" selected>{{ $item->data_values->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('AC status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                   data-toggle="toggle" data-on="@lang('Ac')" data-off="@lang('Non Ac')" name="has_ac">
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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        

        $(document).ready(function(){
          //console.log('test');
             $('.disableBtn').on('click', function () {
                var modal = $('#disableModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.type_name').text($(this).data('type_name'));
                modal.modal('show');
            });

            $('.activeBtn').on('click', function () {
                var modal = $('#activeModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.type_name').text($(this).data('type_name'));
                modal.modal('show');
            });

            $('.addBtn').on('click', function () {
                $('.showSeat').empty();
                var modal = $('#addModal');
                modal.modal('show');
            });

            // $('.select2-auto-tokenize').select2({
            //     tags: true,
            //     tokenSeparators: [',']
            // });


            // $(document).on('click', '.editBtn', function () {
            //     var modal   = $('#editModal');
            //     var data    = $(this).data('fleet_type');
            //     var link    = `{{ route('admin.fleet.type.update', '') }}/${data.id}`;
            //     var deckNumber = data.deck;
            //     modal.find('input[name=name]').val(data.name);
            //     modal.find('input[name=deck]').val(deckNumber);
            //     modal.find('select[name=seat_layout]').val(data.seat_layout);
            //     modal.find('select[name="facilities[]"]').val(data.facilities).select2();
            //     if(data.has_ac == 1){
            //         modal.find('input[name=has_ac]').bootstrapToggle('on');
            //     }else{
            //         modal.find('input[name=has_ac]').bootstrapToggle('off');
            //     }
            //     modal.find('form').attr('action', link);

            //     var fields =``;

            //     $.each(data.deck_seats, function (i, val) {
            //         fields +=`<div class="form-group">
            //                 <label class="form-control-label font-weight-bold"> Seats of Deck - ${i + 1} </label>
            //                 <input type="text" class="form-control" value="${val}" placeholder="@lang('Enter Number of Seat')" name="deck_seats[]" required>
            //             </div>`;
            //     });
            //     $('.showSeat').html(fields);
            //     modal.modal('show');
            // });

            $('#deck').on('click', function(){
                 //console.log('test');
                $('.showSeat').empty();
                for(var deck=1; deck<= $(this).val(); deck++){
                    $('.showSeat').append(`
                        <div class="form-group">
                            <label class="form-control-label font-weight-bold"> Seats of Deck - ${deck} </label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Number of Seat')" name="deck_seats[]" required>
                        </div>
                    `);
                }
            })


        });

    </script>

