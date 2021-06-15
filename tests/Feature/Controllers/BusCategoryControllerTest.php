<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BusCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusCategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_bus_categories()
    {
        $busCategories = BusCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bus-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_categories.index')
            ->assertViewHas('busCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bus_category()
    {
        $response = $this->get(route('bus-categories.create'));

        $response->assertOk()->assertViewIs('app.bus_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bus_category()
    {
        $data = BusCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bus-categories.store'), $data);

        $this->assertDatabaseHas('bus_categories', $data);

        $busCategory = BusCategory::latest('id')->first();

        $response->assertRedirect(route('bus-categories.edit', $busCategory));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bus_category()
    {
        $busCategory = BusCategory::factory()->create();

        $response = $this->get(route('bus-categories.show', $busCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_categories.show')
            ->assertViewHas('busCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bus_category()
    {
        $busCategory = BusCategory::factory()->create();

        $response = $this->get(route('bus-categories.edit', $busCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_categories.edit')
            ->assertViewHas('busCategory');
    }

    /**
     * @test
     */
    public function it_updates_the_bus_category()
    {
        $busCategory = BusCategory::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'total seat' => $this->faker->randomNumber(0),
            'seatnumbers' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('bus-categories.update', $busCategory),
            $data
        );

        $data['id'] = $busCategory->id;

        $this->assertDatabaseHas('bus_categories', $data);

        $response->assertRedirect(route('bus-categories.edit', $busCategory));
    }

    /**
     * @test
     */
    public function it_deletes_the_bus_category()
    {
        $busCategory = BusCategory::factory()->create();

        $response = $this->delete(
            route('bus-categories.destroy', $busCategory)
        );

        $response->assertRedirect(route('bus-categories.index'));

        $this->assertDeleted($busCategory);
    }
}
