<?php

namespace App\Providers;
use Illuminate\Auth\EloquentUserProvider;


class CustomReceptionProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        
        $query = $this->createModel()->newQuery();

        if (isset($credentials['provider']) && $credentials['provider'] === 'reception') {
            $query->where('user_catalogue_id', config('apps.general.reception_id'));
        }

        unset($credentials['provider']);

        foreach ($credentials as $key => $value) {
            if (!str_contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
}
