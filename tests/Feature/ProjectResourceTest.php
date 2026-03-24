<?php

namespace Tests\Feature;

use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create([
            'role' => 'admin',
        ]));
    }

    /** @test */
    public function test_it_can_render_the_project_resource_page()
    {
        $this->get(ProjectResource::getUrl('index'))
            ->assertSuccessful();
    }

    /** @test */
    public function test_it_can_render_the_create_project_page()
    {
        $this->get(ProjectResource::getUrl('create'))
            ->assertSuccessful();
    }

    /** @test */
    public function test_it_can_create_a_project()
    {
        $projectData = Project::factory()->make()->toArray();

        Livewire::test(CreateProject::class)
            ->fillForm($projectData)
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', [
            'title' => $projectData['title'],
        ]);
    }

    /** @test */
    public function test_it_can_list_projects()
    {
        $projects = Project::factory()->count(5)->create();

        Livewire::test(ListProjects::class)
            ->assertCanSeeTableRecords($projects);
    }
}
