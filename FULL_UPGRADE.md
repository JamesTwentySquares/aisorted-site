# Claude Code Prompt — AI Sorted Full Brand & UX Upgrade

Copy everything between the `---START---` and `---END---` markers below and paste it as a single prompt into Claude Code while in your `aisorted-site` directory.

---START---

I need a comprehensive upgrade to index.html for the AI Sorted website (aisorted.co.za). This combines a colour palette update with UX and conversion improvements inspired by top-performing Webflow AI/SaaS templates. Make all changes in a single pass across the file.

## PART 1: COLOUR PALETTE — Option E Duo-Tone (Amber + Teal)

The concept: amber/gold is the PRIMARY accent for brand identity, CTAs, automation services, and energy. Teal is the SECONDARY accent for training/education, trust signals, WhatsApp, success states, and the "learn it yourself" service line. This creates visual distinction between the two offerings.

### 1a. CSS Variables — Replace the :root block

```css
:root {
  --bg: #0d0f10;
  --bg2: #13161a;
  --bg3: #1a1e24;
  --border: rgba(255,255,255,0.07);
  --accent: #f5a623;
  --accent2: #e8891a;
  --teal: #2dd4bf;
  --teal2: #14b8a6;
  --text: #e8e6e1;
  --muted: #7a7870;
  --green: #2dd4bf;
  --red: #ef4444;
}
```

### 1b. Hero glow — Make the secondary glow teal

Change `.hero-glow2` background:
- FROM: `rgba(74,222,128,0.06)` 
- TO: `rgba(45,212,191,0.08)`

### 1c. Training section — Full teal treatment

All training elements should use teal instead of the old green:
- `.training-card:hover` border-color: `rgba(45,212,191,0.3)`
- `.training-icon` background: `rgba(45,212,191,0.1)`, border: `rgba(45,212,191,0.2)`
- `.training-meta` color: `var(--teal)`
- `.training-list li::before` background: `var(--teal)`
- All three training SVG icons: change `stroke="#4ade80"` to `stroke="#2dd4bf"`

### 1d. Featured bundle card — Dual-tone gradient

Change `.service-card.featured` background:
```css
background: linear-gradient(135deg, rgba(245,166,35,0.06), var(--bg3), rgba(45,212,191,0.03));
```

### 1e. Hero stats — Teal on the 24/7 stat

Add `style="color: var(--teal)"` to the `/7` span in the 24/7 hero stat.

### 1f. Contact WhatsApp icon — Teal stroke

Change the WhatsApp SVG icon in the contact section from `stroke="#f5a623"` to `stroke="#2dd4bf"`. Keep email and location icons as amber.

### 1g. FAQ hover — Teal

Change `.faq-q:hover` to `color: var(--teal)`.

### 1h. Footer WhatsApp link — Teal

Add `style="color: var(--teal);"` to the WhatsApp link in the footer.

### 1i. Nav training link — Teal hover

Add CSS:
```css
nav ul a[href="#training"]:hover { color: var(--teal); }
.mobile-menu a[href="#training"]:hover { color: var(--teal); }
```

### 1j. Form success — Teal

`.form-status.success { color: var(--teal); }`


## PART 2: NEW SECTIONS & ELEMENTS

### 2a. Trust/Tools bar — Add after the hero section, before #services

Add a new section between the hero and services. It should NOT have a section id. It's a simple horizontal strip showing the tools/platforms AI Sorted works with. Style: subtle, understated, not flashy.

```html
<!-- TRUST BAR -->
<div class="trust-bar">
  <p class="trust-label">Powered by tools from</p>
  <div class="trust-logos">
    <span class="trust-item">Claude</span>
    <span class="trust-item">ChatGPT</span>
    <span class="trust-item">WhatsApp Business</span>
    <span class="trust-item">Zapier</span>
    <span class="trust-item">Make</span>
    <span class="trust-item">Google Workspace</span>
  </div>
</div>
```

CSS for trust bar:
```css
.trust-bar {
  padding: 2.5rem 4rem;
  text-align: center;
  border-bottom: 1px solid var(--border);
  background: var(--bg);
}

.trust-label {
  font-size: 0.7rem;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--muted);
  margin-bottom: 1.25rem;
  font-weight: 500;
}

.trust-logos {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2.5rem;
  flex-wrap: wrap;
}

.trust-item {
  font-family: 'Syne', sans-serif;
  font-weight: 700;
  font-size: 0.9rem;
  color: var(--muted);
  opacity: 0.5;
  transition: opacity 0.3s;
  letter-spacing: -0.01em;
}

.trust-item:hover { opacity: 0.8; }
```

