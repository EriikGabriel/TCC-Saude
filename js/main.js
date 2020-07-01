$(document).ready(function () {
    var loginStatus = localStorage.getItem('login') || 'false'

    if (loginStatus != 'false') {
        $(".user-icon li:first-child").addClass('d-none')
        $(".user-icon li:last-child").removeClass('d-none')
    } else {
        $(".user-icon li:first-child").removeClass('d-none')
        $(".user-icon li:last-child").addClass('d-none')
    }

    $(".exit").click(function () {
        localStorage.setItem('login', 'false')
        location.reload()
    })

})