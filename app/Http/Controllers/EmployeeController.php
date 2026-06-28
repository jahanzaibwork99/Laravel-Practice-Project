<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return response()->json([
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validated();

        // Create a new employee using the validated data
        $employee = Employee::create($validatedData);

        return response()->json([
            'message' => 'Employee created successfully',
            'employee' => $employee,
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json([
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validated();

        // Update the employee with the validated data
        $employee->update($validatedData);

        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $employee,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully',
        ]);
    }
}
