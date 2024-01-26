function sortTable(n) {
    var table,
        rows,
        switching,
        i,
        x,
        y,
        shouldSwitch,
        dir,
        switchcount = 0,
        col;
    table = document.getElementById("dataTable");
    switching = true;
    dir = "asc";
    colInnerText = table.getElementsByTagName("th")[n].innerText;

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < rows.length - 1; i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i + 1].getElementsByTagName("td")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    table.getElementsByTagName("th")[n].innerHTML =
                        colInnerText +
                        ' <i class="mdi mdi-sort-ascending text-sort"></i>';
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    table.getElementsByTagName("th")[n].innerHTML =
                        colInnerText +
                        ' <i class="mdi mdi-sort-descending text-sort"></i>';
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}