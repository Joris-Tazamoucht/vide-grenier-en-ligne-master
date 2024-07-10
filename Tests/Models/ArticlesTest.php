<?php

namespace Tests\Models;

use App\Models\Articles;
use PHPUnit\Framework\TestCase;


class ArticlesTest extends TestCase
{
    public function testCreateArticle()
    {
        $data = [
            'name' => 'testArticle',
            'description' => 'Ceci est un article de test',
            'user_id' => 1
        ];
        $articleId = Articles::save($data);

        $this->assertIsString($articleId);
        $this->assertNotEmpty($articleId);
    }

    public function testGetOne()
    {
        $article = Articles::getOne(1);

        $this->assertIsArray($article);
        $this->assertNotEmpty($article);
    }

    public function testGetAll()
    {
        $articles = Articles::getAll('');

        $this->assertIsArray($articles);
        $this->assertNotEmpty($articles);
    }
    
    public function testGetByUser()
    {
        $articles = Articles::getByUser(1);

        $this->assertIsArray($articles);
        $this->assertNotEmpty($articles);
    }

    public function testGetSuggest()
    {
        $articles = Articles::getSuggest();

        $this->assertIsArray($articles);
        $this->assertNotEmpty($articles);
    }
}