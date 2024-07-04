//use strict to get more details about wrong 
//code or misspelled variables

'use strict';

//Find the button with class btn
const switcher = document.querySelector('.btn');

//attach click handler
switcher.addEventListener('click', function() {
    //add or remove style by toggling on/off
    document.body.classList.toggle('light-theme');
    document.body.classList.toggle('dark-theme');

    //update button text
    const className = document.body.className;
    if(className == "light-theme") {
        this.textContent = "Dark";
    } else {
        this.textContent = "Light";
    }

    console.log('current class name: ' + className);
});
