  document.addEventListener("DOMContentLoaded", function() {
    const filterForm = document.getElementById("form");

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const selectBox = document.getElementById("sort");

    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener("change", function() {
        form.submit();
      });
    });

    selectBox.addEventListener("change", function() {
      form.submit();
    });
  });