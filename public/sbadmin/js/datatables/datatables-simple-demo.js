window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                placeholder: "Поиск...",
                perPage: "{select} записей на странице",
                noRows: "Записей не найдено",
                info: "Показаны записи с {start} по {end} из {rows}",

            }
        });
    }
});
