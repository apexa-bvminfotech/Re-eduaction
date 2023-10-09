<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\TrainerAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $trainer = Trainer::where('user_id',$user->id)->with('branch')->first();

        $fromDate = '';
        $toDate = '';

        if(isset($_GET['fromDate'])){
            $fromDate = $_GET['fromDate'];
        }
        if(isset($_GET['toDate'])){
            $toDate = $_GET['toDate'];
        }
       
        $qurey = TrainerAttendance::from('trainer_attendances')->where('trainer_id',$trainer->id);

        if($fromDate != '' && $fromDate != null){
            $qurey->whereDate('date', '>=', date('Y-m-d', strtotime($fromDate)));
        }

        if($toDate != '' && $toDate != null){
            $qurey->whereDate('date', '<=',  date('Y-m-d', strtotime($toDate)));
        }

        $trainerAttendance = $qurey->with('slots')->get();
        return view('dashboard.trainer_dashboard',compact('trainer','trainerAttendance','fromDate','toDate'));
    }
}
