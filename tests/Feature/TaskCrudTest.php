<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    // SetUp
    public function setUp(): void
    {
        parent::setUp();

        // yetkileri tanımlıyoruz
        $role = Role::create(['name' => 'admin']);
        $task_list = Permission::create(['name' => 'task.list']);
        $task_create = Permission::create(['name' => 'task.create']);
        $task_edit = Permission::create(['name' => 'task.edit']);
        $task_destroy = Permission::create(['name' => 'task.destroy']);
        $task_store = Permission::create(['name' => 'task.store']);
        $task_update = Permission::create(['name' => 'task.update']);

        $role->givePermissionTo($task_list);
        $role->givePermissionTo($task_create);
        $role->givePermissionTo($task_edit);
        $role->givePermissionTo($task_destroy);
        $role->givePermissionTo($task_store);
        $role->givePermissionTo($task_update);

        // oluştur ve giriş yap
        $this->actingAs($user = \App\Models\User::factory()->create());

        // rolü kullanıcıya ata
        $user->assignRole('admin');
    }

    // Oluşturma Testi
    public function test_task_can_be_created()
    {
        // Başka bir kullanıcı tanımla
        $user = \App\Models\User::factory()->create();

        $response = $this->post('/tasks',
        [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'start_date' => '2021-10-10',
            'end_date' => '2021-10-11',
            'assigned_to' => $user->id,
            'priority' => 'medium',
            'status' => 'done',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'start_date' => '2021-10-10',
            'end_date' => '2021-10-11',
            'assigned_to' => $user->id,
            'priority' => 'medium',
            'status' => 'done',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'start_date' => '2021-10-10',
            'end_date' => '2021-10-11',
            'assigned_to' => $user->id,
            'priority' => 'medium',
            'status' => 'done',
        ]);
    }

    // Düzenleme Testi
    public function test_task_can_be_updated()
    {
        $task = Task::factory()->create();

        $response = $this->put('/tasks/' . $task->id,
        [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'start_date' => '2021-10-10',
            'end_date' => '2021-10-11',
            'assigned_to' => $task->assigned_to,
            'priority' => 'medium',
            'status' => 'done',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'title' => 'Test Task',
            'description' => 'Test Description',
            'start_date' => '2021-10-10',
            'end_date' => '2021-10-11',
            'assigned_to' => $task->assigned_to,
            'priority' => 'medium',
            'status' => 'done',
        ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'start_date' => '2021-10-10',
            'end_date' => '2021-10-11',
            'assigned_to' => $task->assigned_to,
            'priority' => 'medium',
            'status' => 'done',
        ]);
    }

    // Silme Testi
    public function test_task_can_be_deleted()
    {
        $task = Task::factory()->create();

        $response = $this->delete('/tasks/' . $task->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    // Listeleme Testi
    public function test_task_can_be_listed()
    {
        $tasks = Task::factory()->count(5)->create();

        $response = $this->get('/tasks');

        $response->assertStatus(200);

        $response->assertJsonCount(5);
    }

}
