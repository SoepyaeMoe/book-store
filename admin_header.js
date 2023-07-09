const personIcon = document.getElementsByClassName("person_icon")[0];
const menuIcon = document.getElementsByClassName("menu_icon")[0];
const userBox = document.getElementsByClassName("user_box")[0];
const menuItemContainer = document.getElementsByClassName("menu_icon_menu")[0];

personIcon.onclick = () => {
    userBox.classList.toggle('active');
};

menuIcon.onclick = () => {
    menuItemContainer.classList.toggle('active1');
};

window.onscroll = () => {
    userBox.classList.remove('active');
    menuItemContainer.classList.remove('active1');
}