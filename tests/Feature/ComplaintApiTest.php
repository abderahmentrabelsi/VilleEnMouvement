<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComplaintApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_complaint()
    {
        $complaintData = [
            'title' => 'Test Complaint',
            'description' => 'This is a test complaint.',
        ];

        $response = $this->post('/api/complaints', $complaintData);

        $response->assertStatus(201);
    }

    public function test_can_list_complaints()
    {
        $response = $this->get('/api/complaints');

        $response->assertStatus(200);
    }

    public function test_can_update_complaint()
    {
        $complaint = factory(Complaint::class)->create();

        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated description.',
        ];

        $response = $this->put("/api/complaints/{$complaint->id}", $updateData);

        $response->assertStatus(200);
    }

    public function test_can_delete_complaint()
    {
        $complaint = factory(Complaint::class)->create();

        $response = $this->delete("/api/complaints/{$complaint->id}");

        $response->assertStatus(204);
    }
}
