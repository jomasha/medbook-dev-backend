<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Patient;
use App\Models\PatientService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{

    public function fetchAll(): object
    {
        $result = DB::table('tbl_patient_services')
            ->join('tbl_patient', 'tbl_patient_services.patient_id', '=', 'tbl_patient.patient_id')
            ->join('tbl_gender', 'tbl_gender.gender_id', "=", 'tbl_patient.gender_id' )
            ->join('tbl_service', 'tbl_service.service_id', "=", 'tbl_patient_services.service_id' )
            ->select('tbl_patient_services.patient_service_id','tbl_patient_services.patient_id', 'tbl_patient_services.service_id', 'tbl_patient_services.comments', 'tbl_patient.name as patient_name', 'tbl_patient.birth_date as patient_birth_date as dob', 'tbl_gender.gender_name','tbl_service.service_name', DB::raw('CASE
                WHEN COUNT(`tbl_patient_services`.`patient_id`) = (SELECT MAX(total_patient) FROM (
                   SELECT patient_id, COUNT(patient_id) AS total_patient
                   FROM tbl_patient_services
                   GROUP BY patient_id
                 ) AS patient_counts)
                THEN 1
                ELSE 0
              END AS most_active '))
            ->groupBy( 'tbl_patient_services.patient_id')
            ->orderBy('tbl_patient_services.created_at','desc')
            ->get();
        ;
        return response()->json($result, 200);
    }

    public function getGender(): object
    {
        return response()->json(Gender::all(), 200);
    }

    public function getService(): object
    {
        return response()->json(Service::all(), 200);
    }

    public function store(Request $request)
    {
        $patient = Patient::where('name', $request['name'])->first();
        if (!$patient) {

            $patient = Patient::create([
               'name'=>$request->name,
               'birth_date'=>$request->dob,
               'gender_id'=>$request->gender,
            ]);
        }
        $service = PatientService::create([
            'patient_id'=> $patient->id ?? $patient->patient_id,
            'service_id'=>$request->service,
            'comments'=>$request->comments
        ]);
        // Perform an inner join to retrieve the patient and service information
        $result = PatientService::join('tbl_patient', 'tbl_patient_services.patient_id', '=', 'tbl_patient.patient_id')
            ->join('tbl_gender', 'tbl_gender.gender_id', "=", 'tbl_patient.gender_id' )
            ->join('tbl_service', 'tbl_service.service_id', "=", 'tbl_patient_services.service_id' )
            ->select('tbl_patient_services.*', 'tbl_patient.name as patient_name', 'tbl_patient.birth_date as patient_birth_date as dob', 'tbl_gender.gender_name','tbl_service.service_name')
            ->where('tbl_patient_services.patient_service_id', $service->id)
            ->first();

        return response($result, 200);
    }

}
