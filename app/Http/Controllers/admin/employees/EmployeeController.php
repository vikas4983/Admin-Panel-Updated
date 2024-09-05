<?php

namespace App\Http\Controllers\admin\employees;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\employees\CreateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Traits\ModelCountsTrait;


class EmployeeController extends Controller
{
    use ModelCountsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees =Employee::orderByDesc('created_at')->paginate(10);
        $count = ($employees->currentPage() - 1) * $employees->perPage();
        // Activbe Count
        $active = Employee::where('status', 1)->count();
        //Inactive Count
        $inActive = Employee::where('status', 0)->count();
        // All Count
        $countAll = Employee::count();
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        $this->indexCount(Employee::class, $urlName);
        return view('admin.employees.index', compact('employees','count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmployeeRequest $request)
    {
        Employee::create([
            'employee' => $request->employee,
            'status' => $request->status
        ]);
        $msg = "Employee Type Added Successfully";

        return redirect('admin/employees')->with('success', $msg);
    }

    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update([
            'employee' => $request->employee,
            'status' => $request->status
        ]);
        $msg = "Employee Type Updated Successfully";

        return redirect('admin/employees')->with('info', $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
       
        $employee->destroy($employee->id);
        $msg = "Employee Type Deleted Successfully";

        return redirect('admin/employees')->with('error', $msg);
    }
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteEmployeeIds = $request->input('selectedDeleteEmployeeIds');
        if (!empty($selectedDeleteEmployeeIds)) {
            $ids = explode(',', $selectedDeleteEmployeeIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $employees = Employee::find($id);
                if ($employees) {
                    $employees->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Employee Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActiveEmployeeIds = $request->input('selectedActiveEmployeeIds');
        if (!empty($selectedActiveEmployeeIds)) {
            $ids = explode(',', $selectedActiveEmployeeIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $employees = Employee::find($id);
                if ($employees) {
                    $employees->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Employee Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactiveEmployeeIds = $request->input('selectedInactiveEmployeeIds');
        if (!empty($selectedInactiveEmployeeIds)) {
            $ids = explode(',', $selectedInactiveEmployeeIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $employees = Employee::find($id);
                if ($employees) {
                    $employees->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Employee inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
