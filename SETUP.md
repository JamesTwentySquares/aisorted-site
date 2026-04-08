# AI Sorted — Git & Deployment Setup

## Step 1: Create the GitHub repo

1. Go to **github.com/new**
2. Repository name: `aisorted-site`
3. Set to **Private** (you don't want competitors seeing your code)
4. Don't initialise with README (we'll push our own)
5. Click **Create repository**
6. Copy the repo URL — it'll look like:
   `https://github.com/YOUR_USERNAME/aisorted-site.git`


## Step 2: Set up locally and push

Open a terminal on your machine:

```bash
# Create a folder and initialise
mkdir aisorted-site
cd aisorted-site
git init

# Copy the files you downloaded from Claude into this folder:
#   index.html
#   contact.php
#   .cpanel.yml
#   .gitignore
#   README.md

# Stage and commit
git add .
git commit -m "Initial commit — full AI Sorted landing page"

# Connect to GitHub and push
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/aisorted-site.git
git push -u origin main
```


## Step 3: Connect cPanel to GitHub

1. Log into your **Afrihost cPanel**
2. Under **Files**, click **Git™ Version Control**
3. Click **Create**
4. Toggle **Clone a Repository** to ON
5. Fill in:
   - **Clone URL**: `https://github.com/YOUR_USERNAME/aisorted-site.git`
   - **Repository Path**: `/home/YOUR_CPANEL_USERNAME/repositories/aisorted-site`
     (NOT public_html — cPanel needs its own working directory)
   - **Repository Name**: `aisorted-site`
6. Click **Create**

### Finding your cPanel username
Your cPanel username is shown at the top-right of the cPanel dashboard,
or in the **Server Information** section in the sidebar. It's usually
something like `aisortd` or similar (8 char max on some hosts).


## Step 4: Update .cpanel.yml with your actual username

Before deploying, edit `.cpanel.yml` and replace `YOUR_CPANEL_USERNAME`
with your actual cPanel username:

```yaml
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/aisortd/public_html/
    - /bin/cp index.html $DEPLOYPATH
    - /bin/cp contact.php $DEPLOYPATH
```

Commit and push this change:

```bash
git add .cpanel.yml
git commit -m "Set correct cPanel deploy path"
git push
```


## Step 5: Pull and deploy

1. In cPanel → **Git™ Version Control**
2. Click **Manage** next to your repo
3. Click **Pull or Deploy** tab
4. Click **Update from Remote** (pulls latest from GitHub)
5. Click **Deploy HEAD Commit** (runs .cpanel.yml tasks)

Your site should now be live at **aisorted.co.za**!


## Step 6: Set up the email

1. In cPanel → **Email** → **Email Accounts**
2. Create: `hello@aisorted.co.za`
3. Set a strong password
4. If you want it to forward to your personal email:
   - Go to **Forwarders**
   - Add a forwarder from `hello@aisorted.co.za` → your email


## Step 7: Configure the contact form

You have two options:

### Option A: PHP handler (recommended — already included)

In `index.html`, change the fetch URL in the contact form JS:

```javascript
// Change this:
const res = await fetch('https://formspree.io/f/YOUR_FORM_ID', {

// To this:
const res = await fetch('contact.php', {
```

Also update `contact.php`:
- Set `$to_email` to your actual email address
- Set `$from_email` to `noreply@aisorted.co.za`

### Option B: Formspree (if you prefer no server-side code)

1. Go to [formspree.io](https://formspree.io)
2. Sign up (free tier: 50 submissions/month)
3. Create a new form
4. Copy your form ID (e.g., `xpzvqkgl`)
5. In `index.html`, replace `YOUR_FORM_ID` with your actual ID


## Ongoing: How to update the site

After making changes locally:

```bash
# Make your edits to index.html, contact.php, etc.
git add .
git commit -m "Describe what you changed"
git push
```

Then in cPanel:
1. Git Version Control → Manage → Pull or Deploy
2. **Update from Remote**
3. **Deploy HEAD Commit**

Or, if you have SSH access to your Afrihost server:

```bash
ssh yourusername@yourserver
cd ~/repositories/aisorted-site
git pull
```
The `.cpanel.yml` will auto-run on pull.


## Optional: GitHub authentication

If cPanel asks for credentials when cloning a private repo:

1. Go to **github.com → Settings → Developer settings → Personal access tokens → Fine-grained tokens**
2. Create a token with **Contents: Read** permission scoped to `aisorted-site`
3. Use your GitHub username + this token as the password when cPanel asks

Alternatively, use a **Deploy Key**:
1. In cPanel terminal or SSH: `ssh-keygen -t ed25519 -C "aisorted-cpanel"`
2. Copy the public key
3. In GitHub → repo Settings → Deploy keys → Add deploy key
4. Use the SSH clone URL instead: `git@github.com:YOUR_USERNAME/aisorted-site.git`


## File structure

```
aisorted-site/
├── .cpanel.yml       ← Auto-deploy config
├── .gitignore        ← Git ignore rules
├── README.md         ← Project readme
├── SETUP.md          ← This file
├── index.html        ← Full landing page
└── contact.php       ← Form email handler
```


## What to update before going live

- [ ] Replace `YOUR_FORM_ID` or switch to `contact.php` (Step 7)
- [ ] Replace `27XXXXXXXXXX` with your WhatsApp number (2 places in index.html)
- [ ] Create `hello@aisorted.co.za` email (Step 6)
- [ ] Update `$to_email` in contact.php
- [ ] Update `.cpanel.yml` with your cPanel username (Step 4)
- [ ] Test the contact form end-to-end
- [ ] Test on mobile (Chrome DevTools → responsive mode)
