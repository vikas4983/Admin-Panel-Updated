<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use App\Models\SuccessStory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Traits\ModelCountsTrait;

class SuccessStoryController extends Controller
{
    use ModelCountsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $successStories = SuccessStory::orderByDesc('created_at')->paginate(10);
        $url = request()->path();
        $segments = explode('/', $url);
        $lastSegment = end($segments);
        $urlName = '/' . $lastSegment;
        
        $this->indexCount(SuccessStory::class, $urlName);
        return view('admin.successStories.index', compact('successStories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.successStories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSuccessStoryRequest $request)
    {
        $validatedData = $request->validated();
        dump($validatedData);
        if ($request->hasFile('wedding_image')) {
            $file = $request->file('wedding_image');

            if ($validatedData) {
                $imageName = rand(100, 1000) . time() . $file->getClientOriginalName();
                $imagePath = public_path('storage/admin/successStory/');
                $file->move($imagePath, $imageName);
                $userId = Auth::user()->id;
                if ($userId && !SuccessStory::where('user_id', $userId)->exists()) {
                    $success = SuccessStory::create([
                        'user_id' => $userId,
                        'wedding_image' => $imageName,
                        'groom_name' => $validatedData['groom_name'] ?? null,
                        'bride_name' => $validatedData['bride_name'] ?? null,
                        'wedding_date' => $validatedData['wedding_date'] ?? null,
                        'description' => $validatedData['description'] ?? null,
                        'status' => $validatedData['status'] ?? null,
                    ]);
                    return redirect('admin/successStories')->with('success', 'Success story added successfully!');
                } else {

                    return redirect()->back()->with('error', 'Something Went Wrong!');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuccessStory $successStory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuccessStory $successStory)
    {
        return view('admin.successStories.edit', compact('successStory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory)
    {
        $validatedData = $request->validated();
        //dump($validatedData);
        $userId = Auth::user()->id;
        if ($request->hasFile('wedding_image')) {
            $file = $request->file('wedding_image');

            if ($validatedData) {
                $imageName = rand(100, 1000) . time() . $file->getClientOriginalName();
                $imagePath = public_path('storage/admin/successStory/');
                $file->move($imagePath, $imageName);

                $previouseImagePath = $imagePath . $successStory->wedding_image;

                if (File::exists($previouseImagePath)) {
                    File::delete($previouseImagePath);
                }
                if ($userId) {
                    $successStory = SuccessStory::find($successStory->id);
                    $successStory->update([
                        'user_id' => $userId,

                        'groom_name' => $validatedData['groom_name'] ?? null,
                        'bride_name' => $validatedData['bride_name'] ?? null,
                        'wedding_date' => $validatedData['wedding_date'] ?? null,
                        'description' => $validatedData['description'] ?? null,
                        'status' => $validatedData['status'] ?? null,
                    ]);
                    return redirect('admin/successStories')->with('success', 'Success story Updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Something Went Wrong!');
                }
            }
        } else {
            if ($validatedData && $userId) {
                $successStory = SuccessStory::find($successStory->id);
                $successStory->update(
                    $validatedData
                );
                return redirect('admin/successStories')->with('success', 'Success story Updated successfully!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuccessStory $successStory)
    {

        if ($successStory) {
            // Delete the record from the database
            $successStory->destroy($successStory->id);
            $imagePath = public_path('storage/admin/successStory/');
            $previouseImagePath = $imagePath . $successStory->wedding_image;
            // Delete the image file if it exists
            if (File::exists($previouseImagePath)) {
                File::delete($previouseImagePath);
            }

            return redirect('admin/successStories')->with('success', 'Success story deleted successfully!');
        } else {
            return redirect('admin/successStories')->with('error', 'Success story not found.');
        }
    }
}
