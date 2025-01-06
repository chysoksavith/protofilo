document.addEventListener("DOMContentLoaded", () => {
    const counter = document.querySelector(".counter");
    const loader = document.querySelector(".loader");
    const elementsToAnimate = document.querySelectorAll(
        "p:not(.into), .logo h1"
    );
    const introTag = document.querySelector(".intro");
    const isIndexPage = document.body.classList.contains("index-page");
    const isDetailPage = window.location.href.includes("detail");
    let animationsInitialized = false;

    function handlePageLoad() {
        if (isIndexPage) {
            if (!sessionStorage.getItem("loaderShown")) {
                // Show loader and start animation only on the index page if loader hasn't been shown before
                loader.style.display = "flex"; // Show loader
                gsap.to(counter, {
                    innerHTML: 10 + "%",
                    duration: 3,
                    snap: "innerHTML",
                    ease: "none",
                    onComplete: () => {
                        setTimeout(() => {
                            shuffleText("SAVIT/24", 20, () => {
                                setTimeout(removeLetters, 500);
                            });
                        }, 500);
                    },
                });

                // Set sessionStorage to indicate that the loader has been shown
                sessionStorage.setItem("loaderShown", "true");
            } else {
                // Hide loader for index page if already shown
                loader.style.display = "none";
                fadeOutLoader();
            }
        } else {
            // Hide loader for non-index pages
            loader.style.display = "none";
            fadeOutLoader();
        }
    }

    function shuffleText(finalText, duration, callback) {
        let i = 0;
        const shuffleInterval = setInterval(() => {
            if (i < duration) {
                counter.innerHTML = Math.random().toString(36).substring(2, 8);
                i++;
            } else {
                clearInterval(shuffleInterval);
                counter.innerHTML = finalText;
                if (callback) callback();
            }
        }, 100);
    }

    function removeLetters() {
        let text = counter.innerHTML;
        const removeInterval = setInterval(() => {
            if (text.length > 0) {
                text = text.substring(0, text.length - 1);
                counter.innerHTML = text;
            } else {
                clearInterval(removeInterval);
                if (!animationsInitialized) {
                    animateElements();
                    animateIntroTag();
                    animationsInitialized = true;
                }
                fadeOutLoader();
            }
        }, 100);
    }

    function animateElements() {
        if (animationsInitialized) return;
        elementsToAnimate.forEach((element) => {
            let originalText = element.textContent;
            let index = 0;

            const shuffleElement = setInterval(() => {
                if (index < originalText.length) {
                    let shuffleText = "";
                    for (let i = 0; i <= index; i++) {
                        shuffleText +=
                            i < index
                                ? originalText[i]
                                : Math.random().toString(36)[2];
                    }
                    element.textContent =
                        shuffleText + originalText.substring(index + 1);
                    index++;
                } else {
                    clearInterval(shuffleElement);
                    element.textContent = originalText;
                }
            }, 100);
        });
    }

    function animateIntroTag() {
        if (!introTag) return;

        let originalText = introTag.textContent;
        let currentText = "";
        let index = 0;

        const revealText = setInterval(() => {
            if (index < originalText.length) {
                currentText += originalText[index];
                introTag.textContent = currentText;
                index++;
            } else {
                clearInterval(revealText);
            }
        }, 25);
    }

    function fadeOutLoader() {
        gsap.to(loader, {
            opacity: 0,
            pointerEvents: "none",
            duration: 1,
            onComplete: () => {
                animationMasks();
            },
        });
    }

    function animationMasks() {
        const masks = document.querySelectorAll(".hero-img .mask");
        const clipPathValues = [
            "polygon(10% 0, 0 0, 0% 100%, 10% 100%)",
            "polygon(20% 0, 10% 0, 10% 100%, 20% 100%)",
            "polygon(30% 0, 20% 0, 20% 100%, 30% 100%)",
            "polygon(40% 0, 30% 0, 30% 100%, 40% 100%)",
            "polygon(50% 0, 40% 0, 40% 100%, 50% 100%)",
            "polygon(60% 0, 50% 0, 50% 100%, 60% 100%)",
            "polygon(70% 0, 60% 0, 60% 100%, 70% 100%)",
            "polygon(80% 0, 70% 0, 70% 100%, 80% 100%)",
            "polygon(90% 0, 80% 0, 80% 100%, 90% 100%)",
            "polygon(100% 0, 90% 0, 90% 100%, 100% 100%)",
        ];

        setTimeout(() => {
            masks.forEach((mask, index) => {
                gsap.to(mask, {
                    clipPath: clipPathValues[index % clipPathValues.length],
                    duration: 1,
                    delay: index * 0.1,
                });
            });
        });
    }

    gsap.registerPlugin(ScrollTrigger);

    const lenis = window.Lenis ? new Lenis() : null;

    if (lenis) {
        lenis.on("scroll", () => {
            if (ScrollTrigger) {
                ScrollTrigger.update();
            }
        });
        gsap.ticker.add(() => {
            lenis.raf();
        });
    }

    gsap.ticker.lagSmoothing(0);

    const services = gsap.utils.toArray(".service");

    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.1,
    };

    const observerCallback = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const service = entry.target;
                const imgContainer = service.querySelector(".img_style");

                if (ScrollTrigger) {
                    ScrollTrigger.create({
                        trigger: service,
                        start: "bottom bottom",
                        end: "top top",
                        scrub: true,
                        onUpdate: (self) => {
                            let progress = self.progress;
                            let newWidth = 30 + 70 * progress;
                            gsap.to(imgContainer, {
                                width: newWidth + "%",
                                duration: 0.1,
                                ease: "none",
                            });
                        },
                    });

                    ScrollTrigger.create({
                        trigger: service,
                        start: "top bottom",
                        end: "top top",
                        scrub: true,
                        onUpdate: (self) => {
                            let progress = self.progress;
                            let newHeight = 150 + 150 * progress;
                            gsap.to(service, {
                                height: newHeight + "px",
                                duration: 0.1,
                                ease: "none",
                            });
                        },
                    });
                }

                observer.unobserve(service);
            }
        });
    };

    const observe = new IntersectionObserver(observerCallback, observerOptions);

    services.forEach((service) => {
        observe.observe(service);
    });

    // Initially hide loader if it's not the index page or if it's a detail page
    if (!isIndexPage && !isDetailPage) {
        loader.style.display = "none";
    }

    handlePageLoad();
});
