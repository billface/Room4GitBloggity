<?php
namespace Site\Entity;

use Ninja\DatabaseTable;

class Category {
	public $id;
	public $name;
	private $blogsTable;
	private $blogCategoriesTable;

	public function __construct(DatabaseTable $blogsTable, DatabaseTable $blogCategoriesTable) {
		$this->blogsTable = $blogsTable;
		$this->blogCategoriesTable = $blogCategoriesTable;
	}

	public function getBlogs($limit = null, $offset = null) {
		$blogCategories = $this->blogCategoriesTable->find('categoryId', $this->id, null, $limit, $offset);

		$blogs = [];

		foreach ($blogCategories as $blogCategory) {
			$blog =  $this->blogsTable->findById($blogCategory->blogId);
			if ($blog) {
				$blogs[] = $blog;
			}			
		}

		usort($blogs, [$this, 'sortBlogs']);


		return $blogs;
	}

	public function getNumBlogs() {
		return $this->blogCategoriesTable->total('categoryId', $this->id);
	}

	private function sortBlogs($a, $b) {
		$aDate = new \DateTime($a->blogDate);
		$bDate = new \DateTime($b->blogDate);

		if ($aDate->getTimestamp() == $bDate->getTimestamp()) {
			return 0;
		}

		//change the direction of the arrow to sort the other way
		return $aDate->getTimestamp() > $bDate->getTimestamp() ? -1 : 1;
	}
}