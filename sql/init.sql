DROP TABLE IF EXISTS admin;

CREATE TABLE admin
(
    admin_id  integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    login     text    NOT NULL,
    password_ text    NOT NULL
);


DROP TABLE IF EXISTS lesson_hour;

CREATE TABLE lesson_hour
(
    lesson_number integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    start_time    time    NOT NULL,
    end_time      time    NOT NULL
);


DROP TABLE IF EXISTS password_;

CREATE TABLE password_
(
    password_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    user_id     integer NOT NULL,
    password_   text    NOT NULL,
    user_type   char    NOT NULL /*('t','s','p')*/
);


DROP TABLE IF EXISTS class;

CREATE TABLE class
(
    class_id      integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    class_name    text    NOT NULL,
    grade         integer NOT NULL,
    class_teacher integer NOT NULL
);


DROP TABLE IF EXISTS teacher;

CREATE TABLE teacher
(
    teacher_id         integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    name_              text    NOT NULL,
    surname            text    NOT NULL,
    pesel              text    NOT NULL,
    date_of_birth      date    NOT NULL,
    place_of_birth     text    NOT NULL,
    place_of_residence text    NOT NULL,
    phone_number       integer NOT NULL,
    email_address      text    NOT NULL,
    subject_id         integer NOT NULL,
    gender             char    NOT NULL /*('w','m')*/
);


DROP TABLE IF EXISTS day_of_week;

CREATE TABLE day_of_week
(
    day_number integer NOT NULL,
    day_name   text    NOT NULL
);


DROP TABLE IF EXISTS presence;

CREATE TABLE presence
(
    presence_id integer    NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    class_id    integer    NOT NULL,
    student_id  integer    NOT NULL,
    date_       date       NOT NULL,
    type        varchar(3) NOT NULL /*('ob','nob','s','ns','su')*/
);


DROP TABLE IF EXISTS type_of_presence;

CREATE TABLE type_of_presence
(
    type_id    integer    NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    type       varchar(3) NOT NULL, /*('ob','nob','s','ns','su')*/
    short_name text       NOT NULL,
    whole_name text       NOT NULL,
    color      text       NOT NULL
);


DROP TABLE IF EXISTS grade;

CREATE TABLE grade
(
    grade_id   integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    grade      integer NOT NULL,
    student_id integer NOT NULL,
    teacher_id integer NOT NULL,
    subject_id integer NOT NULL,
    date_      date    NOT NULL
);


DROP TABLE IF EXISTS grade_name;

CREATE TABLE grade_name
(
    grade      integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    short_name text    NOT NULL,
    whole_name text    NOT NULL
);


DROP TABLE IF EXISTS grade_description;

CREATE TABLE grade_description
(
    description_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    grade_id       integer NOT NULL,
    description_   text    NOT NULL
);


DROP TABLE IF EXISTS test_description;

CREATE TABLE test_description
(
    description_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    test_id        integer NOT NULL,
    description_   text    NOT NULL
);


DROP TABLE IF EXISTS timetable;

CREATE TABLE timetable
(
    lesson_id     integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    day_of_week   integer NOT NULL,
    lesson_number integer NOT NULL,
    class_id      integer NOT NULL,
    teacher_id    integer NOT NULL,
    classroom_id  integer NOT NULL
);


DROP TABLE IF EXISTS subject;

CREATE TABLE subject
(
    subject_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    short_name text    NOT NULL,
    whole_name text    NOT NULL
);


DROP TABLE IF EXISTS parent;

CREATE TABLE parent
(
    parent_id          integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    name_              text    NOT NULL,
    surname            text    NOT NULL,
    pesel              text    NOT NULL,
    date_of_birth      date    NOT NULL,
    place_of_birth     text    NOT NULL,
    place_of_residence text    NOT NULL,
    phone_number       integer NOT NULL,
    email_address      text    NOT NULL,
    gender             char    NOT NULL /*set('w','m')*/
);


DROP TABLE IF EXISTS classroom;

CREATE TABLE classroom
(
    classroom_id   integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    classroom_name text    NOT NULL,
    subject_id     integer NOT NULL,
    teacher_id     integer NOT NULL
);


DROP TABLE IF EXISTS test;

CREATE TABLE test
(
    test_id       integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    class_id      integer NOT NULL,
    subject_id    integer NOT NULL,
    type_of_test  text    NOT NULL,
    teacher_id    integer NOT NULL,
    date_of_test  date    NOT NULL,
    date_of_entry date    NOT NULL
);


DROP TABLE IF EXISTS student;

CREATE TABLE student
(
    student_id         integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    student_name       text    NOT NULL,
    surname            text    NOT NULL,
    pesel              text    NOT NULL,
    date_of_birth      date    NOT NULL,
    place_of_birth     text    NOT NULL,
    place_of_residence text    NOT NULL,
    phone_number       integer NOT NULL,
    email_address      text    NOT NULL,
    class_id           integer NOT NULL,
    parent_id          integer NOT NULL,
    gender             char    NOT NULL /*set('w','m')*/
);


DROP TABLE IF EXISTS note;

CREATE TABLE note
(
    note_id    integer     NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    student_id integer     NOT NULL,
    teacher_id integer     NOT NULL,
    type       varchar(10) NOT NULL, /*set('Positive','Negative')*/
    content    text        NOT NULL,
    date_      date        NOT NULL
);


DROP TABLE IF EXISTS school;

CREATE TABLE school
(
    school_name       text    NOT NULL,
    address           text    NOT NULL,
    phone_number      integer NOT NULL,
    principal_name    text    NOT NULL,
    principal_surname text    NOT NULL
)

