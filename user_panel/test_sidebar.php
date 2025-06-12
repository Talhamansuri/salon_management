<div class="sidebar" id="sidebar">
    <div class="search-bar">
        <input type="text" placeholder="Search...">
    </div>
    <div class="sidebar-menu">
        <button class="menu-toggle" id="menuToggle">&#9776;</button>
        <ul class="menu">
            <li class="menu-item category">
                <a href="#">Category</a>
                <ul class="submenu">
                    <li><a href="#">Category 1</a></li>
                    <li><a href="#">Category 2</a></li>
                    <!-- Add more categories -->
                </ul>
            </li>
            <li class="menu-item">
                <a href="#">Filter by Price</a>
            </li>
            <li class="menu-item">
                <a href="#">Filter by Brand</a>
            </li>
        </ul>
    </div>
</div>




<style>
    .sidebar {
    width: 250px;
    height: 100%;
    background-color: #f4f4f4;
    position: fixed;
    top: 0;
    left: -250px;
    transition: left 0.3s ease;
    z-index: 1000;
}

.search-bar {
    padding: 10px;
}

.search-bar input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

.sidebar-menu {
    padding: 10px;
}

.menu {
    list-style-type: none;
    padding: 0;
}

.menu-item {
    margin-bottom: 10px;
}

.menu-item a {
    text-decoration: none;
    color: #333;
    display: block;
    padding: 8px;
}

.menu-item a:hover {
    background-color: #ddd;
}

.submenu {
    display: none;
    padding-left: 20px;
}

.menu-toggle {
    display: none;
    border: none;
    background: none;
    font-size: 20px;
    cursor: pointer;
}

@media screen and (max-width: 768px) {
    .sidebar {
        left: -250px;
    }

    .menu-toggle {
        display: block;
    }

    .menu {
        display: none;
    }

    .menu.open {
        display: block;
    }
}

</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const menu = document.querySelector('.menu');

    menuToggle.addEventListener('click', function () {
        menu.classList.toggle('open');
    });

    const categories = document.querySelectorAll('.category');
    categories.forEach(function (category) {
        category.addEventListener('click', function (e) {
            e.preventDefault();
            const submenu = this.querySelector('.submenu');
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    });

    document.addEventListener('click', function (e) {
        if (!menu.contains(e.target) && e.target !== menuToggle) {
            menu.classList.remove('open');
        }
    });
});

</script>