<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emailTemplates =EmailTemplate::orderByDesc('created_at')->paginate(10);
        $count = ($emailTemplates->currentPage() - 1) * $emailTemplates->perPage();
        return view('admin.emailTemplates.index', compact('emailTemplates','count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEmailTemplateRequest $request, EmailTemplate $emailTemplate)
    {
       // dd($request->all());
        EmailTemplate::create($request->all());
        return redirect()->back()->with('success', 'Email Template updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        return view('admin.emailTemplates.edit', compact('emailTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailTemplateRequest $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->update($request->all());
        return redirect('admin/emailTemplates')->with('success', 'Email Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->destroy($emailTemplate->id);
        return redirect()->back()->with('success', 'Email Template deleted successfully.');
    }
}
