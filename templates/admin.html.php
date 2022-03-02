    <h1>Admin</h1>
    
    <li><a href="/page/list">Pages</a></li>
    <li><a href="/event/addpage">Add a new event</a></li>
    <li><a href="/blog/addpage">Add a new blog</a></li>
    <li><a href="/category/list">Blog categories</a></li>
    <?php  if ( $user->hasPermission(\Site\Entity\Author::GOD)): ?>
    <li><a href="/author/list">Users and their permissions</a></li>
    <?php else: ?>
    <li>Users and their permissions</li>
    <?php endif; ?>


    <br>
    