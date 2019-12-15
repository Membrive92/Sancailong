<?php

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
        Storage::deleteDirectory('courses');
        Storage::deleteDirectory('users');

        Storage::makeDirectory('courses');
        Storage::makeDirectory('users');

        factory(\App\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Role::class, 1)->create(['name' => 'teacher']);
        factory(\App\Role::class, 1)->create(['name' => 'student']);

        factory(\App\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::ADMIN
        ])
            ->each(function (\App\User $u) {
                factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
            });

        factory(\App\User::class, 1)->create([
            'name' => 'student',
            'email' => 'student@mail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::STUDENT
        ])
            ->each(function (\App\User $u) {
                factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
            });

        factory(\App\User::class, 5)->create()
            ->each(function (\App\User $u) {
                factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
            });

        factory(\App\User::class, 5)->create()
            ->each(function (\App\User $u) {
                factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
                factory(\App\Teacher::class, 1)->create(['user_id' => $u->id]);
            });

        factory(\App\Level::class, 1)->create(['name' => 'Beginner']);
        factory(\App\Level::class, 1)->create(['name' => 'Intermediate']);
        factory(\App\Level::class, 1)->create(['name' => 'Advanced']);
        factory(\App\Category::class, 1)->create(['name' => 'TaiJi']);
        factory(\App\Category::class, 1)->create(['name' => 'Sanda']);
        factory(\App\Category::class, 1)->create(['name' => 'Wu-shu']);
        factory(\App\Category::class, 1)->create(['name' => 'Cuchillo']);
        factory(\App\Category::class, 1)->create(['name' => 'Mano-vacia']);
        factory(\App\Category::class, 1)->create(['name' => 'Kali']);

        factory(\App\Course::class, 5)
            ->create()
            ->each(function (\App\Course $c) {
                $c->goals()->saveMany(factory(\App\Goal::class, 2)->create());
                $c->requirements()->saveMany(factory(\App\Requirement::class, 4)->create());
            });


    }
}
