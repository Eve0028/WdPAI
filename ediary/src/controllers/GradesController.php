<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/GradeRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/ClassRepository.php';
require_once __DIR__ . '/../models/Grade.php';

class GradesController extends AppController
{
    private GradeRepository $gradeRepository;
    private UserRepository $userRepository;
    private ClassRepository $classRepository;

    public function __construct()
    {
        parent::__construct();
        $this->gradeRepository = new GradeRepository();
        $this->userRepository = new UserRepository();
        $this->classRepository = new ClassRepository();
    }

    public function addGrade()
    {
        if ($this->isPost()) {

        }
    }

    /**
     * @throws Exception - userNotFound
     */
    public function grades()
    {
        if ($this->isPost()) {

        }

        if (!isset($_SESSION['email'])) {
            return $this->render('login');
        }

        $user = $this->userRepository->getUser($_SESSION['email']);
        if ($user->getUserType() === 'student') {
            $this->getStudentGrades($user->getEmail());

        } elseif ($user->getUserType() === 'teacher') {
            $this->getTeacherGrades($user->getEmail());
        }
        //TODO
        // Parent section
    }

    public function filtersub()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "";

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type: application/json');
            http_response_code(200);

            $subjectGradesResult = $this->getTeacherGradesWithoutRender($_SESSION['email'], $decoded['filter']);

            echo json_encode($subjectGradesResult);
        }
    }

    private function getStudentGrades(string $email)
    {
        $grades = $this->gradeRepository->getStudentGrades($email);

        $gradesResult = [];
        foreach ($grades as $grade) {
            $teacher = $this->userRepository->getUser($grade->getTeacher());
            $gradesResult[$grade->getsubjectWholeName()][] = ['grade' => $grade, 'teacher' => $teacher];
        }

        return $this->render('grades',
            ['grades' => $gradesResult]);
    }

    private function getTeacherGrades(string $email)
    {
        $subjectGradesResult = $this->getTeacherGradesWithoutRender($email);

        return $this->render('grades',
            ['gradesSubject' => $subjectGradesResult]);
    }

    private function getTeacherGradesWithoutRender(string $email, string $subject = null)
    {
        $grades = $this->gradeRepository->getTeacherGrades($email, $subject);
        $subjectGradesResult = [];

        foreach ($grades as $grade) {
            $student = $this->userRepository->getUser($grade->getStudent());
            try {
                $studentClass = $this->classRepository->getStudentClass($student->getEmail());
            } catch (Exception $err) {
                return $this->render('grades', ['warnings' => [$err->getMessage()]]);
            }

            $studentWholeName = $student->getName() . " " . $student->getSurname();

            $subjectGradesResult[$grade->getsubjectWholeName()][$studentClass->getClassName()][$studentWholeName][] = $grade;
        }

        return $subjectGradesResult;
    }
}