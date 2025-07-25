<?php

use App\Models\Counter;

test('it displays the counter page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('welcome')
            ->has('count')
    );
});

test('it creates counter with zero if none exists', function () {
    $this->assertDatabaseEmpty('counters');

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->where('count', 0)
    );
    
    $this->assertDatabaseHas('counters', ['count' => 0]);
});

test('it can increment the counter', function () {
    $counter = Counter::create(['count' => 5]);

    $response = $this->post('/counter', ['action' => 'increment']);

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('welcome')
            ->where('count', 6)
    );

    $this->assertDatabaseHas('counters', ['count' => 6]);
});

test('it can decrement the counter', function () {
    $counter = Counter::create(['count' => 5]);

    $response = $this->post('/counter', ['action' => 'decrement']);

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->component('welcome')
            ->where('count', 4)
    );

    $this->assertDatabaseHas('counters', ['count' => 4]);
});

test('it defaults to increment when no action specified', function () {
    $counter = Counter::create(['count' => 0]);

    $response = $this->post('/counter');

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->where('count', 1)
    );

    $this->assertDatabaseHas('counters', ['count' => 1]);
});

test('it can decrement below zero', function () {
    $counter = Counter::create(['count' => 0]);

    $response = $this->post('/counter', ['action' => 'decrement']);

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => 
        $page->where('count', -1)
    );

    $this->assertDatabaseHas('counters', ['count' => -1]);
});