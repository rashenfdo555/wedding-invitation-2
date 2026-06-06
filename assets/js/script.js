// ==========================================
// WEDDING INVITATION MAIN SCRIPT
// ==========================================

// DOM Elements
const openBtn = document.getElementById('openBtn');
const envelopeOverlay = document.getElementById('envelopeOverlay');
const introAnimationOverlay = document.getElementById('introAnimationOverlay');
const mainWebsiteContent = document.getElementById('mainWebsiteContent');
const bgMusic = document.getElementById('bgMusic');
const audioToggleBtn = document.getElementById('audioToggleBtn');
const audioIcon = document.getElementById('audioIcon');
const audioVisualizer = document.querySelector('.audio-visualizer');

// Intro text elements
const introText1 = document.getElementById('introText1');
const introText2 = document.getElementById('introText2');
const introText3 = document.getElementById('introText3');

// Music playing flag
let isMusicPlaying = false;

// ==========================================
// INITIAL ENVELOPE OPEN SEQUENCE
// ==========================================
if (openBtn) {
    openBtn.addEventListener('click', () => {
        // Hide envelope
        envelopeOverlay.classList.add('hidden');
        
        // Show intro animation
        introAnimationOverlay.classList.remove('hidden');
        
        // Add animation classes
        if (introText1) introText1.classList.add('run-anim-1');
        if (introText2) introText2.classList.add('run-anim-2');
        if (introText3) introText3.classList.add('run-anim-3');
        
        // Play background music - FIXED VERSION
        playMusicWithUserInteraction();
        
        // After intro animation, show main content
        setTimeout(() => {
            introAnimationOverlay.classList.add('hidden');
            mainWebsiteContent.classList.remove('hidden');
            audioToggleBtn.classList.remove('hidden');
            
            // Initialize features
            initializeFloatingElements();
            initializeNavScroll();
            initializeRevealOnScroll();
            initializeFAQ();
            initializeGallery();
            
            // Add parallax effect
            window.addEventListener('scroll', handleParallax);
            
        }, 5000); // Match animation duration
    });
}

// ==========================================
// MUSIC PLAY FUNCTION - FIXED VERSION
// ==========================================
function playMusicWithUserInteraction() {
    if (!bgMusic) return;
    
    // Reset audio to beginning
    bgMusic.currentTime = 0;
    bgMusic.volume = 0.5; // Set volume to 50%
    
    // Remove muted attribute
    bgMusic.muted = false;
    
    // Play with proper promise handling
    const playPromise = bgMusic.play();
    
    if (playPromise !== undefined) {
        playPromise.then(() => {
            // Music is playing
            isMusicPlaying = true;
            if (audioVisualizer) audioVisualizer.classList.add('playing');
            console.log('Music playing successfully');
        }).catch(error => {
            // Auto-play was prevented
            console.log('Auto-play prevented:', error);
            isMusicPlaying = false;
            if (audioVisualizer) audioVisualizer.classList.remove('playing');
            
            // Try to play again on any user interaction
            const playOnInteraction = () => {
                bgMusic.play().then(() => {
                    isMusicPlaying = true;
                    if (audioVisualizer) audioVisualizer.classList.add('playing');
                    if (audioIcon) audioIcon.style.display = 'none';
                    document.removeEventListener('click', playOnInteraction);
                    document.removeEventListener('touchstart', playOnInteraction);
                }).catch(e => console.log('Still cannot play:', e));
            };
            
            document.addEventListener('click', playOnInteraction);
            document.addEventListener('touchstart', playOnInteraction);
        });
    }
}

// ==========================================
// AUDIO CONTROL BUTTON - FIXED VERSION
// ==========================================
if (audioToggleBtn) {
    audioToggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        
        if (!bgMusic) return;
        
        if (isMusicPlaying || !bgMusic.paused) {
            // Pause music
            bgMusic.pause();
            isMusicPlaying = false;
            if (audioVisualizer) audioVisualizer.classList.remove('playing');
            if (audioIcon) audioIcon.style.display = 'block';
            console.log('Music paused');
        } else {
            // Play music
            bgMusic.play().then(() => {
                isMusicPlaying = true;
                if (audioVisualizer) audioVisualizer.classList.add('playing');
                if (audioIcon) audioIcon.style.display = 'none';
                console.log('Music resumed');
            }).catch(error => {
                console.log('Play failed:', error);
                alert('Click anywhere on the page first to enable audio, then try again.');
            });
        }
    });
}

// ==========================================
// COUNTDOWN TIMER
// ==========================================
const countdownDate = new Date(window.weddingConfig?.countdownTarget || "August 14, 2026 15:30:00").getTime();

function updateCountdown() {
    const now = new Date().getTime();
    const distance = countdownDate - now;
    
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');
    
    if (daysEl) daysEl.textContent = days < 10 ? '0' + days : days;
    if (hoursEl) hoursEl.textContent = hours < 10 ? '0' + hours : hours;
    if (minutesEl) minutesEl.textContent = minutes < 10 ? '0' + minutes : minutes;
    if (secondsEl) secondsEl.textContent = seconds < 10 ? '0' + seconds : seconds;
    
    if (distance < 0) {
        clearInterval(countdownInterval);
        const countdownDiv = document.getElementById('countdown');
        if (countdownDiv) {
            countdownDiv.innerHTML = '<div class="time-card" style="grid-column: span 4;">The Wedding Day Has Arrived! 🎉</div>';
        }
    }
}

const countdownInterval = setInterval(updateCountdown, 1000);
updateCountdown();

