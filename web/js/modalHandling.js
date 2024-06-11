// modalHandling.js
document.addEventListener("DOMContentLoaded", function() {
    var createEntryLink = document.getElementById('create-entry-link');
    var entryExistsModal = document.getElementById('entryExistsModal');
    var cancelBtn = document.getElementById('cancel-btn');
    var closeBtn = document.querySelector('.modal .close');

    createEntryLink.addEventListener('click', function(event) {
        event.preventDefault();
        fetch(createEntryLink.dataset.checkUrl)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    entryExistsModal.style.display = 'block';
                } else {
                    window.location.href = createEntryLink.dataset.createUrl;
                }
            });
    });

    cancelBtn.addEventListener('click', function() {
        entryExistsModal.style.display = 'none';
    });

    closeBtn.addEventListener('click', function() {
        entryExistsModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == entryExistsModal) {
            entryExistsModal.style.display = 'none';
        }
    });
});
