<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Promo;
use App\Models\SalesContact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // SALES CONTACTS
        SalesContact::insert([
            [
                'nama_sales'    => 'Budi Santoso',
                'wilayah'       => 'Utara',
                'nomor_wa'      => '6281234567890',
                'pesan_default' => 'Halo Kak Budi, saya tertarik dengan Toyota. Boleh info lebih lanjut?',
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_sales'    => 'Sari Dewi',
                'wilayah'       => 'Selatan',
                'nomor_wa'      => '6281234567891',
                'pesan_default' => 'Halo Kak Sari, saya ingin tahu promo Toyota terbaru.',
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_sales'    => 'Andi Wijaya',
                'wilayah'       => 'Barat',
                'nomor_wa'      => '6281234567892',
                'pesan_default' => 'Halo Kak Andi, boleh minta informasi Toyota?',
                'is_active'     => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);

        // CARS
        Car::create([
            'nama_mobil'  => 'Toyota Avanza',
            'kategori'    => 'MPV',
            'harga_mulai' => 228300000,
            'deskripsi'   => 'Toyota Avanza adalah MPV terlaris yang cocok untuk keluarga Indonesia. Desain modern, kabin luas, dan konsumsi bahan bakar efisien.',
            'is_featured' => true,
            'is_active'   => true,
            'spesifikasi' => [
                'mesin'       => ['kapasitas' => '1496 cc', 'tenaga' => '103 hp', 'torsi' => '136 Nm'],
                'transmisi'   => 'CVT',
                'bahan_bakar' => 'Bensin',
                'dimensi'     => ['panjang' => '4395 mm', 'lebar' => '1730 mm', 'tinggi' => '1700 mm'],
                'interior'    => ['kapasitas_penumpang' => 7, 'kapasitas_bagasi' => '204 L'],
                'fitur'       => ['Toyota Safety Sense', 'Android Auto', 'Apple CarPlay', 'Dual SRS Airbag', 'VSC'],
            ],
        ]);

        Car::create([
            'nama_mobil'  => 'Toyota Rush',
            'kategori'    => 'SUV',
            'harga_mulai' => 279900000,
            'deskripsi'   => 'Toyota Rush hadir dengan desain SUV tangguh namun tetap elegan. Cocok untuk petualangan keluarga di segala medan.',
            'is_featured' => true,
            'is_active'   => true,
            'spesifikasi' => [
                'mesin'       => ['kapasitas' => '1496 cc', 'tenaga' => '103 hp', 'torsi' => '136 Nm'],
                'transmisi'   => 'CVT',
                'bahan_bakar' => 'Bensin',
                'dimensi'     => ['panjang' => '4435 mm', 'lebar' => '1695 mm', 'tinggi' => '1705 mm'],
                'interior'    => ['kapasitas_penumpang' => 7, 'kapasitas_bagasi' => '246 L'],
                'fitur'       => ['Hill Start Assist', 'Android Auto', 'Apple CarPlay', 'Dual SRS Airbag'],
            ],
        ]);

        Car::create([
            'nama_mobil'  => 'Toyota Raize',
            'kategori'    => 'SUV',
            'harga_mulai' => 214900000,
            'deskripsi'   => 'Toyota Raize adalah SUV compact yang sporty dan bertenaga. Pilihan tepat untuk anak muda yang dinamis.',
            'is_featured' => true,
            'is_active'   => true,
            'spesifikasi' => [
                'mesin'       => ['kapasitas' => '998 cc Turbo', 'tenaga' => '98 hp', 'torsi' => '140 Nm'],
                'transmisi'   => 'CVT',
                'bahan_bakar' => 'Bensin',
                'dimensi'     => ['panjang' => '3995 mm', 'lebar' => '1695 mm', 'tinggi' => '1620 mm'],
                'interior'    => ['kapasitas_penumpang' => 5, 'kapasitas_bagasi' => '292 L'],
                'fitur'       => ['Toyota Safety Sense', 'Android Auto', 'Apple CarPlay', 'Panoramic Roof'],
            ],
        ]);

        Car::create([
            'nama_mobil'  => 'Toyota Veloz',
            'kategori'    => 'MPV',
            'harga_mulai' => 295200000,
            'deskripsi'   => 'Toyota Veloz hadir dengan desain sporty dan fitur lengkap. MPV premium untuk keluarga modern.',
            'is_featured' => true,
            'is_active'   => true,
            'spesifikasi' => [
                'mesin'       => ['kapasitas' => '1496 cc', 'tenaga' => '105 hp', 'torsi' => '138 Nm'],
                'transmisi'   => 'CVT',
                'bahan_bakar' => 'Bensin',
                'dimensi'     => ['panjang' => '4475 mm', 'lebar' => '1750 mm', 'tinggi' => '1700 mm'],
                'interior'    => ['kapasitas_penumpang' => 7, 'kapasitas_bagasi' => '204 L'],
                'fitur'       => ['Toyota Safety Sense', 'Android Auto', 'Apple CarPlay', 'Wireless Charger'],
            ],
        ]);

        Car::create([
            'nama_mobil'  => 'Toyota Fortuner',
            'kategori'    => 'SUV',
            'harga_mulai' => 559900000,
            'deskripsi'   => 'Toyota Fortuner adalah SUV premium yang gagah dan bertenaga. Simbol prestise dan keperkasaan di jalan.',
            'is_featured' => true,
            'is_active'   => true,
            'spesifikasi' => [
                'mesin'       => ['kapasitas' => '2694 cc', 'tenaga' => '163 hp', 'torsi' => '420 Nm'],
                'transmisi'   => 'Automatic 6-Speed',
                'bahan_bakar' => 'Solar',
                'dimensi'     => ['panjang' => '4795 mm', 'lebar' => '1855 mm', 'tinggi' => '1835 mm'],
                'interior'    => ['kapasitas_penumpang' => 7, 'kapasitas_bagasi' => '201 L'],
                'fitur'       => ['Toyota Safety Sense', 'Android Auto', '4x4 AWD', 'Terrain Command'],
            ],
        ]);

        Car::create([
            'nama_mobil'  => 'Toyota Calya',
            'kategori'    => 'MPV',
            'harga_mulai' => 156900000,
            'deskripsi'   => 'Toyota Calya adalah LCGC MPV yang irit dan terjangkau. Pilihan cerdas untuk keluarga dengan anggaran efisien.',
            'is_featured' => false,
            'is_active'   => true,
            'spesifikasi' => [
                'mesin'       => ['kapasitas' => '1197 cc', 'tenaga' => '88 hp', 'torsi' => '108 Nm'],
                'transmisi'   => 'AT',
                'bahan_bakar' => 'Bensin',
                'dimensi'     => ['panjang' => '4165 mm', 'lebar' => '1660 mm', 'tinggi' => '1635 mm'],
                'interior'    => ['kapasitas_penumpang' => 7, 'kapasitas_bagasi' => '135 L'],
                'fitur'       => ['Dual SRS Airbag', 'ABS', 'EBD', 'Rear Parking Camera'],
            ],
        ]);

        // PROMOS
        Promo::create([
            'judul_promo'      => 'DP Ringan Mulai 20 Juta',
            'konten'           => '<p>Dapatkan penawaran DP ringan mulai <strong>Rp 20.000.000</strong> untuk semua tipe Toyota pilihan.</p><p>Nikmati cicilan ringan dengan tenor hingga 60 bulan dan bunga kompetitif.</p><ul><li>Berlaku untuk semua tipe Avanza, Rush, dan Raize</li><li>Proses cepat dan mudah</li><li>Garansi resmi Toyota</li></ul>',
            'tanggal_berakhir' => now()->addDays(30),
            'is_active'        => true,
        ]);

        Promo::create([
            'judul_promo'      => 'Cashback Hingga 15 Juta',
            'konten'           => '<p>Dapatkan cashback hingga <strong>Rp 15.000.000</strong> untuk pembelian Toyota Fortuner dan Veloz bulan ini.</p><p>Hubungi sales kami sekarang sebelum kehabisan!</p>',
            'tanggal_berakhir' => now()->addDays(15),
            'is_active'        => true,
        ]);

        Promo::create([
            'judul_promo'      => 'Gratis Aksesoris Senilai 5 Juta',
            'konten'           => '<p>Beli Toyota Calya atau Avanza sekarang dan dapatkan <strong>gratis aksesoris</strong> senilai Rp 5.000.000.</p><p>Termasuk karpet, talang air, dan pelindung body.</p>',
            'tanggal_berakhir' => now()->addDays(45),
            'is_active'        => true,
        ]);
    }
}