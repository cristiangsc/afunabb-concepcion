let myChartIngresos;
let myChartEgresos;
let myChartIngresoEgreso;
let myChartIngresoMensuales;
let myChartEgresoMensuales;
let myChartUtilidad;

const fetchCoastersData = (...urls) => {
    const promises = urls.map(url => fetch(url).then(response => response.json()))
    return Promise.all(promises)
}

const getDataColors = opacity => {
    const colors = [
        '#e1bee7',
        '#ce93d8',
        '#ba68c8',
        '#e1bee7',
        '#ce93d8',
        '#ba68c8',
        '#e1bee7',
        '#ce93d8',
        '#ba68c8',
        '#e1bee7',
        '#ce93d8',
        '#ba68c8',
    ]
    return colors.map(color => opacity ? `${color + opacity}` : color)
}

const getDataColorsUtilidad = opacity => {
    const colors = [
        '#020a6e',
        '#e43106',
        '#68b2c8',
    ]
    return colors.map(color => opacity ? `${color + opacity}` : color)
}

const getDataColorsEgresos = opacity => {
    const colors = [
        '#db360e',
        '#e1421b',
        '#ec5835',
        '#ed7052',
        '#ec907a',
        '#db360e',
        '#ec907a',
        '#f3aa99',
        '#db360e',
        '#ed7052',
        '#f3aa99',
        '#ed7052',
    ]
    return colors.map(color => opacity ? `${color + opacity}` : color)
}

const graficos = () => {
    let anioInicial = document.querySelector('#featuresOptions').selectedOptions[0].label
    printCharts(anioInicial)
    document.querySelector('#featuresOptions').onchange = e => {
        const {value, text} = e.target.selectedOptions[0]
        printCharts(value)
    }
}


const printCharts = (anual) => {
    fetchCoastersData(
        'https://afunabb.test/cafeteria/grafico/ingresos/'+anual,
        'https://afunabb.test/cafeteria/grafico/egresos/'+anual,
        'https://afunabb.test/cafeteria/grafico/consolidado/'+anual,
        'https://afunabb.test/cafeteria/grafico/ingresos/mensual/'+anual,
        'https://afunabb.test/cafeteria/grafico/egresos/mensual/'+anual,
        'https://afunabb.test/cafeteria/grafico/utilidad/'+anual)
        .then((data) => {
            renderModelsChartIngresos(data[0])
            renderModelsChartEgresos(data[1])
            renderModelsChartMensual(data[2])
            renderModelsChartIngresosMensuales(data[3])
            renderModelsChartEgresosMensuales(data[4])
            renderModelsChartUtilidad(data[5])

        })
}


/* Grafico Utilidades*/

const dataSetsUtilidades = (utilidad) => {
    let resultado = [];
    resultado.push(utilidad[0]['ingresos'],utilidad[0]['egresos'],utilidad[0]['utilidad'])
    return resultado
}


const renderModelsChartUtilidad = utilidad => {

    const sumaTotal = dataSetsUtilidades(utilidad)
    const data = {
        labels: ['Total Ingresos', 'Total Egresos', 'Utilidad'],
        datasets: [{
            data: sumaTotal,
            label:'GRÁFICO DE UTILIDADES',
            borderColor: getDataColorsUtilidad(),
            backgroundColor: getDataColorsUtilidad(95)
        }]
    }
    const options = {
        plugins: {
            legend: {display:true,
                labels: {
                    color: 'indigo',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }

                }
            }
        }
    }
    if (myChartUtilidad) {
        myChartUtilidad.destroy();
    }

    myChartUtilidad = new Chart('myChartUtilidad', {type: 'bar', data, options})
}


/*Grafico ingresos*/

const dataSets = (ingresos) => {
    let resultado = [];
    resultado.push(ingresos[0]['caja'],ingresos[0]['transbank'],ingresos[0]['junaeb'],ingresos[0]['ing_varios'], ingresos[0]['aporte'])
    return resultado
}


const renderModelsChartIngresos = ingresos => {

    const sumaIngreso = dataSets(ingresos)
    const data = {
        labels: ['Caja', 'Transbank', 'Junaeb', 'Otros Ingresos','Cuota Socio/a'],
        datasets: [{
            data: sumaIngreso,
            label:'GRÁFICO DE INGRESOS ANUALES DE CAFETERÍAS Y APORTE CUOTA SOCI@S',
            borderColor: getDataColors(),
            backgroundColor: getDataColors(95)
        }]
    }
    const options = {
        plugins: {
            legend: {display:true,
                labels: {
                    color: 'indigo',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }

                }
            }
        }
    }
    if (myChartIngresos) {
        myChartIngresos.destroy();
    }

    myChartIngresos = new Chart('myChartIngresos', {type: 'bar', data, options})
}


