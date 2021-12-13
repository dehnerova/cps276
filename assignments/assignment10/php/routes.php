<?php

$path = "index.php?page=login";
$nav = "";

$adminNav = <<<HTML
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php?page=welcome">Welcome Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=addAdmin">Add Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=login">Logout</a>
            </li>
        </ul>
    </nav>
HTML;

$staffNav = <<<HTML
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php?page=welcome">Welcome</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=addContact">Add Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=login">Logout</a>
            </li>
        </ul>
    </nav>
HTML;

function security()
{
    session_start();
    global $nav, $staffNav, $adminNav;
    if ($_SESSION['access'] != 'accessgranted') {
        header('location:index.php?page=login');
        exit;
    } elseif ($_SESSION['status'] == 'admin') {
        $nav = $adminNav;
    } elseif ($_SESSION['status'] == 'staff') {
        $nav = $staffNav;
    }
}
function admin()
{
    if ($_SESSION['status'] != 'admin') {
        header('location: index.php?page=login');
        exit;
    }
}

if (isset($_GET)) {

    switch (isset($_GET)) {

        case ($_GET['page'] === "login"):
            require_once('php/login.php');
            $result = init();
            $nav = "";
            break;
        case ($_GET['page'] === "addContact"):
            require_once('php/addContact.php');
            security();
            $result = init();
            $nav = "";
            break;
        case ($_GET['page'] === "deleteContacts"):
            require_once('php/deleteContacts.php');
            security();
            $result = init();
            break;
        case ($_GET['page'] === "addAdmin"):
            require_once('php/addAdmin.php');
            security();
            admin();
            $result = init();
            break;
        case ($_GET['page'] === "deleteAdmins"):
            require_once('php/deleteAdmins.php');
            security();
            admin();
            $result = init();
            break;
        case ($_GET['page'] === "welcome"):
            require_once('php/welcome.php');
            security();
            $result = init($_SESSION['name']);
            break;
        case ($_GET['page'] === "logout"):
            require_once('php/logout.php');
            session_destroy();
            $result = header('Location: index.php?page=login');
            break;
        default:
           // header('Location: http://russet.php?page=form');
            header('location: ' . $path);
    }
} else {
    header('location: ' . $path);
}
