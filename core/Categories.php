<?php

namespace App\core;

use Exception;

class Categories
{
    private Database $DB;
    private array $categories;
    private string $id;
    private string $name;

    public function __construct()
    {
        $this->DB = new Database();
        $this->setCategories();
    }

    private function setCategories(): void
    {
        $response = $this->DB->query('SELECT * FROM categories ORDER BY name ASC', [], true);
        if (!$response->success) {
            $this->categories = [];
            return;
        }
        $this->categories = $response->data;
    }

    /**
     * @throws Exception
     */
    public function setID(string $id): void
    {
        if (!is_numeric($id)) {
            throw new Exception('ID is not a number');
        }
        $this->id = (int) $id;
    }

    public function setName(string $name): void
    {
        $this->name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

    public function getAll(): array
    {
        return $this->categories;
    }

    public function getOneById(string $id): object
    {
        foreach ($this->categories as $category) {
            if ($id == $category->id ) {
                return $category;
            }
        }
        return (object)[];
    }

    /**
     * @throws Exception
     */
    public function create(): object
    {
        $exists = $this->findByName();
        if ($exists->success) {
            throw new Exception('Name is not defined');
        }
        return $this->DB->query(
            'INSERT INTO blog.categories (name) VALUES(:name)', ['name' => $this->name]
        );
    }

    /**
     * @throws Exception
     */
    public function findByName(): object
    {
        if (empty($this->name)) {
            throw new Exception('Name is not defined');
        }
        return $this->DB->query(
            'SELECT * FROM blog.categories WHERE name LIKE :name', ['name' => "%$this->name%"], true
        );
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
            'SELECT * FROM blog.categories WHERE id = :id', ['id' => $this->id], true
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
            'UPDATE blog.categories SET name = :name WHERE id = :id',
            ['name' => $this->name, 'id' => $this->id]
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
            'DELETE FROM blog.categories WHERE id = :id',
            ['id' => $this->id]
        );
    }

    public function validate(array $values): bool
    {
        if (empty($values)) return false;
        return array_key_exists('name', $values);
    }
}