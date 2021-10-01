let session_user = $('#session_user').text();

if (session_user) {
    $(".btn.login").hide();
    let session_typeuser = $('#session_typeuser').text();
    if (session_typeuser == 'patient') {
        $(".nav-link.appointments").hide();
        $(".nav-link.exams").hide();
    } else if (session_typeuser == 'doctor') {
        $(".nav-link.doctors").hide();
        $(".nav-link.contact").hide();
        $(".nav-link.make-appointment").hide();
        $(".nav-link.exams").hide();
        $(".nav-link.exams-history").hide();
        $(".page-section.make-appointment").hide();

    } else if (session_typeuser == 'laboratory') {
        $(".nav-link.doctors").hide();
        $(".nav-link.appointments").hide();
        $(".nav-link.appointment-history").hide();
        $(".nav-link.contact").hide();
        $(".nav-link.make-appointment").hide();
        $(".page-section.make-appointment").hide();
    }

} else {
    $(".nav-link.appointments").hide();
    $(".nav-link.exams").hide();
    $(".nav-link.appointment-history").hide();
    $(".nav-link.exams-history").hide();
}