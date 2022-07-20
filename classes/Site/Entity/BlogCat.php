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

	public function getBlogs($limit = null, $offset = null) {
	$blogCategories = $this->blogCatJoinTable->findAndJoin('categoryId', $this->id, 'blogId', 'blog', 'id',  'blogdate DESC', $limit, $offset);
    //null is there to negate orderBy in find()

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
		return $this->blogCatJoinTable->total('categoryId', $this->id);
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