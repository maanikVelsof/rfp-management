<?php

/**
 * @BOC
 * @Task #160741 Develop RFP Management System
 * @Author Maanik Arya 
 * @date 31-05-2025
 * @Description This is the controller for the category management in the RFP Management System.
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RfpCategory;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = RfpCategory::orderBy('id', 'desc');
        Log::info('Category Query SQL: ' . $query->toSql());
        $categories = $query->paginate(5);
        Log::info('Category IDs in order: ' . $categories->pluck('id'));
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|unique:rfp_categories,name',
                'status' => 'required|in:0,1'
            ]);

            RfpCategory::create([
                'name' => $validated['name'],
                'status' => (bool) $validated['status']
            ]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category Created Successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to create category: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create category. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $category = RfpCategory::findOrFail($id);
            return view('admin.categories.show', compact('category'));
        }catch(\Exception $e){
            // Log the error
            Log::error('Failed to show category: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error' , 'Category not found!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RfpCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RfpCategory $category)
    {
        try{
            $requestedData = $request->validate([
                'name' => 'required|string|unique:rfp_categories,name,' . $category->id,
                'status' => 'required|boolean'
            ]);

            $category->update($requestedData);

            return redirect()->route('admin.categories.index')->with('success','Category updated!');
        }catch(\Exception $e){
            // Log the error
            Log::error('Failed to update category: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error' , 'Failed to update category!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RfpCategory $category)
    {
        try{
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted!');
        }catch(\Exception $e){
            // Log the error
            Log::error('Failed to delete category: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'Failed to delete category!');
        }
    }
}
