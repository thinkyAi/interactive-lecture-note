import {get, post, del} from "./ajax"
import "../css/_course.scss";
import DataTable from "datatables.net";

document.addEventListener('DOMContentLoaded', e => {
    // elements
    const all = document.querySelectorAll('#createCourseSection [data-id]')
    const step = document.querySelector('.step');
    const click = document.querySelector('.click');
    let stepCount = '1';


    const courseTable = new DataTable('#courseTable', {
        //processing: true,
        serverSide: true,
        ajax: '/course/load',
        orderMulti: false,
        columns: [
            {data: 'sn'},
            {data: 'courseCode'},
            {data: 'courseTitle'},
            {
                data: row =>
                    `<button type="button">Course outline</button>`
            },
            {
                data: row =>
                    `<button type="button">Progress</button>`
            },
            {
                data: row =>
                    ` <div class="dropdown d-inline-block">
                <a href="#" class="text-decoration-none d-flex align-items-center text-white" id="userDropDownMenu" data-bs-toggle="dropdown"
                   aria-expanded="false">                    
                    <i class="bi bi-three-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropDownMenu">
                    <li>
                    <button class="dropdown-item" >View details</button>                       
                    </li>
                    <li>
                    <button class="dropdown-item" href="#">Edit</button>                       
                    </li>                   
                    <li>
                    <button class="dropdown-item" href="#">Delete</button>                       
                    </li>
                </ul>
            </div>
                        `
            }
        ]
    })

    document.querySelector('.btn-next').addEventListener('click', e => {
        e.preventDefault();
        all.forEach(elm => {
            if (! elm.classList.contains('d-none')) {
                elm.classList.add('d-none');
            }
        });
        let next = ++stepCount;
        if (next > 1 && next < 5) {
            all.forEach(elm => {
                if (elm.getAttribute('data-id') === (next).toString()) {
                    elm.classList.remove('d-none');
                    elm.classList.add('animate__animated', 'animate__fadeInRight');
                }
            })

            if (next === 4) {
                document.querySelector('.btn-prevNext').classList.add('d-none');
                document.querySelector('.form-container-2').classList.add('d-none');
                document.querySelector('.guided-text').textContent = 'Course Outline Creation';
                registerCourse(next);
            }
            document.querySelector('.btn-prev').classList.remove('d-none');
            document.querySelector('.btn-prevNext').classList.add('animate__animated', 'animate__fadeIn')
            step.textContent = (next).toString();
        }

    });

    document.querySelector('.btn-prev').addEventListener('click', e => {
        e.preventDefault();
        all.forEach(elm => {
            if (! elm.classList.contains('d-none')) {
                elm.classList.add('d-none');
            }
        })
        let prev = --stepCount;
        if (prev  < 5 ) {
            all.forEach(elm => {
                if (elm.getAttribute('data-id') === (prev).toString()) {
                    elm.classList.remove('d-none');
                    if (elm.classList.contains('animate__fadeInRight')) {
                        elm.classList.remove('animate__fadeInRight');
                        elm.classList.add('animate__fadeInLeft');
                    }
                }
            });
            
            if (prev === 1) {
                document.querySelector(`#createCourseSection [data-id="${prev}"]`).classList.add('animate__animated','animate__fadeInLeft');
                if (! document.querySelector('.btn-prev').classList.contains('d-none') ) {
                    document.querySelector('.btn-prev').classList.add('d-none')
                }
            }
            
            step.textContent = (prev).toString();
        }

    })

    // GET COURSES BY LEVEL AND SEMESTER
    const showCoursesByLevelAndSemester = function () {
        const studyLevel = document.getElementById('studyLevel');
        const semester = document.getElementById('semester');
        const courseCodeSelect = document.getElementById('courseCode');
        const courseTitleInput = document.getElementById('courseTitle');

        studyLevel.addEventListener('change', fetchCourses);
        semester.addEventListener('change', fetchCourses);

        async  function fetchCourses () {
            const studyLevelId = studyLevel.value;
            const semesterId = semester.value;

            let courses;
            if (studyLevelId && semesterId) {
                const response = await fetch(`/course/fetch-by-level-and-semester?levelId=${studyLevelId}&semesterId=${semesterId}`);
                courses = await response.json();

                // clear existing options and value
                courseCodeSelect.innerHTML = '<option value="" selected hidden>-- select course code --</option>';
                courseTitleInput.value = '';

                // Populate new options
                courses.forEach(course => {
                    const option = document.createElement('option');
                    option.value = course.courseCode;
                    option.textContent = course.courseCode;

                    courseCodeSelect.appendChild(option);
                });

            }

            // get course title by course code
            courseCodeSelect.addEventListener('change', ev => {
                const courseCodeId = ev.currentTarget.value;
                if (studyLevelId && semesterId) {
                    const course = courses.find(course => course.courseCode === courseCodeId )
                    //console.log(course)
                    courseTitleInput.value = course.courseTitle
                }
            })

        }
    };

    // REGISTER COURSE BY LECTURER
    const registerCourse = function (next) {
        const dataId = document.querySelector('#courseCreationForm [data-id="3"]');
        const courseDOM =   document.querySelector('#courseCreationForm');
        if (next) {
            post('/course/create', getFormData(), courseDOM )
                .then(response => {
                    if (response.ok) {
                        courseTable.draw();
                    }
                })
           

        }
    }

    // SHOW COURSE OUTLINE - MODULE DATA TABLES
    const showModuleDataTables = function () {
       const moduleOption = {
            serverSide: true,
            ajax: '/module/load',
            orderMulti: false,
            columns: [
                {data: 'sn'},
                {data: 'timeline'},
                {data: 'courseOutline'},
                {data: 'progress'},
                {
                    data: row =>
                        ` <div class="dropdown d-inline-block">
                <a href="#" class="text-decoration-none d-flex align-items-center text-white" id="userDropDownMenu" data-bs-toggle="dropdown"
                   aria-expanded="false">                    
                    <i class="bi bi-three-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropDownMenu">
                    <li>
                    <button class="dropdown-item" >View details</button>                       
                    </li>
                    <li>
                    <button class="dropdown-item" href="#">Create Note</button>                       
                    </li>
                    <li>
                    <button class="dropdown-item" href="#">Edit</button>                       
                    </li>
                    <li>
                    <button class="dropdown-item" href="#">Delete</button>                       
                    </li>
                </ul>
            </div>
                        `
                }
            ]
        }
        //const table = new DataTable('#moduleTable', moduleOption);
    }
    
       
    const getFormData = function () {
        const form = document.getElementById('courseCreationForm');
        const formData = new FormData(form);
        let data = {};
        formData.forEach((value, key) => {
           return data[key] = value
        })
        return data;
    }

    showCoursesByLevelAndSemester(); 
    

})