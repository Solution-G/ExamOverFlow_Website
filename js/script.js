let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () => {
    toggleBtn.classList.replace('fa-sun', 'fa-moon');
    body.classList.add('dark');
    localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () => {
    toggleBtn.classList.replace('fa-moon', 'fa-sun');
    body.classList.remove('dark');
    localStorage.setItem('dark-mode', 'disabled');
}

// for the main page
const toggleBtn1 = document.getElementById('toggle-btn');
const bigText = document.querySelector('.big-text');
const paragraph = document.querySelector('.paragraph');

toggleBtn1.addEventListener('click', function () {
    bigText.classList.toggle('dark-mode');
    paragraph.classList.toggle('dark-mode');
});

if (darkMode === 'enabled') {
    enableDarkMode();
}

toggleBtn.onclick = (e) => {
    darkMode = localStorage.getItem('dark-mode');
    if (darkMode === 'disabled') {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
}

let profile = document.querySelector('.header .flex .profile');
let search = document.querySelector('.header .flex .search-form');
let sideBar = document.querySelector('.side-bar');

document.querySelector('#search-btn').onclick = () => {
    search.classList.toggle('active');
    profile.classList.remove('active');
}


// ensure the side bar is initially inactive
sideBar.classList.remove('active');
body.classList.remove('active');



document.querySelector('#close-btn').onclick = () => {
    sideBar.classList.remove('active');
    body.classList.remove('active');
}

document.querySelector('#menu-btn').onclick = () => {
    sideBar.classList.toggle('active');
    body.classList.toggle('active');
}

window.onscroll = () => {
    profile.classList.remove('active');
    search.classList.remove('active');

    if (window.innerWidth < 1200) {
        sideBar.classList.remove('active');
        body.classList.remove('active');
    }
    if (window.innerWidth < 731) {
        search.classList.remove('active');
        profile.classList.remove('active');
    }
}

function displayConfirmation() {

    var massage = "Feedback submitted succesfully ";
    alert(massage);
    return false;
}

function validateQuestion(){
    let subject = document.querySelector('#subject');
    let topic = document.querySelector('#topic');
    let question = document.querySelector('#question');

    if (!validateSubject(subject.value)){
        subject.classList.add('error');
        return false;
    }else{
        subject.classList.remove('error');
    }
}

function validateSubject(subject){
    my_subjects = ['chemistry', 'mathematics', 'biology', 'english', 'physics'];
    if (my_subjects.indexOf(subject.toLowerCase()) === -1){
        return false;
    }
    console.log("Here");
    return true;
}

function nameValidator(name){

}

function passwordValidator(password){

}

function emailValidator(email){

}