Faribault Web Design - static HTML version
==========================================

Upload the CONTENTS of this folder (including the hidden .htaccess file) to the web root of
faribaultwebdesign.com, or to any subfolder for a staging preview. All links are relative.

All 23 URLs are unchanged: home, about, services, web design, local SEO, digital marketing,
Faribault web design, website design cost, contact, and the blog with its 9 posts, category
and author pages. Each URL is a folder containing index.html.
Two URLs that redirect on the live site still redirect (small redirect pages):
  /blog/2026/03/12/  -> home page
  /blog/marketing/content-marketing-scaling-your-small-business-in-the-era-of-ai-search/
                     -> /blog/content-marketing-scaling-your-small-business-in-the-era-of-ai-search/

Contact form
------------
The Contact Form 7 form (home page and /contact/) now posts to send.php (needs PHP) and shows
the usual "Thank you for your message" after sending.
IMPORTANT: no email address is published on the site, so open send.php and set $to to the
address that should receive messages. Until then the form shows its error message.
The Cloudflare Turnstile box only works on faribaultwebdesign.com itself, so on a staging
domain it may show an error; forms still send either way.

Noindex (staging)
-----------------
Every page has <meta name="robots" content="noindex, nofollow" /> and .htaccess sends an
X-Robots-Tag: noindex, nofollow header, so search engines will not index this copy.
BEFORE GOING LIVE on the real domain: remove that meta line from each page and delete the
"BEGIN noindex ... END noindex" block from .htaccess, or the site will drop out of Google.
