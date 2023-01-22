<header class="info-header">
    <h2>Grades</h2>
    <p class="headerName"><?= $userWholeName . " - " . $_SESSION['student_class'];; ?></p>
</header>

<?php
foreach ($grades as $subject => $gradesFromSubject): ?>
    <div class="grades-row">
        <div class="subject-name"><?= $subject ?></div>
        <div class="subject-grades">
            <?php foreach ($gradesFromSubject as $grade): ?>
            <div class="one-grade"><?= $grade['grade']->getGrade(); ?></div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
