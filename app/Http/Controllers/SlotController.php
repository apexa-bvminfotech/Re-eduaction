<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Rtc;
use App\Models\Slot;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:slot-list|slot-create|slot-edit', ['only' => ['index', 'store']]);
        $this->middleware('permission:slot-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:slot-edit', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slot = Slot::orderBy('id', 'DESC')->get();
        if(Auth::user()->type == 1){
            $slot = Slot::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('slot.index', compact('slot'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::orderBy('id', 'DESC')->get();
        if(Auth::user()->type == 1) {
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        return view('slot.create', compact( 'branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'trainer_id' => 'required',
            'rtc_id' => 'required',
            'branch_id' => 'required',
            'whatsapp_group_name' => 'required',
            'slot_time_to' => 'required',
            'slot_time_from' => 'required',
        ]);
        $time = $request->slot_time_to . " - " . $request->slot_time_from;
        $existingTrainerSlot = Slot::where('slot_time', $time)
            ->where('trainer_id', $request->trainer_id)
            ->first();

        if ($existingTrainerSlot) {
            if ($existingTrainerSlot->trainer_id == $request->trainer_id) {
                return back()->with('error', 'Trainer slot already create please select other time');
            }
        }

        $time = $request->input('slot_time_to') . " - " . $request->input('slot_time_from');
        $data = [
            'trainer_id' => $request->input('trainer_id'),
            'rtc_id' => $request->input('rtc_id'),
            'branch_id' => $request->input('branch_id'),
            'whatsapp_group_name' => $request->whatsapp_group_name,
            'slot_time' => $time,
            'is_active' => $request->input('is_active'),
        ];
        Slot::create($data);
        return redirect()->route('slot.index')
            ->with('success', 'Slot created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slot $slot)
    {
        $branch = Branch::orderBy('id', 'DESC')->get();
        if(Auth::user()->type == 1){
            $branch = Branch::where('id', Auth::user()->branch_id)->orderBy('id', 'DESC')->get();
        }
        $trainer = Trainer::where('branch_id', $slot->branch_id)->orderBy('id', 'DESC')->get();
        $rtc = Rtc::where('branch_id', $slot->branch_id)->orderBy('id', 'DESC')->get();
        return view('slot.edit', compact('slot', 'trainer', 'rtc', 'branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slot $slot)
    {
        $this->validate($request, [
            'trainer_id' => 'required',
            'rtc_id' => 'required',
            'branch_id' => 'required',
            'whatsapp_group_name' => 'required',
            'slot_time_to' => 'required',
            'slot_time_from' => 'required',
        ]);
        $time = $request->input('slot_time_to') . " - " . $request->input('slot_time_from');
        $data = [
            'trainer_id' => $request->input('trainer_id'),
            'rtc_id' => $request->input('rtc_id'),
            'branch_id' => $request->input('branch_id'),
            'whatsapp_group_name' => $request->whatsapp_group_name,
            'slot_time' => $time,
            'is_active' => $request->input('is_active')
        ];

        $slot->update($data);

        return redirect()->route('slot.index')
            ->with('success', 'Slot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slot::where('id', $id)->delete();
        return redirect()->route('slot.index')
            ->with('success', 'Slot deleted successfully');
    }

    public function changeSlotStatus(Request $request)
    {
        $slot = Slot::find($request->slot_id);
        $slot->is_active = $request->status;
        $slot->save();
        return response()->json(['success' => $request->status ? 'Slot de-active' : 'Slot active']);
    }

    public function gettrainerdata(Request $request)
    {
        $trainer = Trainer::where('branch_id', $request->branch_id)
                    ->where('is_active',0)->orderBy('id', 'DESC')->get();
        $rtc = Rtc::where('branch_id', $request->branch_id)
                    ->where('is_active',0)->orderBy('id', 'DESC')->get();
        return response()->json(['trainer' => $trainer, 'rtc' => $rtc]);
    }

}
