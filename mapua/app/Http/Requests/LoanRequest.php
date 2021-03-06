<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'user_loan'=>'required|exists:users,id',
            
            'loan_type'=>'required',
            'loan_amount'=>'required',
            // 'department'=>'required',
            'interest'=>'required',
            // 'approval'=>'required',
            'duration'=>'required',
            // 'loan_status'=>'required',
            'attachment_path'=>'file|mimes:jpg,png,jpeg,pdf',
            // 'total_contribution'=>'required',
        ];
    }
}
