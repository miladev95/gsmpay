<?php

namespace Tests\Feature;

use App\Infrastructure\Persistence\Eloquent\PostModel;
use App\Infrastructure\Persistence\Eloquent\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class ApiIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_login()
    {
        $user = UserModel::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'username' => $user->username,
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['token'], 'server_time']);
    }

    public function test_authenticated_user_can_create_post()
    {
        Sanctum::actingAs(UserModel::factory()->create());

        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'text' => 'This is a test post.'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'title', 'text'], 'server_time']);
    }

    public function test_user_can_view_post_and_visit_is_tracked()
    {
        $post = PostModel::factory()->create();

        $response = $this->getJson("/api/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'title', 'text', 'visit_count'], 'server_time']);
    }

    public function test_user_cannot_increment_visit_count_multiple_times()
    {
        $post = PostModel::factory()->create();

        $this->getJson("/api/posts/{$post->id}");
        $this->getJson("/api/posts/{$post->id}");

        $this->assertEquals(1, $post->fresh()->visit_count);
    }

    public function test_user_can_upload_profile_photo()
    {
        Sanctum::actingAs(UserModel::factory()->create());

        $response = $this->postJson('/api/users/profile-photo', [
            'profile_photo' => UploadedFile::fake()->image('profile.jpg')
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['profile_photo'], 'server_time']);
    }
}
