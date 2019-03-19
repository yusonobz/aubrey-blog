<?php

namespace App\Http\Controllers;

use App\Articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::all();
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validate the Field
         $this->validate($request,[
            'title'=>'required|max:255',
            'content'=>'required',
            'photo' => 'required',
            'photo'=>'image|mimes:jpeg,png,jpg,svg|max:5120'
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        $article = new Articles;
        $article->title = $request->title;
        $article->url = $slug;
        $article->content = $request->content;
        $article->status = $request->status;

        if($request->hasfile('photo'))
         {
            $destinationPath = public_path().'/images/';
            $filename = $slug.'.jpg';
            $request->file('photo')->move($destinationPath, $filename);
            $article->photo = $filename;
         }

         $article->save();
         return redirect()->route('article.index')->with('message','New Article Created Successfull !');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Articles::find($id);
        return view('article.read',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Articles::find($id);
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|max:255',
            'content'=>'required',
            'photo' => 'required',
            'photo'=>'image|mimes:jpeg,png,jpg,svg|max:5120'
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));

        $article = Articles::find($id);
        $article->title = $request->title;
        $article->url = $slug;
        $article->content = $request->content;
        $article->status = $request->status;

        if($request->hasfile('photo'))
         {
            $destinationPath = public_path().'/images/';
            $filename = $slug.'.jpg';
            $request->file('photo')->move($destinationPath, $filename);
            $article->photo = $filename;
         }

         $article->save();
         return redirect()->route('article.index')->with('message','Article Updated Successfull !');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Articles::find($id);
        $filepath = public_path().'/images/'.$article->photo;
        \File::delete($filepath);

        
        $article->delete();
        return back()->with('message','Article Deleted Successfull !');
    }
}
