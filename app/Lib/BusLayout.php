<?php

namespace App\Lib;

class BusLayout
{
  protected $trip;
  protected $fleet;
  public $sitLayouts;
  protected $totalRow;
  protected $deckNumber;
  protected $seatNumber;

  public function __construct($trip){

  	$this->trip =$trip;
  	$this->fleet = $trip->fleetType;
  	$this->sitLayouts= $this->sitLayouts();

  }

  public function sitLayouts(){

  	   $seatLayout =explode('x', str_replace('','',$this->fleet->seat_layout));
  	   $layout['left'] = $seatLayout[0];
  	   $layout['right'] = $seatLayout[1];
  	 //dd($layout['right']);
  	 return (object)$layout;
  }

  public function getDeckHeader($deckNumber){

  	 $html='<span class="front">Front</span>
            <span class="rear">Rear</span>
        ';

         if($deckNumber== 0){

             $html.='
              <span class="lower">Door</span>
               <span class="driver"><img src="'.getImage('assets/templates/basic/images/icon/wheel.svg').'" alt="icon"></span>
             ';
         }else{
         	 $html .= '<span class="driver">Deck :  '.($deckNumber+1) .'</span>';

         }
         return $html;
  }
  public function getTotalRow($seat){

  	  $rowItem = $this->sitLayouts->left +$this->sitLayouts->right;
  	   $totalRow   = floor ($seat / $rowItem);
  	   $this->totalRow = $totalRow;
  	 // dd($totalRow );
  	   return $this->totalRow;
  }

   public function getLastRowSit($seat){

   	$rowItem = $this->sitLayouts->left + $this->sitLayouts->right;
   	$lastRowSeat =$seat -$this->getTotalRow($seat)* $rowItem;
   	return  $lastRowSeat;
   }

    public function getSeats($deckNumber,$seatNumber){

    	$this->deckNumber = $deckNumber;
    	$this->seatNumber = $seatNumber;

    	$seats =[
    		'left'=>$this->leftSeat(),
    		'right'=>$this->rightSeat()

    	];
    	return (object)$seats ;
    }

    public function leftSeat(){


    }

    public function rightSeat(){

    	
    }






}