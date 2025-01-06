const menuElement = document.querySelector('.menu');
const menuItemElements = document.querySelectorAll('.menu-item');
let menuElementHeight = menuElement.clientHeight;
let menuItemHeight = menuItemElements.length > 0 ? menuItemElements[0].clientHeight : 0;
let totalMenuHeight = menuItemElements.length * menuItemHeight;

let currentScrollPosition = 0;
let lastScrollY = 0;
let smoothScrollY = 0;

const lerp = (start, end, factor) => start * (1 - factor) + end * factor;

const adjustMenuItemsPosition = (scroll) => {
    gsap.set(menuItemElements, {
        y: (index) => {
            if (menuItemElements.length === 0) return 0; // No items
            const wrappedY = gsap.utils.wrap(
                -menuItemHeight,
                totalMenuHeight - menuItemHeight,
                index * menuItemHeight + scroll
            );
            return `${wrappedY}px`;
        }
    });
};

adjustMenuItemsPosition(0);

const onWheelScroll = (event) => {
    currentScrollPosition -= event.deltaY;
};

let startY = 0;
let currentY = 0;
let isDragging = false;

const onDragStart = (event) => {
    startY = event.clientY || event.touches[0].clientY;
    isDragging = true;
    menuElement.classList.add("is-dragging");
};

const onDragMove = (event) => {
    if (!isDragging) return;

    currentY = event.clientY || event.touches[0].clientY;
    currentScrollPosition += (currentY - startY) * 3;
    startY = currentY;
};

const onDragEnd = () => {
    isDragging = false;
    menuElement.classList.remove('is-dragging');
};

const animate = () => {
    requestAnimationFrame(animate);
    smoothScrollY = lerp(smoothScrollY, currentScrollPosition, 0.1);
    adjustMenuItemsPosition(smoothScrollY);

    const scrollSpeed = smoothScrollY - lastScrollY;
    lastScrollY = smoothScrollY;

    gsap.to(menuItemElements, {
        scale: 1 - Math.min(100, Math.abs(scrollSpeed) * 0.0075),
        rotate: scrollSpeed * 0.2,
    });
};

// Event Listeners
menuElement.addEventListener("wheel", onWheelScroll);
menuElement.addEventListener("touchstart", onDragStart);
menuElement.addEventListener("touchmove", onDragMove);
menuElement.addEventListener("touchend", onDragEnd);
menuElement.addEventListener("mousedown", onDragStart);
menuElement.addEventListener("mousemove", onDragMove);
menuElement.addEventListener("mouseup", onDragEnd);
menuElement.addEventListener("selectstart", () => false);

window.addEventListener("resize", () => {
    menuElementHeight = menuElement.clientHeight;
    menuItemHeight = menuItemElements.length > 0 ? menuItemElements[0].clientHeight : 0;
    totalMenuHeight = menuItemElements.length * menuItemHeight;
});

// Start the animation
animate();
    