<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

// Muchas aplicaciones web consisten en acciones de CRUD (Create Read Update Delete) sobre diferentes recursos. Los controladores de recursos crea todas las rutas necesaria y métodos de los controladores por nosotros -> "sail artisan make:controller PostsController --resource". Diagrama adjunto ayuda a entender que rutas y métodos son necesarios crear y desarrollar para la funcionalidad CRUD.
class PostsController extends Controller
{
    // private $posts = [
    //     1 => [
    //         'title' => 'Intro to Laravel',
    //         'content' => 'This is a short intro to Laravel',
    //         'is_new' => true,
    //         'has_comments' => true
    //     ],
    //     2 => [
    //         'title' => 'Intro to PHP',
    //         'content' => 'This is a short intro to PHP',
    //         'is_new' => false
    //     ],
    //     3 => [
    //         'title' => 'Intro to Golang',
    //         'content' => 'This is a short intro to Golang',
    //         'is_new' => false
    //     ]
    // ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // El método all() devuelve todos los registros de la tabla de los más antiguos a los más recientes primero por defecto
        return view('posts.index', ['posts' => BlogPost::all()]);
        // En caso de necesitar un orden diferente se puede usar el método orderBy. El método take limita cuantos items se quieren devolver de la consulta
        // return view('posts.index', ['posts' => BlogPost::orderBy('created_at', 'desc')->take(3)->get()]);

        // Recordar que estos mñetodos existen tanto en el query builder como en las coleciones de modelos despues de que las consultas son ejecutadas. El método take() es un ejemplo en el query builder, puede añadir un límite pero añadiendolo despues de la llamada al método get() puede operar en los registros resultantes. Esto significa que acidentalmente se pueden pasar consultas ineficientes. La mejor manera de aprender es probar diferentes consultas, por lo que la mejor manera es ejecutarlas en tinker.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);
        // con el método findOrFail() no necesitamos el método abort_if()
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
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
    public function destroy($id)
    {
        //
    }
}
