DROP TABLE IF EXISTS admin;

CREATE TABLE admin
(
    admin_id  integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    login     text    NOT NULL,
    password_ text    NOT NULL
);

INSERT INTO admin (login, password_)
VALUES ('admin', '$2y$10$vLdhtG4jdd6Qn1W86gr7ruBcCFtHNPJgFwfaRmlphdbFKapAkpeuS');


DROP TABLE IF EXISTS address;

CREATE TABLE address
(
    address_id  integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    postal_code text    NOT NULL,
    street      text    NOT NULL,
    locality    text    NOT NULL,
    number      text    NOT NULL
);

INSERT INTO address (postal_code, street, locality, number)
VALUES ('postal_code1', 'street1', 'locality1', 'number1'),
       ('postal_code2', 'street2', 'locality2', 'number2');


DROP TABLE IF EXISTS gender;

CREATE TABLE gender
(
    gender_id integer     NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    gender    varchar(25) NOT NULL
);

INSERT INTO gender (gender)
VALUES ('female'),
       ('male');


DROP TABLE IF EXISTS user_details;

CREATE TABLE user_details
(
    user_details_id integer     NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    name_           text        NOT NULL,
    surname         text        NOT NULL,
    pesel           text        NOT NULL,
    date_of_birth   date        NOT NULL,
    place_of_birth  text        NOT NULL,
    address_id      integer     NOT NULL,
    phone_number    varchar(15) NOT NULL,
    gender_id       integer,

    CONSTRAINT fk_address
        FOREIGN KEY (address_id)
            REFERENCES address (address_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_gender
        FOREIGN KEY (gender_id)
            REFERENCES gender (gender_id)
            on update cascade on delete set null
);

INSERT INTO user_details (name_, surname, pesel, date_of_birth, place_of_birth, address_id, phone_number, gender_id)
VALUES ('Grzegorz', 'Inny', '05241686211', '2008-04-16', 'Wrocław', 2, '989937278',
        2),
       ('Katarzyna', 'Sasim', '05310681781', '2008-11-06', 'Lublin', 2, '983678002', 1),
       ('Jakub', 'Kazimierz', '05252243997', '2008-05-22', 'Kraków', 2, '678829651',
        2),
       ('Julia', 'Golanczyk', '05291186846', '2008-09-11', 'Oleśnica', 2, '444678882',
        1),
       ('Aleksandra', 'Jasiak', '05220541728', '2008-02-05', 'Oleśnica', 2, '892776190', 1),
       ('Mateusz', 'Soplica', '05262463837', '2008-06-24', 'Bydgoszcz', 2, '988727337',
        2),
       ('Wiktoria', 'Lysiak', '05301631128', '2008-10-16', 'Szczecin', 2, '980026234',
        1),
       ('Zuzanna', 'Smith', '05221321628', '2008-02-13', 'Wrocław', 2, '555819233', 1),
       ('Bartek', 'Potocki', '05300982935', '2008-10-09', 'Gdynia', 2, '233789179', 2),
       ('Jan', 'Potocki', '05242577273', '2008-04-25', 'Gdynia', 1, '899932221', 2),
       ('Michał', 'Mater', '05320182757', '2008-12-01', 'Lublin', 1, '227888946', 2),
       ('Natalia', 'Babiarz', '05293076363', '2008-09-30', 'Leszno', 1, '287900123', 1),
       ('Maja', 'Mazurowska', '05230325686', '2008-03-03', 'Poznań', 1, '222900987', 1),
       ('Maciej', 'Mieta', '05241936897', '2008-04-19', 'Olsztyn', 1, '992100289', 2),
       ('Piotr', 'Gates', '05303151394', '2008-10-31', 'Kraków', 1, '121189873', 2),
       ('Oliwia', 'Kaczan', '05221589284', '2008-02-15', 'Poznań', 1, '122988789', 1),
       ('Szymon', 'Lysiak', '03233089833', '2006-03-30', 'Szczecin', 1, '333789871',
        2),
       ('Anna', 'Jasiak', '03300945727', '2006-11-09', 'Oleśnica', 1, '122345432', 1),
       ('Filip', 'Wanik', '03242141597', '2006-04-21', 'Gdynia', 1, '938109206', 2),
       ('Zofia', 'Lisowska', '03211985542', '2006-01-19', 'Szczecin', 1, '228178471',
        1),
       ('Magdalena', 'Kilarska', '03292079165', '2006-09-20', 'Kraków', 1, '192948701',
        1),
/*22 - parents*/
       ('Stefan', 'Inny', '68072064915', '1968-07-20', 'Szczecin', 2, '632458991', 2),
/*23 - teachers*/
       ('Adam', 'Holmes', '70122597692', '1970-12-25', 'Oleśnica', 2, '734865238', 2);

DROP TABLE IF EXISTS user_type;

CREATE TABLE user_type
(
    user_type_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    user_type    text    NOT NULL
);

INSERT INTO user_type (user_type)
VALUES ('teacher'),
       ('student'),
       ('parent');


DROP TABLE IF EXISTS user_;

CREATE TABLE user_
(
    user_id         integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    user_details_id integer NOT NULL,
    user_type_id    integer NOT NULL,
    password_       text    NOT NULL,
    email           text    NOT NULL,
    enabled_        boolean NOT NULL default false,
    salt            text    NOT NULL,
    created_at      date    NOT NULL,

    CONSTRAINT fk_details
        FOREIGN KEY (user_details_id)
            REFERENCES user_details (user_details_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_user_type
        FOREIGN KEY (user_type_id)
            REFERENCES user_type (user_type_id)
            on update cascade on delete cascade
);

INSERT INTO user_ (user_details_id, user_type_id, password_, email, salt, created_at)
VALUES (22, 3, '$2y$10$V.ajrG1rUZtKbOuPMQGJzufRHf6pZ1ZaY6SDyAYcMKHSnqG6OqW/2', 'stefan_r@gmail.com', '', '2022-08-15'),
       (1, 2, '$2y$10$HWn28CH35AEw13Z1y0YeFeL2NXWL0btylGfc1UMwaQJZPUTMt8//i', 'grzegorz_u@gmail.com', '',
        '2022-08-15'),
       (2, 2, '$2y$10$HXX77CSD0izDT61WFGx8POBRIOSoRncvz5v3Kh.7Y5z2DSEf8tRMG', 'kasia_u@gmail.com', '', '2022-08-15'),
       (4, 2, '$2y$10$gqID8u9x4ACzsfF6oD3rD.8HBCrkO1AEhw7jwUSMLh3H8xiptbCo.', 'julia_u@gmail.com', '', '2022-08-15'),
       (23, 1, '$2y$10$0gxpacYmYQ1feEtKcISLF.9ADWzBsRtiLM6Qn0BTakoA5PvQxvzfW', 'adam_n@gmail.com', '', '2022-08-15');
/*p, s, s, s, t*/


DROP TABLE IF EXISTS subject;

CREATE TABLE subject
(
    subject_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    short_name text    NOT NULL,
    whole_name text    NOT NULL
);

INSERT INTO subject (short_name, whole_name)
VALUES ('math', 'Mathematics'),
       ('art', 'Art'),
       ('english', 'English'),
       ('languages', 'Foreign languages'),
       ('chemi', 'Chemistry'),
       ('biology', 'Biology'),
       ('geography', 'Geography'),
       ('physics', 'Physics'),
       ('history', 'History'),
       ('philosophy', 'Philosophy'),
       ('PE', 'Physical Education'),
       ('algebra', 'Algebra'),
       ('IT', 'Information Technology');


DROP TABLE IF EXISTS teacher;

CREATE TABLE teacher
(
    teacher_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    user_id    integer NOT NULL,

    CONSTRAINT fk_user
        FOREIGN KEY (user_id)
            REFERENCES user_ (user_id)
            on update cascade on delete cascade
);

INSERT INTO teacher (user_id)
VALUES (5);


CREATE TABLE teacher_subject
(
    teacher_subject_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    teacher_id integer NOT NULL,
    subject_id integer NOT NULL,

    CONSTRAINT fk_teacher
        FOREIGN KEY (teacher_id)
            REFERENCES teacher (teacher_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_subject
        FOREIGN KEY (subject_id)
            REFERENCES subject (subject_id)
            on update cascade on delete cascade
);


DROP TABLE IF EXISTS parent;

CREATE TABLE parent
(
    parent_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    user_id   integer NOT NULL,

    CONSTRAINT fk_user
        FOREIGN KEY (user_id)
            REFERENCES user_ (user_id)
            on update cascade on delete cascade
);

INSERT INTO parent (user_id)
VALUES (1);


/* class - list of students */
DROP TABLE IF EXISTS class;

CREATE TABLE class
(
    class_id      integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    class_name    text    NOT NULL,
    grade         integer NOT NULL,
    class_teacher integer NOT NULL,

    CONSTRAINT fk_class_teacher
        FOREIGN KEY (class_teacher)
            REFERENCES teacher (teacher_id)
            on update cascade on delete cascade
);

INSERT INTO class (class_name, grade, class_teacher)
VALUES ('1a', 1, 1),
       ('1b', 1, 1),
       ('2a', 2, 1),
       ('2c', 2, 1),
       ('3b', 3, 1);


DROP TABLE IF EXISTS student;

CREATE TABLE student
(
    student_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    user_id    integer NOT NULL,
    class_id   integer NOT NULL,
    parent_id  integer NOT NULL,

    CONSTRAINT fk_user
        FOREIGN KEY (user_id)
            REFERENCES user_ (user_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_class
        FOREIGN KEY (class_id)
            REFERENCES class (class_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_parent
        FOREIGN KEY (parent_id)
            REFERENCES parent (parent_id)
            on update cascade on delete cascade
);

INSERT INTO student (user_id, class_id, parent_id)
VALUES (2, 1, 1),
       (3, 2, 1),
       (4, 1, 1);


DROP TABLE IF EXISTS lesson_hour;

CREATE TABLE lesson_hour
(
    lesson_number integer NOT NULL primary key,
    start_time    time    NOT NULL,
    end_time      time    NOT NULL
);

INSERT INTO lesson_hour (lesson_number, start_time, end_time)
VALUES (1, '08:00:00', '08:45:00'),
       (2, '08:50:00', '09:35:00'),
       (3, '09:40:00', '10:25:00'),
       (4, '10:35:00', '11:20:00'),
       (5, '11:25:00', '12:10:00'),
       (6, '12:15:00', '13:00:00'),
       (7, '13:15:00', '14:00:00'),
       (8, '14:05:00', '14:50:00'),
       (9, '14:55:00', '15:40:00'),
       (10, '15:45:00', '16:30:00');


DROP TABLE IF EXISTS day_of_week;

CREATE TABLE day_of_week
(
    day_number integer NOT NULL primary key,
    day_name   text    NOT NULL
);

INSERT INTO day_of_week (day_number, day_name)
VALUES (1, 'Monday'),
       (2, 'Tuesday'),
       (3, 'Wednesday'),
       (4, 'Thursday'),
       (5, 'Friday');


DROP TABLE IF EXISTS classroom;

CREATE TABLE classroom
(
    classroom_id   integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    classroom_name text    NOT NULL,
    subject_id     integer NOT NULL,
    teacher_id     integer NOT NULL,

    CONSTRAINT fk_subject
        FOREIGN KEY (subject_id)
            REFERENCES subject (subject_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_teacher
        FOREIGN KEY (teacher_id)
            REFERENCES teacher (teacher_id)
            on update cascade on delete cascade
);

INSERT INTO classroom (classroom_name, subject_id, teacher_id)
VALUES ('r5', 1, 1),
       ('r6', 2, 1),
       ('r7', 3, 1),
       ('r8', 4, 1),
       ('r9', 5, 1),
       ('r12', 6, 1),
       ('r13', 7, 1),
       ('r14', 8, 1),
       ('rg', 9, 1),
       ('r15', 10, 1),
       ('r16', 11, 1),
       ('r17', 12, 1);


DROP TABLE IF EXISTS timetable;

CREATE TABLE timetable
(
    lesson_id     integer NOT NULL primary key,
    day_of_week   integer NOT NULL,
    lesson_number integer NOT NULL,
    class_id      integer NOT NULL,
    teacher_id    integer NOT NULL,
    classroom_id  integer NOT NULL,

    CONSTRAINT fk_class
        FOREIGN KEY (class_id)
            REFERENCES class (class_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_teacher
        FOREIGN KEY (teacher_id)
            REFERENCES teacher (teacher_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_classroom
        FOREIGN KEY (classroom_id)
            REFERENCES classroom (classroom_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_lesson
        FOREIGN KEY (lesson_number)
            REFERENCES lesson_hour (lesson_number)
            on update cascade on delete cascade,
    CONSTRAINT fk_day
        FOREIGN KEY (day_of_week)
            REFERENCES day_of_week (day_number)
            on update cascade on delete cascade
);

INSERT INTO timetable (lesson_id, day_of_week, lesson_number, class_id, teacher_id, classroom_id)
VALUES (1, 1, 1, 1, 1, 2),
       (2, 1, 2, 1, 1, 2),
       (3, 1, 3, 1, 1, 6),
       (4, 1, 4, 1, 1, 1),
       (5, 1, 5, 1, 1, 5),
       (6, 1, 6, 1, 1, 5),
       (7, 1, 7, 1, 1, 11),
       (8, 2, 3, 1, 1, 1),
       (9, 2, 4, 1, 1, 3),
       (10, 2, 5, 1, 1, 2),
       (11, 2, 6, 1, 1, 7),
       (12, 2, 7, 1, 1, 9),
       (13, 2, 8, 1, 1, 9),
       (14, 3, 2, 1, 1, 3),
       (15, 3, 3, 1, 1, 11),
       (16, 3, 4, 1, 1, 4),
       (17, 3, 5, 1, 1, 1),
       (18, 3, 6, 1, 1, 6),
       (19, 3, 7, 1, 1, 8),
       (20, 4, 2, 1, 1, 5),
       (21, 4, 3, 1, 1, 12),
       (22, 4, 4, 1, 1, 2),
       (23, 4, 5, 1, 1, 8),
       (24, 4, 6, 1, 1, 7),
       (25, 5, 1, 1, 1, 9),
       (26, 5, 2, 1, 1, 9),
       (27, 5, 3, 1, 1, 1),
       (28, 5, 4, 1, 1, 4),
       (29, 5, 5, 1, 1, 2),
       (30, 5, 6, 1, 1, 11),
       (31, 5, 7, 1, 1, 3),
       (32, 1, 2, 2, 1, 7),
       (33, 1, 3, 2, 1, 2),
       (34, 1, 4, 2, 1, 5),
       (35, 1, 5, 2, 1, 1),
       (36, 1, 6, 2, 1, 11),
       (37, 1, 7, 2, 1, 3),
       (38, 2, 1, 2, 1, 6),
       (39, 2, 2, 2, 1, 1),
       (40, 2, 3, 2, 1, 3),
       (41, 2, 4, 2, 1, 2),
       (42, 2, 5, 2, 1, 9),
       (43, 2, 6, 2, 1, 9),
       (44, 3, 2, 2, 1, 11),
       (45, 3, 3, 2, 1, 4),
       (46, 3, 4, 2, 1, 2),
       (47, 3, 5, 2, 1, 6),
       (48, 3, 6, 2, 1, 8),
       (49, 4, 1, 2, 1, 1),
       (50, 4, 2, 2, 1, 12),
       (51, 4, 3, 2, 1, 2),
       (52, 4, 4, 2, 1, 8),
       (53, 4, 5, 2, 1, 2),
       (54, 4, 6, 2, 1, 3),
       (55, 4, 7, 2, 1, 7),
       (56, 5, 2, 2, 1, 5),
       (57, 5, 3, 2, 1, 9),
       (58, 5, 4, 2, 1, 9),
       (59, 5, 5, 2, 1, 1),
       (60, 5, 6, 2, 1, 4),
       (61, 5, 7, 2, 1, 2),
       (62, 5, 8, 2, 1, 11);


DROP TABLE IF EXISTS type_of_presence;

CREATE TABLE type_of_presence
(
    type_id    integer    NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    type       varchar(3) NOT NULL unique, /*('pr','ab','e','as','l', 'le')*/
    short_name text       NOT NULL,
    whole_name text       NOT NULL,
    color      text       NOT NULL
);

INSERT INTO type_of_presence (type, short_name, whole_name, color)
VALUES ('pr', '[pr]', 'Presence', '#FFF'),
       ('ab', '[-]', 'Absence', '#ffa687'),
       ('e', '[e]', 'Excused absence', '#fcc150'),
       ('as', '[as]', 'Absence for school reasons', '#a9c9fd'),
       ('l', '[l]', 'Late', '#ede049'),
       ('le', '[le]', 'Excused lateness', '#87a7ff');


DROP TABLE IF EXISTS presence;

CREATE TABLE presence
(
    presence_id integer    NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    lesson_id   integer    NOT NULL,
    student_id  integer    NOT NULL,
    date_       date       NOT NULL,
    type        varchar(3) NOT NULL /*('pr','ab','e','as','l', 'le')*/,

    CONSTRAINT fk_lesson
        FOREIGN KEY (lesson_id)
            REFERENCES timetable (lesson_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_student
        FOREIGN KEY (student_id)
            REFERENCES student (student_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_type
        FOREIGN KEY (type)
            REFERENCES type_of_presence (type)
            on update cascade on delete cascade
);

INSERT INTO presence (lesson_id, student_id, date_, type)
VALUES (1, 3, '2022-12-05', 'pr'),
       (1, 1, '2023-01-03', 'ab'),
       (8, 1, '2022-12-08', 'l'),
       (32, 2, '2019-05-13', 'as'),
       (33, 2, '2019-05-13', 'l');


DROP TABLE IF EXISTS grade_name;

CREATE TABLE grade_name
(
    grade      integer NOT NULL primary key,
    short_name text    NOT NULL,
    whole_name text    NOT NULL
);

INSERT INTO grade_name (grade, short_name, whole_name)
VALUES (1, 'isuf', 'insufficient'),
       (2, 'per', 'permissive'),
       (3, 'suf', 'sufficient'),
       (4, 'gd', 'good'),
       (5, 'vgd', 'very good'),
       (6, 'aim', 'aiming');


DROP TABLE IF EXISTS grade;

CREATE TABLE grade
(
    grade_id   integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    grade      integer NOT NULL,
    student_id integer NOT NULL,
    teacher_id integer NOT NULL,
    subject_id integer NOT NULL,
    date_      date    NOT NULL,

    CONSTRAINT fk_student
        FOREIGN KEY (student_id)
            REFERENCES student (student_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_teacher
        FOREIGN KEY (teacher_id)
            REFERENCES teacher (teacher_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_subject
        FOREIGN KEY (subject_id)
            REFERENCES subject (subject_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_grade
        FOREIGN KEY (grade)
            REFERENCES grade_name (grade)
            on update cascade on delete cascade
);

INSERT INTO grade (grade, student_id, teacher_id, subject_id, date_)
VALUES (3, 2, 1, 3, '2019-04-15'),
       (3, 1, 1, 1, '2019-05-02'),
       (4, 3, 1, 3, '2019-03-14'),
       (5, 1, 1, 3, '2019-04-24'),
       (4, 3, 1, 12, '2019-04-22'),
       (1, 2, 1, 12, '2019-04-12'),
       (2, 1, 1, 1, '2019-05-06'),
       (3, 2, 1, 3, '2019-04-18'),
       (6, 3, 1, 9, '2019-04-02'),
       (4, 1, 1, 1, '2019-03-15');


DROP TABLE IF EXISTS grade_description;

CREATE TABLE grade_description
(
    description_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    grade_id       integer NOT NULL,
    description_   text    NOT NULL,

    CONSTRAINT fk_grade
        FOREIGN KEY (grade_id)
            REFERENCES grade (grade_id)
            on update cascade on delete cascade
);

INSERT INTO grade_description (grade_id, description_)
VALUES (1, 'Test - past tenses'),
       (4, 'Test');


DROP TABLE IF EXISTS test;

CREATE TABLE test
(
    test_id       integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    class_id      integer NOT NULL,
    subject_id    integer NOT NULL,
    type_of_test  text    NOT NULL,
    teacher_id    integer NOT NULL,
    date_of_test  date    NOT NULL,
    date_of_entry date    NOT NULL,

    CONSTRAINT fk_class
        FOREIGN KEY (class_id)
            REFERENCES class (class_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_subject
        FOREIGN KEY (subject_id)
            REFERENCES subject (subject_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_teacher
        FOREIGN KEY (teacher_id)
            REFERENCES teacher (teacher_id)
            on update cascade on delete cascade
);

INSERT INTO test (class_id, subject_id, type_of_test, teacher_id, date_of_test, date_of_entry)
VALUES (1, 1, 'quiz', 1, '2019-05-01', '2019-04-15'),
       (1, 5, 'test', 1, '2019-06-06', '2019-05-23');


DROP TABLE IF EXISTS test_description;

CREATE TABLE test_description
(
    description_id integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    test_id        integer NOT NULL,
    description_   text    NOT NULL,

    CONSTRAINT fk_test
        FOREIGN KEY (test_id)
            REFERENCES test (test_id)
            on update cascade on delete cascade
);

INSERT INTO test_description (test_id, description_)
VALUES (2, 'Division 3 - density and intensity; elements');


DROP TABLE IF EXISTS note_type;

CREATE TABLE note_type
(
    note_type_id integer     NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    note_type    varchar(25) NOT NULL
);

INSERT INTO note_type (note_type)
VALUES ('Positive'),
       ('Negative');


DROP TABLE IF EXISTS note;

CREATE TABLE note
(
    note_id    integer NOT NULL primary key GENERATED ALWAYS AS IDENTITY,
    student_id integer NOT NULL,
    teacher_id integer NOT NULL,
    type       integer NOT NULL,
    content    text    NOT NULL,
    date_      date    NOT NULL,

    CONSTRAINT fk_student
        FOREIGN KEY (student_id)
            REFERENCES student (student_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_teacher
        FOREIGN KEY (teacher_id)
            REFERENCES teacher (teacher_id)
            on update cascade on delete cascade,
    CONSTRAINT fk_type
        FOREIGN KEY (type)
            REFERENCES note_type (note_type_id)
            on update cascade on delete cascade
);

INSERT INTO note (student_id, teacher_id, type, content, date_)
VALUES (1, 1, 1, 'Took part in school open days', '2022-04-15'),
       (2, 1, 2, 'He disturbed in the class', '2022-04-09'),
       (3, 1, 1, 'He helped clean the gym after the spectacle', '2022-04-22');


DROP TABLE IF EXISTS school;

CREATE TABLE school
(
    school_name       text    NOT NULL,
    address           text    NOT NULL,
    phone_number      integer NOT NULL,
    principal_name    text    NOT NULL,
    principal_surname text    NOT NULL
);

INSERT INTO school (school_name, address, phone_number, principal_name, principal_surname)
VALUES ('Exemplary Primary or Higher School', 'ul. Dluga 56, 56-120 Krakow, Poland', 335901289, 'Wlodzimierz',
        'Dyrski');
