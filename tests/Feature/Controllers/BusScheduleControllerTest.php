<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BusSchedule;

use App\Models\Bus;
use App\Models\BusRoute;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusScheduleControllerTest extends TestCase
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
    public function it_displays_index_view_with_bus_schedules()
    {
        $busSchedules = BusSchedule::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bus-schedules.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_schedules.index')
            ->assertViewHas('busSchedules');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bus_schedule()
    {
        $response = $this->get(route('bus-schedules.create'));

        $response->assertOk()->assertViewIs('app.bus_schedules.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bus_schedule()
    {
        $data = BusSchedule::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bus-schedules.store'), $data);

        $this->assertDatabaseHas('bus_schedules', $data);

        $busSchedule = BusSchedule::latest('id')->first();

        $response->assertRedirect(route('bus-schedules.edit', $busSchedule));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bus_schedule()
    {
        $busSchedule = BusSchedule::factory()->create();

        $response = $this->get(route('bus-schedules.show', $busSchedule));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_schedules.show')
            ->assertViewHas('busSchedule');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bus_schedule()
    {
        $busSchedule = BusSchedule::factory()->create();

        $response = $this->get(route('bus-schedules.edit', $busSchedule));

        $response
            ->assertOk()
            ->assertViewIs('app.bus_schedules.edit')
            ->assertViewHas('busSchedule');
    }

    /**
     * @test
     */
    public function it_updates_the_bus_schedule()
    {
        $busSchedule = BusSchedule::factory()->create();

        $bus = Bus::factory()->create();
        $busRoute = BusRoute::factory()->create();

        $data = [
            'date' => $this->faker->dateTime,
            'bus_id' => $bus->id,
            'bus_route_id' => $busRoute->id,
        ];

        $response = $this->put(
            route('bus-schedules.update', $busSchedule),
            $data
        );

        $data['id'] = $busSchedule->id;

        $this->assertDatabaseHas('bus_schedules', $data);

        $response->assertRedirect(route('bus-schedules.edit', $busSchedule));
    }

    /**
     * @test
     */
    public function it_deletes_the_bus_schedule()
    {
        $busSchedule = BusSchedule::factory()->create();

        $response = $this->delete(route('bus-schedules.destroy', $busSchedule));

        $response->assertRedirect(route('bus-schedules.index'));

        $this->assertDeleted($busSchedule);
    }
}
