<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientService extends Model
{
    use HasFactory;
    protected $table = 'tbl_patient_services';
    protected $fillable = ['patient_id', 'service_id', 'comments'];
}
