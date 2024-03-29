<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email']) || !isset($_SESSION['whole_name'])) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/login");
} else {
    $userWholeName = $_SESSION['whole_name'];
}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>eDiary</title>
    <meta name="description" content="dashboard">
    <link rel="stylesheet" type="text/css" href="/public/scss/main.css">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;subset=latin-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Amita&subset=latin,latin-ext" rel="stylesheet" type="text/css">
</head>

<body>
<a href="logout" class="sign-out">Sign out</a>

<div class="container-tiles">
    <header class="logo-container">
        <a class="logo-link" href="dashboard">
            <h1 class="logo"><em class="logo-prefix">e</em>Diary</h1>
        </a>
        <span><?= $userWholeName ?></span>
    </header>
    <a class="tile group-one" href="grades">
        <h3 class="tile-title">Grades</h3>
        <img src="/public/img/scores.png" alt="grades icon"/>
    </a>
    <a class="tile group-two" href="attendance">
        <h3 class="tile-title">Attendance</h3>
        <img src="/public/img/survey.png" alt="attendance icon"/>
    </a>

    <a class="tile group-three" href="grades.php">
        <h3 class="tile-title">Tests</h3>
        <img src="/public/img/open-book.png" alt="tests icon"/>
    </a>
    <a class="tile group-four" href="grades.php">
        <h3 class="tile-title">Timetable</h3>
        <img src="/public/img/small-calendar.png" alt="timetable icon"/>
    </a>
    <a class="tile group-three" href="grades.php">
        <h3 class="tile-title">Remarks</h3>
        <img src="/public/img/warning.png" alt="remarks icon"/>
    </a>

    <a class="tile group-four" href="grades.php">
        <h3 class="tile-title">Achievements</h3>
        <img src="/public/img/bar-chart.png" alt="achievements icon"/>
    </a>
    <a class="tile group-two" href="grades.php">
        <h3 class="tile-title">Personal data</h3>
        <img src="/public/img/resume.png" alt="personal data icon"/>
    </a>
    <a class="tile group-one" href="grades.php">
        <h3 class="tile-title">School and teachers</h3>
        <img src="/public/img/briefcase.png" alt="school and teachers icon"/>
    </a>

</div>
</body>