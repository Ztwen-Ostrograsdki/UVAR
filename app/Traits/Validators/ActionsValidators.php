<?php 

namespace App\Traits\Validators;
use Illuminate\Support\Facades\Validator;



trait ActionsValidators {


	    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    protected function validateAction(array $data, string $except = null)
    {
        if ($except !== null) {
            if ($except == 'name') {
                return Validator::make($data, [
                    'name' => ['required', 'string', 'max:50', 'min:5', 'bail'],
                    'description' => ['required', 'string', 'max:255', 'min:5', 'bail'],
                    'price' => ['required', 'numeric', 'min:5', 'bail'],
                    'total' => ['required', 'numeric', 'min:1', 'bail'],
                ]);
            }
            elseif ($except == 'phone') {
                return Validator::make($data, [
                    'name' => ['required', 'string', 'unique:actions', 'max:50', 'min:5', 'bail'],
                    'description' => ['required', 'string', 'max:255', 'min:5', 'bail'],
                    'price' => ['required', 'numeric', 'min:5', 'bail'],
                    'total' => ['required', 'numeric', 'min:1', 'bail'],
                ]);
            }
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'unique:actions', 'max:50', 'min:5', 'bail'],
            'description' => ['required', 'string', 'max:255', 'min:5', 'bail'],
            'price' => ['required', 'numeric', 'min:5', 'bail'],
            'total' => ['required', 'numeric', 'min:1', 'bail'],
        ]);
    }
    


}
