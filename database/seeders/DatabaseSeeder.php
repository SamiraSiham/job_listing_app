<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
        ]);
        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
        // Listing::create(
        //     [
        //         'title' => 'Laravel Senior Developer',
        //         'tags' => 'Laravel, JavaScript',
        //         'company' => 'Acme Corp',
        //         'location' => 'Boston, MA',
        //         'email' => 'email1@email.com',
        //         'website' => 'http://www.acme.com',
        //         'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Faucibus nisl tincidunt eget nullam non. Urna neque viverra justo nec ultrices. Massa vitae tortor condimentum lacinia. Eget nullam non nisi est sit amet facilisis magna. Condimentum mattis pellentesque id nibh tortor id aliquet lectus proin.'
        //     ]
        // );
        // Listing::create(
        //     [
        //         'title' => 'Full-Stack Engineer',
        //         'tags' => 'Laravel, backend, api',
        //         'company' => 'Acme Corp',
        //         'location' => 'Boston, MA',
        //         'email' => 'email1@email.com',
        //         'website' => 'http://www.acme.com',
        //         'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Faucibus nisl tincidunt eget nullam non. Urna neque viverra justo nec ultrices. Massa vitae tortor condimentum lacinia. Eget nullam non nisi est sit amet facilisis magna. Condimentum mattis pellentesque id nibh tortor id aliquet lectus proin.'
        //     ]
        // );

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
