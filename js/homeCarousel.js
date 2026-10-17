function initializeCarousel(carouselClass, listClass, cardClass, leftArrowId, rightArrowId, transitionClass) {
    const carouselList = document.querySelector(`.${listClass}`);
    const arrowBtns = document.querySelectorAll(`.${carouselClass} i`);
    const cards = carouselList?.querySelectorAll(`.${cardClass}`);

    if (!carouselList || !cards || cards.length === 0) return;

    const firstCardWidth = cards[0].offsetWidth;
    const cardPerView = Math.round(carouselList.offsetWidth / firstCardWidth);

    let isDragging = false, startX, startScrollLeft, timeoutId;

    [...cards].slice(-cardPerView).reverse().forEach(card => {
        carouselList.insertAdjacentHTML("afterbegin", card.outerHTML);
    });
    [...cards].slice(0, cardPerView).forEach(card => {
        carouselList.insertAdjacentHTML("beforeend", card.outerHTML);
    });

    arrowBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const isLeft = btn.id === leftArrowId;
            carouselList.scrollLeft += isLeft ? -firstCardWidth : firstCardWidth;
        });
    });

    carouselList.addEventListener("mousedown", (e) => {
        isDragging = true;
        startX = e.pageX;
        startScrollLeft = carouselList.scrollLeft;
        carouselList.classList.add("dragging");
    });

    document.addEventListener("mouseup", () => {
        isDragging = false;
        carouselList.classList.remove("dragging");
    });

    carouselList.addEventListener("mousemove", (e) => {
        if (!isDragging) return;
        e.preventDefault();
        carouselList.scrollLeft = startScrollLeft - (e.pageX - startX);
    });

    const infiniteScroll = () => {
        if (carouselList.scrollLeft === 0) {
            carouselList.classList.add(transitionClass);
            carouselList.scrollLeft = carouselList.scrollWidth - (2 * carouselList.offsetWidth);
            carouselList.classList.remove(transitionClass);
        } else if (Math.ceil(carouselList.scrollLeft) === carouselList.scrollWidth - carouselList.offsetWidth) {
            carouselList.classList.add(transitionClass);
            carouselList.scrollLeft = carouselList.offsetWidth;
            carouselList.classList.remove(transitionClass);
        }

        clearTimeout(timeoutId);
        if (!carouselList.matches(":hover")) autoPlay();
    };

    const autoPlay = () => {
        if (window.innerWidth < 300) return;
        timeoutId = setTimeout(() => carouselList.scrollLeft += firstCardWidth, 2500);
    };

    carouselList.addEventListener("scroll", infiniteScroll);
    carouselList.addEventListener("mouseenter", () => clearTimeout(timeoutId));
    carouselList.addEventListener("mouseleave", autoPlay);

    autoPlay();
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(".carouselList")) {
        initializeCarousel("carouselDiv", "carouselList", "carouselCard", "carouselArrowLeft", "carouselArrowRight", "no-transition");
    }
    if (document.querySelector(".carouselList2")) {
        initializeCarousel("carouselDiv2", "carouselList2", "carouselCard2", "carouselArrowLeft2", "carouselArrowRight2", "no-transition2");
    }
    if (document.querySelector(".carouselList3")) {
        initializeCarousel("carouselDiv3", "carouselList3", "carouselCard3", "carouselArrowLeft3", "carouselArrowRight3", "no-transition3");
    }
});