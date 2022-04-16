<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home.index', []);
// })->name('home.index');

// Las rutas que devuelven una vista sin pasar parámetros se pueden simplificar, el primer parámetro pasado a la vista el la ruta y el segundo el template. Esta ruta es equivalente a la anterior
Route::view('/','home.index')->name('home.index');

// Route::get('/contact', function(){
//     return view('home.contact');
// })->name('home.contact');

Route::view('/contact','home.contact')->name('home.contact');


$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ],
    3 => [
        'title' => 'Intro to Golang',
        'content' => 'This is a short intro to Golang',
        'is_new' => false
    ]
];

// Ademas de los parámetros de Route se pueden aceptar entradas arbitrarias como los parámetros de consulta enviados a traves de un formulario HTML o una interfaz y formato de solicitud. Antes de hablar de los formularios y enviar json, veamos un ejemplo de consulta simple con parámetros en la url.
Route::get('/posts', function() use($posts) {
    // Las entradas son accesibles mediante los métodos del objeto request, pero como accedemos al objeto request? Hay dos formas usando la función request o escribiendo un argumento con el request "Request $request" que debe ser importado de Illuminate\Http ambas formas son correctas. Usaremos la función.
    // dd(request()->all('page', 1)); // Con el método all() tenemos acceso a todas las entradas pero no da acceso a los parámetros del route si existen. Podemos usar la funcion dd() "dump and die" para ver la entrada disponible volcando los datos rapidamente en pantalla y deteniendo la ejecución.Podemos probarlo limit y page /posts?limit=10&page=5. Se devuelve una matriz y podemos recuperar los campos individuales con el método input() del objeto request()
    // dd((int)request()->input('page', 1)); // el método input permite especificar un valor por defecto en la solicitud usando el segundo parámetro.
    // Hay un métod de consulta especial si desea obtener el valor de solo un parámetro de consulta
    dd((int)request()->query('page', 1));
    // El método input() buscará los nombres en todas los posibles entradas (query parameters, data center, formularios o json) mientras que la función query() es especificamente solo para query parameters.
    // compact($posts) equivale a ['posts' => $posts]
    return view('posts.index', ['posts' => $posts]);
})->name('posts.index');

// Pasando parametros a la ruta parametros obligatorios y restricciones que también se pueden indicar en el fichero RouteServiceProvider.php línea 40 y no es necesario el where
Route::get('posts/{id}', function ($id) use ($posts) {
    // Si el parámetro pasado no existe se aborta la operación con un error 404 not found
    abort_if(!isset($posts[$id]), 404);
    // Pasando datos a un template para renderizarlos
    return view('posts.show', ['post' => $posts[$id]]);
})
    // ->where([
    //     'id' => '[0-9]+'
    // ])
    ->name('posts.show');

//Pasando parámetros opcionales
Route::get('/recent-posts/{days_ago?}', function($daysAgo = 20){
    return 'Posts from ' . $daysAgo . ' days ago.';
})->name('posts.recent.index')->middleware('auth');

// Responses, Codes, Headers and Cookies
// Route::get('/fun/responses', function() use($posts) {
//     // helper response() tiene los métodos header y cookie y acepta 3 parámetros, todos opcionales, el primero el content, elsegundo el status code y el tercero un array de response headers. El método header() estable los headers de la respuesta por ejemplo el Content-type de tipo json. El método cookie() establece las cookies del navegador con nombre, valor y tiempo de expiración
//     return response($posts, 201, )
//         ->header('Content-Type', 'application/json')
//         ->cookie('MY_COOKIE', 'Jesus Martin', 3600);
// });

// // Cuando utilizar el helper response() en lugar del helper view(), se debe usar el helper response() cuando necesitamos establecer un header o una cookie o cambiar el codigo del status de la respuesta, por otra parte el helper response() crea un objeto de respuestael cual también contiene el método view que acepta lo mismos argumentos que el helper view(). También se puede pues renderizar vistas de blade añadiendo headers, cookies y cambiando el status code. Tambien es una manera sencilla de devolver un json añadiendo contenido de tipo header explicitamente.

// // Redirección a otra página
// Route::get('/fun/redirect', function() {
//     // uso de la función helper redirect() devuelve una respuesta 302 tras redireccionar
//     return redirect('/contact');
// });

// Route::get('/fun/back', function() {
//     // uso de la función helper back() que redirecciona a la última dirección
//     return back();
// });

// Route::get('/fun/named-route', function() {
//     // uso de la función helper redirec() y la función helper route a la cual se le indica una nombre de ruta y se pueden pasar parametros como un array de argumentos en segunda posición
//     return redirect()->route('posts.show', ['id' => 1]);
// });

// Route::get('/fun/away', function() {
//     // uso de la función helper away() que redirecciona a una url externa que se le pasa como parámetro
//     return redirect()->away('https://google.com');
// });

// // Algunas veces solo necesitamos devolver los datos de la respuesta sin ningún HTML en muchos casos en formato json
// Route::get('/fun/json', function() use($posts) {
//     // uso de la función helper response() que utiliza el método json es la forma más sencilla de conseguirlo la función anónima hace uso de la variable con los datos para poder ser usada en el método json
//     return response()->json($posts);
// });

// // Es sencillo forzar al navegador a descargar un fichero, se puede conseguir usando el metodo download del objeto response
// Route::get('/fun/download', function() use($posts) {
//     // llamamos a la función helper response() que devuelve el objeto respuesta y entonces llamamos al método download, su primer argumento es el path del fichero y para obtenerlo llamamos a la funcion helper public_path(), el segundo argumento es un nombre opcional, el usuario verá si necesita ser diferente del original, el tercero es una lista de headers opcionales a devolver en  forma de array, y no podremos añadir ningun header adicional
//     return response()->download(public_path('/daniel.jpg'), 'face.jpg', );
// });

// Algunas de las rutas anteriores presentan en común el mismo prefijo /fun y laravel nos permite agruparlas. Las rutas se pueden agrupar por atributos compartidos como:
//  .Prefijo URL
//  .Prefijo name
//  .Middleware

Route::prefix('/fun')->name('fun.')->group(function() use($posts) {
    // Dentro de la función anónima movemos todas las declaraciones de rutas que contienen los parámetros o atributos anteriores y hay que asegurarse de añadir la nueva declaración para cualquier variable fuera del contexto que se utiliza
    Route::get('responses', function() use($posts) {
        return response($posts, 201, )
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE', 'Jesus Martin', 3600);
    })->name('responses');


    // Redirección a otra página
    Route::get('redirect', function() {
        return redirect('/contact');
    })->name('redirect');

    Route::get('back', function() {
        return back();
    })->name('back');

    Route::get('named-route', function() {
        return redirect()->route('posts.show', ['id' => 1]);
    })->name('named-route');

    Route::get('away', function() {
        return redirect()->away('https://google.com');
    })->name('away');

    Route::get('json', function() use($posts) {
        return response()->json($posts);
    })->name('json');

    Route::get('download', function() use($posts) {
        return response()->download(public_path('/daniel.jpg'), 'face.jpg', );
    })->name('download');
});
