// When user have change theme, we must save it in local-storage, or these options reset after page be updated;
var switchers = document.getElementsByClassName('themeSwitch')

if(switchers.length > 0){
    for(var i = 0; i < switchers.length; i++) {
        switchers[i].addEventListener('change', function(event){
            var theme = 'white';

            console.log('Theme changed on: ' + theme)

            if(event.target.checked){
                theme = 'dark'
                document.body.setAttribute('data-theme', 'dark')
            }   else{
                document.body.removeAttribute('data-theme')
            }

            // Fix for framework styles;
            $('.anim-menu-btn__icon').addClass('cross-fix')
            setTimeout(function(){
                $('.anim-menu-btn__icon').removeClass('cross-fix')
            }, 1)

            // Save theme in DB after switch;
            $.ajax({
                data: {
                    theme: theme
                },
                url: '/users/settings/saveTheme/ajax',
                type: 'POST',
                success: function(response) {},
            });

            changeAllSwitchers(event.target.checked)
        });
    }
}

function changeAllSwitchers(state){
    for(var i = 0; i < switchers.length; i++) {
        if(switchers[i].checked !== state){
            switchers[i].checked = state
        }
    }
}

