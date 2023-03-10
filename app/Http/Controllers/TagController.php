<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index');
    }


    public function list(Request $request)
    {

        
        $category = Tag::query()
            ->when(!$request->order, function ($query) {
                $query->latest();
            });


        return datatables()
            ->eloquent($category)
            ->addColumn('action', function ($tag) {
                return '
                    
                <form onsubmit="destroy(event)" action="'.route('tag.destroy', $tag->id) .'" method="POST">
                <input type="hidden" name="_token" value="'. @csrf_token() .'">
                <input type="hidden" name="_method" value="DELETE">
                <button class="butn-hapus" >
                <i class="fa fa-trash"></i>
                </button>
            </form>

                        <a href="'. route('tag.edit', $tag->id).'" class="butn-info" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
    </svg>
                        </a>
                    
                ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

//halaman create
    public function create()
    {
        return view('tag.create');
    }

// input tag 
    public function store(Request $request)
    {
        // Validate Request //
        $request->validate(
            [
                'nama' => 'required|string',
                'description' => 'nullable|string',
            ]
        );

        $data = [
            'created_by' => auth()->user()->nama,
            'nama' => $request->nama,
            'description' => $request->description

        ];
        Tag::create($data);
        return redirect('/tag')->with('success', 'Tag Created Successfully!');
    }


    // edit tag
    public function edit($id) 
    {
        $tag = Tag::find($id);
        return view('tag.update', compact('tag'));
    }

    
    public function update(Request $request, Tag $tag)
    {
        // Validate Request //
        $request->validate(
            [
                'nama' => 'required|string',
                'description' => 'string|nullable',

            ]
        );

        $data = [
            'nama' => $request->nama,
            'created_by' => $request->created_by,
            'description' => $request->description
        ];

        $findTag = Tag::find($tag->id);
        $findTag->update($data);

        return redirect('/tag')->with('success', 'Tag Updated Successfully!');
    }

    
    // hapus tag
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->back()->with('success', 'User has been Deleted!');;
    }
}
