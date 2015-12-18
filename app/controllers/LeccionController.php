<?php

class LeccionController extends BaseController 
{
      
     
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lecciones = Leccion::all();
		return View::make('Leccion/lista')->with('lecciones', $lecciones);
   	}
   	
   	
   	
   	public function lista()
   	{
		$lecciones = Leccion::all();
		return View::make('Leccion/lista')->with('lecciones', $lecciones);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$leccion = new Leccion;
		$tematicas = Tematica::lists('nombre','id_tematica');
		return View::make('Leccion/form')->with('leccion', $leccion)->with('tematicas', $tematicas);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$leccion = new Leccion;
		// Obtenemos la data enviada por el materia
		$data = Input::all();
				
		// Revisamos si la data es válido
		if ($leccion->isValid($data))
		{
			// Si la data es valida se la asignamos al materia
			$leccion->fill($data);
			// Guardamos el materia
			$leccion->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			return Redirect::route('leccion.show', array($leccion->id));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('leccion.create')->withInput()->withErrors($leccion->errors);
		}
				
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$leccion = Leccion::find($id);
		return View::make('Leccion/view')->with('leccion', $leccion);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$leccion = Leccion::find($id);
		if (is_null ($leccion))
		{
		App::abort(404);
		}
		
		$form_data = array('route' => array('leccion.update', $leccion->id_leccion), 'method' => 'PATCH');
        $action    = 'Editar';
        
   		$tematicas = Tematica::lists('nombre','id_tematica');
        return View::make('Leccion/form', compact('leccion', 'form_data', 'action'))->with('tematicas', $tematicas);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $leccion = Leccion::find($id);
			$data = Input::all();

		 // Revisamos si la data es válida y guardamos en ese caso
        if ($leccion->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            return Redirect::route('leccion.show', array($leccion->id_leccion));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('leccion.edit', $leccion->id_leccion)->withInput()->withErrors($leccion->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
