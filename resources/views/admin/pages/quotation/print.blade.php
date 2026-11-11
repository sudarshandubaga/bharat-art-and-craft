<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation {{ $quotation->quotation_no }} — Bharat Art &amp; Craft</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --fur-primary: #9a7b4f;
            --fur-primary-dark: #7a5f39;
            --fur-text: #24201c;
            --fur-text-muted: #6c6358;
            --fur-border: #ded6ca;
            --fur-bg-light: #faf7f2;
            --fur-font-serif: 'Playfair Display', Georgia, serif;
            --fur-font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--fur-font-sans);
            color: var(--fur-text);
            background: #e9e5de;
            line-height: 1.5;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Non-printable Action Toolbar */
        .print-toolbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #24201c;
            color: #ffffff;
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
        }

        .print-toolbar__info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .print-toolbar__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
        }

        .print-toolbar__btn--primary {
            background: var(--fur-primary);
            color: #ffffff;
        }
        .print-toolbar__btn--primary:hover {
            background: #b18f5f;
        }

        .print-toolbar__btn--secondary {
            background: rgba(255,255,255,0.12);
            color: #ffffff;
        }
        .print-toolbar__btn--secondary:hover {
            background: rgba(255,255,255,0.22);
        }

        /* Container & Page Wrapper for Screen View */
        .print-document-container {
            max-width: 1160px;
            margin: 32px auto 60px;
            background: transparent;
        }

        .print-page {
            background: #ffffff;
            width: 100%;
            min-height: 210mm;
            padding: 14mm 20mm 12mm;
            margin-bottom: 28px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            position: relative;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 4px;
        }

        /* Running Header & Footer for Product Pages */
        .print-running-header {
            position: absolute;
            top: 7mm;
            left: 20mm;
            right: 20mm;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--fur-border);
            padding-bottom: 5px;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--fur-text-muted);
        }

        .print-running-header strong {
            color: var(--fur-primary);
        }

        .print-running-footer {
            position: absolute;
            bottom: 6mm;
            left: 20mm;
            right: 20mm;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--fur-border);
            padding-top: 5px;
            font-size: 0.7rem;
            color: var(--fur-text-muted);
        }

        /* ==========================================================================
           PAGE 1: TITLE & COMPANY COVER PAGE (LUXURY LANDSCAPE)
           ========================================================================== */
        .cover-page {
            padding: 13mm 18mm 11mm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #fffdfa;
            border: 2px solid #24201c;
            box-shadow: 0 10px 35px rgba(0,0,0,0.15);
            position: relative;
        }

        /* Subtle inner decorative border for luxury catalog feel */
        .cover-page::after {
            content: '';
            position: absolute;
            top: 4mm;
            left: 4mm;
            right: 4mm;
            bottom: 4mm;
            border: 1px solid rgba(154, 123, 79, 0.4);
            pointer-events: none;
        }

        .cover-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #24201c;
            padding-bottom: 10px;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .cover-header-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .cover-brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: #ffffff;
            border: 2px solid #24201c;
            border-radius: 50%;
            padding: 6px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .cover-brand-logo img {
            max-height: 32px;
            max-width: 32px;
            object-fit: contain;
        }

        .cover-brand-name {
            font-family: var(--fur-font-serif);
            font-size: 1.95rem;
            font-weight: 700;
            color: #24201c;
            letter-spacing: 0.03em;
            margin: 0;
            line-height: 1.15;
        }

        .cover-brand-tagline {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: var(--fur-primary);
            font-weight: 700;
            margin-top: 3px;
        }

        .cover-header-ref {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 5px;
        }

        .cover-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px;
            border-radius: 4px;
            background: #24201c;
            border: 1px solid #9a7b4f;
            color: #e5c99e;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.14em;
        }

        .cover-ref-box {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #fbf9f6;
            border: 1.5px solid #24201c;
            padding: 6px 14px;
            border-radius: 4px;
            font-size: 0.78rem;
            color: #24201c;
        }

        .cover-ref-box strong {
            color: var(--fur-primary-dark);
            font-family: monospace;
            font-size: 0.95rem;
        }

        /* Landscape Main Grid (2 Columns) */
        .cover-main-grid {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 20px;
            align-items: stretch;
            flex: 1;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .cover-left-col {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cover-title-wrap {
            background: linear-gradient(135deg, #ffffff 0%, #fbf8f3 100%);
            border: 2px solid #24201c;
            border-radius: 6px;
            padding: 16px 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            position: relative;
        }

        .cover-title-wrap::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--fur-primary);
            border-radius: 4px 0 0 4px;
        }

        .cover-title-eyebrow {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: var(--fur-primary);
            font-weight: 700;
            display: block;
            margin-bottom: 4px;
        }

        .cover-title {
            font-family: var(--fur-font-serif);
            font-size: 1.65rem;
            font-weight: 700;
            color: #24201c;
            line-height: 1.25;
            margin: 0 0 6px;
        }

        .cover-title-desc {
            font-size: 0.78rem;
            color: #6c6358;
            line-height: 1.45;
            margin: 0;
        }

        /* Cover Summary Numbers in 2x2 Grid with Solid Dark Borders */
        .cover-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            background: #ffffff;
            border: 2px solid #24201c;
            border-radius: 6px;
            padding: 12px 14px;
            text-align: center;
        }

        .cover-stat-box {
            padding: 8px 6px;
            background: #fbf8f3;
            border-radius: 4px;
            border: 1px solid #24201c;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .cover-stat-label {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6c6358;
            display: block;
            margin-bottom: 2px;
            font-weight: 700;
        }

        .cover-stat-val {
            font-size: 1.12rem;
            font-weight: 700;
            color: #24201c;
        }

        .cover-stat-val--highlight {
            color: var(--fur-primary);
        }

        /* Right Column Parties with Solid Dark Borders */
        .cover-right-col {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cover-parties {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            height: 100%;
        }

        .party-card {
            background: #ffffff;
            border: 2px solid #24201c;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .party-card__header {
            background: #24201c;
            color: #e5c99e;
            padding: 4px 14px;
            font-size: 0.68rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.12em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .party-card__header--client {
            background: #9a7b4f;
            color: #ffffff;
        }

        .party-card__body {
            padding: 10px 14px;
            flex: 1;
        }

        .party-card__name {
            font-family: var(--fur-font-serif);
            font-size: 1.15rem;
            font-weight: 700;
            color: #24201c;
            margin-bottom: 3px;
        }

        .party-card__info {
            font-size: 0.77rem;
            color: #55504a;
            line-height: 1.45;
        }

        .party-card__info div {
            margin-bottom: 2px;
        }

        .cover-footer {
            border-top: 2px solid #24201c;
            padding-top: 8px;
            font-size: 0.72rem;
            color: #55504a;
            line-height: 1.4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .cover-footer-left {
            text-align: left;
            flex: 1;
        }

        .cover-footer-right {
            text-align: right;
            padding-left: 20px;
            white-space: nowrap;
            font-weight: 600;
            color: #24201c;
        }

        /* ==========================================================================
           MULTIPLE PRODUCT PAGES (1 PAGE FOR 1 PRODUCT - LANDSCAPE)
           ========================================================================== */
        .product-page {
            min-height: 210mm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 14mm 20mm 12mm;
        }

        .product-content {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 26px;
            align-items: center;
            flex: 1;
            padding: 3mm 0;
        }

        /* LEFT SIDE: MAIN IMAGE */
        .product-left {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .product-image-frame {
            width: 100%;
            height: 135mm;
            max-height: 135mm;
            border: 2px solid #24201c;
            border-radius: 8px;
            overflow: hidden;
            background: #fbf9f6;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
        }

        .product-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 4px;
            display: block;
        }

        .product-image-caption {
            font-size: 0.7rem;
            color: var(--fur-text-muted);
            margin-top: 6px;
            text-align: center;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* RIGHT SIDE: PRODUCT NAME & DETAILS IN TABLE */
        .product-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .product-tag {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--fur-primary);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-bottom: 2px;
            display: block;
        }

        .product-name {
            font-family: var(--fur-font-serif);
            font-size: 1.55rem;
            font-weight: 700;
            color: var(--fur-text);
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .product-code-badge {
            display: inline-block;
            background: var(--fur-bg-light);
            border: 1.5px solid #24201c;
            font-family: monospace;
            font-size: 0.75rem;
            font-weight: 700;
            color: #24201c;
            padding: 2px 8px;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        /* SPECIFICATION TABLE (REQUIRED FIELDS - SOLID DARK BORDER IN COLUMN) */
        .spec-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            background: #ffffff;
            border: 2px solid #24201c;
            border-radius: 4px;
            overflow: hidden;
        }

        .spec-table th,
        .spec-table td {
            padding: 6px 12px;
            font-size: 0.81rem;
            border-bottom: 1.5px solid #24201c;
            text-align: left;
        }

        .spec-table th {
            width: 36%;
            background: #f7f3ec;
            color: #24201c;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.05em;
            border-right: 2px solid #24201c; /* Solid dark column border */
        }

        .spec-table td {
            color: #24201c;
            font-weight: 600;
            background: #ffffff;
            border-left: 2px solid #24201c; /* Solid dark column border */
        }

        .spec-table tr:last-child th,
        .spec-table tr:last-child td {
            border-bottom: none;
        }

        .spec-table td.highlight-price {
            color: #7a5f39;
            font-size: 0.95rem;
            font-weight: 700;
        }

        .spec-table td.highlight-cbm {
            color: #2e7d32;
            font-weight: 700;
        }

        .product-notes {
            background: #fbf9f6;
            border: 1.5px solid #24201c;
            border-radius: 4px;
            padding: 6px 12px;
            font-size: 0.73rem;
            color: #55504a;
            line-height: 1.4;
        }

        .product-notes strong {
            color: #24201c;
            display: block;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.68rem;
        }

        /* ==========================================================================
           THANK YOU (LAST) PAGE STYLING (LANDSCAPE)
           ========================================================================== */
        .thankyou-page {
            min-height: 210mm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 14mm 20mm 12mm;
        }

        .thankyou-content {
            display: grid;
            grid-template-columns: 1fr 1.1fr;
            gap: 32px;
            align-items: center;
            flex: 1;
            padding: 5mm 0;
        }

        /* LEFT SIDE: THANK YOU */
        .thankyou-left {
            padding: 12px 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .thankyou-emblem {
            margin-bottom: 12px;
        }

        .thankyou-emblem img {
            height: 44px;
            width: auto;
            object-fit: contain;
        }

        .thankyou-eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--fur-primary);
            display: block;
            margin-bottom: 6px;
        }

        .thankyou-heading {
            font-family: var(--fur-font-serif);
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--fur-text);
            line-height: 1.05;
            margin: 0 0 10px;
            letter-spacing: -0.01em;
        }

        .thankyou-divider {
            width: 48px;
            height: 3px;
            background: var(--fur-primary);
            margin-bottom: 14px;
            border-radius: 2px;
        }

        .thankyou-message {
            font-size: 0.88rem;
            line-height: 1.6;
            color: var(--fur-text-muted);
            margin-bottom: 12px;
        }

        .thankyou-signature {
            font-family: var(--fur-font-serif);
            font-size: 0.95rem;
            font-style: italic;
            color: var(--fur-text);
            line-height: 1.45;
            border-left: 2px solid var(--fur-primary);
            padding-left: 12px;
            margin: 4px 0 0;
        }

        /* RIGHT SIDE: COMPANY NAME, CONTACT US, ADDRESS */
        .thankyou-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .thankyou-card {
            background: var(--fur-bg-light);
            border: 1px solid var(--fur-border);
            border-radius: 10px;
            padding: 20px 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            position: relative;
        }

        .thankyou-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 24px;
            right: 24px;
            height: 3px;
            background: linear-gradient(90deg, var(--fur-primary), var(--fur-primary-dark));
            border-radius: 3px 3px 0 0;
        }

        .thankyou-card-header {
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--fur-border);
        }

        .thankyou-card-tag {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: var(--fur-primary);
            font-weight: 700;
            display: block;
            margin-bottom: 2px;
        }

        .thankyou-company-title {
            font-family: var(--fur-font-serif);
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--fur-text);
            margin: 0;
            line-height: 1.2;
        }

        .thankyou-info-block {
            margin-bottom: 12px;
        }

        .thankyou-info-label {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--fur-primary-dark);
            font-weight: 700;
            display: block;
            margin-bottom: 6px;
        }

        .thankyou-contact-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 8px;
        }

        .thankyou-contact-row:last-child {
            margin-bottom: 0;
        }

        .thankyou-contact-row i {
            color: var(--fur-primary);
            font-size: 1rem;
            line-height: 1.3;
            flex-shrink: 0;
        }

        .thankyou-row-title {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--fur-text-muted);
            font-weight: 600;
            display: block;
            margin-bottom: 1px;
        }

        .thankyou-contact-link {
            color: var(--fur-text);
            font-weight: 600;
            font-size: 0.85rem;
            text-decoration: none;
            word-break: break-all;
        }

        .thankyou-address-text {
            color: var(--fur-text);
            font-weight: 600;
            font-size: 0.82rem;
            line-height: 1.4;
            margin: 0;
        }

        .thankyou-card-footer {
            margin-top: 14px;
            padding-top: 10px;
            border-top: 1px dashed var(--fur-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.72rem;
            color: var(--fur-text-muted);
            font-weight: 600;
        }

        /* ==========================================================================
           PRINT SPECIFIC STYLES & EXACT A4 LANDSCAPE PAGE BREAKS
           ========================================================================== */
        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .print-toolbar {
                display: none !important;
            }

            .print-document-container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .print-page {
                box-shadow: none !important;
                margin: 0 !important;
                width: 297mm !important;
                height: 210mm !important;
                max-height: 210mm !important;
                min-height: 210mm !important;
                padding: 13mm 18mm 11mm !important;
                page-break-after: always !important;
                break-after: page !important;
                position: relative !important;
                overflow: hidden !important;
                box-sizing: border-box !important;
            }

            /* Page 1 Cover page break */
            .cover-page {
                page-break-after: always !important;
                break-after: page !important;
            }

            /* Multiple Product Pages - 1 page for 1 product */
            .product-page {
                page-break-before: always !important;
                break-before: page !important;
                page-break-after: always !important;
                break-after: page !important;
                page-break-inside: avoid !important;
            }

            /* Last Page: Thank You */
            .thankyou-page {
                page-break-before: always !important;
                break-before: page !important;
                page-break-after: auto !important;
                break-after: auto !important;
                page-break-inside: avoid !important;
            }

            .thankyou-page:last-child {
                page-break-after: auto !important;
                break-after: auto !important;
            }

            .print-running-header {
                top: 6mm !important;
                left: 18mm !important;
                right: 18mm !important;
            }

            .print-running-footer {
                bottom: 5mm !important;
                left: 18mm !important;
                right: 18mm !important;
            }
        }

        @page {
            size: A4 landscape;
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Non-Printable Floating Toolbar -->
    <div class="print-toolbar no-print">
        <div class="print-toolbar__info">
            <span style="font-family: var(--fur-font-serif); font-size: 1.15rem; color: var(--fur-primary); font-weight: 700;">
                Bharat Art &amp; Craft
            </span>
            <span style="color: #888; font-size: 0.85rem;">|</span>
            <span style="font-size: 0.9rem; font-weight: 600;">
                Quotation {{ $quotation->quotation_no }} ({{ $quotation->items->count() }} Products)
            </span>
            <span style="background: rgba(154, 123, 79, 0.25); border: 1px solid rgba(154, 123, 79, 0.5); color: #e5c99e; font-size: 0.72rem; padding: 3px 9px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 600;">
                <i class="bi bi-aspect-ratio me-1"></i> A4 Landscape
            </span>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.quotation.show', $quotation->id) }}" class="print-toolbar__btn print-toolbar__btn--secondary">
                <i class="bi bi-arrow-left"></i> Return to Admin
            </a>
            <button type="button" onclick="window.print()" class="print-toolbar__btn print-toolbar__btn--primary">
                <i class="bi bi-printer-fill"></i> Print / Save Landscape PDF
            </button>
        </div>
    </div>

    <!-- MAIN PRINTABLE DOCUMENT CONTAINER (LANDSCAPE A4) -->
    <div class="print-document-container">

        <!-- ====================================================================
             PAGE 1: TITLE & COMPANY COVER PAGE (LANDSCAPE)
             ==================================================================== -->
        <section class="print-page cover-page" id="page-1">
            
            <!-- Top Cover Header: Landscape Brand & Proposal Box -->
            <header class="cover-header">
                <div class="cover-header-brand">
                    <div class="cover-brand-logo">
                        <img src="{{ asset('assets/img/logo-symbol.png') }}" alt="Bharat Art &amp; Craft Arch Emblem">
                    </div>
                    <div>
                        <h1 class="cover-brand-name">{{ $quotation->company_name ?? 'Bharat Art & Craft' }}</h1>
                        <div class="cover-brand-tagline">Master Solid Wood &amp; Architectural Furniture Atelier &bull; Jodhpur</div>
                    </div>
                </div>
                <div class="cover-header-ref">
                    <span class="cover-badge">Formal Export Proposal</span>
                    <div class="cover-ref-box">
                        <span>Quotation Ref: <strong>{{ $quotation->quotation_no }}</strong></span>
                        <span>&bull;</span>
                        <span>Date: <strong>{{ $quotation->date ? $quotation->date->format('d F Y') : date('d F Y') }}</strong></span>
                        <span>&bull;</span>
                        <span>Valid Until: <strong>{{ $quotation->valid_until ? $quotation->valid_until->format('d F Y') : '30 Days' }}</strong></span>
                    </div>
                </div>
            </header>

            <!-- Main Landscape Grid (2 Columns) -->
            <div class="cover-main-grid">
                
                <!-- Left Side: Title & Commercial Summary -->
                <div class="cover-left-col">
                    <div class="cover-title-wrap">
                        <span class="cover-title-eyebrow"><i class="bi bi-award-fill me-1"></i> Handcrafted Heritage Export Proposal</span>
                        <h2 class="cover-title">{{ $quotation->title ?? 'Bespoke Handcrafted Furniture Quotation' }}</h2>
                        <p class="cover-title-desc">
                            Bespoke architectural woodwork and solid timber collection, meticulously crafted with generational joinery techniques in Jodhpur for global delivery.
                        </p>
                    </div>

                    <!-- Commercial Summary Grid (2x2) with Solid Dark Borders -->
                    <div class="cover-stats">
                        <div class="cover-stat-box">
                            <span class="cover-stat-label"><i class="bi bi-grid-3x3-gap me-1"></i> Total Designs</span>
                            <div class="cover-stat-val">{{ $quotation->items->count() }} Models</div>
                        </div>
                        <div class="cover-stat-box">
                            <span class="cover-stat-label"><i class="bi bi-boxes me-1"></i> Total Quantity</span>
                            <div class="cover-stat-val">{{ $quotation->items->sum('moq') }} Pieces</div>
                        </div>
                        <div class="cover-stat-box">
                            <span class="cover-stat-label"><i class="bi bi-box-seam me-1"></i> Estimated Volume</span>
                            <div class="cover-stat-val cover-stat-val--highlight">{{ number_format((float)$quotation->total_cbm, 2) }} CBM</div>
                        </div>
                        <div class="cover-stat-box">
                            <span class="cover-stat-label"><i class="bi bi-currency-dollar me-1"></i> Quotation Value</span>
                            <div class="cover-stat-val" style="color: #2e7d32;">${{ number_format((float)$quotation->total_amount, 2) }} USD</div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Parties (Prepared By & Prepared For) -->
                <div class="cover-right-col">
                    <div class="cover-parties">
                        <!-- Prepared By (Company) -->
                        <div class="party-card">
                            <div class="party-card__header">
                                <span><i class="bi bi-shield-check me-1"></i> Manufacturer &amp; Exporter</span>
                                <span>Atelier Dossier</span>
                            </div>
                            <div class="party-card__body">
                                <div class="party-card__name">{{ $quotation->company_name ?? 'Bharat Art & Craft' }}</div>
                                <div class="party-card__info">
                                    <div><i class="bi bi-geo-alt me-1 text-primary"></i> {{ $quotation->company_address ?? 'Industrial Area, Phase II, Basni, Jodhpur, Rajasthan, India - 342005' }}</div>
                                    <div style="display: flex; gap: 14px; flex-wrap: wrap; margin-top: 2px;">
                                        <span><i class="bi bi-envelope me-1 text-primary"></i> {{ $quotation->company_email ?? 'exports@bharatartandcraft.com' }}</span>
                                        <span><i class="bi bi-telephone me-1 text-primary"></i> {{ $quotation->company_phone ?? '+91 98290 12345' }}</span>
                                    </div>
                                    <div style="margin-top: 2px;"><i class="bi bi-globe me-1 text-primary"></i> www.bharatartandcraft.com</div>
                                </div>
                            </div>
                        </div>

                        <!-- Prepared For (Client) -->
                        <div class="party-card">
                            <div class="party-card__header party-card__header--client">
                                <span><i class="bi bi-person-badge me-1"></i> Prepared Exclusively For</span>
                                <span>Client Dossier</span>
                            </div>
                            <div class="party-card__body">
                                <div class="party-card__name">{{ $quotation->customer_name }}</div>
                                <div class="party-card__info">
                                    @if($quotation->customer_company)
                                        <div class="fw-bold text-dark"><i class="bi bi-building me-1"></i> {{ $quotation->customer_company }}</div>
                                    @endif
                                    <div><i class="bi bi-envelope me-1"></i> {{ $quotation->customer_email }}</div>
                                    @if($quotation->customer_phone)
                                        <div><i class="bi bi-telephone me-1"></i> {{ $quotation->customer_phone }}</div>
                                    @endif
                                    @if($quotation->customer_address)
                                        <div><i class="bi bi-geo-alt me-1"></i> {{ $quotation->customer_address }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Commercial Terms Overview & Timber Warranty Footer -->
            <footer class="cover-footer">
                <div class="cover-footer-left">
                    <span>🪵 <strong>Timber Integrity Guarantee:</strong> 100% seasoned, kiln-dried solid timber (moisture 8-12%). Free from MDF, particleboard, or synthetic cores. Mortise &amp; tenon joinery handcrafted in Jodhpur, India.</span>
                </div>
                <div class="cover-footer-right">
                    @if($quotation->terms)
                        <span><strong>Commercial Terms:</strong> {{ $quotation->terms }}</span>
                    @else
                        <span><strong>Port:</strong> FOB Mundra / Nhava Sheva</span>
                    @endif
                </div>
            </footer>

        </section>

        <!-- ====================================================================
             MULTIPLE PRODUCT PAGES (1 PAGE FOR 1 PRODUCT)
             ==================================================================== -->
        @php
            $totalPages = $quotation->items->count() + 2;
        @endphp

        @foreach($quotation->items as $index => $item)
            @php
                $itemPageNum = $index + 2;
                $linePrice = $item->moq * (float)$item->price_usd;
                $lineCbm = $item->moq * (float)$item->cbm;
            @endphp
            <section class="print-page product-page" id="page-product-{{ $index + 1 }}">
                
                <!-- Running Header -->
                <div class="print-running-header">
                    <span>{{ $quotation->company_name ?? 'Bharat Art & Craft' }} &bull; Quotation Ref: <strong>{{ $quotation->quotation_no }}</strong></span>
                    <span>Piece {{ $index + 1 }} of {{ $quotation->items->count() }}</span>
                </div>

                <!-- Product 2-Column Content -->
                <div class="product-content">
                    
                    <!-- LEFT SIDE: MAIN IMAGE -->
                    <div class="product-left">
                        <div class="product-image-frame">
                            <img src="{{ $item->image_url }}" alt="{{ $item->product_name }}" loading="eager">
                        </div>
                        <div class="product-image-caption">
                            {{ $item->product_code ? "Product Code: {$item->product_code}" : "Handcrafted Atelier Design" }}
                        </div>
                    </div>

                    <!-- RIGHT SIDE: PRODUCT NAME & DETAILS IN TABLE -->
                    <div class="product-right">
                        <span class="product-tag">Design Selection {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h2 class="product-name">{{ $item->product_name }}</h2>
                        
                        @if($item->product_code)
                            <div>
                                <span class="product-code-badge">SKU: {{ $item->product_code }}</span>
                            </div>
                        @endif

                        <!-- DETAILS TABLE (REQUIRED SPECIFICATIONS) -->
                        <table class="spec-table">
                            <tbody>
                                <!-- 1. Material -->
                                <tr>
                                    <th>Material</th>
                                    <td>{{ $item->material ?: ($item->product?->wood?->name ?? 'Solid Hardwood') }}</td>
                                </tr>

                                <!-- 2. Dimension CMS -->
                                <tr>
                                    <th>Dimension CMS</th>
                                    <td>{{ $item->dimension ?: ($item->product?->dimension ?? 'Custom Dimension on Request') }}</td>
                                </tr>

                                <!-- 3. Finish -->
                                <tr>
                                    <th>Finish</th>
                                    <td>{{ $item->finish ?: ($item->product?->finish?->name ?? 'Natural Hand-Rubbed Wax') }}</td>
                                </tr>

                                <!-- 4. MOQ -->
                                <tr>
                                    <th>MOQ</th>
                                    <td><strong>{{ $item->moq }} pcs</strong></td>
                                </tr>

                                <!-- 5. Price USD -->
                                <tr>
                                    <th>Price USD</th>
                                    <td class="highlight-price">${{ number_format((float)$item->price_usd, 2) }} / pc</td>
                                </tr>

                                <!-- 6. CBM -->
                                <tr>
                                    <th>CBM (Unit)</th>
                                    <td class="highlight-cbm">{{ number_format((float)$item->cbm, 3) }} m³</td>
                                </tr>

                                <!-- 7. Loadability -->
                                <tr>
                                    <th>Loadability</th>
                                    <td>{{ $item->loadability ?: '68 m³ / 40\' HC' }}</td>
                                </tr>

                                <!-- Line Summary Calculation -->
                                <tr>
                                    <th>Total Line Value</th>
                                    <td style="font-weight: 700; color: var(--fur-text);">
                                        ${{ number_format($linePrice, 2) }} USD 
                                        <span style="font-size: 0.76rem; font-weight: normal; color: var(--fur-text-muted);">
                                            ({{ number_format($lineCbm, 2) }} CBM total)
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Additional Specifications or Notes -->
                        <div class="product-notes">
                            <strong>Craftsmanship &amp; Packaging Notes:</strong>
                            {{ $item->notes ?: 'Full mortise and tenon joinery. High-density foam corner protection, sealed poly wrapping, and corrugated export carton packaging.' }}
                        </div>

                    </div>

                </div>

                <!-- Running Footer -->
                <div class="print-running-footer">
                    <span>{{ $quotation->company_name ?? 'Bharat Art & Craft' }} &bull; Industrial Area, Jodhpur &bull; {{ $quotation->company_email ?? 'exports@bharatartandcraft.com' }}</span>
                    <span>Page {{ $itemPageNum }} of {{ $totalPages }}</span>
                </div>

            </section>
        @endforeach

        <!-- ====================================================================
             LAST PAGE: THANK YOU PAGE
             - Left side: Thank You
             - Right side:
               > Company Name
               > Contact Us (Email, Phone No.)
               > Address
             ==================================================================== -->
        <section class="print-page thankyou-page" id="page-thankyou">
            
            <!-- Running Header -->
            <div class="print-running-header">
                <span>{{ $quotation->company_name ?? 'Bharat Art & Craft' }} &bull; Quotation Ref: <strong>{{ $quotation->quotation_no }}</strong></span>
                <span>Conclusion</span>
            </div>

            <!-- 2-Column Thank You Content -->
            <div class="thankyou-content">
                
                <!-- LEFT SIDE: THANK YOU -->
                <div class="thankyou-left">
                    <div class="thankyou-emblem">
                        <img src="{{ asset('assets/img/logo-symbol.png') }}" alt="{{ $quotation->company_name ?? 'Bharat Art & Craft' }}" onerror="this.style.display='none'">
                    </div>
                    <span class="thankyou-eyebrow">With Sincere Gratitude</span>
                    <h2 class="thankyou-heading">Thank You</h2>
                    <div class="thankyou-divider"></div>
                    <p class="thankyou-message">
                        We appreciate the opportunity to present our handcrafted woodwork and architectural furniture collections. Every piece reflects generations of artistry, sustainable timber sourcing, and master joinery from Jodhpur, Rajasthan.
                    </p>
                    <p class="thankyou-signature">
                        We look forward to handcrafting your bespoke heirloom collection.
                    </p>
                </div>

                <!-- RIGHT SIDE: COMPANY NAME, CONTACT US, ADDRESS -->
                <div class="thankyou-right">
                    <div class="thankyou-card">
                        
                        <!-- 1. Company Name -->
                        <div class="thankyou-card-header">
                            <span class="thankyou-card-tag">Exporters &amp; Manufacturers</span>
                            <h3 class="thankyou-company-title">{{ $quotation->company_name ?? 'Bharat Art & Craft' }}</h3>
                        </div>

                        <!-- 2. Contact Us (Email, Phone No.) -->
                        <div class="thankyou-info-block">
                            <span class="thankyou-info-label">Contact Us</span>
                            <div class="thankyou-contact-row">
                                <i class="bi bi-envelope-fill"></i>
                                <div>
                                    <span class="thankyou-row-title">Email</span>
                                    <a href="mailto:{{ $quotation->company_email ?? 'exports@bharatartandcraft.com' }}" class="thankyou-contact-link">
                                        {{ $quotation->company_email ?? 'exports@bharatartandcraft.com' }}
                                    </a>
                                </div>
                            </div>
                            <div class="thankyou-contact-row">
                                <i class="bi bi-telephone-fill"></i>
                                <div>
                                    <span class="thankyou-row-title">Phone No.</span>
                                    <a href="tel:{{ $quotation->company_phone ?? '+91 98290 12345' }}" class="thankyou-contact-link">
                                        {{ $quotation->company_phone ?? '+91 98290 12345' }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Address -->
                        <div class="thankyou-info-block" style="margin-bottom: 0;">
                            <span class="thankyou-info-label">Address</span>
                            <div class="thankyou-contact-row">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div>
                                    <span class="thankyou-row-title">Atelier &amp; Works</span>
                                    <p class="thankyou-address-text">
                                        {{ $quotation->company_address ?? 'Industrial Area, Phase II, Basni, Jodhpur, Rajasthan, India - 342005' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="thankyou-card-footer">
                            <span><i class="bi bi-globe me-1"></i> www.bharatartandcraft.com</span>
                            <span><i class="bi bi-shield-check me-1"></i> Certified Solid Wood Exporter</span>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Running Footer -->
            <div class="print-running-footer">
                <span>{{ $quotation->company_name ?? 'Bharat Art & Craft' }} &bull; Industrial Area, Jodhpur &bull; {{ $quotation->company_email ?? 'exports@bharatartandcraft.com' }}</span>
                <span>Page {{ $totalPages }} of {{ $totalPages }}</span>
            </div>

        </section>

    </div>

</body>
</html>
