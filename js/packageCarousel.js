// Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project
// Project Name: packageCarousel.js
// Description: To create a JavaScript for the carousel's functionality, such as infinite scrolling, auto-play and arrow buttons.
// Date first written: 25/6/2025
// Date last modified: 27/6/2025

// JavaScript for the first carousel - Recommended Packages
const packagesection = document.querySelector(".packageSection");
const packagecarousel = document.querySelector(".packageCarousel");
const arrowBtns = document.querySelectorAll(".packageSection i");
const firstCardWidth = packagecarousel.querySelector(".packageCard").offsetWidth;
const carouselChildrens = [...packagecarousel.children];

let isDragging =  false, startX, startScrollLeft, timeoutId;

// Get the number of cards that can fit in the carousel at once
let cardPerView = Math.round(packagecarousel.offsetWidth / firstCardWidth);

// Insert copies of the last few cards to beginning of carousel for infinite scrolling
carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
    packagecarousel.insertAdjacentHTML("afterbegin", card.outerHTML);
});

// Insert copies of the first few cards to end of carousel for infinite scrolling
carouselChildrens.slice(0, cardPerView).reverse().forEach(card => {
    packagecarousel.insertAdjacentHTML("beforeend", card.outerHTML);
});

// Add event listeners for the arrow buttons to scroll the carousel left and right
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        packagecarousel.scrollLeft += btn.id === "carouselArrowLeft" ? -firstCardWidth : firstCardWidth;
    });
});

const dragStart = (e) => {
    isDragging =  true;
    packagecarousel.classList.add("dragging");
    // Records the initial cursor and scroll position of the carousel
    startX = e.pageX;
    startScrollLeft = packagecarousel.scrollLeft;
}

const dragging = (e) => {
    if(!isDragging) return; //If isDragging is false return from here
    // Updates the scroll position of the carousel based on the cursor movement
    packagecarousel.scrollLeft = startScrollLeft - (e.pageX - startX);
}

const dragStop = () => {
    isDragging = false;
    packagecarousel.classList.remove("dragging");
}

const autoPlay = () => {
    if(window.innerWidth < 300) return; // Return if window is smaller than 300
    // Autoplay the carousel after every 2500ms
    timeoutId = setTimeout(() => packagecarousel.scrollLeft += firstCardWidth, 2500);
}
autoPlay();

const infiniteScroll = () => {
    // If the carousel is at the beginning, scroll to the end
    if(packagecarousel.scrollLeft === 0) {
        packagecarousel.classList.add("no-transition");
        packagecarousel.scrollLeft = packagecarousel.scrollWidth - (2 * packagecarousel.offsetWidth);
        packagecarousel.classList.remove("no-transition");
    // If the carousel is at the end, scroll to the beginning
    } else if(Math.ceil(packagecarousel.scrollLeft) === packagecarousel.scrollWidth - packagecarousel.offsetWidth) {
        packagecarousel.classList.add("no-transition");
        packagecarousel.scrollLeft = packagecarousel.offsetWidth;
        packagecarousel.classList.remove("no-transition");
    }

    // Clear existing timeout & start autoplay if mouse is not hovering over carousel
    clearTimeout(timeoutId);
    if(!packagecarousel.matches(":hover")) autoPlay();
}

packagecarousel.addEventListener("mousedown", dragStart);
packagecarousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
packagecarousel.addEventListener("scroll", infiniteScroll);
packagecarousel.addEventListener("mouseenter", () => clearTimeout(timeoutId));
packagecarousel.addEventListener("mouseleave", autoPlay);



// JavaScript for the second carousel - Latest Packages
const packagesection2 = document.querySelector(".packageSection2");
const packagecarousel2 = document.querySelector(".packageCarousel2");
const arrowBtns2 = document.querySelectorAll(".packageSection2 i");
const firstCardWidth2 = packagecarousel2.querySelector(".packageCard2").offsetWidth;
const carouselChildrens2 = [...packagecarousel2.children];

let isDragging2 =  false, startX2, startScrollLeft2, timeoutId2;

// Get the number of cards that can fit in the carousel at once
let cardPerView2 = Math.round(packagecarousel2.offsetWidth / firstCardWidth2);

// Insert copies of the last few cards to beginning of carousel for infinite scrolling
carouselChildrens2.slice(-cardPerView2).reverse().forEach(card => {
    packagecarousel2.insertAdjacentHTML("afterbegin", card.outerHTML);
});

// Insert copies of the first few cards to end of carousel for infinite scrolling
carouselChildrens2.slice(0, cardPerView2).reverse().forEach(card => {
    packagecarousel2.insertAdjacentHTML("beforeend", card.outerHTML);
});

// Add event listeners for the arrow buttons to scroll the carousel left and right
arrowBtns2.forEach(btn => {
    btn.addEventListener("click", () => {
        packagecarousel2.scrollLeft += btn.id === "carouselArrowLeft2" ? -firstCardWidth2 : firstCardWidth2;
    });
});

const dragStart2 = (e) => {
    isDragging2 =  true;
    packagecarousel2.classList.add("dragging2");
    // Records the initial cursor and scroll position of the carousel
    startX2 = e.pageX;
    startScrollLeft2 = packagecarousel2.scrollLeft;
}

const dragging2 = (e) => {
    if(!isDragging2) return; //If isDragging is false return from here
    // Updates the scroll position of the carousel based on the cursor movement
    packagecarousel2.scrollLeft = startScrollLeft2 - (e.pageX - startX2);
}

