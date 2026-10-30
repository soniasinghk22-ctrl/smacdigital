<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seo['title'] ?? 'Best Performing Digital Marketing Agency in India | SMAC Digital' }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Smac Digital is a top-performing digital marketing agency in India that works with a performance-driven approach through experienced marketers. Get quotes for customized SEO, Social Media, and Online ADS proposal for your brand now.' }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? 'Best Digital Marketing Agency in India, Social Media Marketing in India, SMAC Digital' }}">
    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $seo['title'] ?? 'Best Performing Digital Marketing Agency in India | SMAC Digital' }}">
    <meta property="og:description" content="{{ $seo['description'] ?? 'Smac Digital is a top-performing digital marketing agency in India that works with a performance-driven approach through experienced marketers.' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="SMAC Digital">
    <meta property="og:locale" content="en-IN">
    <meta property="og:image" content="{{ asset('assets/brand/logo-white.png') }}">

    <link rel="icon" href="{{ asset('assets/brand/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Inter:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "ProfessionalService",
      "name": "SMAC Digital",
      "url": "{{ url('/') }}",
      "image": "{{ asset('assets/brand/logo-white.png') }}",
      "description": "Performance-driven digital marketing agency. SMAC stands for Social, Mobile, Analytics, and Cloud.",
      "email": "Jitendra@smacdigital.com",
      "telephone": "+91-9829069519",
      "areaServed": "IN",
      "sameAs": [
        "https://www.facebook.com/smacdigi",
        "https://www.linkedin.com/company/smac-digital-pvt-ltd",
        "https://twitter.com/DigitalSmac",
        "https://www.instagram.com/smacdigital/"
      ],
      "address": [
        {
          "@@type": "PostalAddress",
          "streetAddress": "Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar",
          "addressLocality": "Jaipur",
          "addressRegion": "Rajasthan",
          "postalCode": "302020",
          "addressCountry": "IN"
        },
        {
          "@@type": "PostalAddress",
          "streetAddress": "Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur",
          "addressLocality": "Kolkata",
          "postalCode": "700099",
          "addressCountry": "IN"
        }
      ]
    }
    </script>

    @viteReactRefresh
    @vite(['resources/css/style.css', 'resources/js/main.jsx'])
</head>
<body id="top">
    <div id="react-root"></div>

    <noscript>
        <div style="padding: 2rem; text-align: center; font-family: sans-serif;">
            <h2>JavaScript Required</h2>
            <p>Please enable JavaScript to view the SMAC Digital website.</p>
        </div>
    </noscript>
</body>
</html>
