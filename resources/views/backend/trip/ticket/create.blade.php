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
                                <select name="start_from" class="select2-basic form-control" required>
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
                                <select name="start_from" class="form-control select2-basic" required>
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
           
       


   
@endsection