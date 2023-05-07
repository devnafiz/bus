@extends('home.master_home')


@section('content')
     <div class="row">
     	<div class="col-md-4">

     		
     		
     	</div>
          <div class="col-md-8">

                 @foreach ($trip->fleetType->deck_seats as $seat)
                <div class="seat-plan-inner">
                   <div class="single">

                    @php
                     echo $busLayout->getDeckHeader($loop->index);
                    @endphp

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
  </style>   


@endsection