Mobile responsive: `.trust-bar` should have `padding: 2rem 1.5rem;` and `.trust-logos` should have `gap: 1.5rem;` at the 768px breakpoint.

### 2b. "Who this is for" section — Add between #services and #training

This helps visitors self-identify. Use a grid of small audience cards.

```html
<!-- WHO IT'S FOR -->
<section id="audience">
  <div class="reveal">
    <div class="section-label">Who it's for</div>
    <h2 class="section-title">If this sounds like you, we should talk</h2>
  </div>
  <div class="audience-grid">
    <div class="audience-card reveal">
      <div class="audience-emoji">💇</div>
      <div class="audience-name">Salons & spas</div>
      <div class="audience-pain">Missing bookings when you're with a client</div>
    </div>
    <div class="audience-card reveal">
      <div class="audience-emoji">🍽️</div>
      <div class="audience-name">Restaurants & cafés</div>
      <div class="audience-pain">Wasting time on phone bookings and social posts</div>
    </div>
    <div class="audience-card reveal">
      <div class="audience-emoji">⚖️</div>
      <div class="audience-name">Law firms & consultants</div>
      <div class="audience-pain">Drowning in admin, proposals, and follow-ups</div>
    </div>
    <div class="audience-card reveal">
      <div class="audience-emoji">🏠</div>
      <div class="audience-name">Estate agents</div>
      <div class="audience-pain">Leads going cold because you're too busy to respond</div>
    </div>
    <div class="audience-card reveal">
      <div class="audience-emoji">🔧</div>
      <div class="audience-name">Tradespeople</div>
      <div class="audience-pain">No time for marketing between jobs</div>
    </div>
    <div class="audience-card reveal">
      <div class="audience-emoji">🏥</div>
      <div class="audience-name">Clinics & practices</div>
      <div class="audience-pain">No-shows and unanswered patient enquiries</div>
    </div>
    <div class="audience-card reveal">
      <div class="audience-emoji">🏋️</div>
      <div class="audience-name">Fitness & wellness</div>
      <div class="audience-pain">Managing class bookings and client retention manually</div>
    </div>
    <div class="audience-card reveal">
      <div class="audience-emoji">🛒</div>
      <div class="audience-name">Retail & e-commerce</div>
      <div class="audience-pain">Struggling to keep social media active and engaging</div>
    </div>
  </div>
</section>
```

CSS for audience section:
```css
#audience { background: var(--bg); }

.audience-grid {
  margin-top: 3rem;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1rem;
}

.audience-card {
  background: var(--bg3);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 1.25rem;
  transition: border-color 0.25s, transform 0.2s;
}

.audience-card:hover {
  border-color: rgba(45,212,191,0.25);
  transform: translateY(-2px);
}

.audience-emoji {
  font-size: 1.5rem;
  margin-bottom: 0.6rem;
}

.audience-name {
  font-family: 'Syne', sans-serif;
  font-weight: 700;
  font-size: 0.9rem;
  margin-bottom: 0.35rem;
}

.audience-pain {
  font-size: 0.8rem;
  color: var(--muted);
  line-height: 1.5;
}
```

Mobile responsive at 768px: `.audience-grid` should be `grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));`

### 2c. Social proof / testimonial placeholder — Add between #why and #faq

Even without real testimonials yet, having the structure ready (with a compelling stat-based quote) signals credibility.

```html
<!-- SOCIAL PROOF -->
<section id="proof">
  <div class="proof-container reveal">
    <div class="proof-quote">
      <div class="proof-mark">"</div>
      <p class="proof-text">53% of South African small businesses plan to use AI for automation this year. The businesses that start now will have a 12-month head start on their competitors.</p>
      <div class="proof-attribution">
        <span class="proof-source">Xero State of Small Business Report, 2025</span>
      </div>
    </div>
    <div class="proof-stats">
      <div class="proof-stat">
        <div class="proof-stat-num" data-target="67">0%</div>
        <div class="proof-stat-label">of SA enterprises already using AI</div>
      </div>
      <div class="proof-stat">
        <div class="proof-stat-num" data-target="91">0%</div>
        <div class="proof-stat-label">of SMBs report AI boosts revenue</div>
      </div>
      <div class="proof-stat">
        <div class="proof-stat-num" data-target="35">0%</div>
        <div class="proof-stat-label">annual AI market growth in SA</div>
      </div>
    </div>
  </div>
</section>
```

