<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function getEmployee(): object
    {
        return response()->json(Employee::all(), 200);
    }

    public function getEmployeeById($id): object
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return response()->json(['message' => 'Employee Not Found'], 404);
        }
        return response()->json($employee, 200);
    }

    public function addEmployee(Request $request): object
    {
        $employee = Employee::create($request->all());
        return response($employee, 201);
    }

    public function updateEmployee($id, Request $request): object
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return response()->json(['message' => 'Employee Not Found'], 404);
        }

        $employee->update($request->all());
        return response($employee, 200);
    }

    public function deleteEmployee($id): object
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            return response()->json(['message' => 'Employee Not Found'], 404);
        }
        $employee->delete();
        return response()->json(null, 204);
    }

}
