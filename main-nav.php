<nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px">
    <div class="container">
        <!-- Brand -->
        <a href="products.php" class="navbar-brand">
            Minimart Catarog
        </a>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item"><a href="products.php" class="nav-link">Products</a></li>
            <li class="nav-item"><a href="sections.php" class="nav-link">Section</a></li>
        </ul>
        <el class="navbar-nav ms-auto">
            <li class="nav-item"><a href="#" class="nav-link"><?= $_SESSION['username'] ?></a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
        </el>
    </div>
</nav>