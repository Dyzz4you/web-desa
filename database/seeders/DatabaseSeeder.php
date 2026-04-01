<?php

namespace Database\Seeders;

use App\Models\OrganizationStructure;
use App\Models\Post;
use App\Models\Umkm;
use App\Models\User;
use App\Models\VillageProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@desa.test'],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        VillageProfile::updateOrCreate(
            ['village_name' => 'Desa Sukamaju'],
            [
                'hero_title' => 'Selamat Datang di Website Resmi Desa Sukamaju',
                'hero_description' => 'Portal informasi desa, berita, UMKM, dan layanan masyarakat.',
                'about' => 'Desa Sukamaju adalah desa yang berkembang dengan fokus pada pelayanan publik dan ekonomi masyarakat.',
                'vision' => 'Mewujudkan desa yang mandiri, maju, dan sejahtera.',
                'mission' => 'Meningkatkan pelayanan publik, ekonomi warga, dan transparansi pemerintahan desa.',
                'address' => 'Jl. Raya Desa Sukamaju No. 1',
                'email' => 'info@desa.test',
                'phone' => '08123456789',
            ]
        );

        if (OrganizationStructure::count() === 0) {
            OrganizationStructure::insert([
                [
                    'name' => 'Budi Santoso',
                    'position' => 'Kepala Desa',
                    'description' => 'Pimpinan utama pemerintahan desa.',
                    'sort_order' => 1,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Siti Aminah',
                    'position' => 'Sekretaris Desa',
                    'description' => 'Mengelola administrasi desa.',
                    'sort_order' => 2,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        if (Post::count() === 0) {
            Post::factory(10)->create([
                'user_id' => $admin->id,
            ]);
        }

        if (Umkm::count() === 0) {
            Umkm::insert([
                [
                    'user_id' => $admin->id,
                    'name' => 'Keripik Pisang Maju',
                    'owner_name' => 'Ibu Sari',
                    'category' => 'Makanan',
                    'description' => 'UMKM keripik pisang khas desa.',
                    'address' => 'Dusun 1',
                    'phone' => '08111111111',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $admin->id,
                    'name' => 'Batik Desa Kreatif',
                    'owner_name' => 'Pak Rudi',
                    'category' => 'Kerajinan',
                    'description' => 'Produk batik lokal khas desa.',
                    'address' => 'Dusun 2',
                    'phone' => '08222222222',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}