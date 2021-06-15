<?php

namespace Tests\Feature\Controllers;

use App\Models\Bus;
use App\Models\User;

use App\Models\Company;
use App\Models\SeatClass;
use App\Models\BusCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusControllerTest extends TestCase
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
    public function it_displays_index_view_with_buses()
    {
        $buses = Bus::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('buses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.buses.index')
            ->assertViewHas('buses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bus()
    {
        $response = $this->get(route('buses.create'));

        $response->assertOk()->assertViewIs('app.buses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bus()
    {
        $data = Bus::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('buses.store'), $data);

        $this->assertDatabaseHas('buses', $data);

        $bus = Bus::latest('id')->first();

        $response->assertRedirect(route('buses.edit', $bus));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bus()
    {
        $bus = Bus::factory()->create();

        $response = $this->get(route('buses.show', $bus));

        $response
            ->assertOk()
            ->assertViewIs('app.buses.show')
            ->assertViewHas('bus');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bus()
    {
        $bus = Bus::factory()->create();

        $response = $this->get(route('buses.edit', $bus));

        $response
            ->assertOk()
            ->assertViewIs('app.buses.edit')
            ->assertViewHas('bus');
    }

    /**
     * @test
     */
    public function it_updates_the_bus()
    {
        $bus = Bus::factory()->create();

        $company = Company::factory()->create();
        $seatClass = SeatClass::factory()->create();
        $busCategory = BusCategory::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'bus_number' => $this->faker->text(255),
            'company_id' => $company->id,
            'seat_class_id' => $seatClass->id,
            'bus_category_id' => $busCategory->id,
        ];

        $response = $this->put(route('buses.update', $bus), $data);

        $data['id'] = $bus->id;

        $this->assertDatabaseHas('buses', $data);

        $response->assertRedirect(route('buses.edit', $bus));
    }

    /**
     * @test
     */
    public function it_deletes_the_bus()
    {
        $bus = Bus::factory()->create();

        $response = $this->delete(route('buses.destroy', $bus));

        $response->assertRedirect(route('buses.index'));

        $this->assertDeleted($bus);
    }
}
