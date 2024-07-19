


        <div class="main__header">
            <a class="header__Logo"  href="./admin.php?page=data">
                <img src="./style/Logo.svg" alt="">
            </a>
            <a class="header__add_element" href="./admin.php?page=add&type=clinic">
                Добавить Клинику
            </a>
            <a class="header__add_element" href="./admin.php?page=add&type=aptek">
                Добавить Аптеку
            </a>

            <a class="header__add_element" href="./admin.php?page=add&type=stomatologiya">
                Добавить Стоматологию
            </a>
            <a class="header__add_element" href="./admin.php?page=add&type=optiks">
                Добавить Оптику
            </a>

            <div class="header__username__exit">
                <div class="header__username__image">
                    <img src="./style/account.png" alt="">
                </div>
                <div class="header__username__name">
                    <p>Admin</p>
                </div>
                <div class="header__username__exit">
                    <form action="./logout.php" method="POST" id="logout">
                        <button>Logout</button>
                    </form>
                </div>
            </div>
        </div>