<?php

class Grade
{
    private $grade;
    private $student;
    private $teacher;
    private $subjectWholeName;
    private $date;

    public function __construct(int $grade, string $student, string $teacher, string $subjectWholeName, string $date)
    {
        $this->grade = $grade;
        $this->student = $student;
        $this->teacher = $teacher;
        $this->subjectWholeName = $subjectWholeName;
        $this->date = $date;
    }

    public function getGrade(): int
    {
        return $this->grade;
    }

    public function setGrade($grade): void
    {
        $this->grade = $grade;
    }

    public function getStudent(): string
    {
        return $this->student;
    }

    public function setStudent($student): void
    {
        $this->student = $student;
    }

    public function getTeacher(): string
    {
        return $this->teacher;
    }

    public function setTeacher($teacher): void
    {
        $this->teacher = $teacher;
    }

    public function getSubjectWholeName(): string
    {
        return $this->subjectWholeName;
    }

    public function setSubjectWholeName($subjectWholeName): void
    {
        $this->subjectWholeName = $subjectWholeName;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }
}