@extends('home.master_home')


@section('content')
     <div class="row">
     	<div class="col-md-6">

     		
     		
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