<?php

namespace App\Http\Controllers;

use App\Models\Blocks;
use Illuminate\Http\Request;

class BlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blocks::latest()->paginate(5);
    
        return view('blocks.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'slug' => 'required',
            'text_ru' => 'required',
            'text_uz' => 'required',
            'text_en' => 'required',
        ]);

    
        Blocks::create($request->all());
     
        return redirect()->route('blocks.index')
                        ->with('success','blocks created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blocks  $blocks
     * @return \Illuminate\Http\Response
     */
    public function show(Blocks $blocks)
    {

        return view('blocks.show', compact('blocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blocks  $blocks
     * @return \Illuminate\Http\Response
     */
    public function edit(Blocks $blocks)
    {
        return view('blocks.edit',compact('blocks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blocks  $blocks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blocks $blocks)
    {
        $request->validate([
            'slug' => 'required',
            'text_ru' => 'required',
            'text_uz' => 'required',
            'text_en' => 'required',
        ]);
    
        $block->update($request->all());
    
        return redirect()->route('blocks.index')
                        ->with('success','blocks updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blocks  $blocks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blocks $blocks)
    {
        $block->delete();
    
        return redirect()->route('blocks.index')
                        ->with('success','blocks deleted successfully');
    }
}