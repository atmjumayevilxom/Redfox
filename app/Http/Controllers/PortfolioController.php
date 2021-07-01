<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
class PortfolioController extends Controller
{
    public function index()
    {
        $data['portfolios'] = Portfolio::orderBy('id','desc')->paginate(5);
    
        return view('portfolios.index', $data);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portfolios.create');
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
            'title_uz' => 'required',
            'title_ru' => 'required',
            'title_en' => 'required',
            'catid'    => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
   
        ]);
        $path = $request->file('image')->store('public/images');
        $portfolio = new Portfolio;
        $portfolio->title_uz = $request->title_uz;
        $portfolio->title_ru = $request->title_ru;    
        $portfolio->title_en = $request->title_en;
        $portfolio->catid = $request->catid;
        $portfolio->image = $path;
        $portfolio->save();
     
        return redirect()->route('portfolios.index')
                        ->with('success','portfolio has been created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(portfolio $portfolio)
    {
        return view('portfolios.show',compact('portfolio'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(portfolio $portfolio)
    {
        return view('portfolios.edit',compact('portfolio'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title_uz' => 'required',
            'title_ru' => 'required',
            'title_en' => 'required',
            'catid'=> 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
       
        ]);
        
        $portfolio = Portfolio::find($id);
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $portfolio->image = $path;
        }
        $portfolio->title_uz = $request->title_uz;
        $portfolio->title_ru = $request->title_ru;    
        $portfolio->title_en = $request->title_en;
        $portfolio->catid = $request->catid;
        $portfolio->image = $path;
        $portfolio->save();
    
        return redirect()->route('portfolios.index')
                        ->with('success','portfolio updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(portfolio $portfolio)
    {
        $portfolio->delete();
    
        return redirect()->route('portfolios.index')
                        ->with('success','portfolio has been deleted successfully');
    }
}
