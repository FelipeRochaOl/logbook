<?php

namespace App\core;

use Exception;

class Posts
{
    private Database $DB;
    private array $posts;
    private int $id;
    private int $categoryId;
    private string $title;
    private string $datePost;
    private string $content;
    private string $image;
    private string $search;

    public function __construct()
    {
        $this->DB = new Database();
        $this->setPosts();
    }

    private function setPosts(): void
    {
        $response = $this->DB->query('
            SELECT 
                posts.*, categories.name as categoryName
            FROM posts 
                INNER JOIN categories ON categories.id = posts.category_id 
            ORDER BY date_publication DESC
        ', [], true);
        if (!$response->success) {
            $this->posts = [];
            return;
        }
        $this->posts = $response->data;
    }

    public function setID(string $id): void
    {
        if (!is_numeric($id)) {
            throw new Exception('ID is not a number');
        }
        $this->id = (int) $id;
    }

    public function setTitle(string $name): void
    {
        $this->title = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

    public function setCategoryId(string $id): void
    {
        $categoryModel = new \App\core\Categories();
        $category = $categoryModel->getOneById($id);
        if (!isset($category->name)) {
            throw new Exception('Category not exists');
        }
        $this->categoryId = (int) $category->id;
    }

    public function setDate(string $date): void
    {
        $this->datePost = $date;
    }

    public function setContent(string $content): void
    {
        $this->content = htmlspecialchars(trim($content), ENT_QUOTES, 'UTF-8');;
    }

    public function setSearch(string $search): void
    {
        $this->search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');;
    }

    public function setImage(string $image): void
    {
        $this->image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');;
    }

    public function getAll(): array
    {
        return $this->posts;
    }

    public function getAllByCategory(): array
    {
        if (empty($this->categoryId)) {
            throw new Exception('Category ID is not defined');
        }
        $response = $this->DB->query('
            SELECT 
                posts.*, categories.name as categoryName
            FROM posts 
                INNER JOIN categories ON categories.id = posts.category_id
            WHERE categories.id = :categoryId
            ORDER BY date_publication DESC
        ', ['categoryId' => $this->categoryId], true);
        if (!$response->success) {
            return [];
        }
        return $response->data;
    }

    public function getBySearch(): array
    {
        if (empty($this->search)) {
            throw new Exception('Search content is empty');
        }
        $response = $this->DB->query('
            SELECT 
                posts.*, categories.name as categoryName
            FROM posts 
                INNER JOIN categories ON categories.id = posts.category_id
            WHERE 
                posts.content LIKE :search
                OR posts.title LIKE :search
                OR posts.date_publication LIKE :search
                OR categories.name LIKE :search
            ORDER BY date_publication DESC
        ', ['search' => "%$this->search%"], true);
        if (!$response->success) {
            return [];
        }
        return $response->data;
    }

    public function getOneById(string $id): object
    {
        foreach ($this->posts as $post) {
            if ($id == $post->id ) {
                return $post;
            }
        }
        return (object)[];
    }

    /**
     * @throws Exception
     */
    public function create(): object
    {
        $fields = $this->getFieldsToDB();
        unset($fields['id']);
        return $this->DB->query(
            'INSERT INTO blog.posts (title, category_id, date_publication, content, image) 
                        VALUES(:title, :categoryId, :datePost, :content, :image)',
            $fields
        );
    }

    private function getFieldsToDB(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'categoryId' => $this->categoryId,
            'datePost' => $this->datePost,
            'content' => $this->content,
            'image' => $this->image
        ];
    }

    public function getFields(): object
    {
        return (object) [
            'title' => '',
            'category_id' => '',
            'date_publication' => '',
            'content' => '',
            'image' => ''
        ];
    }

    /**
     * @throws Exception
     */
    public function findById(): object
    {
        if (empty($this->id)) {
            throw new Exception('ID is not defined');
        }
        return $this->DB->query(
            'SELECT * FROM blog.posts WHERE id = :id', ['id' => $this->id], true
        );
    }

    /**
     * @throws Exception
     */
    public function edit(): object
    {
        $exists = $this->findById();
        if (!$exists->success) {
            throw new Exception('ID is not defined');
        }
        return $this->DB->query(
            'UPDATE blog.posts 
                    SET 
                        title = :title, 
                        category_id = :categoryId,
                        date_publication = :datePost,
                        content = :content,
                        image = :image
                    WHERE id = :id',
            $this->getFieldsToDB()
        );
    }

    /**
     * @throws Exception
     */
    public function delete(): object
    {
        $exists = $this->findById();
        if (!$exists->success) {
            throw new Exception('ID is not defined');
        }
        return $this->DB->query(
            'DELETE FROM blog.posts WHERE id = :id',
            ['id' => $this->id]
        );
    }

    public function validate(array $values): bool
    {
        if (empty($values)) return false;
        return array_key_exists('title', $values) &&
            array_key_exists('categoryId', $values) &&
            array_key_exists('datePost', $values) &&
            array_key_exists('content', $values) &&
            array_key_exists('image', $values);
    }
}