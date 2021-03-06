<?php

namespace App\Imports;

use App\Models\User;


use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
// use App\Imports\Date;

class UsersImport implements   WithHeadingRow, ToCollection, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        // HeadingRowFormatter::default('none');

            foreach ($rows as $row) {
                # code...
                $user = User::create([
                    'name'      =>$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'],
                    'email'     =>$row['email'],
                    'userType'  =>1,
                    'password'  =>Hash::make('password')
                ]);
                $user->adminReg()->create([
                    'first_name'    =>$row['first_name'],
                    'middle_name'   =>$row['middle_name'],
                    'last_name'     =>$row['last_name'],
                    'mobile_number' =>$row['mobile'],
                    'birth_date'    =>date('Y-m-d',$row['birthdate']),
                    'birth_place'   =>$row['Birthplace'],
                    'civil_status'  =>$row['civil_status'],

                    'region'        =>$row['region'],
                    'province'      =>$row['province'],
                    'municipality'  =>$row['municipality'],
                    'barangay'      =>$row['barangay'],
                    'current_address'=>$row['current_address'],

                    'department'    =>$row['department'],
                    'salary'        =>$row['salary'],
                    'membership'    =>date('Y-m-d',$row['membership']),
                    'employment'    =>date('Y-m-d',$row['employment']),
                ]);
                

            }
            //
    }
    public function rules(): array
    {
        return[
            'email'=>'required|email|unique:users,email',

            'first_name'=>'required',
            'middle_name'=>'required',
            'last_name'=>'required',
            
            'mobile'=>'required',
            'birthdate'=>'required',
            'birth_place'=>'required',
            'civil_status'=>'required',

            'region'=>'required',
            'province'=>'required',
            'municipality'=>'required',
            'barangay'=>'required',
            'current_address'=>'required',

            'department'=>'required',
            'salary'=>'required',
            'membership'=>'required',
            'employment'=>'required',

        ];
    }
    // public function map($row): array
    // {
    //     return[
    //         $row['first_name'],
    //         \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($row['birthdate']),
    //         \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($row['membership']),
    //         \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($row['employment']),
      
    //     ];
    // }
    // public function columnFormats(): array
    // {
    //     return[
    //         'birth_date'=> NumberFormat::FORMAT_DATE_YYYYMMDD,
    //         'membership'=> NumberFormat::FORMAT_DATE_YYYYMMDD,
    //         'employment' => NumberFormat::FORMAT_DATE_YYYYMMDD,


    //     ];
    // }

}
