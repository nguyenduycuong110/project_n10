<?php

namespace App\Providers;
use Illuminate\Auth\EloquentUserProvider;


class ConsultProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        
        $query = $this->createModel()->newQuery();

        if (isset($credentials['provider']) && $credentials['provider'] === 'consultation') {
            $query->where('user_catalogue_id', config('apps.general.doctor_id'));
        }

        unset($credentials['provider']);

        foreach ($credentials as $key => $value) {
            if (!str_contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        $user = $query->first();

        if($user){
            $userClinic = $query->join('clinics as tb2','tb2.user_id','=','users.id')
            ->join('departments as tb3','tb3.id','=','users.department_id')
            ->select(
                'users.*',
                'tb2.name as clinic_name',
                'tb2.code as clinic_code',
                'tb3.name as department_name'
            )
            ->where('users.id', $user->id)
            ->first();
            return $userClinic;
        }
    }
}
