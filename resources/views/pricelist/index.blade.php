@extends('layouts.app')

@section('title', 'Italian Marble Price List in India 2026 | Stone Hub India')
@section('meta_description', 'Detailed Italian marble price list in India from Stone Hub India, Kishangarh. Compare 90+ imported marble varieties with prices from ₹150* to ₹400* per square foot.')
@section('meta_keywords', 'italian marble price list, italian marble price in india, marble price per square foot, imported marble kishangarh, stone hub india pricelist')

@section('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@type' }}": "WebPage",
  "name": "Italian Marble Price List in India 2026",
  "url": "{{ route('pricelist') }}",
  "description": "Detailed Italian marble price list with varieties and rates per square foot from Stone Hub India."
}
</script>
@endsection

@section('styles')
<style>
    .pricelist-page { background: #f4f2ed; }
    .pricelist-intro,
    .pricelist-table-wrap,
    .pricelist-faq {
        padding: 3.5rem 0;
    }
    .pricelist-intro { padding-top: 3rem; }
    .pricelist-intro h2,
    .pricelist-table-wrap h2,
    .pricelist-faq h2 {
        font-family: 'Outfit', sans-serif !important;
        font-weight: 750 !important;
        color: #121214 !important;
        font-size: clamp(1.55rem, 2.4vw, 2rem) !important;
        margin: 0 0 1rem !important;
        letter-spacing: -0.02em;
    }
    .pricelist-intro p,
    .pricelist-table-wrap > .container > p,
    .pricelist-variations p {
        color: #4a4a52 !important;
        font-size: 1.02rem;
        line-height: 1.75;
        margin: 0 0 1rem;
        max-width: 920px;
    }
    .pricelist-intro strong { color: #1a1a1e; }
    .price-table-card {
        background: #fff;
        border: 1px solid rgba(15,15,17,0.07);
        border-radius: 18px;
        box-shadow: 0 12px 32px rgba(15,15,17,0.05);
        overflow: hidden;
        margin-top: 1.5rem;
    }
    .price-table-scroll { overflow-x: auto; }
    .price-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 720px;
    }
    .price-table thead th {
        background: #16161a;
        color: #fff !important;
        font-family: 'Outfit', sans-serif;
        font-weight: 650;
        font-size: 0.88rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        padding: 1rem 1.1rem;
        text-align: left;
        white-space: nowrap;
    }
    .price-table tbody td {
        padding: 0.95rem 1.1rem;
        border-bottom: 1px solid rgba(15,15,17,0.07);
        vertical-align: middle;
        color: #2a2a30 !important;
        background: #fff;
    }
    .price-table tbody tr:nth-child(even) td { background: #faf9f7; }
    .price-table tbody tr:hover td { background: #f3efe8; }
    .price-table .col-no {
        width: 70px;
        text-align: center;
        font-weight: 650;
        color: #8a8a96 !important;
    }
    .price-table .marble-name {
        color: #b0782f !important;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        font-family: 'Outfit', sans-serif;
    }
    .price-table .marble-name:hover { color: #8a6d3b !important; text-decoration: underline; }
    .price-thumb {
        width: 92px;
        height: 72px;
        object-fit: cover;
        border-radius: 10px;
        display: block;
        background: #ebe8e2;
    }
    .price-value {
        font-weight: 700;
        color: #1c1c20 !important;
        white-space: nowrap;
    }
    .price-note {
        margin-top: 1rem;
        font-size: 0.88rem;
        color: #6f6f78 !important;
    }
    .pricelist-faq { background: #fff; border-top: 1px solid rgba(15,15,17,0.05); }
    .faq-grid { display: grid; gap: 1rem; max-width: 900px; }
    .faq-card {
        background: #f7f6f3;
        border: 1px solid rgba(15,15,17,0.06);
        border-radius: 14px;
        padding: 1.2rem 1.35rem;
    }
    .faq-card h3 {
        margin: 0 0 0.5rem !important;
        font-size: 1.05rem !important;
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-weight: 700 !important;
    }
    .faq-card p {
        margin: 0;
        color: #5f5f68 !important;
        line-height: 1.65;
        font-size: 0.95rem;
    }
    .pricelist-cta {
        margin-top: 2rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.85rem;
        align-items: center;
    }
    .pricelist-cta .btn {
        border-radius: 12px;
        font-weight: 700;
        padding: 0.85rem 1.35rem;
    }
    @media (max-width: 640px) {
        .price-thumb { width: 72px; height: 56px; }
        .pricelist-intro, .pricelist-table-wrap, .pricelist-faq { padding: 2.5rem 0; }
    }
</style>
@endsection

@section('content')
<div class="pricelist-page">
    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ asset('assets/images/pages/hero-collections.webp') }}" alt="Italian marble price list" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">STONE HUB INDIA</span>
            <h1>Marble Price List</h1>
            <p>Transparent Italian marble rates per square foot for 90+ premium varieties curated in Kishangarh.</p>
        </div>
    </section>

    <div class="product-breadcrumb-bar">
        <div class="container">
            <nav class="product-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span style="margin: 0 8px;">/</span>
                <span style="color: #8a6d3b;">Italian Marble Price List</span>
            </nav>
        </div>
    </div>

    <section class="pricelist-intro">
        <div class="container">
            <h2>Italian Marble Price in India</h2>
            <p><strong>Italian marble</strong> is a symbol of luxury, elegance, and quality, known worldwide for its exquisite veining and timeless appeal. At Stone Hub India, we bring you a curated selection of premium Italian marble suitable for every space, whether it’s a high-end residential project or a sophisticated commercial interior. This guide provides a complete overview of <strong>Italian marble prices in India</strong>, types, benefits, and care, helping you make an informed choice for your project.</p>
            <p>Adding Italian marble to your interiors instantly elevates the aesthetics, bringing a sense of grandeur and elegance. With our diverse range of <strong>Italian marble prices per square foot</strong>, we cater to various budgets and preferences, allowing you to explore this luxurious material without compromising on quality.</p>
            <p>Italian marble is available in different colors and styles, making it adaptable to various design aesthetics. From soft, classic whites to bold blacks and beiges, Stone Hub India’s collection is designed to suit every interior vision. Italian marble prices can vary depending on the type, finish, and thickness, offering options for both economical and luxurious preferences.</p>
            <p>The cost of Italian marble per square foot in India depends on factors like the rarity of the marble, its source, and the quality of finish. Stone Hub India’s pricing structure ensures you get top value for high-quality marble sourced from renowned Italian quarries.</p>
        </div>
    </section>

    <section class="pricelist-table-wrap" id="price-table">
        <div class="container">
            <h2>Italian Marble Price List</h2>
            <p>Here’s a detailed Italian marble price list at Stone Hub India, displaying different varieties and their respective pricing:</p>

            <div class="price-table-card">
                <div class="price-table-scroll">
                    <table class="price-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No</th>
                                <th scope="col">Name Of Italian Marbles</th>
                                <th scope="col">Images Of Italian Marbles</th>
                                <th scope="col">Italian Marble Prices</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $row)
                                <tr>
                                    <td class="col-no">{{ $row['no'] }}</td>
                                    <td>
                                        <a class="marble-name" href="{{ route('imported-marble.show', $row['slug']) }}">{{ $row['name'] }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('imported-marble.show', $row['slug']) }}">
                                            <img class="price-thumb" src="{{ site_image($row['image']) }}" alt="{{ $row['name'] }}" loading="lazy" width="92" height="72">
                                        </a>
                                    </td>
                                    <td class="price-value">{{ $row['price'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="price-note">*Prices are indicative and may vary based on block selection, finish, thickness, and current stock. Contact our Kishangarh yard for a live quotation.</p>
        </div>
    </section>

    <section class="pricelist-intro pricelist-variations" style="padding-top: 0;">
        <div class="container">
            <h2>Italian Marbles Prices and Its Variations</h2>
            <p>Here you can find the Italian Marble prices and variations of Italian marbles. We offer a wide range of options to suit your needs and preferences. Whether you're looking for classic or unique variations, we have something for everyone.</p>
            <div class="pricelist-cta">
                <a href="{{ route('contact') }}" class="btn btn-primary">Request Latest Quote</a>
                <a href="https://wa.me/{{ $site['whatsapp_number'] ?? '919672777749' }}?text={{ urlencode('Hi Stone Hub India, I want the latest Italian marble price list.') }}" class="btn" style="background:#fff;border:1px solid rgba(15,15,17,0.12);color:#151518;" target="_blank" rel="noopener">WhatsApp Curator</a>
            </div>
        </div>
    </section>

    <section class="pricelist-faq">
        <div class="container">
            <h2>Frequently Asked Questions (FAQs)</h2>
            <div class="faq-grid" style="margin-top: 1.5rem;">
                <div class="faq-card">
                    <h3>How much does Italian marble cost Per Square Feet?</h3>
                    <p>The cost of Italian marble per square feet varies greatly depending on the type and quality of the marble. On Stone Hub India, the prices range from ₹150 to ₹400 per square foot.</p>
                </div>
                <div class="faq-card">
                    <h3>Which marble is costlier?</h3>
                    <p>Among the different types of Italian marble listed on Stone Hub India, Grey Laurent Marble is among the most expensive varieties in the published list, priced at ₹400 per square foot.</p>
                </div>
                <div class="faq-card">
                    <h3>What factors influence the price of Italian marble on Stone Hub India?</h3>
                    <p>The price of Italian marble on Stone Hub India is influenced by factors such as the type of marble, its quality, color, texture, and availability.</p>
                </div>
                <div class="faq-card">
                    <h3>How can I purchase Italian marble from Stone Hub India?</h3>
                    <p>You can purchase Italian marble from Stone Hub India by contacting us via the contact form or via WhatsApp for bookmatch photos and live block rates.</p>
                </div>
                <div class="faq-card">
                    <h3>Is Italian marble costly?</h3>
                    <p>Yes, Italian marble is generally more expensive than other types of marble due to its high quality, rarity, and luxurious appeal. At Stone Hub India, prices start around ₹150 per sq. ft. and can reach higher depending on the specific variety.</p>
                </div>
                <div class="faq-card">
                    <h3>What is special about Italian marble?</h3>
                    <p>Italian marble is known for its dense structure, unique veining patterns, and high-quality finish, making it a premium choice for luxurious interiors. It adds lasting beauty and value to any space and is highly valued in both residential and commercial projects.</p>
                </div>
                <div class="faq-card">
                    <h3>What is the price of 1 sq ft of Italian marble in India?</h3>
                    <p>In India, the cost of Italian marble per square foot typically ranges from ₹150 to ₹2,500, depending on factors like marble type, quality, and finish. Stone Hub India provides a detailed price list to help you find the best fit for your budget.</p>
                </div>
                <div class="faq-card">
                    <h3>What are the disadvantages of Italian marble?</h3>
                    <p>While Italian marble is exceptionally beautiful, it is more porous than some other stones, making it susceptible to stains. Regular sealing and maintenance are recommended to keep it looking pristine over time.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
