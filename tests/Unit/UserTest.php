<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test to create user.
     */
    public function test_create_user(): void
    {
        $result = false;

        DB::beginTransaction();

        $user = User::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('testing'),
        ]);  
        $result = 'John' === $user->name;

        DB::rollBack();

        $this->assertTrue($result);
    }

    /**
     * A basic unit test to update user data.
     */
    public function test_update_user(): void 
    {
        $result = false;

        DB::beginTransaction();

        $user = User::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('testing'),
        ]);

        $result = "John" === $user->name;

        $user->name = "testing";
        $user->save();

        $result = $result && "testing" === $user->name;

        DB::rollBack();

        $this->assertTrue($result);
    }

    /**
     * A basic unit test to delete user.
     */
    public function test_delete_user(): void
    {
        $result = false;

        DB::beginTransaction();

        $user = User::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('testing'),
        ]);

        $result = "John" === $user->name;

        $deletedRows = User::destroy($user->id);

        $result = $result && $deletedRows === 1;

        DB::rollBack();

        $this->assertTrue($result);
    }
}
