require('./bootstrap');


Echo.channel('lupp_database_carrera')
    .listen('.carrera.nueva', (e) => {
        console.log(e);
    });

Echo.private(`carrera.4`)
    .listen('.carrera.aceptada', (e) => {
        console.log(e.update);
    });