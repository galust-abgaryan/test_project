<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();
        if (\App\Models\User::query()->whereEmail('user@gmail.com')->doesntExist()) {
            $user = factory(App\Models\User::class)->create([
                'email' => 'user@gmail.com'
            ]);
            $this->setInterests($user);
        }
        factory(App\Models\User::class, 50)->create()->map(function (\App\Models\User  $user) {
            $this->setInterests($user);
        });

    }

    protected function setInterests($user)
    {
        $interests = \Illuminate\Support\Arr::random(config('web.interests'), 2);
        $interests[] = $this->faker->word;
        foreach ($interests as $interest) {
            $user->userInterests()->create([
                'interest' => $interest
            ]);
        }

    }
}
