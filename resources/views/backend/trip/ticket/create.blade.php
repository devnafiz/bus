@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	 <a href="{{ route('admin.trip.ticket.price') }}" class="btn btn-sm btn--primary box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Ticket Price list')</a>
       </div>
       <br>

         <form action="{{ route('admin.trip.ticket.price.store')}}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('Fleet Type')</label>
                                <select name="fleet_type" class="select2-basic form-control" required>
                                    <option value="">@lang('Select an option')</option>
                                    @foreach ($fleettypes as $fleet)
                                        <option value="{{ $fleet->id }}">{{ __($fleet->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                           
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('Route')</label>
                                <select name="route" class="form-control select2-basic" required>
                                    <option value="">@lang('Select an option')</option>
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->id }}">{{ __($route->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                           
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('Price')</label>
                                <input type="text" class="form-control" placeholder="@lang('Enter Price')" name="price" required>
                            </div>
                        </div>

                       
                       <div class="col-md-12 price-error-message">

                        </div>

                        <div class="price-wrapper col-md-12">

                        </div>
                        
                       
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save')
                                </button>
                            </div>
                        </div>

                    </div>
                </form>


 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
        
       $(document).on('change','select[name=fleet_type] , select[name=route]',function(){

            //alert('hi');
            var routeId =$('select[name="route"]').find("option:selected").val();
            var fleetTypeId = $('select[name="fleet_type"]').find("option:selected").val();

            alert(routeId);

       });

    </script>            
           
       


   
@endsection


