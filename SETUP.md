# AI Sorted — Git & Deployment Setup

## Status: LIVE ✓
Site is live at **aisorted.co.za** — all setup steps completed 2026-04-08.

---

## Step 1: Create the GitHub repo ✓

- Repo: `https://github.com/JamesTwentySquares/aisorted-site`
- Set to **Private**

## Step 2: Set up locally and push ✓

- Files committed and pushed to `main`
- Remote: `https://github.com/JamesTwentySquares/aisorted-site.git`

## Step 3: Connect cPanel to GitHub ✓

- Cloned into Afrihost cPanel via Git™ Version Control
- Repository path: `/home/aisortp6e1q8/repositories/aisorted-site`

## Step 4: Update .cpanel.yml ✓

cPanel username is `aisortp6e1q8`. Deploy path set to:

```yaml
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/aisortp6e1q8/public_html/
    - /bin/cp index.html $DEPLOYPATH
    - /bin/cp contact.php $DEPLOYPATH
```

## Step 5: Pull and deploy ✓

- Site pulled and deployed via cPanel → Git™ Version Control → Pull or Deploy
- Live at **aisorted.co.za**

## Step 6: Set up the email ✓

- Email created: `howzit@aisorted.co.za`
- Note: originally planned as `hello@aisorted.co.za` — changed to `howzit@aisorted.co.za`
- All references in `index.html` and `contact.php` updated to match

## Step 7: Configure the contact form ✓

- **Option A (PHP handler)** chosen — no third-party dependency
- `contact.php` is deployed alongside `index.html` in `public_html/`
- `index.html` fetch URL updated from `https://formspree.io/f/YOUR_FORM_ID` to `contact.php`
- `$to_email` set to `howzit@aisorted.co.za`
- `$from_email` set to `noreply@aisorted.co.za`

---

## What was updated before going live

- [x] Contact form switched to `contact.php` (PHP handler)
- [x] `$to_email` in contact.php set to `howzit@aisorted.co.za`
- [x] WhatsApp number set to `+27 83 414 7656` (`wa.me/27834147656`) — 2 places in index.html
- [x] Email `howzit@aisorted.co.za` created in cPanel
- [x] `.cpanel.yml` updated with cPanel username `aisortp6e1q8`
- [x] Tested deploy — site is live

---

## How to update the site going forward

1. Edit files locally (`index.html`, `contact.php`, etc.)
2. Commit and push:

```bash
git add .
git commit -m "Describe what you changed"
git push
```

3. In cPanel → Git™ Version Control → Manage → Pull or Deploy:
   - **Update from Remote**
   - **Deploy HEAD Commit**

---

## File structure

```
aisorted-site/
├── .cpanel.yml       ← Auto-deploy config (cPanel username: aisortp6e1q8)
├── .gitignore        ← Git ignore rules
├── README.md         ← Project readme
├── SETUP.md          ← This file
├── index.html        ← Full landing page
└── contact.php       ← Form email handler (sends to howzit@aisorted.co.za)
```

---

## GitHub authentication note

The repo is private. If cPanel ever needs re-authentication:

1. Go to **github.com → Settings → Developer settings → Personal access tokens → Fine-grained tokens**
2. Create a token with **Contents: Read** permission scoped to `aisorted-site`
3. Use your GitHub username + this token as the password when cPanel prompts
