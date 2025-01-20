
const userBtn = document.getElementById('user-btn');
const profileDropdown = document.querySelector('.profile');


userBtn.addEventListener('click', () => {
    profileDropdown.classList.toggle('active'); 
});


document.addEventListener('click', (e) => {
    if (!userBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
        profileDropdown.classList.remove('active');
    }
});
