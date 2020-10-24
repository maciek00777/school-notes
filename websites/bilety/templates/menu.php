<style>
    /* z w3schools */
/* Navbar container */
.navbar {
  overflow: hidden;
  background-color: #333;
  font-family: Arial;
}

/* Links inside the navbar */
.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}

/* Dropdown button */
.dropdown .dropbtn {
  font-size: 16px;
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Add a red background color to navbar links on hover */
.dropdown:hover .dropbtn {
  background-color: lightseagreen;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

#logout{
   float:right;
}
#logout:hover{
    background-color: red;
}

</style>

<div class="navbar">
    <div class="dropdown">
        <button class="dropbtn">Zamówienia
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
        <a href="../order/new.php">Złóż zamówienie</a>
        <a href="../order/display.php">Pokaż moje zamówienia</a>
        </div>
    </div>
    <?php 
    //pokaż menu admin jeśli administrator
    if($_SESSION['is_admin']) echo '
    <div class="dropdown">
        <button class="dropbtn">Administrator
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
        <a href="../admin/cities.php">Miasta</a>
        <a href="../admin/index.php">Statystyki</a>
        </div>
    </div>
    '; ?>
    <a id="logout" href="?logout=1">Wyloguj : <?php echo $_SESSION['user']?> </a>

</div>