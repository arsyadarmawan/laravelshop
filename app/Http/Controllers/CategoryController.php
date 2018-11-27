<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = \App\Category::paginate(5);        
        $filterKeyword = $request->get('name');
        //mencari request dari filter name

        if ($filterKeyword) {
            $categories = \App\Category::where("name", "LIKE","%$filterKeyword%")->paginate(5);
        }
        
        return view('categories.index', ['categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $new_category =  new \App\Category;
        $new_category->name =$name;
        
        if ($request->file('image')) {
            $imagepath = $request->file('image')->store('category_image','public');
            $new_category->image = $imagepath; 
        } else {
            return redirect()->route('categories.create')->with('status', 'file gagal diupload');
        }

        //untk menentukan siapa yang menyimpan dengan id
        $new_category->created_by =  \Auth::user()->id;
        
        $new_category->slug =  str_slug($name, '-');
        $new_category->save();
        return redirect()->route('categories.index')->with('status', 'categori dapat dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = \App\Category::findorFail($id);
        return view('categories.show',['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = \App\Category::FindorFail($id);
        return view('categories.edit',['category'=> $category]);
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
        $name = $request->get('name');
        $slug = $request->get('slug');
        
        $category = \App\Category::findorFail($id);
        $category->name = $name;
        $category->slug = $slug;

        if ($request->file('image')) {
            if($category->image && file_exists(storage_path('app/public/'. $category->image))){
                \Storage::delete('public/'. $category->name);
            } 
            $new_image = $request->file('image')->store('categories_image','public');
            $category->image = $new_image;
        } 
        $category->updated_by = \Auth::user()->id;
        $category->slug = str_slug($name);
        $category->save();

        return redirect()->route('categories.index', ['id' => $id])->with('status','Category successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Category::findorFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('status','Category successfully moved to trash');
    }

    public function trash(){
        // untuk mendapatkan hanya kategori yang status nya soft delete yaitu yang
        // field deleted_at nya tidak NULL.
        $deleted_category = \App\Category::onlyTrashed()->paginate(5); 
        return view('categories.trash', ['categories' => $deleted_category]);
    }

    public function restore($id)
    {
        $category = \App\Category::withTrashed()->findorFail($id);

        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route('categories.index')->with('status','Category is not in trash');
        }
        
        return redirect()->route('categories.index')->with('status','Categorry successfuly restored');
    }

    public function deletepermanent($id)
    {
        $category = \App\Category::withTrashed()->findorFail($id);
        
        if (!$category->trashed()) {
            return redirect()->route('categories.index')->with('status','cant delete permanently');
        } else {
            $category->forceDelete();
            return redirect()->route('categories.index')->with('status','Category delete permanently');
        }
        
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');
        $categories = \App\Category::where("name", "LIKE", "%$keyword%")->get();
        return $categories;
    }
       
}
