@extends('backend.layouts.app')

@section('title', __('Counter'))


@section('content')
        <div class="pull-left">
        	
        	 <a href="{{ route('admin.trip.route.create') }}" class="btn btn-sm btn--primary box--shadow1 text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Route list')</a>
       </div>
       <br>

         <form action="{{ route('admin.trip.route.store')}}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('Name')</label>
                                <input type="text" class="form-control" placeholder="@lang('Enter Name')" name="name" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('Start From')</label>
                                <select name="start_from" class="select2-basic" required>
                                    <option value="">@lang('Select an option')</option>
                                    @foreach ($stoppages as $item)
                                        <option value="{{ $item->id }}">{{ __($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox form-check-primary">
                                    <input type="checkbox" class="custom-control-input" id="has-stoppage">
                                    <label class="custom-control-label" for="has-stoppage">@lang('Has More Stoppage')</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('End To')</label>
                                <select name="end_to" class="select2-basic" required>
                                    <option value="">@lang('Select an option')</option>
                                    @foreach ($stoppages as $item)
                                        <option value="{{ $item->id }}">{{ __($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="stoppages-wrapper col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('Time')</label>
                                <input type="text" class="form-control" name="time" placeholder="@lang('Enter Approximate Time')" required>
                                <small class="text-danger">@lang('Keep space between value & unit')</small>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label font-weight-bold"> @lang('Distance')</label>
                                <input type="text" class="form-control" placeholder="@lang('Enter Distance')" name="distance" required>
                                <small class="text-danger">@lang('Keep space between value & unit')</small>
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