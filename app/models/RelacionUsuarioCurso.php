<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Relacion_usuario_curso extends Eloquent implements UserInterface, RemindableInterface 
{
 
 	use UserTrait, RemindableTrait;

	public $errors;
    // protected $primaryKey = 'id_pregunta';
 
 	protected $table = 'pregunta_leccion';
 	$table->primary(array('id_usuario', 'id_curso', 'tipo_relacion'));
 	 	
 	protected $fillable = array('id_usuario', 'id_curso', 'tipo_relacion', 'fecha_creacion');

	//protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

	public function isValid($data)
    {
		$rules = array(
            'id_usuario' => 'required|numeric',
            'id_curso' => 'required|numeric',
            'tipo_relacion' => 'required',
            'fecha_creacion' => 'required'
        );
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;

    }
    
    public function validAndSave($data)
    {
        // Revisamos si la data es válida
        if ($this->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $this->fill($data);
            // Guardamos el usuario
            $this->save();
            
            return true;
        }
        
        return false;
    }
    
    
}
