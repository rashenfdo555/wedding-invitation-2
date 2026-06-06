<?php
// ==========================================
// LUXURY WEDDING INVITATION CONFIGURATION
// ==========================================

$config = [
    // Couple Information
    'groom_name'       => 'Sahel',
    'bride_name'       => 'Himara',
    'couple_headline'  => 'Sahel & Himara',
    'couple_story'     => 'Two souls, one journey. From strangers to soulmates, our love story culminates in this beautiful celebration.',
    
    // Blessings & Greetings
    'blessing_text'    => 'ජය මංගලම්',
    'invitation_note'  => 'With hearts full of joy and blessings from our families,<br>we invite you to share in our special day.',
    'bottom_blessing'  => 'Your presence is our greatest blessing.',
    
    // Wedding Date & Time
    'countdown_target' => 'August 14, 2026 15:30:00',
    'event_date'       => '14 August 2026',
    'event_day'        => 'Friday',
    'event_time'       => '3:30 PM - 10:00 PM',
    
    // Ceremony Details
    'ceremony_title'   => 'Wedding Ceremony',
    'ceremony_time'    => '4:00 PM - 5:30 PM',
    'ceremony_venue'   => 'Grand Ballroom',
    
    // Reception Details
    'reception_title'  => 'Wedding Reception',
    'reception_time'   => '7:00 PM - 10:00 PM',
    'reception_venue'  => 'Sky Garden Terrace',
    
    // Venue Information
    'venue_name'       => 'The Grand Pearl Hotel',
    'venue_address'    => '123 Coastal Road, Colombo, Sri Lanka',
    'dress_code'       => 'Formal / Traditional Attire',
    
    // Family Information
    'groom_parents'    => 'Mr. & Mrs. Ahmed Khan',
    'bride_parents'    => 'Mr. & Mrs. Priya Sharma',
    
    // Contact & Media
    'google_maps_url'  => 'https://maps.app.goo.gl/YZ9BwcDv1xZY4AaY6',
    'whatsapp_phone'   => '94767126118',
    'instagram_handle' => '@sahel_himara_wedding',
    
    // Gallery Images
    'gallery_images'   => [
        'assets/images/gallery/engagement.jpg',
        'assets/images/gallery/venue.jpg',
        'assets/images/gallery/couple2.jpg',
        'assets/images/gallery/decor.jpg',
    ],
    
    // FAQ Section
    'faqs' => [
        [
            'question' => 'What is the dress code?',
            'answer'   => 'Formal attire or traditional wear is appreciated.'
        ],
        [
            'question' => 'Can I bring a plus one?',
            'answer'   => 'Please refer to your invitation for the number of seats reserved.'
        ],
        [
            'question' => 'Is there parking available?',
            'answer'   => 'Yes, complimentary valet parking will be available.'
        ],
        [
            'question' => 'Are children welcome?',
            'answer'   => 'We love children, but we recommend this as an adults-only celebration.'
        ],
    ],
    
    // Music & Effects
    'bg_music_url'     => 'assets/audio/wedding-music.mp3',
    'enable_petals'    => true,
    
    // Colors Theme
    'primary_color'    => '#c9a03d',
    'secondary_color'  => '#2c1810',
];

