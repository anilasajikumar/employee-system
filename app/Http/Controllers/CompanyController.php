<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //
    public function index()
    { 
        $companies = Company::orderBy('id','desc')->paginate(5);
        return view('companies.index', compact('companies'));
    }
    public function create()
    {
        return view('companies.create');
    }
    public function store(Request $request)
    { 
      $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required'
            
            
        ]); 
         
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images'); 
            $image->move($destinationPath, $name);
            
        }
        $cmp = new Company;
        $cmp->name = $request->name;
        $cmp->email = $request->email;
        $cmp->website = $request->website;
        $cmp->file_path = $destinationPath ;
        $cmp->save();

       return redirect()->route('companies.index')->with('success','Company has been created successfully.');
    }
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        $company->fill($request->post())->save();

        return redirect()->route('companies.index')->with('success','Company Has Been updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been deleted successfully');
    }

}
