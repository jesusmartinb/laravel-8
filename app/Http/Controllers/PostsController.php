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
        // Necesitamos estar seguros que las entradas pueden cumplir con ciertas restricciones como la necesidad de tener una longitud determinada, ser de un tipo concreto como un número o estar presente. La validación de los datos de entrada es facil y muy conveniente. El objeto request utiliza el método validate(). Hay muchas reglas de validación. El método validate acepta un array donde la clave es la propiedad del input a validar y el valor es una colección de reglas de validación. Las reglas de validación serán un string con las reglas separadas por un caracter pipe | o un array de reglas. Es normal tener más de una regla de validación en una única propiedad, pero si se prefiere utilizar solo la primera y evitar que el resto de las reglas de un campo se ejecuten debemos introducir la regla "bail" en primer lugar.
        $request->validate([
            'title' => 'bail|required|min:5|max:100',
            'content' => 'required|min:10'
        ]);

        // Para almacenar los datos primero necesitamos una nueva instancia del modelo igual a una variable $post. Hay que asegurarse de importar el modelo
        $post = new BlogPost();
        // Segundo asignar a  las propiedades, en este caso title y content la lectura de los input usando el método input del objeto request
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        // llamamos al método save() del objeto modelo para registrar el nuevo registro en la BD
        $post->save();
        // podemos mostrar un mensaje de exito o redirigir a otra página, en este caso redirigimos para mostrar el mismo registro insertado pasando el valor del campo id al método route() pasado como un segundo parámetro
        return redirect()->route('posts.show', ['post' => $post->id]);
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
