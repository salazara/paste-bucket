<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasteController extends Controller
{

    // user must be authenticated to use paste controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paste_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'paste_title' => 'required',
                'paste_content' => 'required'
            ]
        );

        $paste = new Paste;

        $paste->title = $request['paste_title'];
        $paste->content = $request['paste_content'];
        $paste->user_id = Auth::id();
        $paste->save();

        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        try {

            $id = $request['id'];
            $paste = Paste::find($id);

            if($paste){

                return view('paste_show', ['paste' => $paste]);

            } else {

                return redirect()->route('home');

            }

        } catch (\Exception $e) {

            return redirect()->route('home');
        
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        try {

            $id = $request['id'];
            $paste = Paste::find($id);

            if($paste->user_id == Auth::id()){

                return view('paste_edit', ['paste' => $paste]);

            } else {

                return redirect()->route('home');

            }

        } catch (\Exception $e) {

            return redirect()->route('home');
        
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate(
            $request,
            [
                'id' => 'required',
                'paste_title' => 'required',
                'paste_content' => 'required'
            ]
        );

        try {

            $id = $request['id'];
            $paste = Paste::find($id);

            if($paste->user_id == Auth::id()){

                $paste->title = $request['paste_title'];
                $paste->content = $request['paste_content'];
                $paste->save();

            }

            return redirect()->route('home');

        } catch (\Exception $e) {

            return redirect()->route('home');
        
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        try {

            $id = $request['id'];
            $paste = Paste::find($id);

            if($paste->user_id == Auth::id()){

                $paste->delete();

            }

            return redirect()->route('home');

        } catch (\Exception $e) {

            return redirect()->route('home');
        
        }

    }
}
