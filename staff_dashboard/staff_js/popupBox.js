function openDeletePopup(referRecord) {
    document.getElementById('delPopup').style.display = 'block';
    document.getElementById('deleteRefRec').value = referRecord;
}

function openDeletePopup2(referRecord) {
    document.getElementById('delPopup2').style.display = 'block';
    document.getElementById('deleteRefRec').value = referRecord;
}

function openDeletePopup3(referRecord) {
    document.getElementById('delPopup3').style.display = 'block';
    document.getElementById('deleteRefRec').value = referRecord;
    
    if (popup && hiddenInput) {
        popup.style.display = 'block';
        hiddenInput.value = referRecord;
    } else {
        console.error('Popup or hidden input not found.');
    }
}

window.onclick = function(event) {
    const popups = ['delPopup', 'delPopup2', 'delPopup3'];

    popups.forEach(popupId => {
        const popup = document.getElementById(popupId);
        if (popup && event.target === popup) {
            popup.style.display = 'none';
        }
    });
};