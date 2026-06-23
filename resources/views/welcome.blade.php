<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow & Style | Premium Luxury Salon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@300;400;600&family=Outfit:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        :root { --accent: #c2a17e; --dark: #1c1917; }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-display { font-family: 'Playfair Display', serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); }
        .text-accent { color: var(--accent); }
        .bg-accent { background: var(--accent); }
        .border-accent { border-color: var(--accent); }
        .hero-gradient { background: linear-gradient(135deg, rgba(28,25,23,0.95) 0%, rgba(28,25,23,0.7) 100%); }
    </style>
</head>
<body class="bg-stone-50 text-stone-900 selection:bg-stone-200" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-500 px-6 py-4 flex justify-between items-center" 
         :class="scrolled ? 'glass py-3 shadow-lg border-b border-stone-200' : 'bg-transparent py-5'">
        <div class="flex items-center space-x-2">
            <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center text-white font-bold">G</div>
            <span class="text-2xl font-bold tracking-tighter text-stone-800 uppercase font-outfit" :class="!scrolled ? 'text-white' : 'text-stone-900'">Glow & Style</span>
        </div>
        
        <div class="space-x-8 hidden md:flex items-center font-outfit text-sm uppercase tracking-widest" :class="!scrolled ? 'text-stone-200' : 'text-stone-700'">
            <a href="#services" class="hover:text-amber-500 transition">Services</a>
            <a href="#gallery" class="hover:text-amber-500 transition">Gallery</a>
            <a href="#about" class="hover:text-amber-500 transition">Our Story</a>
            <a href="#contact" class="hover:text-amber-500 transition">Contact</a>
        </div>

        <div class="flex items-center space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-7 py-2.5 bg-accent text-white rounded-full hover:bg-stone-800 transition font-outfit text-sm font-bold shadow-lg">DASHBOARD</a>
                @else
                    <a href="{{ route('login') }}" class="font-outfit text-sm font-bold tracking-widest transition" :class="!scrolled ? 'text-white hover:text-stone-300' : 'text-stone-900 hover:text-accent'">LOG IN</a>
                    <a href="{{ route('register') }}" class="px-7 py-2.5 bg-stone-900 text-white rounded-full hover:bg-accent transition font-outfit text-sm font-bold shadow-lg">BOOK NOW</a>
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="h-screen w-full relative flex items-center overflow-hidden">
        <img src="{{ asset('images/hero.png') }}" alt="Salon Interior" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 hero-gradient"></div>
        
        <div class="container mx-auto px-6 relative z-10 text-white pt-20">
            <div class="max-w-4xl">
                <span class="inline-block px-4 py-2 bg-accent/20 border border-accent/30 rounded-full text-accent font-outfit text-xs uppercase tracking-[0.3em] mb-6 backdrop-blur-sm">
                    Luxury Redefined in Sri Lanka
                </span>
                <h1 class="text-6xl md:text-8.5xl mb-8 leading-[1.1] font-bold">Unveil Your <br><span class="italic text-accent">Radiant Self</span></h1>
                <p class="text-xl md:text-2xl text-stone-300 mb-12 max-w-2xl leading-relaxed font-light">
                    Where artistry meets elegance. Experience world-class hair, skin, and nail treatments in a masterpiece of tranquility.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center bg-accent text-white px-10 py-5 rounded-full text-lg font-bold hover:bg-white hover:text-stone-900 transition-all duration-500 transform hover:scale-105 shadow-2xl">
                        Schedule Appointment
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#services" class="inline-flex items-center justify-center border border-white/50 text-white px-10 py-5 rounded-full text-lg font-bold hover:bg-white/10 transition-all backdrop-blur-sm">
                        View Menu
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center animate-bounce opacity-40">
            <span class="text-[10px] uppercase tracking-widest text-white mb-2">Scroll</span>
            <div class="w-[1px] h-12 bg-white"></div>
        </div>
    </header>

    <!-- Stats Bar -->
    <section class="bg-stone-900 py-12 border-b border-stone-800">
        <div class="container mx-auto px-6 grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-accent mb-1 font-outfit">15+</div>
                <div class="text-stone-500 text-xs uppercase tracking-widest">Master Artists</div>
            </div>
            <div class="text-center border-l border-stone-800">
                <div class="text-4xl font-bold text-accent mb-1 font-outfit">10k+</div>
                <div class="text-stone-500 text-xs uppercase tracking-widest">Happy Clients</div>
            </div>
            <div class="text-center border-l border-stone-800">
                <div class="text-4xl font-bold text-accent mb-1 font-outfit">5yr</div>
                <div class="text-stone-500 text-xs uppercase tracking-widest">Experience</div>
            </div>
            <div class="text-center border-l border-stone-800">
                <div class="text-4xl font-bold text-accent mb-1 font-outfit">4.9★</div>
                <div class="text-stone-500 text-xs uppercase tracking-widest">Google Rating</div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-32 px-6 bg-white overflow-hidden">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-6">
                <div class="max-w-xl">
                    <h2 class="text-5xl md:text-6xl mb-6 leading-tight">Crafted with <br> <span class="text-accent italic">Precision & Care</span></h2>
                    <p class="text-stone-500 text-lg leading-relaxed">We use only organic, hypoallergenic products combined with the latest styling techniques to create a look that is uniquely yours.</p>
                </div>
                <a href="{{ route('login') }}" class="text-accent font-bold border-b-2 border-accent pb-1 hover:text-stone-900 hover:border-stone-900 transition">View Full Catalog</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Service 1 -->
                <div class="group relative" data-aos="fade-up">
                    <div class="overflow-hidden rounded-3xl mb-8 aspect-[4/5]">
                        <img src="{{ asset('images/haircut.png') }}" alt="Signature Cut" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h3 class="text-3xl mb-4">Signature Haircuts</h3>
                    <p class="text-stone-500 mb-6 leading-relaxed">From modern bobs to classic pixies, our master stylists create silhouettes that perfectly complement your face shape.</p>
                    <div class="flex items-center justify-between pt-6 border-t border-stone-100">
                        <span class="font-outfit text-xl font-bold">$25 - $45</span>
                        <a href="{{ route('register') }}" class="w-12 h-12 bg-stone-50 rounded-full flex items-center justify-center hover:bg-stone-900 hover:text-white transition group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="group relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="overflow-hidden rounded-3xl mb-8 aspect-[4/5]">
                        <img src="{{ asset('images/skincare.png') }}" alt="Glow Facial" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h3 class="text-3xl mb-4">The Glow Facial</h3>
                    <p class="text-stone-500 mb-6 leading-relaxed">Our clinical treatments combine peptides and vitamin C to restore your skin's natural luminosity and firmness.</p>
                    <div class="flex items-center justify-between pt-6 border-t border-stone-100">
                        <span class="font-outfit text-xl font-bold">$50 - $90</span>
                        <a href="{{ route('register') }}" class="w-12 h-12 bg-stone-50 rounded-full flex items-center justify-center hover:bg-stone-900 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="group relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="overflow-hidden rounded-3xl mb-8 aspect-[4/5] bg-stone-100 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-stone-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white font-bold tracking-widest text-xs uppercase border-b border-white">Coming Soon</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b?auto=format&fit=crop&q=80&w=800" alt="Nail Art" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h3 class="text-3xl mb-4">Artisanal Spa</h3>
                    <p class="text-stone-500 mb-6 leading-relaxed">Complete your rejuvenation with our botanical-infused manicure and pedicure sessions designed for ultimate relaxation.</p>
                    <div class="flex items-center justify-between pt-6 border-t border-stone-100">
                        <span class="font-outfit text-xl font-bold">$20 - $35</span>
                        <a href="{{ route('register') }}" class="w-12 h-12 bg-stone-50 rounded-full flex items-center justify-center hover:bg-stone-900 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery (Dynamic Parallax Style) -->
    <section id="gallery" class="py-32 bg-stone-950 text-white overflow-hidden">
        <div class="container mx-auto px-6 mb-20 text-center">
            <span class="text-accent uppercase tracking-[0.4em] text-[10px] mb-4 block">Visual Diary</span>
            <h2 class="text-6xl mb-6">Masterpiece Gallery</h2>
            <p class="text-stone-400 max-w-xl mx-auto">Take a glimpse into our world of transformation and beauty.</p>
        </div>
        
        <div class="flex space-x-8 animate-marquee whitespace-nowrap">
            <div class="flex space-x-8">
                <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
                <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
                <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
                <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
            </div>
            <div class="flex space-x-8">
                <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
                <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
                <img src="https://images.unsplash.com/photo-1492106087820-71f1a00d2b11?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
                <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&q=80&w=400" class="w-[400px] h-[500px] object-cover rounded-3xl" alt="">
            </div>
        </div>

        <style>
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee { animation: marquee 30s linear infinite; }
        </style>
    </section>

    <!-- Appointment Quote -->
    <section class="py-40 bg-white text-center relative px-6 overflow-hidden">
        <div class="max-w-4xl mx-auto">
            <div class="text-accent text-8xl font-serif mb-8 opacity-20">"</div>
            <h2 class="text-5xl md:text-7xl mb-12 leading-tight">Beauty begins the moment <br> you decide to <span class="italic font-light">be yourself.</span></h2>
            <div class="flex justify-center flex-col items-center">
                <a href="{{ route('register') }}" class="px-16 py-6 bg-accent text-white rounded-full text-xl font-bold shadow-2xl hover:bg-stone-900 transition-all duration-500 transform hover:scale-105">
                    Start Your Transformation
                </a>
                <p class="mt-8 text-stone-400 font-outfit uppercase tracking-widest text-xs">- Coco Chanel inspirited</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-stone-950 text-stone-500 py-32 px-10 border-t border-stone-900">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-20">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-2 text-white mb-8">
                    <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center text-white font-bold">G</div>
                    <span class="text-3xl font-bold tracking-tighter uppercase font-outfit">Glow & Style</span>
                </div>
                <p class="text-lg max-w-sm mb-12 leading-relaxed">A sanctuary of style and sophistication in Los Angeles. We are committed to excellence, redefining beauty one guest at a time.</p>
                <div class="flex space-x-6">
                    <a href="#" class="w-10 h-10 border border-stone-800 rounded-full flex items-center justify-center hover:bg-accent hover:text-white transition"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                    <a href="#" class="w-10 h-10 border border-stone-800 rounded-full flex items-center justify-center hover:bg-accent hover:text-white transition"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-bold mb-8 uppercase tracking-widest text-xs">Opening Hours</h4>
                <ul class="space-y-4">
                    <li class="flex justify-between"><span>Mon - Fri</span> <span class="text-white">9:00 - 20:00</span></li>
                    <li class="flex justify-between"><span>Saturday</span> <span class="text-white">9:00 - 18:00</span></li>
                    <li class="flex justify-between"><span>Sunday</span> <span class="text-white font-bold text-accent">Closed</span></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-8 uppercase tracking-widest text-xs">Quick Access</h4>
                <ul class="space-y-4">
                    <li><a href="#services" class="hover:text-white transition">Services</a></li>
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-white transition underline">Admin Login</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">My Account</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-32 pt-12 border-t border-stone-900 flex flex-col md:flex-row justify-between items-center text-xs uppercase tracking-widest opacity-60">
            <div>&copy; 2026 GLOW & STYLE SALON. CRAFTED BY PASINDU DILMIN.</div>
            <div><a class="hover:text-white transition" target="_blank" href="https://portfolio-psi-two-16.vercel.app/"> CLICK HERE TO VIEW DEVELOPER'S PORTFOLIO</a></div>
            <!-- <div class="mt-4 md:mt-0">MADE WITH PASSION IN SRI LANKA</div> -->
        </div>
    </footer>
</body>
</html>
