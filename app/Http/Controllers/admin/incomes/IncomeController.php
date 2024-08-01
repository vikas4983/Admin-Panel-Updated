<?php

namespace App\Http\Controllers\admin\incomes;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\incomes\CreateIncomeRequest;
use App\Http\Requests\admin\incomes\UpdateIncomeRequest;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = Income::orderByDesc('created_at')->paginate(10);
        $count = ($incomes->currentPage() - 1) * $incomes->perPage();
        // Activbe Count
        $active = Income::where('status', 1)->count();
        //Inactive Count
        $inActive = Income::where('status', 0)->count();
        // All Count
        $countAll = Income::count();
        return view('admin.incomes.index', compact('incomes','count', 'active', 'inActive', 'countAll'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateIncomeRequest $request)
    {
        //dd($request->all());
        Income::create([
            'income' => $request->income,
            'status' => $request->status
        ]);
        $msg = "Income  Added Successfully";

        return redirect('admin/incomes')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        return view('admin.incomes.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomeRequest $request, Income $income)
    {
        //dd($request->all());
        $income->update([
            'income' => $request->income,
            'status' => $request->status
        ]);
        $msg = "Income Updated Successfully";

        return redirect('admin/incomes')->with('info', $msg);
       // return redirect('error');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $income->destroy($income->id);
        $msg = "Income Deleted Successfully";

        return redirect('admin/incomes')->with('error', $msg);
    }
    public function checkBoxDelete(Request $request)
    {
        //dd('checkBoxDelete');
        //dd($request->all());
        $selectedDeleteIncomeIds = $request->input('selectedDeleteIncomeIds');
        if (!empty($selectedDeleteIncomeIds)) {
            $ids = explode(',', $selectedDeleteIncomeIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $incomes = Income::find($id);
                if ($incomes) {
                    $incomes->delete(); // Use delete() method to delete a single record
                }
            }

            return redirect()->back()->with('error', 'Selected Income Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }

    public function activeItem(Request $request)
    {

        //dd('activeItem');
        //dd($request->all());
        $selectedActiveIncomeIds = $request->input('selectedActiveIncomeIds');
        if (!empty($selectedActiveIncomeIds)) {
            $ids = explode(',', $selectedActiveIncomeIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $incomes = Income::find($id);
                if ($incomes) {
                    $incomes->update([
                        'status' => 1
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Income Activated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
    public function inActiveItem(Request $request)
    {
        //dd('inActiveItem');
        // dd($request->all());
        $selectedInactiveIncomeIds = $request->input('selectedInactiveIncomeIds');
        if (!empty($selectedInactiveIncomeIds)) {
            $ids = explode(',', $selectedInactiveIncomeIds[0]);

            // Check if you're receiving an array of selected IDs
            foreach ($ids as $id) {
                //dd($id); // Check if each ID is being processed correctly
                $incomes = Income::find($id);
                if ($incomes) {
                    $incomes->update([
                        'status' => 0
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Selected Income inActivated successfully.');
        } else {
            return redirect()->back()->with('error', 'No items selected.');
        }
    }
}
