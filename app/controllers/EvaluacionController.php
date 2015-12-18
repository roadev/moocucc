<?php

class EvaluacionController extends BaseController 
{
      
     
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$evaluaciones = Evaluacion::all();
		return View::make('Evaluacion/lista')->with('evaluaciones', $evaluaciones);
   	}
   	
   	
   	
   	public function lista()
   	{
		$evaluaciones = Evaluacion::all();
		return View::make('Evaluacion/lista')->with('evaluaciones', $evaluaciones);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$evaluacion = new Evaluacion;
		$tematicas = Tematica::lists('nombre','id_tematica');
		return View::make('Evaluacion/form')->with('evaluacion', $evaluacion)->with('tematicas', $tematicas);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Creamos un nuevo objeto para nuestro nuevo materia
		$evaluacion = new Evaluacion;
		// Obtenemos la data enviada por el materia
		$data = Input::all();
				
		// Revisamos si la data es válido
		if ($evaluacion->isValid($data))
		{
			// Si la data es valida se la asignamos al materia
			$evaluacion->fill($data);
			// Guardamos el materia
			$evaluacion->save();
			// Y Devolvemos una redirección a la acción show para mostrar el materia
			return Redirect::route('evaluacion.show', array($evaluacion->id));
		}
		else
		{
			// En caso de error regresa a la acción create con los datos y los errores encontrados
			return Redirect::route('evaluacion.create')->withInput()->withErrors($evaluacion->errors);
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
		$evaluacion = Evaluacion::find($id);
		return View::make('Evaluacion/view')->with('evaluacion', $evaluacion);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$evaluacion = Evaluacion::find($id);
		if (is_null ($evaluacion))
		{
		App::abort(404);
		}
		
		$form_data = array('route' => array('evaluacion.update', $evaluacion->id_evaluacion), 'method' => 'PATCH');
        $action    = 'Editar';
        
   		$tematicas = Tematica::lists('nombre','id_tematica');
        return View::make('Evaluacion/form', compact('evaluacion', 'form_data', 'action'))->with('tematicas', $tematicas);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		   $evaluacion = Evaluacion::find($id);
			$data = Input::all();

		 // Revisamos si la data es válida y guardamos en ese caso
        if ($evaluacion->validAndSave($data))
        {
            // Y Devolvemos una redirección a la acción show para mostrar el materia
            return Redirect::route('evaluacion.show', array($evaluacion->id_evaluacion));
        }
        else
        {
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::route('evaluacion.edit', $evaluacion->id_evaluacion)->withInput()->withErrors($evaluacion->errors);
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
