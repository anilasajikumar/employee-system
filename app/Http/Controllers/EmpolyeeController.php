<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Company;

use Illuminate\Http\Request;

class EmpolyeeController extends Controller
{
    //

    public function index()
    {
        $employee = Employee::join('companies', 'employee.company_id', '=', 'companies.id')
                             ->select('employee.*','companies.name')
                             ->paginate(5); 
        return view('employee.index', compact('employee'));
    }
    public function create()
    {
        $company = Company::select('id','name')->get(); 
        return view('employee.create',compact('company'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'lastname' => 'required',
           
            
           
        ]); 
        
       
        $emp = new Employee;
        $emp->first_name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->last_name = $request->lastname;
        $emp->company_id = $request->cmp_id;
        $emp->save();

        return redirect()->route('employee.index')->with('success','Company has been created successfully.');
    }
    public function show(Employee $employee)
    {
        return view('employee.show',compact('employee'));
    }
    public function edit(Employee $employee)
    {   
        $company = Company::select('id','name')->get(); 
        return view('employee.edit',compact('employee','company'));
    }
    public function update(Request $request, Employee $employee)
    { 
        $request->validate([
            'firstname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'lastname' => 'required'
        ]);
       
        // $employee->fill($request->post())->save();
        
        $emp = Employee::find($employee->id); 
        $emp->first_name = $request->firstname;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->last_name = $request->lastname;
        $emp->company_id = $request->cmp_id;
        $emp->save();

        return redirect()->route('employee.index')->with('success','Company Has Been updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success','Company has been deleted successfully');
    }
}
