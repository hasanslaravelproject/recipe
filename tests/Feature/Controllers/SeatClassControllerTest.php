<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SeatClass;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeatClassControllerTest extends TestCase
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
    public function it_displays_index_view_with_seat_classes()
    {
        $seatClasses = SeatClass::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('seat-classes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.seat_classes.index')
            ->assertViewHas('seatClasses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_seat_class()
    {
        $response = $this->get(route('seat-classes.create'));

        $response->assertOk()->assertViewIs('app.seat_classes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_seat_class()
    {
        $data = SeatClass::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('seat-classes.store'), $data);

        $this->assertDatabaseHas('seat_classes', $data);

        $seatClass = SeatClass::latest('id')->first();

        $response->assertRedirect(route('seat-classes.edit', $seatClass));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_seat_class()
    {
        $seatClass = SeatClass::factory()->create();

        $response = $this->get(route('seat-classes.show', $seatClass));

        $response
            ->assertOk()
            ->assertViewIs('app.seat_classes.show')
            ->assertViewHas('seatClass');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_seat_class()
    {
        $seatClass = SeatClass::factory()->create();

        $response = $this->get(route('seat-classes.edit', $seatClass));

        $response
            ->assertOk()
            ->assertViewIs('app.seat_classes.edit')
            ->assertViewHas('seatClass');
    }

    /**
     * @test
     */
    public function it_updates_the_seat_class()
    {
        $seatClass = SeatClass::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'unit_seat_price' => $this->faker->randomNumber(2),
        ];

        $response = $this->put(route('seat-classes.update', $seatClass), $data);

        $data['id'] = $seatClass->id;

        $this->assertDatabaseHas('seat_classes', $data);

        $response->assertRedirect(route('seat-classes.edit', $seatClass));
    }

    /**
     * @test
     */
    public function it_deletes_the_seat_class()
    {
        $seatClass = SeatClass::factory()->create();

        $response = $this->delete(route('seat-classes.destroy', $seatClass));

        $response->assertRedirect(route('seat-classes.index'));

        $this->assertDeleted($seatClass);
    }
}
