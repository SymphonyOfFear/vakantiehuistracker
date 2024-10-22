<?php

it('returns a successful response', function () {
    $response = $this->get('home');

    $response->assertStatus(200);
});
