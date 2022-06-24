<?php
namespace Site\Entity;

use Ninja\DatabaseTable;

class BlogCat {
	public $id;
	public $name;
	private $blogsTable;
	private $blogCatJoinTable;

	public function __construct(DatabaseTable $blogsTable, DatabaseTable $blogCatJoinTable) {
		$this->blogsTable = $blogsTable;
		$this->blogCatJoinTable = $blogCatJoinTable;
	}

	public function getBlogs() {
		$blogCategories = $this->blogCatJoinTable->find('categoryId', $this->id);

		$blogs = [];

		foreach ($blogCategories as $blogCategory) {
			$blog =  $this->blogsTable->findById($blogCategory->blogId);
			if ($blog) {
				$blogs[] = $blog;
			}			
		}

		return $blogs;
	}
}