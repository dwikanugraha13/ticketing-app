<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Kategori;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProtectedEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_with_sales_cannot_be_deleted(): void
    {
        $user = User::factory()->create();
        $kategori = Kategori::create(['nama' => 'Konser']);
        $event = Event::create([
            'user_id' => $user->id,
            'kategori_id' => $kategori->id,
            'judul' => 'Festival Musik',
            'deskripsi' => 'Deskripsi event',
            'lokasi' => 'Bandung',
            'gambar' => 'konser.jpg',
            'tanggal_waktu' => now()->addDay(),
        ]);

        Order::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'order_date' => now(),
            'total_harga' => 150000,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('admin.events.index'))
            ->delete(route('admin.events.destroy', $event));

        $response->assertRedirect(route('admin.events.index'))
            ->assertSessionHas('error', 'Event tidak dapat dihapus karena sudah memiliki penjualan tiket.');

        $this->assertDatabaseHas('events', ['id' => $event->id]);
        $this->assertDatabaseHas('orders', ['event_id' => $event->id]);
    }
}
