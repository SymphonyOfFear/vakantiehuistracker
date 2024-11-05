<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('home page can be accessed', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
