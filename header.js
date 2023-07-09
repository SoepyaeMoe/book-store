const menuIcon = document.getElementById('menu');
const personIcon = document.getElementById('preson');
const userBox = document.getElementsByClassName('user_info_box')[0];
const menuCon = document.getElementsByClassName('menu_items_parent')[0];

menuIcon.onclick = () => {
    menuCon.classList.toggle('active');
    userBox.classList.remove('active1');
};
personIcon.onclick = () => {
    userBox.classList.toggle('active1');
    menuCon.classList.remove('active');
};
window.onscroll = () => {
    menuCon.classList.remove('active');
    userBox.classList.remove('active1');
};
document.onclick = (event) => {
    if(event.target !== menuCon && event.target !== menuIcon){
        menuCon.classList.remove('active');
    }
};
