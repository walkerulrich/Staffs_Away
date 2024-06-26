document.addEventListener('DOMContentLoaded', function() {
  const categoryButtons = document.querySelectorAll('.category-button');
  const forms = document.querySelectorAll('.form-container > div');

  categoryButtons.forEach(button => {
      button.addEventListener('click', function() {
          const targetId = this.getAttribute('data-target');
          forms.forEach(form => {
              if (form.id === targetId) {
                  form.classList.add('show');
              } else {
                  form.classList.remove('show');
              }
          });
          categoryButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
      });
  });
});

document.addEventListener('DOMContentLoaded', function () {
    const oneWayCheckbox = document.getElementById('one-way');
    const returnDateField = document.getElementById('return-date-field');

    // Hide/show return date field based on one way checkbox
    oneWayCheckbox.addEventListener('change', function () {
        if (this.checked) {
            returnDateField.style.display = 'none';
        } else {
            returnDateField.style.display = 'block';
        }
    });
});