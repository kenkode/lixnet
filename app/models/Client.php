<?php

class Client extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'name' => 'required',
		 'email_office' => 'email|unique:clients,email',
		 'email_personal' => 'email|unique:clients,contact_person_email',
		 'type' => 'required',
		 'mobile_phone' => 'unique:clients,contact_person_phone',
		 'office_phone' => 'unique:clients,phone',

	];

    public static function rolesUpdate($id)
    {
        return array(
         'name' => 'required',
		 'email_office' => 'email|unique:clients,email,' . $id,
		 'email_personal' => 'email|unique:clients,contact_person_email,' . $id,
		 'type' => 'required',
		 'mobile_phone' => 'unique:clients,contact_person_phone,' . $id,
		 'office_phone' => 'unique:clients,phone,' . $id
        );
    }

    public static $messages = array(
    	'name.required'=>'Please insert client name!',
        'email_office.email'=>'That please insert a vaild email address!',
        'email_office.unique'=>'That office email already exists!',
        'email_personal.email'=>'That please insert a vaild email address!',
        'email_personal.unique'=>'That office email already exists!',
        'mobile_phone.unique'=>'That mobile number already exists!',
        'office_phone.unique'=>'That swift code already exists!',
        'type.required'=>'Please select client type!'
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function erporders(){

		return $this->hasMany('Erporder');
	}

	public function payments(){

		return $this->hasMany('Payment');
	}

}