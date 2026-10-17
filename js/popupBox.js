// Open popup box for specific record deletion
function openDeletePopup(referRecord) {
    document.getElementById('delPopup').style.display = 'block';
    document.getElementById('delPopup2').style.display = 'block';
    document.getElementById('deleteRefRec').value = referRecord;
}

// Close popup on outside click
window.onclick = function(event) {
    if (event.target == document.getElementById('delPopup')) {
        document.getElementById('delPopup').style.display = "none";
    }
    if (event.target == document.getElementById('delPopup2')) {
        document.getElementById('delPopup2').style.display = "none";
    }
}

// JavaScript for activating a popup box for record deletion
var popupBox = document.getElementById('delPopup');

// Ability to let user close popup box screen when not clicking close button
window.onclick = function(event) {
    if (event.target == popupBox) {
        popupBox.style.display = "none";
    }
}

// JavaScript for activating a popup box for record deletion
var popupBox2 = document.getElementById('delPopup2');

// Ability to let user close popup box screen when not clicking close button
window.onclick = function(event) {
    if (event.target == popupBox2) {
        popupBox2.style.display = "none";
    }
}