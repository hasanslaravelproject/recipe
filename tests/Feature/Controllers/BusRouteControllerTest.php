<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BusRoute;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusRouteControllerTest extends TestCase
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
    public function it_displays_index_view_with_bus_routes()
    {
        $busRoutes = BusRoute::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bus-routes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_routes.index')
            ->assertViewHas('busRoutes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bus_route()
    {
        $response = $this->get(route('bus-routes.create'));

        $response->assertOk()->assertViewIs('app.bus_routes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bus_route()
    {
        $data = BusRoute::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bus-routes.store'), $data);

        $this->assertDatabaseHas('bus_routes', $data);

        $busRoute = BusRoute::latest('id')->first();

        $response->assertRedirect(route('bus-routes.edit', $busRoute));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bus_route()
    {
        $busRoute = BusRoute::factory()->create();

        $response = $this->get(route('bus-routes.show', $busRoute));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_routes.show')
            ->assertViewHas('busRoute');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bus_route()
    {
        $busRoute = BusRoute::factory()->create();

        $response = $this->get(route('bus-routes.edit', $busRoute));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_routes.edit')
            ->assertViewHas('busRoute');
    }

    /**
     * @test
     */
    public function it_updates_the_bus_route()
    {
        $busRoute = BusRoute::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->put(route('bus-routes.update', $busRoute), $data);

        $data['id'] = $busRoute->id;

        $this->assertDatabaseHas('bus_routes', $data);

        $response->assertRedirect(route('bus-routes.edit', $busRoute));
    }

    /**
     * @test
     */
    public function it_deletes_the_bus_route()
    {
        $busRoute = BusRoute::factory()->create();

        $response = $this->delete(route('bus-routes.destroy', $busRoute));

        $response->assertRedirect(route('bus-routes.index'));

        $this->assertDeleted($busRoute);
    }
}
