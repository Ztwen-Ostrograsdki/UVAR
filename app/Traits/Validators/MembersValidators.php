<?php 

namespace App\Traits\Validators;
use Illuminate\Support\Facades\Validator;



trait MembersValidators {


	    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    protected function EditMemberValidator(array $data, string $except = null)
    {
        if ($except !== null) {
            if ($except == 'name') {
                return Validator::make($data, [
                    'phone' => ['required', 'string','max:25', 'min:8'],
                ]);
            }
            elseif ($except == 'phone') {
                return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255', 'min:5'],
                ]);
            }
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'unique:members', 'max:255', 'min:5'],
            'phone' => ['required', 'string', 'unique:members', 'max:25', 'min:8'],
        ]);
    }
    


}
