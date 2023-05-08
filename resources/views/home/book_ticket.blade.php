@extends('home.master_home')


@section('content')
     <div class="row">
     	<div class="col-md-6">
                <form action="{{ route('frontend.ticket.book', $trip->id) }}" method="POST" id="bookingForm" class="row gy-2">
                    <input type="text" name="price" hidden>
                    <div class=" col-md-12">
                          <div class="form-group">
                               <label for="date_of_journey" class="form-label">@lang('Journey Date')</label>
                               <input type="text" id="date_of_journey" value="{{Session::get('date_of_journey') ? Session::get('date_of_journey') :date('m/d/Y')}}" name="date_of_journey" class="form-control">
                           </div>   
                         
                    </div>

                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="pickup_point" class="form-label">@lang('Pickup Point')</label>
                                <select name="pickup_point" id="pickup_point" class="form-control select2">
                                    <option value="">@lang('Select One')</option>
                                    @foreach($stoppages as $item)
                                    <option value="{{ $item->id }}" @if (Session::get('pickup')==$item->id)
                                        selected
                                        @endif>
                                        {{ __($item->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         <div class="col-12">
                            <div class="form-group">
                                <label for="dropping_point" class="form-label">@lang('Dropping Point')</label>
                                <select name="dropping_point" id="dropping_point" class="form-control select2">
                                    <option value="">@lang('Select One')</option>
                                    @foreach($stoppages as $item)
                                    <option value="{{ $item->id }}" @if (Session::get('destination')==$item->id)
                                        selected
                                        @endif>
                                        {{ __($item->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         <div class="col-12">
                            <label class="form-label">@lang('Select Gender')</label>
                            <div class="d-flex flex-wrap justify-content-between">
                                <div class="form-group custom--radio">
                                    <input id="male" type="radio" name="gender" value="1">
                                    <label class="form-label" for="male">@lang('Male')</label>
                                </div>
                                <div class="form-group custom--radio">
                                    <input id="female" type="radio" name="gender" value="2">
                                    <label class="form-label" for="female">@lang('Female')</label>
                                </div>
                                <div class="form-group custom--radio">
                                    <input id="other" type="radio" name="gender" value="3">
                                    <label class="form-label" for="other">@lang('Other')</label>
                                </div>
                            </div>
                        </div>

                         <div class="booked-seat-details my-3 d-none">
                            <label>@lang('Selected Seats')</label>
                            <div class="list-group seat-details-animate">
                                <span class="list-group-item d-flex bg--base text-white justify-content-between">@lang('Seat Details')<span>@lang('Price')</span></span>
                                <div class="selected-seat-details">
                                </div>
                            </div>
                        </div>
                        <input type="text" name="seats" hidden>
                        <div class="col-12">
                            <button type="submit" class="book-bus-btn btn">@lang('Continue')</button>
                        </div>



     		</form>
     		
     	</div>
          <div class="col-md-6">

                 @foreach ($trip->fleetType->deck_seats as $seat)
                <div class="seat-plan-inner">
                   <div class="single">

                    @php
                     echo $busLayout->getDeckHeader($loop->index);
                    @endphp
                    @php
                     $totalRow=$busLayout->getTotalRow($seat);
                    $lastRowSeat = $busLayout->getLastRowSit($seat);
                    $chr ='A';
                    $deckIndex =$loop->index+1;
                    $seatlayout= $busLayout->sitLayouts();
                    $rowItem =$seatlayout->left +$seatlayout->right;
                     //dd($rowItem);
                    @endphp

                    @for($i=1 ; $i<=$totalRow;$i++)

                    @php

                    if($lastRowSeat==1 && $i== $totalRow-1) break;
                    $seatNumber = $chr;
                    $chr++;
                    $seats=$busLayout->getSeats($deckIndex,$seatNumber);
                    //dd($seats);
                    @endphp

                       <div class="seat-wrapper">
                                @php echo $seats->left; @endphp
                                  @php echo $seats->right; @endphp
                                
                            </div>

                    @endfor



                   </div>
                  </div> 

                  
                 @endforeach
               
               
          </div>
          
     	
     	
     </div>
 <!-- jQuery -->
    <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- jQueryUI -->
     <script>
          
          $(document).ready(function(){

              var date_of_journey = '{{ Session::get('date_of_journey')}}';
               var pickup = '{{ Session::get(' pickup ') }}';
              var destination = '{{ Session::get('destination ') }}';

        if (date_of_journey && pickup && destination) {
            showBookedSeat();
        }
             // alert(destination);
               //click on seat
        $('.seat-wrapper .seat').on('click', function() {
            var pickupPoint = $('select[name="pickup_point"]').val();
            var droppingPoing = $('select[name="dropping_point"]').val();

            if (pickupPoint && droppingPoing) {
                selectSeat();
            } else {
                $(this).removeClass('selected');

    //              $notification = array(
    //     'message' => 'Please select pickup point and dropping point before select any seat',
    //     'alert-type' => 'error'
    // );
                notify('error', "@lang('Please select pickup point and dropping point before select any seat')")
            }
        });
             
          });
     </script>

  <style>
       
     .seat-plan-inner .front {
    position: absolute;
    width: 60px;
    height: 25px;
    top: -13px;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    text-transform: uppercase;
    font-size: 10px;
    font-weight: 600;
    z-index: 1;
    color: #9b9b9b;
    background: #f1f1f1;
    letter-spacing: 1px;
}
.seat-plan-inner .single {
    position: relative;
    border: 0.5px solid #00000028;
    min-height: 150px;
    max-width: 100%;
    padding: 80px 25px 30px;
    margin-bottom: 55px;
}
.seat-plan-inner .lower {
    width: 50px;
    height: 40px;
    position: absolute;
    left: 20px;
    top: 20px;
    color: #777;
    font-weight: 600;
    text-transform: uppercase;
}
.seat-plan-inner .driver {
    position: absolute;
    right: 20px;
    top: 15px;
}
.seat-wrapper .left-side, .seat-wrapper .right-side {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.seat-wrapper .seat {
    height: 40px !important;
    width: 30px !important;
    color: #777;
    border: 1px solid #979797;
    border-top-left-radius: 2px;
    border-bottom-left-radius: 2px;
    margin-right: 10px;
    cursor: pointer;
    position: relative;
    font-weight: 100;
    font-size: 14px;
    display: inline-block;
}
.seat-wrapper .seat span {
    position: absolute;
    left: 2px;
    right: 2px;
    height: 4px;
    border: 1px solid rgba(27, 39, 61, 0.25);
    border-radius: 2px;
    bottom: 6px;
}
.seat-wrapper .left-side, .seat-wrapper .right-side {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.seat-wrapper .right-side {
     float: right;
}
  </style>   


@endsection