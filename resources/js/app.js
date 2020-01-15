require('./bootstrap');


Echo.channel('lupp_database_carrera')
    .listen('.carrera.nueva', (e) => {
        console.log(e);
    });