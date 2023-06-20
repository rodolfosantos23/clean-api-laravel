<?php

namespace Tests\Unit;

use Exception;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_fail_if_name_has_2_characters()
    {
        $expectedMessage = 'Name must have at least 3 characters';
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($expectedMessage);

        // Code to test
        $user = new User();
        $user->name = 'Zé';
    }

    /** @test */
    public function it_should_fail_if_email_is_invalid()
    {
        $expectedMessage = 'Invalid email address';
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($expectedMessage);

        // Code to test
        $user = new User();
        $user->email = 'invalid-email';
    }
}