CSS for proof section:
```css
#proof {
  background: var(--bg2);
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}

.proof-container {
  max-width: 900px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
}

.proof-mark {
  font-family: 'Syne', sans-serif;
  font-size: 4rem;
  font-weight: 800;
  color: var(--teal);
  line-height: 1;
  margin-bottom: 0.5rem;
  opacity: 0.6;
}

.proof-text {
  font-size: 1.05rem;
  line-height: 1.7;
  color: var(--text);
  font-weight: 300;
  font-style: italic;
}

.proof-attribution {
  margin-top: 1.25rem;
}

.proof-source {
  font-size: 0.78rem;
  color: var(--teal);
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.06em;
}

.proof-stats {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.proof-stat {
  padding: 1.25rem;
  background: var(--bg3);
  border-radius: 10px;
  border: 1px solid var(--border);
}

.proof-stat-num {
  font-family: 'Syne', sans-serif;
  font-size: 2rem;
  font-weight: 800;
  color: var(--accent);
  letter-spacing: -0.02em;
}

.proof-stat-label {
  font-size: 0.8rem;
  color: var(--muted);
  margin-top: 0.15rem;
}
```

Mobile responsive at 768px: `.proof-container` should be `grid-template-columns: 1fr;`

### 2d. Sticky mobile CTA — Fixed bottom bar on mobile

Add this HTML just before the closing `</body>` tag (before the `<script>` block):

```html
<!-- STICKY MOBILE CTA -->
<div class="sticky-cta" id="stickyCta">
  <a href="#contact" class="btn-primary" style="width:100%;text-align:center;padding:0.9rem;">Book a free consult →</a>
</div>
```

CSS:
```css
.sticky-cta {
  display: none;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 90;
  padding: 0.75rem 1.5rem;
  background: rgba(13, 15, 16, 0.95);
  backdrop-filter: blur(12px);
  border-top: 1px solid var(--border);
}

@media (max-width: 768px) {
  .sticky-cta { display: block; }
  footer { padding-bottom: 5rem; }
  #contact { padding-bottom: 5rem; }
}
```

JavaScript (add to the existing script block): Show/hide the sticky CTA based on scroll position — hide it when the user is at the top (hero visible) or when they've scrolled to the contact form:

```javascript
// ── STICKY MOBILE CTA ──
const stickyCta = document.getElementById('stickyCta');
const contactSection = document.getElementById('contact');
const heroSection = document.querySelector('.hero');

if (stickyCta) {
  window.addEventListener('scroll', () => {
    const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;
    const contactTop = contactSection.offsetTop - window.innerHeight;
    const scrollY = window.scrollY;

    if (scrollY > heroBottom && scrollY < contactTop) {
      stickyCta.style.transform = 'translateY(0)';
      stickyCta.style.opacity = '1';
    } else {
      stickyCta.style.transform = 'translateY(100%)';
      stickyCta.style.opacity = '0';
    }
  });
  stickyCta.style.transition = 'transform 0.3s, opacity 0.3s';
  stickyCta.style.transform = 'translateY(100%)';
  stickyCta.style.opacity = '0';
}
```


## PART 3: ANIMATION & UX UPGRADES

### 3a. Staggered reveal on card grids

Replace the existing scroll reveal observer with an improved version that staggers child cards within grids:

```javascript
// ── SCROLL REVEAL (IMPROVED) ──
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const el = entry.target;
      // If this element is inside a grid, stagger based on sibling index
      const parent = el.parentElement;
      const siblings = parent ? Array.from(parent.querySelectorAll('.reveal')) : [];
      const index = siblings.indexOf(el);
      const delay = index >= 0 ? index * 80 : 0;
      setTimeout(() => el.classList.add('visible'), delay);
      revealObserver.unobserve(el);
    }
  });
}, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
```

