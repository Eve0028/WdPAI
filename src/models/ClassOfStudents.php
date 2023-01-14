<?php

class ClassOfStudents
{
    private $className;
    private $numberOfGrade;
    private $teacherEmail;

    public function __construct(string $className, int $numberOfGrade, string $teacherEmail)
    {
        $this->className = $className;
        $this->numberOfGrade = $numberOfGrade;
        $this->teacherEmail = $teacherEmail;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function getNumberOfGrade(): int
    {
        return $this->numberOfGrade;
    }

    public function setNumberOfGrade(int $numberOfGrade): void
    {
        $this->numberOfGrade = $numberOfGrade;
    }

    public function getTeacherEmail(): string
    {
        return $this->teacherEmail;
    }

    public function setTeacherEmail(string $teacherEmail): void
    {
        $this->teacherEmail = $teacherEmail;
    }
}