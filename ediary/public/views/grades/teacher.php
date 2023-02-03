<header class="info-header">
    <h2>Grades</h2>
    <p class="headerName"><?= $userWholeName; ?></p>
</header>

<div class="subject-filter">
    <select name="subject-select">
        <option value="" selected="">All subjects</option>
        <?php foreach ($gradesSubject as $subject => $gradesOfClasses): ?>
            <option><?= $subject; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div id="teacher-grades-view">
    <?php
    include __DIR__ . "/teacher-subjects.php";
    ?>
</div>


<template id="grades-in-subject">
    <div class="teacher-one-subject">
        <div class="subject-name">subject name</div>
        <div class="subject-class">

            <!--classes loop-->
            <div class="class-with-students">
                <div class="one-class">class name</div>
                <div class="all-student-in-class">

                    <!--students loop-->
                    <div class="student-with-grades">
                        <div class="one-student-name">student name</div>
                        <div class="student-grades">
                            <div class="student-grades-only">
                                <!--grades loop-->
                                <div class="one-grade">grade</div>
                            </div>
                            <a class="add-grade" href="add-grade">+</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
