<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/ClassOfStudents.php';

class ClassRepository extends Repository
{
    public function getClass(string $className): ?ClassOfStudents
    {
        $statement = $this->database->connect()->prepare('
            SELECT class_name, grade, email as teacherEmail FROM class 
                LEFT JOIN teacher t ON t.teacher_id = class.class_teacher
                    LEFT JOIN user_ u ON u.user_id = t.user_id
                WHERE class.class_name = :className
        ');
        $statement->bindParam(':className', $className, PDO::PARAM_STR);
        $statement->execute();

        $class = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$class) {
            throw new Exception('Class not found');
        }

        return new ClassOfStudents(
            $class['class_name'],
            $class['grade'],
            $class['teacherEmail'],
        );
    }

    public function getStudentClass(string $studentEmail): ?ClassOfStudents
    {
        $statement = $this->database->connect()->prepare('
            SELECT class_name, grade, ut.email as teacherEmail FROM class 
                LEFT JOIN teacher t ON t.teacher_id = class.class_teacher
                    LEFT JOIN user_ ut ON ut.user_id = t.user_id
                LEFT JOIN student s ON class.class_id = s.class_id
                    LEFT JOIN user_ us ON us.user_id = s.user_id
                WHERE us.email = :studentEmail
        ');
        $statement->bindParam(':studentEmail', $studentEmail, PDO::PARAM_STR);
        $statement->execute();

        $class = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$class) {
            throw new Exception('Class not found');
        }

        return new ClassOfStudents(
            $class['class_name'],
            $class['grade'],
            $class['teacheremail'],
        );
    }
    
    public function getTeacherClass(string $teacherEmail): ?ClassOfStudents
    {
        $statement = $this->database->connect()->prepare('
            SELECT class_name, grade, ut.email as teacherEmail FROM class 
                LEFT JOIN teacher t ON t.teacher_id = class.class_teacher
                    LEFT JOIN user_ ut ON ut.user_id = t.user_id
                WHERE ut.email = :teacherEmail
        ');
        $statement->bindParam(':teacherEmail', $teacherEmail, PDO::PARAM_STR);
        $statement->execute();

        $class = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$class) {
            throw new Exception('Class not found');
        }

        return new ClassOfStudents(
            $class['class_name'],
            $class['grade'],
            $class['teacheremail'],
        );
    }
}