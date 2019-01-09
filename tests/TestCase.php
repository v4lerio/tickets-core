<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createUser($data = []) {
    	return factory(\App\User::class)->create($data);
    }

    public function signIn($user = null) {
        $user = $user ?? $this->createUser();
        return $this->actingAs($user, 'api');
    }

    protected function create($model, $data = [], $times = null) {
        return factory($model, $times)->create($data);
    }

}