const dragStop2 = () => {
    isDragging2 = false;
    packagecarousel2.classList.remove("dragging2");
}

const autoPlay2 = () => {
    if(window.innerWidth < 300) return; // Return if window is smaller than 300
    // Autoplay the carousel after every 2500ms
    timeoutId2 = setTimeout(() => packagecarousel2.scrollLeft += firstCardWidth2, 2500);
}
autoPlay2();

const infiniteScroll2 = () => {
    // If the carousel is at the beginning, scroll to the end
    if(packagecarousel2.scrollLeft === 0) {
        packagecarousel2.classList.add("no-transition2");
        packagecarousel2.scrollLeft = packagecarousel2.scrollWidth - (2 * packagecarousel2.offsetWidth);
        packagecarousel2.classList.remove("no-transition2");
    // If the carousel is at the end, scroll to the beginning
    } else if(Math.ceil(packagecarousel2.scrollLeft) === packagecarousel2.scrollWidth - packagecarousel2.offsetWidth) {
        packagecarousel2.classList.add("no-transition2");
        packagecarousel2.scrollLeft = packagecarousel2.offsetWidth;
        packagecarousel2.classList.remove("no-transition2");
    }

    // Clear existing timeout & start autoplay if mouse is not hovering over carousel
    clearTimeout(timeoutId2);
    if(!packagecarousel2.matches(":hover")) autoPlay2();
}

packagecarousel2.addEventListener("mousedown", dragStart2);
packagecarousel2.addEventListener("mousemove", dragging2);
document.addEventListener("mouseup", dragStop2);
packagecarousel2.addEventListener("scroll", infiniteScroll2);
packagecarousel2.addEventListener("mouseenter", () => clearTimeout(timeoutId2));
packagecarousel2.addEventListener("mouseleave", autoPlay2);



// JavaScript for the third carousel - All Packages
const packagesection3 = document.querySelector(".packageSection3");
const packagecarousel3 = document.querySelector(".packageCarousel3");
const arrowBtns3 = document.querySelectorAll(".packageSection3 i");
const firstCardWidth3 = packagecarousel3.querySelector(".packageCard3").offsetWidth;
const carouselChildrens3 = [...packagecarousel3.children];

let isDragging3 =  false, startX3, startScrollLeft3, timeoutId3;

// Get the number of cards that can fit in the carousel at once
let cardPerView3 = Math.round(packagecarousel3.offsetWidth / firstCardWidth3);

// Insert copies of the last few cards to beginning of carousel for infinite scrolling
carouselChildrens3.slice(-cardPerView3).reverse().forEach(card => {
    packagecarousel3.insertAdjacentHTML("afterbegin", card.outerHTML);
});

// Insert copies of the first few cards to end of carousel for infinite scrolling
carouselChildrens3.slice(0, cardPerView3).reverse().forEach(card => {
    packagecarousel3.insertAdjacentHTML("beforeend", card.outerHTML);
});

// Add event listeners for the arrow buttons to scroll the carousel left and right
arrowBtns3.forEach(btn => {
    btn.addEventListener("click", () => {
        packagecarousel3.scrollLeft += btn.id === "carouselArrowLeft3" ? -firstCardWidth3 : firstCardWidth3;
    });
});

const dragStart3 = (e) => {
    isDragging3 =  true;
    packagecarousel3.classList.add("dragging3");
    // Records the initial cursor and scroll position of the carousel
    startX3 = e.pageX;
    startScrollLeft3 = packagecarousel3.scrollLeft;
}

const dragging3 = (e) => {
    if(!isDragging3) return; //If isDragging is false return from here
    // Updates the scroll position of the carousel based on the cursor movement
    packagecarousel3.scrollLeft = startScrollLeft3 - (e.pageX - startX3);
}

const dragStop3 = () => {
    isDragging3 = false;
    packagecarousel3.classList.remove("dragging3");
}

const autoPlay3 = () => {
    if(window.innerWidth < 300) return; // Return if window is smaller than 300
    // Autoplay the carousel after every 2500ms
    timeoutId3 = setTimeout(() => packagecarousel3.scrollLeft += firstCardWidth3, 2500);
}
autoPlay3();

const infiniteScroll3 = () => {
    // If the carousel is at the beginning, scroll to the end
    if(packagecarousel3.scrollLeft === 0) {
        packagecarousel3.classList.add("no-transition3");
        packagecarousel3.scrollLeft = packagecarousel3.scrollWidth - (2 * packagecarousel3.offsetWidth);
        packagecarousel3.classList.remove("no-transition3");
    // If the carousel is at the end, scroll to the beginning
    } else if(Math.ceil(packagecarousel3.scrollLeft) === packagecarousel3.scrollWidth - packagecarousel3.offsetWidth) {
        packagecarousel3.classList.add("no-transition3");
        packagecarousel3.scrollLeft = packagecarousel3.offsetWidth;
        packagecarousel3.classList.remove("no-transition3");
    }

    // Clear existing timeout & start autoplay if mouse is not hovering over carousel
    clearTimeout(timeoutId3);
    if(!packagecarousel3.matches(":hover")) autoPlay3();
}

packagecarousel3.addEventListener("mousemove", dragging3);
packagecarousel3.addEventListener("mousedown", dragStart3);
document.addEventListener("mouseup", dragStop3);
packagecarousel3.addEventListener("scroll", infiniteScroll3);
packagecarousel3.addEventListener("mouseenter", () => clearTimeout(timeoutId3));
packagecarousel3.addEventListener("mouseleave", autoPlay3);