/* Grafico egresos anual---------------------------------------------------------------------------*/


const dataSetsEgresos = (egresos) => {
    let resultado= [];
    resultado.push(egresos[0]['facturas'],egresos[0]['impuestos'],egresos[0]['comision_junaeb'],egresos[0]['remuneraciones'],egresos[0]['imposiciones'],egresos[0]['honorarios'],egresos[0]['egresos_v'])
    return resultado
}

const renderModelsChartEgresos = egresos => {
    const sumaEgreso = dataSetsEgresos(egresos)
    const data = {
        labels: ['Facturas', 'Impuestos', 'Comisión Junaeb','Remuneraciones','Imposiciones','Honorarios','Otros Egresos'],
        datasets: [{
            data: sumaEgreso,
            label:'GRÁFICO DE EGRESOS ANUALES DE CAFETERÍAS',
            borderColor: getDataColorsEgresos(),
            backgroundColor: getDataColorsEgresos(95)
        }]
    }
    const options = {
        plugins: {
            legend: {
                display:true,
                labels: {
                    color: 'indigo',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }

                }
            }
        }
    }
    if (myChartEgresos) {
        myChartEgresos.destroy();
    }
    myChartEgresos = new Chart('myChartEgresos', {type: 'bar', data, options})

}

/* Grafico egresos e ingresos mensuales---------------------------------------------------------------------------*/


const renderModelsChartMensual = mensual => {
    let anno = new Date().getFullYear();
    const mensualEI = dataSetsIngresoMensual(mensual)
    const data = {
        labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        datasets: [{
            data: mensualEI,
            label:'GRÁFICO DE INGRESOS - EGRESOS MENSUALES DE CAFETERÍAS',
            borderColor: getDataColors(),
            backgroundColor: getDataColors(95)
        }]
    }
    const options = {
        plugins: {
            legend: {display:true,
                labels: {
                    color: 'indigo',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }

                }
            }
        }
    }
    if (myChartIngresoEgreso) {
        myChartIngresoEgreso.destroy();
    }
    myChartIngresoEgreso = new Chart('myChartMensuales', {type: 'bar', data, options})

}


/* Grafico ingresos mensuales---------------------------------------------------------------------------*/

const dataSetsIngresoMensual = (mensual) => {
    let resultado= [];
    resultado.push(mensual[0]['enero'],mensual[0]['febrero'],mensual[0]['marzo'],mensual[0]['abril'],mensual[0]['mayo'],mensual[0]['junio'],mensual[0]['julio'],mensual[0]['agosto'],mensual[0]['septiembre'],mensual[0]['octubre'],mensual[0]['noviembre'],mensual[0]['diciembre'])
    return resultado
}

const renderModelsChartIngresosMensuales = mensual => {
    const dataSet = (mensual)
    const data = {
        labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        datasets: [{
            data: dataSetsIngresoMensual(dataSet),
            label:'GRÁFICO INGRESOS MENSUALES DE CAFETERÍAS',
            borderColor: getDataColors(),
            backgroundColor: getDataColors(95)
        }]
    }
    const options = {
        plugins: {
            legend: {display:true,
                labels: {
                    color: 'indigo',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }

                }
            }
        }
    }
    if (myChartIngresoMensuales) {
        myChartIngresoMensuales.destroy();
    }
    myChartIngresoMensuales = new Chart('myChartIngresosMensuales', {type: 'bar', data, options})

}

/* Grafico egresos mensuales---------------------------------------------------------------------------*/


const renderModelsChartEgresosMensuales = mensual => {
    const dataSet = (mensual)
    const data = {
        labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        datasets: [{
            data: dataSetsIngresoMensual(dataSet),
            label:'GRÁFICO EGRESOS MENSUALES DE CAFETERÍAS',
            borderColor: getDataColorsEgresos(),
            backgroundColor: getDataColorsEgresos(95)
        }]
    }
    const options = {
        plugins: {
            legend: {display:true,
                labels: {
                    color: 'indigo',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }

                }
            }
        }
    }
    if (myChartEgresoMensuales) {
        myChartEgresoMensuales.destroy();
    }
    myChartEgresoMensuales =new Chart('myChartEgresosMensuales', {type: 'bar', data, options})

}

    graficos()
