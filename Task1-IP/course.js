document.addEventListener("DOMContentLoaded", function() {
  // Function to fetch JSON data
  function fetchJSON(callback) {
    var xhr = new XMLHttpRequest();
    xhr.overrideMimeType("application/json");
    xhr.open("GET", "course.json", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        callback(JSON.parse(xhr.responseText));
      }
    };
    xhr.send(null);
  }

  // Function to format currency
  // function formatCurrency(value) {
  //   return new Intl.NumberFormat("en-GB", {
  //     style: "currency",
  //     currency: "GBP"
  //   }).format(value);
  // }

  // Function to populate the table with course data
  function populateTable(data) {
    var tableBody = document.querySelector("#courseTable tbody");

    data.course.forEach(function(course) {
      var row = document.createElement("tr");
      row.innerHTML = `
        <td>${course.title}</td>
        <td>${course.level}</td>
        <td>${course["course details"]}</td>
        <td>${course["entry requirments"]}</td>
        <td>UK: ${(course["uk fees details"].pound)}</br>
            Euro: ${course["uk fees details"].euro}</br>
            Dollar: ${course["uk fees details"].dollar}</td>
        <td>UK: ${(course["International fee details"].pound)}</br>
            Euro: ${course["International fee details"].euro}</br>
            Dollar: ${course["International fee details"].dollar}</td>
        <td>${course.duration}</td>
      `;
      tableBody.appendChild(row);
    });
  }

  // Fetch JSON data and populate the table
  fetchJSON(function(data) {
    populateTable(data);
  });
});
