<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::latest()->paginate(10);
        $users= User::all();
        $groups= Group::all();


        return view('home.index', compact('posts', 'users','groups'));

    }

    public function filter(Request $data)
    {
        $posts= Post::where('group_id', '=', $data['id'])->latest()->paginate(10);
        $users= User::all();
        $groups= Group::all();

        return view('home.index', compact('posts', 'users','groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(array $data)
    {
         return Validator::make($data, [
             'body' => ['required', 'string', 'max:255'],
             'image' => ['required', 'string'],

         ]);
    }

    public function create(Request $data)
    {
      $ruta= request()->file('avatar')->store('public');
       $nombreArchivo= basename($ruta);

       $post = Post::create([
        'body' => $data['body'],
        'image' => $nombreArchivo,
        'group_id' => $data['actividad'],
        'etiqueta_id' => $data['etiqueta'],
        'user_id' => Auth::id(),
      ]);
        return redirect('/index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        Post::create([
            'body'=> $data['body'],
            'image' => $data['image'],
            'group_id' => $data['actividad'],
            'etiqueta_id' => $data['etiqueta'],
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy(Request $request) {
      $post = Post::findOrFail($request->id);
      $post->delete();

      return redirect('/index');
    }

}