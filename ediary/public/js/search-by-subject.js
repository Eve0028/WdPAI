const search = document.querySelector('select[name="subject-select"]');
const teacherContainer = document.querySelector('#teacher-grades-view');

search.addEventListener("change", function () {
    const data = {filter: this.value};

    fetch("/filtersub", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then((function (response) {
        return response.json();
    })).then(function (gradesBySubjects) {
        teacherContainer.innerHTML = "";
        loadGradesBySubjects(gradesBySubjects);
    })
});

function loadGradesBySubjects(gradesAllSubjects) {
    const template = document.querySelector("#grades-in-subject");

    let subjectTemplate = template.content.cloneNode(true);
    let classTemplate = subjectTemplate.querySelector('.class-with-students').cloneNode(true);
    let studentTemplate = classTemplate.querySelector('.student-with-grades').cloneNode(true);
    let gradeTemplate = studentTemplate.querySelector('.one-grade').cloneNode(true);
    subjectTemplate.querySelector('.subject-class').innerHTML = "";
    classTemplate.querySelector('.all-student-in-class').innerHTML = "";
    studentTemplate.querySelector('.student-grades-only').innerHTML = "";
    gradeTemplate.innerHTML = "";

    for (let gradesSubject in gradesAllSubjects) {
        if (gradesAllSubjects.hasOwnProperty(gradesSubject)) {
            let cloneGradesSubject = subjectTemplate.cloneNode(true);
            cloneGradesSubject.querySelector('.subject-name').innerHTML = gradesSubject;

            for (let studentsClass in gradesAllSubjects[gradesSubject]) {
                if (gradesAllSubjects[gradesSubject].hasOwnProperty(studentsClass)) {
                    const htmlClass = classTemplate.cloneNode(true);
                    htmlClass.querySelector('.one-class').innerHTML = studentsClass;

                    for (let student in gradesAllSubjects[gradesSubject][studentsClass]) {
                        if (gradesAllSubjects[gradesSubject][studentsClass].hasOwnProperty(student)) {
                            const htmlStudent = studentTemplate.cloneNode(true);
                            htmlStudent.querySelector('.one-student-name').innerHTML = student;

                            for (let grade in gradesAllSubjects[gradesSubject][studentsClass][student]) {
                                const htmlGrade = gradeTemplate.cloneNode(true);
                                htmlGrade.innerHTML = gradesAllSubjects[gradesSubject][studentsClass][student][grade]["grade"];

                                htmlStudent.querySelector('.student-grades-only').appendChild(htmlGrade);
                            }
                            htmlClass.querySelector('.all-student-in-class').appendChild(htmlStudent);
                        }
                    }
                    cloneGradesSubject.querySelector('.subject-class').appendChild(htmlClass);
                }
            }
            teacherContainer.appendChild(cloneGradesSubject);
        }
    }
}