This replaces the existing `observer` code. Make sure to remove the old observer and use `revealObserver` as the variable name.

### 3b. Animated stat counters — For the proof section stats

Add this JavaScript to animate the stat numbers when they scroll into view:

```javascript
// ── ANIMATED COUNTERS ──
const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const target = parseInt(el.getAttribute('data-target'));
      if (isNaN(target)) return;
      let current = 0;
      const duration = 1500;
      const step = target / (duration / 16);
      const counter = setInterval(() => {
        current += step;
        if (current >= target) {
          current = target;
          clearInterval(counter);
        }
        el.textContent = Math.round(current) + '%';
      }, 16);
      counterObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('[data-target]').forEach(el => counterObserver.observe(el));
```

### 3c. Smooth nav background transition

Add this JavaScript to make the nav background more opaque as the user scrolls past the hero:

```javascript
// ── NAV SCROLL EFFECT ──
const navEl = document.querySelector('nav');
window.addEventListener('scroll', () => {
  if (window.scrollY > 100) {
    navEl.style.background = 'rgba(13, 15, 16, 0.95)';
    navEl.style.borderBottomColor = 'rgba(255,255,255,0.1)';
  } else {
    navEl.style.background = 'rgba(13, 15, 16, 0.85)';
    navEl.style.borderBottomColor = 'rgba(255,255,255,0.07)';
  }
});
```


## PART 4: SECTION ORDER (FINAL PAGE STRUCTURE)

After all changes, the page sections should flow in this order:

1. `nav`
2. Mobile menu overlay
3. `.hero` section
4. `.trust-bar` (NEW — tools/powered by strip)
5. `#services` (automation offerings — amber accented)
6. `#audience` (NEW — "who it's for" cards)
7. `#training` (learn it yourself — teal accented)
8. `#how` (how it works steps)
9. `#why` (why AI Sorted)
10. `#proof` (NEW — social proof with stat counters)
11. `#faq` (frequently asked)
12. `#contact` (contact form)
13. Sticky mobile CTA (NEW — fixed bottom bar)
14. `footer`

Update the nav links and mobile menu links to include the new sections where appropriate. The nav should remain: Services | Training | How it works | Why us | FAQ | Get started (CTA). Don't add audience or proof to the nav — they're flow sections, not destination sections.


## PART 5: RESPONSIVE ADDITIONS

Add these to the appropriate media query breakpoints:

At 1024px (tablet):
```css
.trust-bar { padding: 2rem 2rem; }
.proof-container { gap: 2rem; }
```

At 768px (mobile):
```css
.trust-bar { padding: 1.5rem 1.5rem; }
.trust-logos { gap: 1.25rem; }
.trust-item { font-size: 0.78rem; }
.audience-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
.proof-container { grid-template-columns: 1fr; }
.proof-text { font-size: 0.95rem; }
.sticky-cta { display: block; }
footer { padding-bottom: 5rem; }
#contact { padding-bottom: 5rem; }
```

At 380px (small mobile):
```css
.trust-logos { gap: 1rem; }
.trust-item { font-size: 0.72rem; }
.audience-grid { grid-template-columns: 1fr 1fr; }
```


## COLOUR LOGIC REFERENCE

Keep this mapping consistent throughout:

| Amber (#f5a623) | Teal (#2dd4bf) |
|---|---|
| Logo "Sorted" text | Training section accents |
| Primary CTA buttons | Training card icons & meta |
| Section labels | FAQ hover states |
| Service card accents & pricing tags | WhatsApp links & icons |
| Hero badge | Hero secondary glow |
| Email & location icons | Success states |
| Featured card border | Audience card hover |
| Nav CTA button | Proof section quote mark & source |
| Stat numbers in proof section | Footer WhatsApp link |

Do NOT change to teal: the logo, primary CTA buttons, section-label text, hero badge, or nav-cta. Amber remains dominant — teal supports.

After making all changes, verify the HTML is valid, all sections render correctly, and the two-tone palette creates clear visual distinction between automation (amber) and training/education (teal).

---END---

After Claude Code applies the changes:
```bash
git add .
git commit -m "Full brand upgrade: Option E duo-tone palette + trust bar, audience section, social proof, sticky CTA, animated counters, staggered reveals"
git push
```

Then in cPanel → Git Version Control → Update from Remote → Deploy HEAD Commit.
