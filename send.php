<?php
/**
 * Contact form handler for the static Faribault Web Design site.
 * Replaces Contact Form 7 (which needed WordPress). Uses PHP mail().
 *
 * TODO: set $to to the address that should receive contact messages
 * (no email address is published on the site). Until it is set, the form
 * shows its error message instead of sending.
 */

$to       = ''; // e.g. 'info@faribaultwebdesign.com'
$fromAddr = 'no-reply@faribaultwebdesign.com';

$allowedReturns = ['./', 'contact/'];
$return = in_array($_POST['_return'] ?? '', $allowedReturns, true) ? $_POST['_return'] : './';
function back($return, $ok) { header('Location: ' . $return . '?sent=' . ($ok ? '1' : '0')); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ./'); exit; }

// Honeypot: real visitors never fill this hidden field.
if (!empty($_POST['website_url'])) back($return, true);

function clean_line($v) { return trim(str_replace(["\r", "\n", "%0a", "%0d"], ' ', (string)$v)); }

$name    = clean_line($_POST['your-name'] ?? '');
$email   = clean_line($_POST['your-email'] ?? '');
$phone   = clean_line($_POST['your-phone'] ?? '');
$message = trim((string)($_POST['your-message'] ?? ''));

if ($to === '' || $name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) back($return, false);

$page = $return === './' ? 'Home' : rtrim($return, '/');
$body  = "New message from the website ({$page} page)\n\n";
$body .= "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n\nMessage:\n{$message}\n";
$body .= "\n--\nSent from faribaultwebdesign.com";

$headers  = "From: Faribault Web Design Website <{$fromAddr}>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$ok = mail($to, 'Website message from ' . $name, $body, $headers, '-f' . $fromAddr);
back($return, $ok);
