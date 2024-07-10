<?php

namespace Tests\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $data = [
            'username' => 'johndoe',
            'email' => 'john.doe@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'salt' => 'salt'
        ];
        $userId = User::createUser($data);

        $this->assertIsString($userId);
        $this->assertNotEmpty($userId);
    }

    public function testGetOne()
    {
        $user = User::getOne(1);

        $this->assertIsArray($user);
        $this->assertNotEmpty($user);
    }

    public function testGetByLogin()
    {
        $user = User::getByLogin('john.doe@example.com');

        $this->assertIsArray($user);
        $this->assertNotEmpty($user);
    }
}