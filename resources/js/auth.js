import "../css/_auth.scss"

window.addEventListener('DOMContentLoaded', ev => {

    //elements
    const signup = document.getElementById('signup');
    const login = document.getElementById('login');
    const btnAuth = document.querySelector('.btn-auth');

    const roleBtn = document.getElementsByName('role');
    const roleNumber = document.getElementById('roleNumber');


    document.querySelector('.btn-signup').addEventListener('click', e => {
        e.preventDefault();
        showSignupForm();
    })

    document.querySelector('.btn-login').addEventListener('click', e => {
        e.preventDefault();
        if (login.classList.contains('d-none')) {
            showLoginForm();
        }
    })

    btnAuth.addEventListener('click', e => {
        if (signup.classList.contains('d-none')) {
            showSignupForm();
        }else if (login.classList.contains('d-none')) {
            showLoginForm();
        }
    } )


    const showLoginForm = function () {
        signup.classList.add('d-none' );
        login.classList.add('animate__animated', 'animate__zoomIn')
        login.classList.remove('d-none');
        btnAuth.innerHTML = `Signup <i class="iconoir-user-plus ms-1"></i>`;
    };

    const showSignupForm = function() {
        login.classList.add('d-none' );
        signup.classList.remove('d-none');
        btnAuth.innerHTML = `Login <i class="iconoir-log-in ms-1"></i>`;
    }

    roleBtn.forEach(radio => {
        radio.addEventListener('change', e => {
            if (e.target.checked && e.target.value === "lecturer" ) {
                roleNumber.placeholder = 'ID No:..';
                roleNumber.name = 'id_number';
            } else if (e.target.checked && e.target.value === 'student') {
                roleNumber.placeholder = 'Matric Number: ...';
                roleNumber.name = 'matric_number';
            } else {
                roleNumber.placeholder = 'Staff ID No: ...'
                roleNumber.name = 'staff_id'
            }
        })
    })

})

