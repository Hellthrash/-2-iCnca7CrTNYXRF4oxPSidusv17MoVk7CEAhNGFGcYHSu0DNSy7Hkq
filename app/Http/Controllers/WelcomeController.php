<?php namespace App\Http\Controllers;

use App\Noticia;
use App\Funciones\CvsToArray;

use App\Continente;
use App\Pais;



class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$csvFile = public_path().'/archivos_cvs/paises.csv';
		$areas = new CvsToArray();
		$areas = $areas->csv_to_array($csvFile);
		//dd($areas);
		Pais::insert($areas);
		$noticias = Noticia::where('carousel','si')->get();
		return view('welcome.index',compact('noticias'));
	}

}
