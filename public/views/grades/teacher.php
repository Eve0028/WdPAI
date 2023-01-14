<header class="info-header">
    <h2>Grades</h2>
    <p class="headerName"><?= $teacher->getName() . " " . $teacher->getSurname(); ?></p>
</header>

<?php
foreach ($gradesSubject as $subject => $gradesOfClasses): ?>
    <div class="teacher-one-subject">
        <div class="subject-name"><?= $subject ?></div>
        <div class="subject-class">

            <?php foreach ($gradesOfClasses as $class => $students): ?>
                <div class="class-with-students">
                    <div class="one-class"><?= $class; ?></div>
                    <div class="all-student-in-class">

                        <?php foreach ($students as $student => $grades): ?>
                            <div class="student-with-grades">
                                <div class="one-student-name"><?= $student; ?></div>
                                <div class="student-grades">
                                    <?php foreach ($grades as $grade): ?>
                                        <div class="one-grade"><?= $grade->getGrade(); ?></div>
                                    <?php endforeach; ?>
                                    <a class="add-grade" href="add-grade">+</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>