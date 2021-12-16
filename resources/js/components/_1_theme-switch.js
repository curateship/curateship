// When user have change theme, we must save it in local-storage, or these options reset after page be updated;
document.getElementById('themeSwitch').addEventListener('change', function(event){
    (event.target.checked) ? document.body.setAttribute('data-theme', 'dark') : document.body.removeAttribute('data-theme')
    localStorage.setItem('selected-theme', event.target.checked ? 'dark' : 'white')

    // Fix for framework styles;
    $('.anim-menu-btn__icon').addClass('cross-fix')
    setTimeout(function(){
        $('.anim-menu-btn__icon').removeClass('cross-fix')
    }, 1)
});
