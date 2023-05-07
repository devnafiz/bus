@extends('home.master_home')


@section('content')
<div  class="shop-sidebar shop">
	<div class="row">
		
     <div class="col-lg-3 col-md-4 col-12">
     	 <form action="{{ route('frontend.search') }}" id="filterForm">
						<div class="shop-sidebar">
								<!-- Single Widget -->
								
								<!--/ End Single Widget -->
								<!-- Shop By Price -->
								  @if($fleet_type)
									<div class="single-widget range">

										<h3 class="title">Vehicle Type</h3>
										<div class="price-filter">
											<div class="price-filter-inner">
												<div id="slider-range"></div>
													<div class="price_slider_amount">
													<div class="label-input">
														<span>Vehicle Type:</span>
													</div>
												</div>
											</div>
										</div>
										<ul class="check-box-list">
											@foreach($fleet_type as $type)
											<li>
												<label class="checkbox-inline" for="1"><input name="fleetType[]" id="1" type="checkbox" value="{{ $type->id }}">{{ __($type->name) }}<span class="count"></span></label>
											</li>
										    @endforeach	
											
										</ul>
									</div>
								   @endif	
									<!--/ End Shop By Price -->
                                     @if ($routes)
									<div class="single-widget category">
									<h3 class="title">Route</h3>
									<ul class="categor-list">
                                      @foreach($routes as $route)
										<li>
												<label class="checkbox-inline" for="1"><input name="routes[]" id="1" type="checkbox" value="{{ $type->id }}" 

											@if (request()->routes)
                                    @foreach (request()->routes as $item)
                                    @if ($item == $route->id)
                                    checked
                                    @endif
                                    @endforeach
                                    @endif>{{ __($route->name) }}<span class="count"></span></label>
										</li>
										@endforeach
										
									</ul>
								</div>
								@endif
							
								<!--/ End Single Widget -->
								<!--/ End Shop By Price -->
                                     @if ($schedules)
									<div class="single-widget category">
									<h3 class="title">Schedules</h3>
									<ul class="categor-list">
                                      @foreach($schedules as $schedule)
										<li>
												<label class="checkbox-inline" for="1"><input name="schedules[]" id="1" type="checkbox" value="{{ $type->id }}" 

											@if (request()->routes)
                                    @foreach (request()->schedules as $item)
                                    @if ($item == $schedule->id)
                                    checked
                                    @endif
                                    @endforeach
                                    @endif>
                                    {{ showDateTime($schedule->start_from, 'h:i a').' - '. showDateTime($schedule->end_at, 'h:i a') }} <span class="count"></span></label>
										</li>
										@endforeach
										
									</ul>
								</div>
								@endif
								
						</div>
						</form>	
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top">
									<div class="shop-shorter">
										<div class="single-shorter">
											<label>Show :</label>
											<select>
												<option selected="selected">09</option>
												<option>15</option>
												<option>25</option>
												<option>30</option>
											</select>
										</div>
										<div class="single-shorter">
											<label>Sort By :</label>
											<select>
												<option selected="selected">Name</option>
												<option>Price</option>
												<option>Size</option>
											</select>
										</div>
									</div>
									<!-- <ul class="view-mode">
										<li class="active"><a href="shop-grid.html"><i class="fa fa-th-large"></i></a></li>
										<li><a href="shop-list.html"><i class="fa fa-th-list"></i></a></li>
									</ul> -->
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>
						<div class="row">
							  @forelse ($trips as $trip)
							  @php

							   $start =Carbon\Carbon::parse($trip->schedule->start_from);
							  
							    $end =Carbon\Carbon::parse($trip->schedule->end_at);
							    $diff= $start->diff($end);
							    // dd($diff);
                                $ticket = App\Models\TicketPrice::where('fleet_type_id', $trip->fleetType->id)->where('vehicle_route_id', $trip->route->id)->first();
                               // dd( $ticket );
							  @endphp
							
							<div class="col-lg-12 col-md-6 col-12">
								<div  class=" single-product row card">
									<div class="row">

									 <div class="col-lg-5 col-md-4 col-12">
									 	<h4>{{$trip->fleetType->id}}{{$trip->route->id}}{{__($trip->title)}}</h4>
									 	<p>Seat Layout - {{__($trip->fleetType->seat_layout)}}</p>
									 	 <span class="ratting"><i class="las la-bus"></i>{{ __($trip->fleetType->name) }}</span>
									 	
									 </div>
									 <div class="col-lg-4 col-md-4 col-12">
									 	 <div class="bus-time">
		                                <p class="time">{{ showDateTime($trip->schedule->start_from, 'h:i A') }}</p>
		                                <p class="place">{{ __($trip->startFrom->name) }}</p>
	                                     </div>
									 </div>
									 <div class="col-lg-3 col-md-4 col-12">
									 	 <p class="rent mb-0">{{ __($general->cur_sym) }}{{$ticket->price}}</p>
									 	 <p>{{__('off day')}} :
                                          @foreach($trip->day_off as $day)
									 	 	<span class="badge badge-info">{{ __(showDayOff($day)) }}</span>

									 	 	@endforeach
									 	   

									 	 </p>
									 </div>
									 </div>
								<hr>	 

                                 <div class="col-lg-12">
                                 	 @if ($trip->fleetType->facilities)
									 <div>
									 	<p>Facilities - 
                                         @foreach ($trip->fleetType->facilities as $item)
									   <span class="facilities">{{ __($item) }}</span>
                                    @endforeach

                                   </p>
									 </div>
									 @endif
								</div>

								</div>
								
								
							</div>
							 @empty
		                    <div class="ticket-item">
		                        <h5>{{ __($emptyMessage) }}</h5>
		                    </div>
		                    @endforelse
                           

						</div>
					</div>
				
		</div>			
</div>					


@endsection