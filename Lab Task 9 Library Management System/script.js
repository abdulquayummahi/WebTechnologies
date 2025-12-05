document.getElementById('addBtn').addEventListener('click', function() {
    // 1. Get input values
    const titleInput = document.getElementById('titleInput');
    const yearInput = document.getElementById('yearInput');
    const title = titleInput.value;
    const year = parseInt(yearInput.value);

    const titleRegex = /^[a-zA-Z]+$/;

    if (title === "" || !titleRegex.test(title)) {
        alert("Invalid Title: Must be alphabetic characters only (no spaces or numbers).");
        return;
    }

    const currentYear = new Date().getFullYear();

    if (isNaN(year) || year < 1900 || year > currentYear) {
        alert(`Invalid Year: Please enter a year between 1900 and ${currentYear}.`);
        return;
    }

    const tableBody = document.getElementById('bookListBody');
    const newRow = document.createElement('tr');

    if (year < 2000) {
        newRow.classList.add('bg-gray');
    } else {
        newRow.classList.add('bg-green');
    }

    newRow.innerHTML = `
        <td>${title}</td>
        <td>${year}</td>
    `;

    tableBody.appendChild(newRow);
    titleInput.value = '';
    yearInput.value = '';
});