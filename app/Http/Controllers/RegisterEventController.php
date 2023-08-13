<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Event;
use App\Models\Register;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterEventStoreRequest;

class RegisterEventController extends Controller
{
    public function index(Request $request){
        return view('index');
    }
    public function store(RegisterEventStoreRequest $request){
        try {
      
        $registerData = ['total_selected_items'=>$request->total_selected_item_input,
        'total_amount'=>$request->total_amount_input];
        $registerId = Register::create($registerData)->id;
        for ($i=0; $i < count($request->event); $i++) { 
            $eventData = ['register_id'=>$registerId,'event'=>$request->event[$i],'amount'=>$request->amount[$i],
            'selected_item'=>$request->selected[$i],'event_amount'=>$request->event_amount[$i]];
            Event::create($eventData);
        }

        return redirect()->back()->with(['status'=>'success','message'=>'Event Created']);
        }
        catch (Throwable $th) {
            return redirect()->back()->with(['status'=>'danger','message'=>$th->getMessage()]);
        }

    }
}
