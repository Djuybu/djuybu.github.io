const video = document.getElementById("video");
const table = document.getElementById("table").querySelector("table");

const xhr = new XMLHttpRequest();

// autoplay video on finished loading web
document.addEventListener("DOMContentLoaded", () => {
    video.play();
});

document.addEventListener("DOMContentLoaded", () => {
    xhr.open("GET", "index.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            for (const element in response) {
                if (Object.prototype.hasOwnProperty.call(response, element)) {
                    addRow(response[element]);
                }
            }
        }
    };

    xhr.send("type=" + encodeURIComponent("database"));
});

const addRow = (element) => {
    let row = table.insertRow(1);
    let id = row.insertCell(0);
    let note = row.insertCell(1);
    let amount = row.insertCell(2);

    id.innerHTML = element.transactionID;
    note.innerHTML = element.note;
    amount.innerHTML = element.amount;
}