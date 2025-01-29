import './bootstrap';
import axios from "axios";

const headers = {
    "Authorization": "Bearer 1|N9O6sn343EWnEJ4dbGJpv0pDLMGMBBzgunjQF5O480ec66a4", // pass your bearer token
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let currentPage = 1;
const apiUrl = "http://localhost/api/tasks?page=";

function fetchData(page) {
    axios.get(apiUrl + page, {
        headers,
    }).then(data => {
        renderTable(data.data.data);
        renderPagination(data.data.meta);
    }).catch(error => console.error("Error:", error));
}

function renderTable(data) {
    const container = document.getElementById("table-container");
    container.innerHTML = "";

    let table = document.createElement("table");
    let thead = document.createElement("thead");
    let headerRow = document.createElement("tr");
    const headers = ["ID", "User name", "Title", "Description", "Is Completed", "Created At"];

    headers.forEach(headerText => {
        let th = document.createElement("th");
        th.textContent = headerText;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    let tbody = document.createElement("tbody");
    data.forEach(item => {
        let row = document.createElement("tr");

        Object.values(item).forEach(value => {
            let td = document.createElement("td");
            td.textContent = value;
            row.appendChild(td);
        });

        tbody.appendChild(row);
    });

    table.appendChild(tbody);
    container.appendChild(table);
}

function renderPagination(meta) {
    const paginationContainer = document.getElementById("pagination-container");
    paginationContainer.innerHTML = "";

    meta.links.forEach(link => {
        if (link.url) {
            let a = document.createElement("a");
            a.href = "#";
            a.textContent = link.label;
            a.classList.toggle("active", link.active);
            a.addEventListener("click", (e) => {
                e.preventDefault();
                currentPage = new URL(link.url).searchParams.get("page");
                fetchData(currentPage);
            });

            paginationContainer.appendChild(a);
        }
    });
}

fetchData(currentPage);
