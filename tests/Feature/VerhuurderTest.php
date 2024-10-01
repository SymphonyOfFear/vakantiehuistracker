<?php

test('can render verhuurder overview screen', function () {
    $response = $this->get('/verhuurders');
    $response->assertStatus(200);
});
