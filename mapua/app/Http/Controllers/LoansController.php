<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest as request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\{Loans, User};
use Illuminate\Support\Facades\Redirect;
use Tightenco\Ziggy\Output\Script;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Request as query;


class LoansController extends Controller
{
    //
    public function index(){
        
        return Inertia::render('Users/UserLoanPage',[
           
        ]);
    }
// Loans View
    public function loansView(query $query){
        $user = Auth::user();
        $loans = Loans::with('contributions')
        ->filterOwner($user->id)
        ->limit(5)
        ->paginate(5)
        ->appends($query::only(auth()->id()));
        
        return Inertia::render('Users/LoanView',[
            'loans' => $loans,
        ]);
    }

    public function createLoans(request $request){
        $validate_data = $request->validated();
      
        if($request->hasFile('attactment_path')){
            $file = $request->file('attactment_path');
            
            $file_name = time().'.'.$file->getClientOriginalName();
           
            $file->move(public_path('uploads/'),$file_name);

            $user = User::find($validate_data['user_loan']);
          
            $user->loans()->create([
             
                'loan_type'=>$validate_data['loan_type'],
                'duration'=>$validate_data['duration'],
                'attachment_path'=>'uploads/'.$file_name,
                'loan_amount'=>$validate_data['loan_amount'],
                'interest'=>$validate_data['interest'],
                'loan_status'=>'pending',
                'approval'=>'pending',
             
            ]);
            return Redirect::route('dashboard')->with('message',
                [NotificationService::notificationItem('Sucess', '', 'Sucessfully '.$validate_data['loan_type'])]);
        
        }
    }

}