// Guest Book Entries (Demo data - in real scenario, this would be from a file)
$guestbook_entries = [
    ['name' => 'Sarah Johnson', 'message' => 'So happy for you both! 🎉', 'date' => '2024-01-15'],
    ['name' => 'Michael Chen', 'message' => 'Wishing you a lifetime of happiness!', 'date' => '2024-01-14'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="theme-color" content="<?php echo $config['primary_color']; ?>">
    <title><?php echo $config['couple_headline']; ?> - Wedding Invitation</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- Main Stylesheet -->
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- Hidden Configuration for JavaScript -->
<script>
    window.weddingConfig = {
        countdownTarget: "<?php echo $config['countdown_target']; ?>",
        whatsappPhone: "<?php echo $config['whatsapp_phone']; ?>",
        primaryColor: "<?php echo $config['primary_color']; ?>",
        bgMusicUrl: "<?php echo $config['bg_music_url']; ?>",
        enablePetals: <?php echo $config['enable_petals'] ? 'true' : 'false'; ?>
    };
</script>

<!-- Background Music -->
<audio id="bgMusic" loop preload="auto" muted>
    <source src="assets/audio/wedding-music.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<!-- ==========================================
     INITIAL ENVELOPE OVERLAY (Splash Screen)
     ========================================== -->
<div id="envelopeOverlay" class="gate-layer">
    <div class="envelope-card">
        <div class="wedding-rings">
            <i class="fas fa-ring"></i>
            <i class="fas fa-ring second-ring"></i>
        </div>
        <h2>Wedding Invitation</h2>
        <p class="couple-preview"><?php echo $config['couple_headline']; ?></p>
        <div class="date-preview">14.08.2026</div>
        <button id="openBtn" class="btn-open">
            <span>Open Invitation</span>
            <i class="fas fa-heart"></i>
        </button>
    </div>
</div>

<!-- ==========================================
     INTRO ANIMATION OVERLAY
     ========================================== -->
<div id="introAnimationOverlay" class="gate-layer hidden">
    <div class="intro-wrapper">
        <div class="intro-content">
            <h1 id="introText1" class="intro-heading"><?php echo $config['blessing_text']; ?></h1>
            <div class="intro-divider"></div>
            <h2 id="introText2" class="intro-subheading"><?php echo $config['couple_headline']; ?></h2>
            <p id="introText3" class="intro-date">14 August 2026</p>
        </div>
    </div>
</div>

<!-- ==========================================
     MAIN WEBSITE CONTENT
     ========================================== -->
<div id="mainWebsiteContent" class="main-canvas hidden">
    
    <!-- Floating Elements Container -->
    <div id="floatingElements" class="floating-container"></div>
    
    <!-- Navigation Bar -->
    <nav class="wedding-nav" id="weddingNav">
        <div class="nav-container">
            <div class="nav-logo"><?php echo $config['couple_headline']; ?></div>
            <div class="nav-menu">
                <a href="#home" class="nav-link active">Home</a>
                <a href="#story" class="nav-link">Story</a>
                <a href="#events" class="nav-link">Events</a>
                <a href="#gallery" class="nav-link">Gallery</a>
                <a href="#rsvp" class="nav-link">RSVP</a>
            </div>
            <div class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    
    <div class="app-container">
        
        <!-- Hero Section -->
        <section id="home" class="hero-section parallax-section">
            <div class="hero-background"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-decor">
                    <span class="decor-line"></span>
                    <i class="fas fa-heart"></i>
                    <span class="decor-line"></span>
                </div>
                <p class="hero-blessing"><?php echo $config['blessing_text']; ?></p>
                <h1 class="hero-couple"><?php echo $config['couple_headline']; ?></h1>
                <div class="hero-date">
                    <i class="far fa-calendar-alt"></i>
                    <span><?php echo $config['event_date']; ?></span>
                </div>
                <p class="hero-invitation"><?php echo $config['invitation_note']; ?></p>
                <div class="hero-buttons">
                    <a href="#rsvp" class="btn-primary">RSVP Now</a>
                    <a href="#events" class="btn-secondary">View Details</a>
                </div>
            </div>
            <div class="hero-scroll">
                <span>Scroll</span>
                <i class="fas fa-chevron-down"></i>
            </div>
        </section>
        
        <!-- Countdown Section -->
        <section class="countdown-section parallax-section">
            <div class="countdown-background"></div>
            <div class="countdown-content">
                <h2 class="section-title">Counting Down to<br>Our Special Day</h2>
                <div id="countdown">
                    <div class="time-card">
                        <div class="time-number"><span id="days">00</span></div>
                        <div class="time-label">Days</div>
                    </div>
                    <div class="time-card">
                        <div class="time-number"><span id="hours">00</span></div>
                        <div class="time-label">Hours</div>
                    </div>
                    <div class="time-card">
                        <div class="time-number"><span id="minutes">00</span></div>
                        <div class="time-label">Minutes</div>
                    </div>
                    <div class="time-card">
                        <div class="time-number"><span id="seconds">00</span></div>
                        <div class="time-label">Seconds</div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Our Story Section -->
        <section id="story" class="story-section reveal-section">
            <div class="section-container">
                <h2 class="section-title">Our Love Story</h2>
                <div class="story-divider"></div>
                <div class="story-content">
                    <div class="story-text">
                        <p><?php echo $config['couple_story']; ?></p>
                        <div class="family-info">
                            <div class="family-block">
                                <h2>Groom</h2>
                                <p class="family-name"><?php echo $config['groom_name']; ?></p>
                                <p class="family-parents">Son of <?php echo $config['groom_parents']; ?></p>
                            </div>
                            <div class="family-divider">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="family-block">
                                <h2>Bride</h2>
                                <p class="family-name"><?php echo $config['bride_name']; ?></p>
                                <p class="family-parents">Daughter of <?php echo $config['bride_parents']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Events Section -->
        <section id="events" class="events-section reveal-section">
            <div class="section-container">
                <h2 class="section-title">Wedding Events</h2>
                <div class="events-grid">
                    
                    <!-- Ceremony Card -->
                    <div class="event-card">
                        <div class="event-icon">
                            <i class="fas fa-ring"></i>
                        </div>
                        <h3><?php echo $config['ceremony_title']; ?></h3>
                        <div class="event-time">
                            <i class="far fa-clock"></i>
                            <span><?php echo $config['ceremony_time']; ?></span>
                        </div>
                        <div class="event-venue">
                            <i class="fas fa-location-dot"></i>
                            <span><?php echo $config['ceremony_venue']; ?></span>
                        </div>
                        <p class="event-description">Join us as we exchange vows and begin our journey together.</p>
                    </div>
                    
                    <!-- Reception Card -->
                    <div class="event-card">
                        <div class="event-icon">
                            <i class="fas fa-champagne-glasses"></i>
                        </div>
                        <h3><?php echo $config['reception_title']; ?></h3>
                        <div class="event-time">
                            <i class="far fa-clock"></i>
                            <span><?php echo $config['reception_time']; ?></span>
                        </div>
                        <div class="event-venue">
                            <i class="fas fa-location-dot"></i>
                            <span><?php echo $config['reception_venue']; ?></span>
                        </div>
                        <p class="event-description">Celebrate with dinner, dancing, and joyful moments.</p>
                    </div>
                </div>
                
                <!-- Venue Information -->
                <div class="venue-card">
                    <h3>Venue Information</h3>
                    <p class="venue-name"><?php echo $config['venue_name']; ?></p>
                    <p class="venue-address"><?php echo $config['venue_address']; ?></p>
                    <p class="dress-code"><i class="fas fa-tshirt"></i> <?php echo $config['dress_code']; ?></p>
                    <a href="<?php echo $config['google_maps_url']; ?>" target="_blank" class="btn-map">
                        <i class="fas fa-map-marker-alt"></i> Get Directions
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Gallery Section -->
        <section id="gallery" class="gallery-section reveal-section">
            <div class="section-container">
                <h2 class="section-title">Memories Gallery</h2>
                <div class="swiper gallery-slider">
                    <div class="swiper-wrapper">
                        <?php foreach($config['gallery_images'] as $image): ?>
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <img src="<?php echo $image; ?>" alt="Gallery Image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>
        
        <!-- RSVP Section -->
        <section id="rsvp" class="rsvp-section reveal-section">
            <div class="section-container">
                <h2 class="section-title">Kindly Respond</h2>
                <p class="rsvp-subtitle">Your presence will make our day complete</p>
                
                <form id="rsvpForm" class="rsvp-form">
                    <div class="form-group">
                        <input type="text" id="rsvp_name" placeholder="Full Name" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" id="rsvp_email" placeholder="Email Address" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <input type="tel" id="rsvp_phone" placeholder="Phone Number (Optional)">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="form-group">
                        <select id="rsvp_attendance" required>
                            <option value="" disabled selected>Will you attend?</option>
                            <option value="Joyfully Accept">🎉 Joyfully Accept</option>
                            <option value="Regretfully Decline">💔 Regretfully Decline</option>
                        </select>
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="form-group">
                        <select id="rsvp_guests">
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                        </select>
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="form-group">
                        <textarea id="rsvp_message" placeholder="Any special message for the couple?" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn-rsvp">
                        <i class="fab fa-whatsapp"></i> Send via WhatsApp
                    </button>
                </form>
            </div>
        </section>
        
        <!-- FAQ Section -->
        <section class="faq-section reveal-section">
            <div class="section-container">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <?php foreach($config['faqs'] as $faq): ?>
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3><?php echo $faq['question']; ?></h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p><?php echo $faq['answer']; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        
        <!-- Guest Book Section -->
        <!-- <section class="guestbook-section reveal-section">
            <div class="section-container">
                <h2 class="section-title">Guest Book</h2>
                <div class="guestbook-form">
                    <input type="text" id="guest_name" placeholder="Your Name">
                    <textarea id="guest_message" placeholder="Leave your wishes for the couple..."></textarea>
                    <button id="submitGuestbook" class="btn-secondary">Leave Message</button>
                </div>
                <div class="guestbook-entries" id="guestbookEntries">
                    <?php foreach($guestbook_entries as $entry): ?>
                    <div class="guestbook-entry">
                        <div class="entry-name"><?php echo htmlspecialchars($entry['name']); ?></div>
                        <div class="entry-message"><?php echo htmlspecialchars($entry['message']); ?></div>
                        <div class="entry-date"><?php echo $entry['date']; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section> -->
        
        <!-- Footer -->
        <footer class="wedding-footer">
            <div class="footer-content">
                <!-- <div class="footer-social">
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                </div> -->
                <p class="footer-hashtag">#<?php echo str_replace(' & ', '', $config['couple_headline']); ?>Wedding</p>
                <p class="footer-copyright">Thank you for being part of our journey</p>
            </div>
        </footer>
        
    </div>
    
    <!-- Audio Control Button -->
    <button id="audioToggleBtn" class="audio-fab hidden">
        <div class="audio-visualizer">
            <span></span><span></span><span></span><span></span>
        </div>
        <i id="audioIcon" class="fas fa-volume-mute"></i>
    </button>
    
</div>

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- <script src="../assets/js/script.js"></script> -->
<script src="assets/js/script.js"></script>

</body>
</html>