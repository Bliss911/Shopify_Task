<?php

namespace Database\Seeders;

use App\Models\ImageRepository;
use Database\Factories\ImageRepositoryFactory;
use Illuminate\Database\Seeder;

class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageRepository::factory(1)->create();
    }
}
