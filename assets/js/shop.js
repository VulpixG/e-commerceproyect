function filtraOrdenamiento(){
    var orden = $('#ordenamiento').val();

    var queryParams = new URLSearchParams(window.location.search);
    queryParams.set('orden', orden);
    window.location.search = queryParams.toString();
}

function filtraExpansiones(){
    var expan = $('#nuevoCombo').val();

    var queryParams = new URLSearchParams(window.location.search);
    queryParams.set('exp', expan);
    window.location.search = queryParams.toString();
}
//PARA SINGLES
function filtroMTG(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('tcg');
        if (prod) {
            queryParams.set('tcg', prod);
        } else {
            queryParams.set('tcg', 1);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcg', 1);
        window.location.search = queryParams.toString();
    }
}

function filtroPOK(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('tcg');
        if (prod) {
            queryParams.set('tcg', prod);
        } else {
            queryParams.set('tcg', 2);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcg', 2);
        window.location.search = queryParams.toString();
    }
}

function filtroOneP(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    if (orden) {
        // Mantener el parámetro 'tcg' si ya existe
        var prod = queryParams.get('tcg');
        if (prod) {
            queryParams.set('tcg', prod);
        } else {
            queryParams.set('tcg', 5);
        }
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcg', 5);
    }
    window.location.search = queryParams.toString();
}

function filtroYUG(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('tcg');
        if (prod) {
            queryParams.set('tcg', prod);
        } else {
            queryParams.set('tcg', 3);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcg', 3);
        window.location.search = queryParams.toString();
    }
}

function filtroLor(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('tcg');
        if (prod) {
            queryParams.set('tcg', prod);
        } else {
            queryParams.set('tcg', 4);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcg', 4);
        window.location.search = queryParams.toString();
    }
}
//PARA EL SELLADO:
function filtroMTGS(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('tcgs');
        if (prod) {
            queryParams.set('tcgs', prod);
        } else {
            queryParams.set('tcgs', 1);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcgs', 1);
        window.location.search = queryParams.toString();
    }
}

function filtroPOKS(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('tcgs');
        if (prod) {
            queryParams.set('tcgs', prod);
        } else {
            queryParams.set('tcgs', 2);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcgs', 2);
        window.location.search = queryParams.toString();
    }
}

function filtroYUGS(){
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('tcgs');
        if (prod) {
            queryParams.set('tcgs', prod);
        } else {
            queryParams.set('tcgs', 3);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('tcgs', 3);
        window.location.search = queryParams.toString();
    }
}
//PARA FILTRAR POR OTROS PRODUCTOS: MICAS
function filtroM(){//micas
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('prod');
        if (prod) {
            queryParams.set('prod', prod);
        } else {
            queryParams.set('prod', 1);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('prod', 1);
        window.location.search = queryParams.toString();
    }
}
//dados
function filtroD() {
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('prod');
        if (prod) {
            queryParams.set('prod', prod);
        } else {
            queryParams.set('prod', 2);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('prod', 2);
        window.location.search = queryParams.toString();
    }
}
//juegos de mesa
function filtroJ() {
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('prod');
        if (prod) {
            queryParams.set('prod', prod);
        } else {
            queryParams.set('prod', 3);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('prod', 3);
        window.location.search = queryParams.toString();
    }
}
//carpetas
function filtroC() {
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('prod');
        if (prod) {
            queryParams.set('prod', prod);
        } else {
            queryParams.set('prod', 4);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('prod', 4);
        window.location.search = queryParams.toString();
    }
}
//deckbox
function filtroDb() {
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('prod');
        if (prod) {
            queryParams.set('prod', prod);
        } else {
            queryParams.set('prod', 5);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('prod', 5);
        window.location.search = queryParams.toString();
    }
}
//playmat
function filtroP() {
    var queryParams = new URLSearchParams(window.location.search);
    var orden = queryParams.get('orden');
    queryParams = new URLSearchParams();
    if (orden) {
        // Mantener el parámetro 'prod' si ya existe
        var prod = queryParams.get('prod');
        if (prod) {
            queryParams.set('prod', prod);
        } else {
            queryParams.set('prod', 6);
        }
        window.location.search = queryParams.toString();
    } else {
        // Si no hay parámetro 'orden', eliminar todos los demás y establecer 'prod=2'
        queryParams.set('prod', 6);
        window.location.search = queryParams.toString();
    }
}