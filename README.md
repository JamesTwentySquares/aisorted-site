# AI Sorted — aisorted.co.za

Marketing site for AI Sorted — AI consulting and automation services for South African SMEs.

## Stack

- Static HTML/CSS/JS (single page)
- PHP contact form handler (runs on Afrihost cPanel)
- Deployed via cPanel Git Version Control

## Deployment

Push to `main` → pull in cPanel → `.cpanel.yml` auto-deploys to `public_html/`.

## Files

| File | Purpose |
|------|---------|
| `index.html` | Full landing page |
| `contact.php` | Form handler (emails to howzit@aisorted.co.za) |
| `.cpanel.yml` | cPanel auto-deploy config |

## Setup

Push to `main`, then in cPanel → Git™ Version Control → Update from Remote → Deploy HEAD Commit.
