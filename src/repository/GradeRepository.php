<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/user/User.php';
require_once __DIR__ . '/../models/Grade.php';
require_once 'UserRepository.php';

class GradeRepository extends Repository
{
    public function getStudentGrades(string $email): array
    {
        $statement = $this->database->connect()->prepare('
            SELECT g.grade as grade, us.email as studentEmail, ut.email as teacherEmail, 
                   sub.whole_name as subjectName, g.date_ as date FROM grade g
                LEFT JOIN student s ON s.student_id = g.student_id
                    LEFT JOIN user_ us on us.user_id = s.user_id
                LEFT JOIN teacher t on t.teacher_id = g.teacher_id
                     LEFT JOIN user_ ut ON ut.user_id = t.user_id
                LEFT JOIN subject sub on g.subject_id = sub.subject_id
                WHERE us.email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $grades = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->getGrades($grades);
    }

    public function getTeacherGrades(string $email): array
    {
        $statement = $this->database->connect()->prepare('
            SELECT g.grade as grade, us.email as studentEmail, ut.email as teacherEmail, 
                   sub.whole_name as subjectName, g.date_ as date FROM grade g
                LEFT JOIN student s ON s.student_id = g.student_id
                    LEFT JOIN user_ us on us.user_id = s.user_id
                LEFT JOIN teacher t on t.teacher_id = g.teacher_id
                     LEFT JOIN user_ ut ON ut.user_id = t.user_id
                LEFT JOIN subject sub on g.subject_id = sub.subject_id
                WHERE ut.email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $grades = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->getGrades($grades);
    }

    public function getGrades($grades): array
    {
        $gradesResult = [];
        foreach ($grades as $grade) {
            // $dateF = DateTime::createFromFormat('Y-m-d', $grade['date']);
            $gradesResult[] = new Grade(
                $grade['grade'],
                $grade['studentemail'],
                $grade['teacheremail'],
                $grade['subjectname'],
                $grade['date']);
        }
        return $gradesResult;
    }

//    public function getGrade(int $grade, string $studentEmail, string $teacherEmail, string $subjectWholeName, DateTime $date)
//    {
//        $student =
//    }
}