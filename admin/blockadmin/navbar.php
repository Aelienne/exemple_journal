<nav>
    <div>
        <ul>
            <li>
                <a href="./index.php">Home</a>
                <a href="./addAnnouncement.php">Créer une nouvelle annonce</a>


                <?php
                if (!isset($_SESSION["username"])) { ?>
                    <a href="../login.php">Login</a>
                <?php
                } else {
                ?>
                    <form method="POST" action="../logout.php">
                        </br><button type="submit" name="logout">Logout</button>
                    </form>
                <?php
                }
                ?>
            </li>
        </ul>
    </div>
</nav>