// ==========================================
// FLOATING ELEMENTS (Petals/Hearts)
// ==========================================
function initializeFloatingElements() {
    if (!window.weddingConfig?.enablePetals) return;
    
    const container = document.getElementById('floatingElements');
    if (!container) return;
    
    const elements = ['🌸', '🌹', '✨', '💕', '⭐', '🌺'];
    const numElements = 30;
    
    for (let i = 0; i < numElements; i++) {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.textContent = elements[Math.floor(Math.random() * elements.length)];
        element.style.left = Math.random() * 100 + '%';
        element.style.animationDuration = Math.random() * 10 + 8 + 's';
        element.style.animationDelay = Math.random() * -20 + 's';
        element.style.fontSize = Math.random() * 20 + 10 + 'px';
        element.style.opacity = Math.random() * 0.5 + 0.2;
        container.appendChild(element);
    }
}

// ==========================================
// NAVIGATION SCROLL EFFECT
// ==========================================
function initializeNavScroll() {
    const nav = document.getElementById('weddingNav');
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');
    
    if (navToggle) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }
    
    // Close menu when clicking a link
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
                if (navMenu) navMenu.classList.remove('active');
            }
            
            // Update active link
            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });
    
    // Change nav background on scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
        
        // Update active link based on scroll position
        const sections = document.querySelectorAll('section[id]');
        let current = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (scrollY >= sectionTop) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
}

// ==========================================
// REVEAL ON SCROLL ANIMATION
// ==========================================
function initializeRevealOnScroll() {
    const revealElements = document.querySelectorAll('.reveal-section');
    
    function checkReveal() {
        revealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementTop < windowHeight - 100) {
                element.classList.add('revealed');
            }
        });
    }
    
    window.addEventListener('scroll', checkReveal);
    checkReveal(); // Check on load
}

// ==========================================
// PARALLAX EFFECT
// ==========================================
function handleParallax() {
    const scrolled = window.pageYOffset;
    const heroSection = document.querySelector('.hero-section');
    const heroBg = document.querySelector('.hero-background');
    
    if (heroBg) {
        heroBg.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
}

// ==========================================
// FAQ ACCORDION
// ==========================================
function initializeFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        }
    });
}

// ==========================================
// GALLERY SLIDER
// ==========================================
function initializeGallery() {
    if (typeof Swiper !== 'undefined') {
        const gallerySwiper = new Swiper('.gallery-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    }
}

// ==========================================
// RSVP FORM HANDLER (WhatsApp)
// ==========================================
const rsvpForm = document.getElementById('rsvpForm');
if (rsvpForm) {
    rsvpForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('rsvp_name')?.value.trim();
        const email = document.getElementById('rsvp_email')?.value.trim();
        const phone = document.getElementById('rsvp_phone')?.value.trim();
        const attendance = document.getElementById('rsvp_attendance')?.value;
        const guests = document.getElementById('rsvp_guests')?.value;
        const message = document.getElementById('rsvp_message')?.value;
        
        if (!name || !email || !attendance) {
            alert('Please fill in all required fields.');
            return;
        }
        
        const phoneNumber = window.weddingConfig?.whatsappPhone || '94771234567';
        
        const whatsappMessage = `*Wedding RSVP Confirmation*%0A%0A` +
            `*Name:* ${name}%0A` +
            `*Email:* ${email}%0A` +
            `*Phone:* ${phone || 'Not provided'}%0A` +
            `*Attendance:* ${attendance}%0A` +
            `*Number of Guests:* ${guests || '1'}%0A` +
            `*Message:* ${message || 'No message'}%0A%0A` +
            `Thank you! 🎉`;
        
        const whatsappUrl = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${whatsappMessage}`;
        window.open(whatsappUrl, '_blank');
    });
}

// ==========================================
// GUESTBOOK HANDLER
// ==========================================
const submitGuestbook = document.getElementById('submitGuestbook');
if (submitGuestbook) {
    submitGuestbook.addEventListener('click', () => {
        const name = document.getElementById('guest_name')?.value.trim();
        const message = document.getElementById('guest_message')?.value.trim();
        
        if (!name || !message) {
            alert('Please enter your name and message.');
            return;
        }
        
        // Create new entry
        const entriesContainer = document.getElementById('guestbookEntries');
        const newEntry = document.createElement('div');
        newEntry.className = 'guestbook-entry';
        newEntry.innerHTML = `
            <div class="entry-name">${escapeHtml(name)}</div>
            <div class="entry-message">${escapeHtml(message)}</div>
            <div class="entry-date">${new Date().toISOString().split('T')[0]}</div>
        `;
        
        if (entriesContainer) {
            entriesContainer.insertBefore(newEntry, entriesContainer.firstChild);
        }
        
        // Clear form
        const guestNameInput = document.getElementById('guest_name');
        const guestMessageInput = document.getElementById('guest_message');
        if (guestNameInput) guestNameInput.value = '';
        if (guestMessageInput) guestMessageInput.value = '';
        
        // Show success message
        alert('Thank you for your wishes! 💕');
    });
}

// Helper function to escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==========================================
// PRELOAD IMAGES
// ==========================================
function preloadImages() {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        const src = img.getAttribute('src');
        if (src) {
            const preloadImg = new Image();
            preloadImg.src = src;
        }
    });
}

// ==========================================
// ENSURE MUSIC ICON IS VISIBLE ON MOBILE
// ==========================================
function ensureAudioButtonVisibility() {
    if (audioToggleBtn && audioIcon) {
        // Check if music is actually playing
        setTimeout(() => {
            if (bgMusic && bgMusic.paused && !isMusicPlaying) {
                // Show the mute icon if music isn't playing
                if (audioVisualizer) audioVisualizer.classList.remove('playing');
                if (audioIcon) audioIcon.style.display = 'block';
            }
        }, 1000);
    }
}

window.addEventListener('load', () => {
    preloadImages();
    ensureAudioButtonVisibility();
});