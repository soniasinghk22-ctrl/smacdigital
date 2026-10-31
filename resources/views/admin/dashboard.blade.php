@php
    $currentUser = Auth::user();
    $isSuper = $currentUser->role === 'superadmin';
    $userPerms = is_array($currentUser->permissions) ? $currentUser->permissions : (json_decode($currentUser->permissions ?? '[]', true) ?: []);
    $hasAccess = function($tab) use ($isSuper, $userPerms) {
        return $isSuper || in_array('all', $userPerms) || in_array($tab, $userPerms);
    };
    $modules = [
        'general' => 'General Settings',
        'leads' => 'Leads Manager',
        'livechat' => 'Live Chat Support',
        'branding' => 'Branding & Logos',
        'slider' => 'Homepage Slider',
        'testimonials' => 'Testimonials',
        'styling' => 'Section Backgrounds',
        'pagecontents' => 'Page Editor',
        'landing' => 'AI Landing Pages',
        'collections' => 'Collections Manager',
        'categories' => 'Categories Manager',
        'marbles' => 'Marbles Manager',
        'locations' => 'Locations Manager',
        'specialists' => 'Specialists Manager',
        'cms_pages' => 'CMS Pages Manager',
        'blogs' => 'Blog Manager',
        'media' => 'Media Manager',
        'seo' => 'SEO Optimizer',
        'analytics' => 'Analytics Dashboard'
    ];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Admin Dashboard | {{ $site['site_name'] ?? 'SumitZ Clinic' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Outfit Font -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --admin-sidebar-w: 260px;
            --admin-dark-bg: #0b1e36;
            --admin-dark-sidebar: #071526;
            --admin-border: rgba(255,255,255,0.08);
            --admin-text-muted: rgba(255,255,255,0.5);
            --admin-input-bg: rgba(255,255,255,0.04);
        }
        
        body {
            background-color: var(--admin-dark-bg);
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            max-height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--admin-sidebar-w);
            background-color: var(--admin-dark-sidebar);
            border-right: 1px solid var(--admin-border);
            display: flex;
            flex-direction: column;
            padding: 1.5rem 0;
            flex-shrink: 0;
            height: 100vh;
            max-height: 100vh;
            min-height: 0;
            overflow-y: auto !important;
            overflow-x: hidden;
            overscroll-behavior-y: contain;
            -webkit-overflow-scrolling: touch;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), padding 0.3s ease, border-color 0.3s ease;
        }

        .sidebar-brand {
            padding: 0 1.5rem;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand svg {
            width: 36px;
            height: 36px;
        }

        .sidebar-brand span {
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .menu-item button, .menu-item a {
            width: 100%;
            background: none;
            border: none;
            color: var(--admin-text-muted);
            padding: 1rem 1.5rem;
            text-align: left;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            text-decoration: none;
            box-sizing: border-box;
        }

        .menu-item button:hover, .menu-item button.active, .menu-item a:hover, .menu-item a.active {
            color: var(--mint-green);
            background-color: rgba(92, 203, 179, 0.05);
            border-left-color: var(--mint-green);
        }

        .sidebar-footer {
            padding: 0 1.5rem;
        }

        .btn-logout {
            width: 100%;
            background-color: rgba(232, 92, 36, 0.1);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.2);
            padding: 0.75rem;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: rgba(255, 107, 107, 0.2);
        }

        /* Main Content Panel */
        .main-panel {
            flex: 1 1 0%;
            height: 100vh;
            max-height: 100vh;
            min-height: 0;
            min-width: 0;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        .admin-header {
            height: 70px;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            flex-shrink: 0;
            flex-grow: 0;
        }

        .admin-header h1 {
            font-size: 1.5rem;
            margin: 0;
            font-weight: 600;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .admin-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary-teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .admin-content {
            padding: 2rem;
            flex: 1 1 0%;
            min-height: 0;
            height: calc(100vh - 70px);
            max-height: calc(100vh - 70px);
            overflow-y: auto !important;
            overflow-x: hidden;
            overscroll-behavior-y: contain;
            -webkit-overflow-scrolling: touch;
        }
        .admin-content:focus {
            outline: none;
        }

        /* Tab Content Panel */
        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Cards & Forms */
        .admin-card {
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--admin-border);
            border-radius: var(--radius-lg);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .admin-card h2 {
            font-size: 1.25rem;
            margin-top: 0;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--admin-border);
            padding-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.7);
            font-weight: 500;
        }

        .form-control {
            background-color: var(--admin-input-bg);
            border: 1px solid var(--admin-border);
            color: #ffffff;
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: var(--radius-md);
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--mint-green);
            background-color: rgba(255,255,255,0.06);
        }

        select.form-control {
            background-color: #0b1e36;
            color: #ffffff;
            cursor: pointer;
        }

        select.form-control option,
        select option {
            background-color: #0b1e36 !important;
            color: #ffffff !important;
            padding: 9px 14px;
        }

        select.form-control option:checked,
        select.form-control option:hover,
        select.form-control option:focus {
            background-color: #0f766e !important;
            color: #ffffff !important;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .btn-submit {
            background-color: var(--mint-green);
            color: var(--primary-teal-dark);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            cursor: pointer;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #4ebfa7;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(92, 203, 179, 0.3);
        }

        /* Tables & Action Styles */
        .admin-table-wrap {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid var(--admin-border);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        .admin-table th {
            background-color: rgba(255,255,255,0.03);
            padding: 1rem;
            border-bottom: 1px solid var(--admin-border);
            font-weight: 600;
            color: var(--mint-green);
        }

        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--admin-border);
            vertical-align: middle;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-action.edit {
            color: #5ccbb3;
            background-color: rgba(92, 203, 179, 0.1);
        }

        .btn-action.edit:hover {
            background-color: rgba(92, 203, 179, 0.25);
        }

        .btn-action.delete {
            color: #ff6b6b;
            background-color: rgba(255, 107, 107, 0.1);
        }

        .btn-action.delete:hover {
            background-color: rgba(255, 107, 107, 0.25);
        }

        /* Success Banner */
        .alert-success {
            background-color: rgba(92, 203, 179, 0.1);
            border: 1px solid rgba(92, 203, 179, 0.3);
            color: var(--mint-green);
            padding: 1rem 1.5rem;
            border-radius: var(--radius-md);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Image upload helpers */
        .image-preview-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 5px;
        }

        .image-preview {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            border: 1px solid var(--admin-border);
            background-color: rgba(255,255,255,0.02);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-webp {
            font-size: 0.75rem;
            background-color: var(--primary-teal);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
        }
        .badge {
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
            display: inline-block;
        }

        /* Force all headings and instructions in backend to be white/visible */
        h1, h2, h3, h4, h5, h6,
        .admin-header h1, .sidebar-brand span, 
        .admin-card h2, .admin-card h3, .admin-card h4,
        .admin-content h1, .admin-content h2, .admin-content h3, .admin-content h4, .admin-content h5, .admin-content h6,
        #service-form-title-text, #blog-form-title-text {
            color: #ffffff !important;
        }
        
        .admin-content p:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-content span:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-content label:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-content li:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-content small:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-content legend:not(.ck-editor *):not(.badge):not(.badge *),
        .admin-card p:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-card span:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-card label:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-card li:not(.ck-editor *):not(.badge):not(.badge *), 
        .admin-card small:not(.ck-editor *):not(.badge):not(.badge *),
        .admin-table td:not(.badge):not(.badge *), 
        .admin-table th,
        .admin-table strong:not(.badge):not(.badge *) {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .admin-content code, .admin-card code {
            color: #5ccbb3 !important;
            background-color: rgba(92, 203, 179, 0.1) !important;
            padding: 2px 6px !important;
            border-radius: 4px !important;
        }

        .admin-table td, .admin-table th {
            color: #ffffff !important;
        }

        .admin-table th {
            color: var(--mint-green) !important;
        }

        .admin-table small, .admin-table td small {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .admin-card a {
            color: var(--mint-green) !important;
        }
        .admin-card a:hover {
            color: #4ebfa7 !important;
        }

        /* Toast Notification Styles */
        .ai-toast {
            background-color: #0d1718;
            border: 1px solid rgba(168, 85, 247, 0.3);
            box-shadow: 0 4px 20px rgba(168, 85, 247, 0.2);
            border-radius: var(--radius-md);
            color: #ffffff;
            padding: 1rem;
            width: 320px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: toastSlideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        @keyframes toastSlideIn {
            from { transform: translateX(120%) translateY(20px); opacity: 0; }
            to { transform: translateX(0) translateY(0); opacity: 1; }
        }
        .ai-toast-close {
            position: absolute;
            top: 8px;
            right: 8px;
            background: none;
            border: none;
            color: var(--admin-text-muted);
            cursor: pointer;
            font-size: 1.1rem;
            line-height: 1;
        }
        .ai-toast-close:hover {
            color: #ff6b6b;
        }
        .ai-toast-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top-color: #a855f7;
            border-bottom-color: #6366f1;
            border-radius: 50%;
            animation: aiSpin 1s linear infinite;
            flex-shrink: 0;
            margin-top: 3px;
        }
        .ai-toast-success-icon {
            color: var(--mint-green);
            flex-shrink: 0;
            margin-top: 3px;
            display: flex;
            align-items: center;
        }
        .ai-toast-error-icon {
            color: #ff6b6b;
            flex-shrink: 0;
            margin-top: 3px;
            display: flex;
            align-items: center;
        }
        .ai-toast-content {
            flex-grow: 1;
            padding-right: 15px;
        }
        .ai-toast-title {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 2px;
            color: #ffffff !important;
        }
        .ai-toast-message {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.7) !important;
            margin: 0;
            line-height: 1.4;
        }

        /* Keep CKEditor text dark so users can see what they type in the editor box! */
        .ck-editor__editable, .ck-editor__editable * {
            color: #111111 !important;
        }

        /* AI Generator styles */
        .btn-ai-sparkle {
            background: linear-gradient(135deg, #a855f7, #6366f1) !important;
            color: #ffffff !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
            border-radius: var(--radius-md) !important;
            font-weight: 600 !important;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.2);
        }
        .btn-ai-sparkle:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(168, 85, 247, 0.4);
            filter: brightness(1.1);
        }
        .ai-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.82);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999999 !important;
            opacity: 0;
            transition: opacity 0.25s ease;
            overflow-y: auto;
            padding: 2rem 1rem;
            box-sizing: border-box;
        }
        .ai-modal-overlay.show {
            display: flex !important;
            opacity: 1 !important;
        }
        .ai-modal-card {
            background-color: #111827;
            border: 1px solid rgba(92, 203, 179, 0.35);
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.9), 0 0 35px rgba(92, 203, 179, 0.15);
            border-radius: var(--radius-lg);
            width: 95%;
            max-width: 580px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            animation: aiSlideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            margin: auto;
        }
        @keyframes aiSlideIn {
            from { transform: translateY(-30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .ai-modal-card h3 {
            margin-top: 0;
            font-size: 1.35rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid var(--admin-border);
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .ai-modal-card h3 i {
            color: #a855f7;
        }
        .ai-modal-close {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            background: none;
            border: none;
            color: var(--admin-text-muted);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }
        .ai-modal-close:hover {
            color: #ff6b6b;
        }
        .ai-loader-container {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1rem;
            text-align: center;
        }
        .ai-sparkle-loader {
            width: 60px;
            height: 60px;
            position: relative;
            margin-bottom: 1.5rem;
        }
        .ai-sparkle-loader::before, .ai-sparkle-loader::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #a855f7;
            border-bottom-color: #6366f1;
            animation: aiSpin 1.5s linear infinite;
        }
        .ai-sparkle-loader::after {
            width: 40px;
            height: 40px;
            top: 10px;
            left: 10px;
            border-top-color: #5ccbb3;
            border-bottom-color: #e85c24;
            animation: aiSpinReverse 1s linear infinite;
        }
        @keyframes aiSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes aiSpinReverse {
            0% { transform: rotate(360deg); }
            100% { transform: rotate(0deg); }
        }
        .ai-loader-text {
            font-size: 1.05rem;
            font-weight: 500;
            color: #ffffff;
            margin: 0;
        }
        .ai-loader-subtext {
            font-size: 0.85rem;
            color: var(--admin-text-muted);
            margin: 5px 0 0 0;
        }
        .ai-img-preview-box {
            margin-top: 1rem;
            border: 1px solid var(--admin-border);
            border-radius: var(--radius-md);
            overflow: hidden;
            display: none;
            flex-direction: column;
            background: rgba(0,0,0,0.2);
        }
        .ai-img-preview-box img {
            width: 100%;
            max-height: 300px;
            object-fit: contain;
            background: #000;
        }
        .ai-img-preview-box .info {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--admin-border);
        }

        /* Custom Scrollbar for Main Content, Sidebar, Mobile Scroll, and Tables */
        .admin-content, .sidebar, .mobile-tabs-scroll, .admin-table-wrap {
            scrollbar-color: #0f766e rgba(7, 21, 38, 0.6);
            scrollbar-width: thin;
        }

        .admin-content::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar,
        .mobile-tabs-scroll::-webkit-scrollbar,
        .admin-table-wrap::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .admin-content::-webkit-scrollbar-thumb,
        .sidebar::-webkit-scrollbar-thumb,
        .mobile-tabs-scroll::-webkit-scrollbar-thumb,
        .admin-table-wrap::-webkit-scrollbar-thumb {
            background: #0f766e;
            border-radius: 4px;
        }
        .admin-content::-webkit-scrollbar-thumb:hover,
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #14b8a6;
        }
        .admin-content::-webkit-scrollbar-track,
        .sidebar::-webkit-scrollbar-track,
        .mobile-tabs-scroll::-webkit-scrollbar-track,
        .admin-table-wrap::-webkit-scrollbar-track {
            background: rgba(7, 21, 38, 0.6);
        }

        /* Mobile Hamburger & Close buttons */
        .mobile-toggle-btn {
            display: inline-flex;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--admin-border);
            color: #ffffff;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            width: 40px;
            height: 40px;
        }
        .mobile-toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            color: var(--mint-green);
        }

        .sidebar-close-btn {
            display: none;
            background: none;
            border: none;
            color: var(--admin-text-muted);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.25rem;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            border-radius: var(--radius-sm);
            transition: color 0.2s;
        }
        .sidebar-close-btn:hover {
            color: #ff6b6b;
        }

        /* Mobile Backdrop */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-backdrop.show {
            display: block;
            opacity: 1;
        }

        /* Mobile Swipe Tab Strip */
        .mobile-tabs-scroll {
            display: none;
            gap: 8px;
            overflow-x: auto;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--admin-border);
            background-color: var(--admin-dark-sidebar);
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Hide for firefox */
        }
        .mobile-tabs-scroll::-webkit-scrollbar {
            display: none; /* Hide for Chrome/Safari */
        }
        .mobile-tab-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--admin-border);
            color: var(--admin-text-muted);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        .mobile-tab-btn:hover, .mobile-tab-btn.active {
            color: var(--mint-green);
            background-color: rgba(92, 203, 179, 0.08);
            border-color: var(--mint-green);
        }

        @media (min-width: 992px) {
            body.sidebar-collapsed .sidebar {
                width: 0 !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                border-right-color: transparent !important;
                overflow: hidden !important;
                scrollbar-width: none !important;
            }
            body.sidebar-collapsed .sidebar::-webkit-scrollbar {
                display: none !important;
            }
            body.sidebar-collapsed {
                --admin-sidebar-w: 0px;
            }
        }

        /* Media Queries for Layout Responsiveness */
        @media (max-width: 991.98px) {
            body {
                flex-direction: column;
                height: 100vh;
                max-height: 100vh;
                overflow: hidden;
            }
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                height: 100vh;
                max-height: 100vh;
                z-index: 1050;
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 20px 0 30px rgba(0, 0, 0, 0.5);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .sidebar-close-btn {
                display: inline-flex;
            }
            .mobile-toggle-btn {
                display: inline-flex;
            }
            .mobile-tabs-scroll {
                display: flex;
                flex-shrink: 0;
            }
            .admin-header {
                padding: 0 1rem;
                flex-shrink: 0;
            }
            .main-panel {
                height: 100vh;
                max-height: 100vh;
                flex: 1 1 0%;
                min-height: 0;
            }
            .admin-content {
                padding: 1.25rem;
                flex: 1 1 0%;
                min-height: 0;
                height: calc(100vh - 120px);
                max-height: calc(100vh - 120px);
            }
            .admin-card {
                padding: 1.25rem;
                margin-bottom: 1.25rem;
            }
            /* Form grid styling */
            .form-grid {
                grid-template-columns: repeat(auto-fit, minmax(min(100%, 260px), 1fr));
                gap: 1rem;
            }
            .ai-toast {
                max-width: calc(100vw - 40px);
            }
        }

        @media (max-width: 575.98px) {
            .admin-header h1 {
                font-size: 1.2rem;
            }
            .admin-user span {
                display: none; /* Hide user name on small mobile, keep avatar */
            }
            .admin-card h2 {
                font-size: 1.1rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .admin-card h2 button {
                width: 100%;
                justify-content: center;
            }
            .btn-submit {
                width: 100%;
                text-align: center;
            }
            /* Form fields */
            .form-group[style*="grid-column: span 2"] {
                grid-column: span 1 !important;
            }
        }
    </style>
    <script>
    // Global Early Modal Definitions so inline onclicks always resolve instantly
    window.openMenuEditModal = function(target, title, url, type, cat, desc, sort, active, icon) {
        var btn = (target && target.closest) ? (target.closest('.edit-menu-btn') || target) : target;
        var id, mTitle, mUrl, mType, mCat, mDesc, mSort, mActive, mIcon;
        if (typeof btn === 'object' && btn !== null && btn.dataset) {
            id = btn.dataset.id;
            mTitle = btn.dataset.title;
            mUrl = btn.dataset.url;
            mType = btn.dataset.type;
            mCat = btn.dataset.category;
            mDesc = btn.dataset.description;
            mSort = btn.dataset.sort;
            mActive = btn.dataset.active == '1';
            mIcon = btn.dataset.icon;
        } else {
            id = target; mTitle = title; mUrl = url; mType = type; mCat = cat; mDesc = desc; mSort = sort; mActive = !!active; mIcon = icon;
        }

        var modal = document.getElementById('menuEditModal');
        var form = document.getElementById('menuEditForm');
        if (form && id) {
            form.action = '/admin/menu-items/' + id + '/update';
        }
        var elTitle = document.getElementById('edit_menu_title');
        if (elTitle) elTitle.value = mTitle || '';
        var elUrl = document.getElementById('edit_menu_url');
        if (elUrl) elUrl.value = mUrl || '';
        var elCat = document.getElementById('edit_menu_category_group');
        if (elCat) elCat.value = mCat || '';
        var elDesc = document.getElementById('edit_menu_desc');
        if (elDesc) elDesc.value = mDesc || '';
        var elIcon = document.getElementById('edit_menu_icon');
        if (elIcon) elIcon.value = mIcon || '';
        var elSort = document.getElementById('edit_menu_sort');
        if (elSort) elSort.value = mSort || 0;
        var elActive = document.getElementById('edit_menu_active');
        if (elActive) elActive.checked = mActive;

        var catDiv = document.getElementById('edit_menu_cat_div');
        var descDiv = document.getElementById('edit_menu_desc_div');
        var iconDiv = document.getElementById('edit_menu_icon_div');
        if (catDiv && descDiv) {
            if (mType === 'mega_services') {
                catDiv.style.display = 'block';
                descDiv.style.display = 'block';
                if (iconDiv) iconDiv.style.display = 'block';
            } else if (mType === 'portfolio_menu') {
                catDiv.style.display = 'none';
                descDiv.style.display = 'block';
                if (iconDiv) iconDiv.style.display = 'none';
            } else {
                catDiv.style.display = 'none';
                descDiv.style.display = 'none';
                if (iconDiv) iconDiv.style.display = 'none';
            }
        }

        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('show');
            if (elTitle) elTitle.focus();
        }
        if (window.lucide) { lucide.createIcons(); }
    };

    window.closeMenuEditModal = function() {
        var modal = document.getElementById('menuEditModal');
        if (modal) {
            modal.classList.remove('show');
            setTimeout(function() { modal.style.display = 'none'; }, 200);
        }
    };

    window.openSlideEditModal = function(target) {
        var btn = (target && target.closest) ? (target.closest('.edit-slide-btn') || target) : target;
        var id = btn.dataset.id;
        var title = btn.dataset.title;
        var subtitle = btn.dataset.subtitle;
        var btnText = btn.dataset.button_text;
        var btnLink = btn.dataset.button_link;
        var sort = btn.dataset.sort;
        var img = btn.dataset.image;

        var modal = document.getElementById('slideEditModal');
        var form = document.getElementById('slideEditForm');
        if (form && id) {
            form.action = '/admin/slides/' + id + '/update';
        }
        var elTitle = document.getElementById('edit_slide_title');
        if (elTitle) elTitle.value = title || '';
        var elSub = document.getElementById('edit_slide_subtitle');
        if (elSub) elSub.value = subtitle || '';
        var elBtnText = document.getElementById('edit_slide_btn_text');
        if (elBtnText) elBtnText.value = btnText || '';
        var elBtnLink = document.getElementById('edit_slide_btn_link');
        if (elBtnLink) elBtnLink.value = btnLink || '';
        var elImg = document.getElementById('edit_slide_image_url');
        if (elImg) elImg.value = img || '';
        var elSort = document.getElementById('edit_slide_sort');
        if (elSort) elSort.value = sort || 0;

        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('show');
            if (elTitle) elTitle.focus();
        }
        if (window.lucide) { lucide.createIcons(); }
    };

    window.closeSlideEditModal = function() {
        var modal = document.getElementById('slideEditModal');
        if (modal) {
            modal.classList.remove('show');
            setTimeout(function() { modal.style.display = 'none'; }, 200);
        }
    };

    window.openPartnerEditModal = function(target) {
        var btn = (target && target.closest) ? (target.closest('.edit-partner-btn') || target) : target;
        var id = btn.dataset.id;
        var name = btn.dataset.name;
        var logo = btn.dataset.logo;
        var website = btn.dataset.website;
        var sort = btn.dataset.sort;
        var active = btn.dataset.active == '1';

        var modal = document.getElementById('partnerEditModal');
        var form = document.getElementById('partnerEditForm');
        if (form && id) {
            form.action = '/admin/partners/' + id + '/update';
        }
        var elName = document.getElementById('edit_partner_name');
        if (elName) elName.value = name || '';
        var elWeb = document.getElementById('edit_partner_website');
        if (elWeb) elWeb.value = (website && website !== 'None') ? website : '';
        var elLogo = document.getElementById('edit_partner_logo_url');
        if (elLogo) elLogo.value = logo || '';
        var elSort = document.getElementById('edit_partner_sort');
        if (elSort) elSort.value = sort || 0;
        var elActive = document.getElementById('edit_partner_active');
        if (elActive) elActive.checked = active;

        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('show');
            if (elName) elName.focus();
        }
        if (window.lucide) { lucide.createIcons(); }
    };

    window.closePartnerEditModal = function() {
        var modal = document.getElementById('partnerEditModal');
        if (modal) {
            modal.classList.remove('show');
            setTimeout(function() { modal.style.display = 'none'; }, 200);
        }
    };

    window.openTestimonialEditModal = function(target) {
        var btn = (target && target.closest) ? (target.closest('.edit-testimonial-btn') || target) : target;
        var id = btn.dataset.id;
        var name = btn.dataset.name;
        var role = btn.dataset.role;
        var rating = btn.dataset.rating;
        var content = btn.dataset.content;
        var sort = btn.dataset.sort;
        var avatar = btn.dataset.avatar;

        var modal = document.getElementById('testimonialEditModal');
        var form = document.getElementById('testimonialEditForm');
        if (form && id) {
            form.action = '/admin/testimonials/' + id + '/update';
        }
        var elName = document.getElementById('edit_test_name');
        if (elName) elName.value = name || '';
        var elRole = document.getElementById('edit_test_role');
        if (elRole) elRole.value = role || '';
        var elRating = document.getElementById('edit_test_rating');
        if (elRating) elRating.value = rating || 5;
        var elContent = document.getElementById('edit_test_content');
        if (elContent) elContent.value = content || '';
        var elAvatar = document.getElementById('edit_test_avatar_url');
        if (elAvatar) elAvatar.value = avatar || '';
        var elSort = document.getElementById('edit_test_sort');
        if (elSort) elSort.value = sort || 0;

        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('show');
            if (elName) elName.focus();
        }
        if (window.lucide) { lucide.createIcons(); }
    };

    window.closeTestimonialEditModal = function() {
        var modal = document.getElementById('testimonialEditModal');
        if (modal) {
            modal.classList.remove('show');
            setTimeout(function() { modal.style.display = 'none'; }, 200);
        }
    };
    </script>
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="sidebar-brand" style="padding: 1.2rem 1rem;">
            <a href="{{ route('home') }}" target="_blank" class="logo" style="display: flex; align-items: center; gap: 8px; text-decoration: none; color: white;">
                @php
                    $sidebarLogo = !empty($site['logo_path']) ? site_image($site['logo_path']) : asset('assets/brand/logo-white.png');
                @endphp
                <img src="{{ $sidebarLogo }}" alt="SMAC Digital" style="height: 38px; width: auto; max-width: 160px; object-fit: contain;">
            </a>
            <button class="sidebar-close-btn" onclick="toggleSidebar()" aria-label="Close Sidebar">
                <i data-lucide="x"></i>
            </button>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item"><a href="{{ route('admin.tab', 'general') }}" class="tab-btn {{ $activeTab === 'general' ? 'active' : '' }}" id="btn-general"><i data-lucide="settings"></i> General Settings</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'branding') }}" class="tab-btn {{ $activeTab === 'branding' ? 'active' : '' }}" id="btn-branding"><i data-lucide="image"></i> Brand &amp; Logos</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'headermenu') }}" class="tab-btn {{ $activeTab === 'headermenu' ? 'active' : '' }}" id="btn-headermenu"><i data-lucide="compass"></i> Header Menu Builder</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'footermenu') }}" class="tab-btn {{ $activeTab === 'footermenu' ? 'active' : '' }}" id="btn-footermenu"><i data-lucide="panel-bottom"></i> Footer Builder</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'slider') }}" class="tab-btn {{ $activeTab === 'slider' ? 'active' : '' }}" id="btn-slider"><i data-lucide="sparkles"></i> Hero Banner &amp; Slides</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'homesections') }}" class="tab-btn {{ $activeTab === 'homesections' ? 'active' : '' }}" id="btn-homesections"><i data-lucide="layout-grid"></i> Homepage Sections</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'pagecontents') }}" class="tab-btn {{ $activeTab === 'pagecontents' ? 'active' : '' }}" id="btn-pagecontents"><i data-lucide="file-text"></i> Page Content Editor</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'testimonials') }}" class="tab-btn {{ $activeTab === 'testimonials' ? 'active' : '' }}" id="btn-testimonials"><i data-lucide="message-square-quote"></i> Testimonials</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'blogs') }}" class="tab-btn {{ $activeTab === 'blogs' ? 'active' : '' }}" id="btn-blogs"><i data-lucide="book-open"></i> Blog Manager</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'categories') }}" class="tab-btn {{ $activeTab === 'categories' ? 'active' : '' }}" id="btn-categories"><i data-lucide="tags"></i> Categories Manager</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'cms_pages') }}" class="tab-btn {{ $activeTab === 'cms_pages' ? 'active' : '' }}" id="btn-cms_pages"><i data-lucide="files"></i> CMS Pages (SEO)</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'leads') }}" class="tab-btn {{ $activeTab === 'leads' ? 'active' : '' }}" id="btn-leads"><i data-lucide="inbox"></i> Leads Manager</a></li>
            <li class="menu-item">
                <a href="{{ route('admin.tab', 'livechat') }}" class="tab-btn {{ $activeTab === 'livechat' ? 'active' : '' }}" id="btn-livechat" style="position: relative;">
                    <i data-lucide="message-square"></i> Live Chat Support
                    <span id="admin-chat-total-badge" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background-color: #ef4444; color: white; font-size: 0.65rem; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: none; align-items: center; justify-content: center;">0</span>
                </a>
            </li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'media') }}" class="tab-btn {{ $activeTab === 'media' ? 'active' : '' }}" id="btn-media"><i data-lucide="hard-drive"></i> Media Manager</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'analytics') }}" class="tab-btn {{ $activeTab === 'analytics' ? 'active' : '' }}" id="btn-analytics"><i data-lucide="bar-chart-3"></i> Google Analytics</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'seo') }}" class="tab-btn {{ $activeTab === 'seo' ? 'active' : '' }}" id="btn-seo"><i data-lucide="trending-up"></i> SEO Optimizer</a></li>
            <li class="menu-item"><a href="{{ route('admin.tab', 'users') }}" class="tab-btn {{ $activeTab === 'users' ? 'active' : '' }}" id="btn-users"><i data-lucide="user"></i> Admin Users</a></li>
        </ul>


        
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout" onclick="localStorage.removeItem('active_tab')">
                    <i data-lucide="log-out"></i> Log Out
                </button>
            </form>
        </div>
    </div>

    <!-- Sidebar Backdrop for Mobile -->
    <div class="sidebar-backdrop" id="sidebar-backdrop" onclick="toggleSidebar()"></div>

    <!-- Main Content Panel -->
    <div class="main-panel">
        <div class="admin-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <button class="mobile-toggle-btn" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
                    <i data-lucide="menu"></i>
                </button>
                <h1>CMS Control Panel</h1>
            </div>
            <div style="display: flex; gap: 1.5rem; align-items: center;">
                <button class="btn-ai-sparkle" style="padding: 6px 12px; font-size: 0.8rem; height: auto;" onclick="openProfileModal()">
                    <i data-lucide="user" style="width: 14px; height: 14px; vertical-align: middle;"></i> My Profile
                </button>
                <div class="admin-user">
                    <span>{{ Auth::user() ? Auth::user()->name : 'Admin' }}</span>
                    <div class="admin-user-avatar">{{ Auth::user() ? substr(Auth::user()->name, 0, 1) : 'A' }}</div>
                </div>
            </div>
        </div>

        <!-- Mobile Quick-Switch Tabs -->
        <div class="mobile-tabs-scroll">
            @if($hasAccess('general'))<a href="{{ route('admin.tab', 'general') }}" class="mobile-tab-btn {{ $activeTab === 'general' ? 'active' : '' }}" id="m-btn-general"><i data-lucide="settings" style="width: 14px; height: 14px;"></i> General</a>@endif
            @if($hasAccess('leads'))<a href="{{ route('admin.tab', 'leads') }}" class="mobile-tab-btn {{ $activeTab === 'leads' ? 'active' : '' }}" id="m-btn-leads"><i data-lucide="inbox" style="width: 14px; height: 14px;"></i> Leads</a>@endif
            @if($hasAccess('livechat'))<a href="{{ route('admin.tab', 'livechat') }}" class="mobile-tab-btn {{ $activeTab === 'livechat' ? 'active' : '' }}" id="m-btn-livechat" style="position: relative;"><i data-lucide="message-square" style="width: 14px; height: 14px;"></i> Live Chat <span id="admin-chat-mobile-badge" style="position: absolute; right: 2px; top: 2px; background-color: #ef4444; color: white; font-size: 0.6rem; font-weight: 700; width: 14px; height: 14px; border-radius: 50%; display: none; align-items: center; justify-content: center;">0</span></a>@endif
            @if($hasAccess('branding'))<a href="{{ route('admin.tab', 'branding') }}" class="mobile-tab-btn {{ $activeTab === 'branding' ? 'active' : '' }}" id="m-btn-branding"><i data-lucide="image" style="width: 14px; height: 14px;"></i> Branding</a>@endif
            @if($hasAccess('slider'))<a href="{{ route('admin.tab', 'slider') }}" class="mobile-tab-btn {{ $activeTab === 'slider' ? 'active' : '' }}" id="m-btn-slider"><i data-lucide="sliders" style="width: 14px; height: 14px;"></i> Slider</a>@endif
            @if($hasAccess('testimonials'))<a href="{{ route('admin.tab', 'testimonials') }}" class="mobile-tab-btn {{ $activeTab === 'testimonials' ? 'active' : '' }}" id="m-btn-testimonials"><i data-lucide="users" style="width: 14px; height: 14px;"></i> Testimonials</a>@endif
            @if($hasAccess('styling'))<a href="{{ route('admin.tab', 'styling') }}" class="mobile-tab-btn {{ $activeTab === 'styling' ? 'active' : '' }}" id="m-btn-styling"><i data-lucide="palette" style="width: 14px; height: 14px;"></i> Styling</a>@endif
            @if($hasAccess('pagecontents'))<a href="{{ route('admin.tab', 'pagecontents') }}" class="mobile-tab-btn {{ $activeTab === 'pagecontents' ? 'active' : '' }}" id="m-btn-pagecontents"><i data-lucide="file-text" style="width: 14px; height: 14px;"></i> Pages</a>@endif
            @if($hasAccess('landing'))<a href="{{ route('admin.tab', 'landing') }}" class="mobile-tab-btn {{ $activeTab === 'landing' ? 'active' : '' }}" id="m-btn-landing"><i data-lucide="layout" style="width: 14px; height: 14px;"></i> AI Pages</a>@endif
            @if($hasAccess('collections'))<a href="{{ route('admin.tab', 'collections') }}" class="mobile-tab-btn {{ $activeTab === 'collections' ? 'active' : '' }}" id="m-btn-collections"><i data-lucide="folder" style="width: 14px; height: 14px;"></i> Collections</a>@endif
            @if($hasAccess('categories') || $hasAccess('collections') || $hasAccess('blogs') || $hasAccess('services') || $isSuper)<a href="{{ route('admin.tab', 'categories') }}" class="mobile-tab-btn {{ $activeTab === 'categories' ? 'active' : '' }}" id="m-btn-categories"><i data-lucide="tags" style="width: 14px; height: 14px;"></i> Categories</a>@endif
            @if($hasAccess('marbles'))<a href="{{ route('admin.tab', 'marbles') }}" class="mobile-tab-btn {{ $activeTab === 'marbles' ? 'active' : '' }}" id="m-btn-marbles"><i data-lucide="gem" style="width: 14px; height: 14px;"></i> Marbles</a>@endif
            @if($hasAccess('locations'))<a href="{{ route('admin.tab', 'locations') }}" class="mobile-tab-btn {{ $activeTab === 'locations' ? 'active' : '' }}" id="m-btn-locations"><i data-lucide="map-pin" style="width: 14px; height: 14px;"></i> Locations</a>@endif
            @if($hasAccess('specialists'))<a href="{{ route('admin.tab', 'specialists') }}" class="mobile-tab-btn {{ $activeTab === 'specialists' ? 'active' : '' }}" id="m-btn-specialists"><i data-lucide="user-check" style="width: 14px; height: 14px;"></i> Specialists</a>@endif
            @if($hasAccess('cms_pages'))<a href="{{ route('admin.tab', 'cms_pages') }}" class="mobile-tab-btn {{ $activeTab === 'cms_pages' ? 'active' : '' }}" id="m-btn-cms_pages"><i data-lucide="files" style="width: 14px; height: 14px;"></i> CMS Pages</a>@endif
            @if($hasAccess('blogs'))<a href="{{ route('admin.tab', 'blogs') }}" class="mobile-tab-btn {{ $activeTab === 'blogs' ? 'active' : '' }}" id="m-btn-blogs"><i data-lucide="book-open" style="width: 14px; height: 14px;"></i> Blogs</a>@endif
            @if($hasAccess('media'))<a href="{{ route('admin.tab', 'media') }}" class="mobile-tab-btn {{ $activeTab === 'media' ? 'active' : '' }}" id="m-btn-media"><i data-lucide="hard-drive" style="width: 14px; height: 14px;"></i> Media</a>@endif
            {{-- @if($hasAccess('analytics'))<a href="{{ route('admin.tab', 'analytics') }}" class="mobile-tab-btn {{ $activeTab === 'analytics' ? 'active' : '' }}" id="m-btn-analytics"><i data-lucide="bar-chart-2" style="width: 14px; height: 14px;"></i> Analytics</a>@endif --}}
            @if($hasAccess('analytics'))<a href="{{ route('admin.tab', 'analytics') }}" class="mobile-tab-btn {{ $activeTab === 'analytics' ? 'active' : '' }}" id="m-btn-analytics"><i data-lucide="bar-chart-3" style="width: 14px; height: 14px;"></i> Analytics</a>@endif
            @if($hasAccess('seo'))<a href="{{ route('admin.tab', 'seo') }}" class="mobile-tab-btn {{ $activeTab === 'seo' ? 'active' : '' }}" id="m-btn-seo"><i data-lucide="trending-up" style="width: 14px; height: 14px;"></i> SEO</a>@endif
            @if($hasAccess('seo'))<a href="{{ route('admin.tab', 'notifications') }}" class="mobile-tab-btn {{ $activeTab === 'notifications' ? 'active' : '' }}" id="m-btn-notifications"><i data-lucide="bell" style="width: 14px; height: 14px;"></i> Alerts</a>@endif
            @if($isSuper)<a href="{{ route('admin.tab', 'users') }}" class="mobile-tab-btn {{ $activeTab === 'users' ? 'active' : '' }}" id="m-btn-users"><i data-lucide="user" style="width: 14px; height: 14px;"></i> Admins</a>@endif

        </div>


        <div class="admin-content" tabindex="0">
            <!-- Success Banner -->
            @if(session('success'))
                <div class="alert-success">
                    <i data-lucide="check-circle-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="alert-success" style="background-color: rgba(255,107,107,0.1); border-color: rgba(255,107,107,0.3); color: #ff6b6b;">
                    <i data-lucide="alert-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- 1. GENERAL & CONTACT SETTINGS TAB -->
            <div class="tab-panel @if($activeTab === 'general') active @endif" id="tab-general">
                <form action="{{ route('admin.parameters.update') }}" method="POST">
                    @csrf
                    
                    <div class="admin-card">
                        <h2>Contact Information</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ $site['phone'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $site['email'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="whatsapp_number">WhatsApp Number (with country code, no +)</label>
                                <input type="text" id="whatsapp_number" name="whatsapp_number" class="form-control" value="{{ $site['whatsapp_number'] ?? '' }}" required>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 1.25rem;">
                            <label for="address">Physical Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="{{ $site['address'] ?? '' }}" required>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2><i data-lucide="sparkles" style="display: inline-block; vertical-align: middle; margin-right: 5px; color: var(--accent-orange, #ff6b4a);"></i> Sticky Left CTA Button Settings</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Customize the vertical floating sticky CTA button displayed on the left edge of all website pages.
                        </p>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="sticky_cta_text">Sticky CTA Button Text / Label</label>
                                <input type="text" id="sticky_cta_text" name="sticky_cta_text" class="form-control" value="{{ $site['sticky_cta_text'] ?? 'Start A Brief' }}" placeholder="e.g. Start A Brief, Let's Talk, Get A Quote" required>
                                <small style="display: block; margin-top: 5px; color: var(--admin-text-muted); font-size: 0.75rem;">This label appears vertically inside the white floating sticky button on the left edge.</small>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>Social Media Profiles</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">Add links to your official social media pages to show them in the footer.</p>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="social_facebook">Facebook URL</label>
                                <input type="url" id="social_facebook" name="social_facebook" class="form-control" value="{{ $site['social_facebook'] ?? '' }}" placeholder="https://facebook.com/yourpage">
                            </div>
                            <div class="form-group">
                                <label for="social_instagram">Instagram URL</label>
                                <input type="url" id="social_instagram" name="social_instagram" class="form-control" value="{{ $site['social_instagram'] ?? '' }}" placeholder="https://instagram.com/yourusername">
                            </div>
                            <div class="form-group">
                                <label for="social_linkedin">LinkedIn URL</label>
                                <input type="url" id="social_linkedin" name="social_linkedin" class="form-control" value="{{ $site['social_linkedin'] ?? '' }}" placeholder="https://linkedin.com/company/yourcompany">
                            </div>
                            <div class="form-group">
                                <label for="social_twitter">Twitter / X URL</label>
                                <input type="url" id="social_twitter" name="social_twitter" class="form-control" value="{{ $site['social_twitter'] ?? '' }}" placeholder="https://twitter.com/yourhandle">
                            </div>
                            <div class="form-group">
                                <label for="social_practo">Practo Profile URL</label>
                                <input type="url" id="social_practo" name="social_practo" class="form-control" value="{{ $site['social_practo'] ?? '' }}" placeholder="https://practo.com/clinic/yourprofile">
                            </div>
                        </div>
                    </div>


                    <div class="admin-card">
                        <h2>SEO & Tracking Codes</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">Configure global tracking and verification tags.</p>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="google_tag_id">Google Tag ID / GTM ID / GA4 Measurement ID</label>
                                <input type="text" id="google_tag_id" name="google_tag_id" class="form-control" value="{{ $site['google_tag_id'] ?? '' }}" placeholder="e.g., G-XXXXXXXXXX or GTM-XXXXXXX">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 1.25rem;">
                            <label for="header_scripts">Custom Tracking Scripts (inserted before &lt;/head&gt;)</label>
                            <textarea id="header_scripts" name="header_scripts" class="form-control" rows="4" placeholder="<!-- Paste Facebook Pixel, custom GTM script tags, etc. -->">{{ $site['header_scripts'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>Google reCAPTCHA v2 Settings</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Protects all contact and inquiry forms on the website from automated spam. 
                            <a href="https://www.google.com/recaptcha/admin" target="_blank" style="color: var(--accent-orange); text-decoration: underline; font-weight: 500;">
                                Learn how to generate Google reCAPTCHA v2 checkbox keys &rarr;
                            </a>
                        </p>
                        
                        <div class="form-grid">
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="recaptcha_enabled" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" id="recaptcha_enabled" name="recaptcha_enabled" value="1" @checked(($site['recaptcha_enabled'] ?? '0') == '1') style="width: 18px; height: 18px; cursor: pointer;">
                                    <strong>Enable Google reCAPTCHA Checkbox on Forms</strong>
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <label for="recaptcha_site_key">reCAPTCHA Site Key</label>
                                <input type="text" id="recaptcha_site_key" name="recaptcha_site_key" class="form-control" value="{{ $site['recaptcha_site_key'] ?? '' }}" placeholder="Paste Google Site Key (e.g. 6Ld...)">
                            </div>
                            
                            <div class="form-group">
                                <label for="recaptcha_secret_key">reCAPTCHA Secret Key</label>
                                <input type="text" id="recaptcha_secret_key" name="recaptcha_secret_key" class="form-control" value="{{ $site['recaptcha_secret_key'] ?? '' }}" placeholder="Paste Google Secret Key">
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>Google Gemini AI & Business Settings</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Provide a Google Gemini API Key and your Google My Business link to enable AI generation and reviews sync.
                        </p>
                        <div class="form-grid">
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="gemini_api_key">Gemini API Key</label>
                                <input type="password" id="gemini_api_key" name="gemini_api_key" class="form-control" value="{{ $site['gemini_api_key'] ?? '' }}" placeholder="Paste your Gemini API Key here...">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    Get an API Key from the <a href="https://aistudio.google.com/" target="_blank" style="color: var(--mint-green); text-decoration: underline;">Google AI Studio Console</a>.
                                </span>
                            </div>
                            
                            <div class="form-group" style="grid-column: span 2; margin-top: 1rem;">
                                <label for="google_my_business_link">Google My Business Reviews Link</label>
                                <input type="text" id="google_my_business_link" name="google_my_business_link" class="form-control" value="{{ $site['google_my_business_link'] ?? '' }}" placeholder="Paste your Google My Business reviews link here...">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    This link will be used to sync/generate authentic testimonials using AI.
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="gmb_location_id">Google Business Profile Location ID (Optional)</label>
                                <input type="text" id="gmb_location_id" name="gmb_location_id" class="form-control" value="{{ $site['gmb_location_id'] ?? '' }}" placeholder="e.g. locations/1234567890">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    Required for direct API publishing. Format: <code>locations/YOUR_LOCATION_ID</code>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="gmb_access_token">Google Business Profile Access Token (Optional)</label>
                                <input type="password" id="gmb_access_token" name="gmb_access_token" class="form-control" value="{{ $site['gmb_access_token'] ?? '' }}" placeholder="Paste your OAuth access token here...">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    OAuth 2.0 Bearer Access Token with <code>https://www.googleapis.com/auth/business.manage</code> scope.
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>Live Chat Support Settings</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Configure the welcome message triggered automatically when a visitor opens the live chat bubble.
                        </p>
                        <div class="form-grid">
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="livechat_auto_reply">Auto Reply Welcome Message</label>
                                <textarea id="livechat_auto_reply" name="livechat_auto_reply" class="form-control" rows="3" required placeholder="Hello! Welcome to Stone Hub India. How can we help you today with your premium marble selection?">{{ $site['livechat_auto_reply'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>Cloudflare Web Analytics Settings</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Enable Cloudflare Web Analytics to monitor pageviews, requests, and bandwidth inside this dashboard.
                        </p>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="cloudflare_analytics_token">Cloudflare Web Analytics Token</label>
                                <input type="text" id="cloudflare_analytics_token" name="cloudflare_analytics_token" class="form-control" value="{{ $site['cloudflare_analytics_token'] ?? '' }}" placeholder="e.g. 66a2e4fb8...">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    Get the JS beacon token from the <a href="https://developers.cloudflare.com/analytics/web-analytics/" target="_blank" style="color: var(--mint-green); text-decoration: underline;">Cloudflare Web Analytics Guide</a>.
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="cloudflare_zone_id">Cloudflare Zone ID</label>
                                <input type="text" id="cloudflare_zone_id" name="cloudflare_zone_id" class="form-control" value="{{ $site['cloudflare_zone_id'] ?? '' }}" placeholder="e.g., d3b07384...">
                            </div>
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="cloudflare_api_token">Cloudflare API Token (Analytics Read)</label>
                                <input type="password" id="cloudflare_api_token" name="cloudflare_api_token" class="form-control" value="{{ $site['cloudflare_api_token'] ?? '' }}" placeholder="Paste API Token here...">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    Generate a token with <strong>Zone.Analytics Read</strong> permission from your <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank" style="color: var(--mint-green); text-decoration: underline;">Cloudflare API Tokens settings</a>.
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>Cloudflare R2 Object Storage</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Replace FTP with Cloudflare R2 S3-compatible storage. Use Cloudflare's 10 GB free tier for media files.
                        </p>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="cloudflare_r2_account_id">Cloudflare Account ID</label>
                                <input type="text" id="cloudflare_r2_account_id" name="cloudflare_r2_account_id" class="form-control" value="{{ $site['cloudflare_r2_account_id'] ?? '' }}" placeholder="Account ID from Cloudflare dashboard">
                            </div>
                            <div class="form-group">
                                <label for="cloudflare_r2_bucket_name">Cloudflare R2 Bucket Name</label>
                                <input type="text" id="cloudflare_r2_bucket_name" name="cloudflare_r2_bucket_name" class="form-control" value="{{ $site['cloudflare_r2_bucket_name'] ?? '' }}" placeholder="e.g., drsumitz-assets">
                            </div>
                            <div class="form-group">
                                <label for="cloudflare_r2_access_key_id">R2 Access Key ID</label>
                                <input type="text" id="cloudflare_r2_access_key_id" name="cloudflare_r2_access_key_id" class="form-control" value="{{ $site['cloudflare_r2_access_key_id'] ?? '' }}" placeholder="Access Key ID">
                            </div>
                            <div class="form-group">
                                <label for="cloudflare_r2_secret_access_key">R2 Secret Access Key</label>
                                <input type="password" id="cloudflare_r2_secret_access_key" name="cloudflare_r2_secret_access_key" class="form-control" value="{{ $site['cloudflare_r2_secret_access_key'] ?? '' }}" placeholder="Secret Access Key">
                            </div>
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="cloudflare_r2_public_url">R2 Public Custom Domain URL</label>
                                <input type="text" id="cloudflare_r2_public_url" name="cloudflare_r2_public_url" class="form-control" value="{{ $site['cloudflare_r2_public_url'] ?? '' }}" placeholder="e.g., https://assets.drsumitz.com">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    Create R2 credentials & connect a custom domain by following the <a href="https://developers.cloudflare.com/r2/" target="_blank" style="color: var(--mint-green); text-decoration: underline;">Cloudflare R2 Storage Guide</a>.
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card" style="border: 1px solid var(--accent-orange); position: relative; background: rgba(232, 92, 36, 0.01);">
                        <h2 style="color: var(--accent-orange); display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="database" style="width: 22px; height: 22px;"></i> Database Sync (Local to Live Server)
                        </h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Push and synchronize all local database content (Settings, Slides, Testimonials, Blogs, Services, and Page Contents) to your live production server database.
                        </p>
                        <div class="form-grid">
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="live_site_url">Live Site Base URL</label>
                                <input type="text" id="live_site_url" name="live_site_url" class="form-control" value="{{ $site['live_site_url'] ?? 'https://www.smacdigital.com' }}" placeholder="e.g., https://www.smacdigital.com">
                                <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                                    This is the target live domain where data will be pushed. The Sync uses your configured <strong>R2 Secret Access Key</strong> as a secure verification token between your local and live servers.
                                </span>
                            </div>
                        </div>
                        <div style="margin-top: 1.5rem;">
                            <button type="button" class="btn-submit" style="background: var(--accent-orange) !important; border-color: var(--accent-orange); display: inline-flex; align-items: center; gap: 8px; width: auto; font-size: 0.9rem;" onclick="pushLocalDatabaseToLive(this)">
                                <i data-lucide="cloud-lightning" style="width: 16px; height: 16px;"></i> Push Local Database to Live Server
                            </button>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>SMTP Mailer Settings (Lead Notification Email)</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Configure SMTP details to send automated email alerts to admin when a new inquiry is submitted.
                        </p>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="smtp_host">SMTP Host</label>
                                <input type="text" id="smtp_host" name="smtp_host" class="form-control" value="{{ $site['smtp_host'] ?? '' }}" placeholder="smtp.mailtrap.io">
                            </div>
                            <div class="form-group">
                                <label for="smtp_port">SMTP Port</label>
                                <input type="text" id="smtp_port" name="smtp_port" class="form-control" value="{{ $site['smtp_port'] ?? '587' }}" placeholder="587">
                            </div>
                            <div class="form-group">
                                <label for="smtp_username">SMTP Username</label>
                                <input type="text" id="smtp_username" name="smtp_username" class="form-control" value="{{ $site['smtp_username'] ?? '' }}" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label for="smtp_password">SMTP Password</label>
                                <input type="password" id="smtp_password" name="smtp_password" class="form-control" value="{{ $site['smtp_password'] ?? '' }}" placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="smtp_encryption">SMTP Encryption</label>
                                <select id="smtp_encryption" name="smtp_encryption" class="form-control">
                                    <option value="tls" @selected(($site['smtp_encryption'] ?? 'tls') == 'tls')>TLS</option>
                                    <option value="ssl" @selected(($site['smtp_encryption'] ?? 'tls') == 'ssl')>SSL</option>
                                    <option value="none" @selected(($site['smtp_encryption'] ?? 'tls') == 'none')>None</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="smtp_from_address">From Email Address</label>
                                <input type="email" id="smtp_from_address" name="smtp_from_address" class="form-control" value="{{ $site['smtp_from_address'] ?? 'no-reply@smacdigital.com' }}" placeholder="no-reply@smacdigital.com">
                            </div>
                            <div class="form-group">
                                <label for="smtp_from_name">From Sender Name</label>
                                <input type="text" id="smtp_from_name" name="smtp_from_name" class="form-control" value="{{ $site['smtp_from_name'] ?? 'SMAC Digital Alerts' }}" placeholder="SMAC Digital Alerts">
                            </div>
                            <div class="form-group">
                                <label for="smtp_to_email">Recipient Email Address (Admin Alert)</label>
                                <input type="email" id="smtp_to_email" name="smtp_to_email" class="form-control" value="{{ $site['smtp_to_email'] ?? 'Jitendra@smacdigital.com' }}" placeholder="Jitendra@smacdigital.com">
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>WhatsApp API Settings (Lead Notification WhatsApp)</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Configure WhatsApp API settings to send automated alerts when a new inquiry is submitted.
                        </p>
                        <div class="form-grid">
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="whatsapp_api_url">WhatsApp API Gateway URL</label>
                                <input type="text" id="whatsapp_api_url" name="whatsapp_api_url" class="form-control" value="{{ $site['whatsapp_api_url'] ?? '' }}" placeholder="https://api.whatsapp.com/send or custom API endpoint">
                            </div>
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="whatsapp_api_token">WhatsApp API Token / Key</label>
                                <input type="password" id="whatsapp_api_token" name="whatsapp_api_token" class="form-control" value="{{ $site['whatsapp_api_token'] ?? '' }}" placeholder="API Token / Auth Key">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp_admin_recipient">Admin Recipient WhatsApp Number (with country code, no +)</label>
                                <input type="text" id="whatsapp_admin_recipient" name="whatsapp_admin_recipient" class="form-control" value="{{ $site['whatsapp_admin_recipient'] ?? '919672777749' }}" placeholder="e.g. 919672777749">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Save Parameters</button>
                </form>
            </div>

            <!-- LEADS MANAGER TAB -->
            <div class="tab-panel @if($activeTab === 'leads') active @endif" id="tab-leads">
                <!-- Stats Overview Grid -->
                <div class="form-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-bottom: 2rem;">
                    <div class="admin-card text-center" style="padding: 1.25rem; margin-bottom: 0;">
                        <h4 style="margin: 0; font-size: 0.85rem; color: var(--admin-text-muted); text-transform: uppercase;">Total Leads</h4>
                        <p style="font-size: 2.25rem; font-weight: 800; color: var(--primary-teal-dark); margin: 0.5rem 0 0 0;">{{ \App\Models\Lead::count() }}</p>
                    </div>
                    <div class="admin-card text-center" style="padding: 1.25rem; margin-bottom: 0; border-left: 4px solid #3b82f6;">
                        <h4 style="margin: 0; font-size: 0.85rem; color: var(--admin-text-muted); text-transform: uppercase;">New</h4>
                        <p style="font-size: 2.25rem; font-weight: 800; color: #3b82f6; margin: 0.5rem 0 0 0;">{{ \App\Models\Lead::where('status', 'New')->count() }}</p>
                    </div>
                    <div class="admin-card text-center" style="padding: 1.25rem; margin-bottom: 0; border-left: 4px solid #eab308;">
                        <h4 style="margin: 0; font-size: 0.85rem; color: var(--admin-text-muted); text-transform: uppercase;">Contacted</h4>
                        <p style="font-size: 2.25rem; font-weight: 800; color: #eab308; margin: 0.5rem 0 0 0;">{{ \App\Models\Lead::where('status', 'Contacted')->count() }}</p>
                    </div>
                    <div class="admin-card text-center" style="padding: 1.25rem; margin-bottom: 0; border-left: 4px solid #f97316;">
                        <h4 style="margin: 0; font-size: 0.85rem; color: var(--admin-text-muted); text-transform: uppercase;">In Progress</h4>
                        <p style="font-size: 2.25rem; font-weight: 800; color: #f97316; margin: 0.5rem 0 0 0;">{{ \App\Models\Lead::where('status', 'In Progress')->count() }}</p>
                    </div>
                    <div class="admin-card text-center" style="padding: 1.25rem; margin-bottom: 0; border-left: 4px solid #22c55e;">
                        <h4 style="margin: 0; font-size: 0.85rem; color: var(--admin-text-muted); text-transform: uppercase;">Closed</h4>
                        <p style="font-size: 2.25rem; font-weight: 800; color: #22c55e; margin: 0.5rem 0 0 0;">{{ \App\Models\Lead::where('status', 'Closed')->count() }}</p>
                    </div>
                </div>

                <!-- Leads Table Card -->
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                        <div>
                            <h2>Lead Records</h2>
                            <span style="font-size: 0.85rem; color: var(--admin-text-muted);">Manage your customer queries and requests</span>
                        </div>
                        <div style="display: flex; gap: 0.75rem; align-items: center;">
                            <a href="{{ route('admin.leads.export') }}" class="btn" style="background-color: var(--primary-teal); color: white; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; padding: 0.5rem 1rem; border-radius: 4px; font-weight: 600; font-size: 0.9rem;">
                                <i data-lucide="download" style="width: 16px; height: 16px; vertical-align: middle;"></i> Export CSV Sheet
                            </a>
                            <button type="button" onclick="submitBulkDelete()" id="btn-bulk-delete" class="btn" style="background-color: #ef4444; color: white; display: none; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: none; border-radius: 4px; font-weight: 600; font-size: 0.9rem; cursor: pointer;">
                                <i data-lucide="trash-2" style="width: 16px; height: 16px; vertical-align: middle;"></i> Delete Selected (<span id="bulk-select-count">0</span>)
                            </button>
                        </div>
                    </div>

                    @if($leads->isEmpty())
                        <div style="text-align: center; padding: 3rem 1.5rem; color: var(--admin-text-muted);">
                            <i data-lucide="inbox" style="width: 48px; height: 48px; stroke-width: 1.5; margin-bottom: 1rem; color: #cbd5e1;"></i>
                            <p style="font-size: 1.1rem; margin-bottom: 0.25rem;">No leads found</p>
                            <p style="font-size: 0.85rem;">When clients submit a form on the website, they will appear here.</p>
                        </div>
                    @else
                        <form id="bulk-delete-form" action="{{ route('admin.leads.bulk-delete') }}" method="POST" style="margin: 0;">
                            @csrf
                            <div class="admin-table-wrap">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px; text-align: center;">
                                                <input type="checkbox" id="check-all-leads" onchange="toggleAllLeads(this)" style="cursor: pointer;">
                                            </th>
                                            <th>Date & Time</th>
                                            <th>Client Information</th>
                                            <th>Source</th>
                                            <th>Status</th>
                                            <th style="text-align: right;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leads as $lead)
                                            <!-- Main Info Row -->
                                            <tr id="lead-row-{{ $lead->id }}">
                                                <td style="text-align: center;">
                                                    <input type="checkbox" name="ids[]" value="{{ $lead->id }}" class="lead-checkbox" onchange="updateBulkDeleteState()" style="cursor: pointer;">
                                                </td>
                                                <td style="font-size: 0.85rem; color: var(--admin-text-muted); white-space: nowrap;">
                                                    {{ $lead->created_at->format('d M Y, h:i A') }}<br>
                                                    <small style="color: #94a3b8;">{{ $lead->created_at->diffForHumans() }}</small>
                                                </td>
                                                <td>
                                                    <strong style="font-size: 1.05rem; color: var(--primary-teal-dark); display: block;">{{ $lead->name }}</strong>
                                                    <div style="display: flex; gap: 10px; margin-top: 0.25rem; font-size: 0.85rem;">
                                                        <a href="tel:{{ $lead->phone }}" style="color: var(--accent-orange); display: flex; align-items: center; gap: 4px; font-weight: 500;">
                                                            <i data-lucide="phone" style="width: 12px; height: 12px;"></i> {{ $lead->phone }}
                                                        </a>
                                                        @if($lead->email)
                                                            <a href="mailto:{{ $lead->email }}" style="color: var(--admin-text-muted); display: flex; align-items: center; gap: 4px;">
                                                                <i data-lucide="mail" style="width: 12px; height: 12px;"></i> {{ $lead->email }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if(str_contains($lead->source, 'Careers Application'))
                                                        <span class="badge" style="background-color: #f3e8ff; color: #6b21a8; border: 1px solid #d8b4fe; font-size: 0.75rem; font-weight: 600;">
                                                            <i data-lucide="briefcase" style="width: 11px; height: 11px; display: inline-block; vertical-align: middle;"></i> {{ $lead->source }}
                                                        </span>
                                                    @elseif(str_contains($lead->source, 'Project Enquiry'))
                                                        <span class="badge" style="background-color: #fef3c7; color: #92400e; border: 1px solid #fcd34d; font-size: 0.75rem; font-weight: 600;">
                                                            <i data-lucide="layers" style="width: 11px; height: 11px; display: inline-block; vertical-align: middle;"></i> {{ $lead->source }}
                                                        </span>
                                                    @elseif(str_contains($lead->source, 'Application Consultation'))
                                                        <span class="badge" style="background-color: #ccfbf1; color: #115e59; border: 1px solid #5eead4; font-size: 0.75rem; font-weight: 600;">
                                                            <i data-lucide="compass" style="width: 11px; height: 11px; display: inline-block; vertical-align: middle;"></i> {{ $lead->source }}
                                                        </span>
                                                    @else
                                                        <span class="badge" style="background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-size: 0.75rem;">
                                                            {{ $lead->source }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($lead->status === 'New')
                                                        <span class="badge" style="background-color: #dbeafe; color: #1e40af;">New</span>
                                                    @elseif($lead->status === 'Contacted')
                                                        <span class="badge" style="background-color: #fef9c3; color: #854d0e;">Contacted</span>
                                                    @elseif($lead->status === 'In Progress')
                                                        <span class="badge" style="background-color: #ffedd5; color: #9a3412;">In Progress</span>
                                                    @elseif($lead->status === 'Closed')
                                                        <span class="badge" style="background-color: #dcfce7; color: #166534;">Closed</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: right; white-space: nowrap;">
                                                    <button type="button" onclick="toggleLeadDetails({{ $lead->id }})" class="btn-action edit" title="View Details / Edit" style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 4px; font-weight: 500; font-size: 0.85rem; border: 1px solid #ffffff; background-color: transparent; color: #ffffff;">
                                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i> Details
                                                    </button>
                                                </td>
                                            </tr>
                                            
                                            <!-- Inline Expandable Detail/Edit Form Row -->
                                            <tr id="lead-details-{{ $lead->id }}" class="lead-detail-row" style="display: none; background-color: var(--admin-dark-sidebar);">
                                                <td colspan="6" style="padding: 1.5rem; border-top: 1px dashed var(--admin-border); border-bottom: 1px dashed var(--admin-border);">
                                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                                                        
                                                        <!-- Details Section -->
                                                        <div>
                                                            <h4 style="margin: 0 0 0.75rem 0; color: var(--mint-green); font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 0;">Lead Information Details</h4>
                                                            <div style="background-color: rgba(255,255,255,0.02); border: 1px solid var(--admin-border); border-radius: var(--radius-md); padding: 1rem; font-size: 0.9rem; line-height: 1.5; color: rgba(255,255,255,0.95);">
                                                                {!! nl2br(e($lead->message)) !!}
                                                            </div>
                                                            @php
                                                                preg_match_all('#https?://[^\s]+#', $lead->message, $fileMatches);
                                                                $detectedUrls = $fileMatches[0] ?? [];
                                                            @endphp
                                                            @if(!empty($detectedUrls))
                                                                <div style="margin-top: 0.75rem; display: flex; flex-wrap: wrap; gap: 8px;">
                                                                    @foreach($detectedUrls as $detectedUrl)
                                                                        <a href="{{ $detectedUrl }}" target="_blank" rel="noopener noreferrer" class="btn" style="background: var(--accent-gold); color: #000; font-weight: 600; font-size: 0.82rem; padding: 0.4rem 0.85rem; border-radius: 4px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                                                                            <i data-lucide="download" style="width: 14px; height: 14px;"></i>
                                                                            @if(str_contains($detectedUrl, 'uploads/resumes'))
                                                                                Download Candidate Resume
                                                                            @elseif(str_contains($detectedUrl, 'uploads/enquiries'))
                                                                                Download Project Attachment / BOQ
                                                                            @else
                                                                                Open Attached File
                                                                            @endif
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            @if($lead->notes)
                                                                <div style="margin-top: 1rem;">
                                                                    <h5 style="margin: 0 0 0.5rem 0; color: rgba(255,255,255,0.6); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Admin Notes History</h5>
                                                                    <p style="font-size: 0.85rem; color: rgba(255,255,255,0.85); font-style: italic; background-color: rgba(255,255,255,0.02); padding: 0.50rem 0.75rem; border-radius: 4px; border-left: 3px solid var(--mint-green); margin: 0;">
                                                                        {{ $lead->notes }}
                                                                    </p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <!-- Actions & Notes Form Section -->
                                                        <div>
                                                            <h4 style="margin: 0 0 0.75rem 0; color: var(--mint-green); font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.5px; border: none; padding: 0;">Update Status & Actions</h4>
                                                            <form action="{{ route('admin.leads.update', $lead->id) }}" method="POST" style="margin-bottom: 0;">
                                                                @csrf
                                                                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                                                    <div class="form-group">
                                                                        <label style="font-size: 0.8rem; font-weight: 600; display: block; margin-bottom: 4px;">Lead Status</label>
                                                                        <select name="status" class="form-control" required style="padding: 0.5rem; height: auto; background-color: var(--admin-dark-bg); color: #ffffff;">
                                                                            <option value="New" @selected($lead->status === 'New') style="background-color: var(--admin-dark-bg); color: #ffffff;">New</option>
                                                                            <option value="Contacted" @selected($lead->status === 'Contacted') style="background-color: var(--admin-dark-bg); color: #ffffff;">Contacted</option>
                                                                            <option value="In Progress" @selected($lead->status === 'In Progress') style="background-color: var(--admin-dark-bg); color: #ffffff;">In Progress</option>
                                                                            <option value="Closed" @selected($lead->status === 'Closed') style="background-color: var(--admin-dark-bg); color: #ffffff;">Closed</option>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label style="font-size: 0.8rem; font-weight: 600; display: block; margin-bottom: 4px;">Internal Follow-up Notes</label>
                                                                        <textarea name="notes" class="form-control" rows="3" placeholder="Write internal notes about client conversation..." style="font-size: 0.85rem; padding: 0.5rem; background-color: var(--admin-dark-bg); color: #ffffff;">{{ $lead->notes }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn-submit" style="padding: 0.5rem 1rem; width: auto; margin-top: 0.75rem; font-size: 0.85rem;">
                                                                    Update Status & Notes
                                                                </button>
                                                            </form>
                                                            
                                                            <hr style="border: 0; border-top: 1px solid var(--admin-border); margin: 1.25rem 0;">
                                                            
                                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                                <span style="font-size: 0.8rem; color: #94a3b8;">Dangerous operation:</span>
                                                                <form action="{{ route('admin.leads.delete', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this lead record?');" style="margin: 0;">
                                                                    @csrf
                                                                    <button type="submit" class="btn-action delete" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; display: flex; align-items: center; gap: 4px; height: auto; background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; border-radius: 4px; cursor: pointer;">
                                                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i> Delete Lead Record
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        
                        <!-- Custom Leads Pagination -->
                        <div class="admin-pagination" style="margin-top: 1.5rem; display: flex; justify-content: center; align-items: center; gap: 1rem;">
                            @if ($leads->onFirstPage())
                                <span class="btn-action" style="opacity: 0.5; cursor: not-allowed; padding: 0.5rem 1rem;"><i data-lucide="chevron-left"></i> Previous</span>
                            @else
                                <a href="{{ $leads->appends(['blogs_page' => request('blogs_page')])->previousPageUrl() }}#tab-leads" class="btn-action" style="padding: 0.5rem 1rem; color: #fff; background: var(--admin-input-bg); border-radius: var(--radius-md); text-decoration: none;"><i data-lucide="chevron-left"></i> Previous</a>
                            @endif

                            <span style="color: var(--admin-text-muted); font-size: 0.9rem;">Page {{ $leads->currentPage() }} of {{ $leads->lastPage() }}</span>

                            @if ($leads->hasMorePages())
                                <a href="{{ $leads->appends(['blogs_page' => request('blogs_page')])->nextPageUrl() }}#tab-leads" class="btn-action" style="padding: 0.5rem 1rem; color: #fff; background: var(--admin-input-bg); border-radius: var(--radius-md); text-decoration: none;">Next <i data-lucide="chevron-right"></i></a>
                            @else
                                <span class="btn-action" style="opacity: 0.5; cursor: not-allowed; padding: 0.5rem 1rem;">Next <i data-lucide="chevron-right"></i></span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- LIVE CHAT MANAGER TAB -->
            <div class="tab-panel @if($activeTab === 'livechat') active @endif" id="tab-livechat">
                <div class="admin-card" style="padding: 0; overflow: hidden; display: flex; height: calc(100vh - 160px); min-height: 500px; border: 1px solid var(--admin-border); background-color: var(--admin-dark-sidebar); border-radius: var(--radius-lg);">
                    
                    <!-- Chat Sessions List (Sidebar) -->
                    <div style="width: 320px; border-right: 1px solid var(--admin-border); display: flex; flex-direction: column; background-color: var(--admin-dark-sidebar);">
                        <div style="padding: 1.25rem; border-bottom: 1px solid var(--admin-border); display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h2 style="margin: 0; font-size: 1.2rem;">Live Support Chats</h2>
                                <p style="margin: 4px 0 0 0; font-size: 0.8rem; color: var(--admin-text-muted);">Real-time patient chat sessions</p>
                            </div>
                            <button type="button" onclick="loadAdminChatSessions(); if(typeof showToast === 'function') showToast('Chat list refreshed!', 'success');" style="padding: 6px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 4px; color: var(--mint-green); cursor: pointer; display: flex; align-items: center; justify-content: center; height: auto;" title="Refresh Chat List">
                                <i data-lucide="refresh-cw" style="width: 14px; height: 14px;"></i>
                            </button>
                        </div>
                        <div id="admin-chat-sessions-list" style="flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column;">
                            <!-- Active sessions loaded dynamically -->
                            <div style="padding: 2rem; text-align: center; color: var(--admin-text-muted); font-size: 0.9rem;">
                                Loading chat sessions...
                            </div>
                        </div>
                    </div>

                    <!-- Conversation Window (Main) -->
                    <div style="flex-grow: 1; display: flex; flex-direction: column; background-color: var(--admin-dark-bg);">
                        <!-- Conversation Header -->
                        <div id="admin-chat-header" style="padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--admin-border); display: flex; justify-content: space-between; align-items: center; background-color: var(--admin-dark-sidebar);">
                            <div>
                                <h3 id="admin-chat-header-title" style="margin: 0; font-size: 1.05rem; color: var(--mint-green);">Select a Chat</h3>
                                <p id="admin-chat-header-subtitle" style="margin: 2px 0 0 0; font-size: 0.8rem; color: var(--admin-text-muted);">Please pick a patient chat session from the list to start responding.</p>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <button type="button" id="admin-chat-refresh-btn" onclick="loadAdminChatMessages(); if(typeof showToast === 'function') showToast('Conversation refreshed!', 'success');" style="display: none; align-items: center; gap: 4px; padding: 6px 12px; font-size: 0.8rem; height: auto; background-color: rgba(92, 203, 179, 0.1); color: var(--mint-green); border: 1px solid rgba(92, 203, 179, 0.2); border-radius: 4px; cursor: pointer;">
                                    <i data-lucide="refresh-cw" style="width: 14px; height: 14px;"></i> Refresh Messages
                                </button>
                                <button type="button" id="admin-chat-delete-btn" onclick="deleteCurrentChat()" class="btn-action delete" style="display: none; align-items: center; gap: 4px; padding: 6px 12px; font-size: 0.8rem; height: auto; background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; border-radius: 4px; cursor: pointer;">
                                    <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i> Close & Delete Chat
                                </button>
                            </div>
                        </div>


                        <!-- Messages Content area -->
                        <div id="admin-chat-messages-wrap" style="flex-grow: 1; padding: 1.5rem; overflow-y: auto; display: flex; flex-direction: column; gap: 12px;">
                            <div style="margin: auto; text-align: center; color: var(--admin-text-muted);">
                                <i data-lucide="message-square" style="width: 48px; height: 48px; stroke-width: 1.25; margin-bottom: 0.75rem; color: var(--admin-border);"></i>
                                <p style="font-size: 0.95rem; margin: 0;">No Chat Selected</p>
                            </div>
                        </div>

                        <!-- Chat Reply Input area -->
                        <div id="admin-chat-input-wrap" style="padding: 1rem 1.5rem; border-top: 1px solid var(--admin-border); background-color: var(--admin-dark-sidebar); display: none; gap: 10px;">
                            <input type="text" id="admin-chat-reply-input" placeholder="Type your reply here..." onkeydown="handleAdminChatKey(event)" style="flex-grow: 1; background-color: var(--admin-input-bg); border: 1px solid var(--admin-border); color: white; padding: 0.75rem 1rem; border-radius: 24px; outline: none; font-size: 0.9rem;">
                            <button type="button" onclick="sendAdminReply()" class="btn" style="background-color: var(--primary-teal); color: white; border: none; padding: 0 1.25rem; border-radius: 24px; font-weight: 600; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                                Send <i data-lucide="send" style="width: 14px; height: 14px;"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- 2. BRANDING & LOGOS TAB -->
            <div class="tab-panel @if($activeTab === 'branding') active @endif" id="tab-branding">
                <form action="{{ route('admin.parameters.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="admin-card">
                        <h2>Website Information</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="site_name">Website Name</label>
                                <input type="text" id="site_name" name="site_name" class="form-control" value="{{ $site['site_name'] ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="site_tagline">Website Tagline</label>
                                <input type="text" id="site_tagline" name="site_tagline" class="form-control" value="{{ $site['site_tagline'] ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <h2>Logo & Favicon Customization</h2>
                        <p style="font-size:0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Uploaded images are automatically converted to <strong>WebP format</strong> on the server for web speed optimizations. SVG format files will be uploaded untouched.
                        </p>
                        
                        <div class="form-grid">
                            <!-- Logo file -->
                            <div class="form-group">
                                <label style="font-weight: 600; font-size: 0.95rem;">Header &amp; Footer Brand Logo</label>
                                @php
                                    $activeLogo = !empty($site['logo_path']) ? $site['logo_path'] : 'assets/brand/logo-white.png';
                                    $activeFavicon = !empty($site['favicon_path']) ? $site['favicon_path'] : 'assets/brand/favicon.ico';
                                @endphp
                                <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 12px; margin-top: 8px;">
                                    <div style="background: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 10px 16px; min-height: 56px; display: inline-flex; align-items: center; justify-content: center; box-shadow: inset 0 2px 4px rgba(0,0,0,0.4);">
                                        <img src="{{ site_image($activeLogo) }}" alt="Active Logo" style="height: 38px; max-width: 180px; object-fit: contain;">
                                    </div>
                                    <div style="font-size: 0.8rem; color: var(--admin-text-muted);">
                                        <div><strong style="color: #fff;">Current Active Logo:</strong></div>
                                        <code style="color: var(--mint-green, #5ccbb3);">{{ $activeLogo }}</code>
                                    </div>
                                </div>
                                <label style="font-size: 0.82rem; color: var(--admin-text-muted);">Upload New Logo (Replaces Current)</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                <div style="margin-top: 10px;">
                                    <label style="font-size: 0.82rem; color: var(--admin-text-muted);">Or Paste Logo Path / URL</label>
                                    <input type="text" name="logo_url" class="form-control" value="{{ $site['logo_path'] ?? 'assets/brand/logo-white.png' }}" placeholder="assets/brand/logo-white.png">
                                </div>
                            </div>
                            
                            <!-- Favicon file -->
                            <div class="form-group">
                                <label style="font-weight: 600; font-size: 0.95rem;">Browser Favicon (.ico / .png / .svg)</label>
                                <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 12px; margin-top: 8px;">
                                    <div style="background: #0f172a; border: 1px solid #334155; border-radius: 8px; padding: 8px; width: 56px; height: 56px; display: inline-flex; align-items: center; justify-content: center; box-shadow: inset 0 2px 4px rgba(0,0,0,0.4);">
                                        <img src="{{ site_image($activeFavicon) }}" alt="Active Favicon" style="width: 32px; height: 32px; object-fit: contain;">
                                    </div>
                                    <div style="font-size: 0.8rem; color: var(--admin-text-muted);">
                                        <div><strong style="color: #fff;">Current Active Favicon:</strong></div>
                                        <code style="color: var(--mint-green, #5ccbb3);">{{ $activeFavicon }}</code>
                                    </div>
                                </div>
                                <label style="font-size: 0.82rem; color: var(--admin-text-muted);">Upload New Favicon</label>
                                <input type="file" name="favicon" class="form-control" accept="image/*">
                                <div style="margin-top: 10px;">
                                    <label style="font-size: 0.82rem; color: var(--admin-text-muted);">Or Paste Favicon Path / URL</label>
                                    <input type="text" name="favicon_url" class="form-control" value="{{ $site['favicon_path'] ?? 'assets/brand/favicon.ico' }}" placeholder="assets/brand/favicon.ico">
                                </div>
                            </div>
                        </div>
                </div>

                    <div class="admin-card" style="margin-top: 1.5rem;">
                        <h2>Live Chat Widget Customization</h2>
                        <div class="form-grid">
                            <!-- Chat Assistant Name -->
                            <div class="form-group">
                                <label for="chat_assistant_name">Chat Assistant Display Name</label>
                                <input type="text" id="chat_assistant_name" name="chat_assistant_name" class="form-control" value="{{ $site['chat_assistant_name'] ?? 'Clinic Assistant' }}" required>
                            </div>
                            
                            <!-- Chat Assistant Avatar File -->
                            <div class="form-group">
                                <label>Chat Assistant Avatar (Upload File)</label>
                                <input type="file" name="chat_assistant_avatar" class="form-control" accept="image/*">
                                <div style="margin-top: 10px;">
                                    <label>Or Paste Avatar Image URL</label>
                                    <input type="text" name="chat_assistant_avatar_url" class="form-control" value="{{ !empty($site['chat_assistant_avatar']) && (str_starts_with($site['chat_assistant_avatar'], 'http') || str_starts_with($site['chat_assistant_avatar'], '//')) ? $site['chat_assistant_avatar'] : '' }}" placeholder="https://example.com/avatar.webp">
                                </div>
                                <div class="image-preview-container" style="margin-top: 15px; display: flex; align-items: center; gap: 12px;">
                                    <div class="image-preview" style="border-radius: 50%; overflow: hidden; width: 60px; height: 60px; border: 2px solid var(--admin-border); display: flex; align-items: center; justify-content: center;">
                                        @if(!empty($site['chat_assistant_avatar']))
                                            <img src="{{ site_image($site['chat_assistant_avatar']) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div style="background-color: var(--secondary-teal); color: white; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; font-size: 0.95rem; font-weight: bold; font-family: 'Outfit';">
                                                CA
                                            </div>
                                        @endif
                                    </div>
                                    @if(!empty($site['chat_assistant_avatar']) && !str_starts_with($site['chat_assistant_avatar'], 'http') && !str_starts_with($site['chat_assistant_avatar'], '//'))
                                        <span class="badge-webp">WebP Optimized</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Save Branding</button>
                </form>
            </div>

                        <!-- HEADER MENU BUILDER TAB -->
            <div class="tab-panel @if($activeTab === 'headermenu') active @endif" id="tab-headermenu">
                <div class="admin-card">
                    <h2>Add New Navigation Menu Item</h2>
                    <p style="font-size:0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -0.5rem;">
                        Add links to your Primary Header Nav, Services Mega-Menu columns, or Portfolio Dropdown.
                    </p>
                    <form action="{{ route('admin.menu.store') }}" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="menu_type">Menu Section / Location</label>
                                <select name="menu_type" id="menu_type" class="form-control" required onchange="toggleMegaFields(this.value)">
                                    <option value="header">Main Header Navigation</option>
                                    <option value="mega_services">Services Mega-Menu Item</option>
                                    <option value="portfolio_menu">Portfolio Dropdown Item</option>
                                    <option value="footer_col1">Footer Column 1 (Services)</option>
                                    <option value="footer_col2">Footer Column 2 (Company)</option>
                                    <option value="footer_col3">Footer Column 3 (Resources)</option>
                                    <option value="footer_col4">Footer Column 4 (Legal)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="menu_title">Menu Label / Title</label>
                                <input type="text" id="menu_title" name="title" class="form-control" placeholder="e.g. Lead Generation" required>
                            </div>

                            <div class="form-group">
                                <label for="menu_url">Destination URL / Link</label>
                                <input type="text" id="menu_url" name="url" class="form-control" placeholder="e.g. /services/lead-generation" required>
                            </div>

                            <div class="form-group" id="group_cat_field">
                                <label for="menu_category_group">Mega-Menu Category (For Mega Menu)</label>
                                <input type="text" id="menu_category_group" name="category_group" class="form-control" placeholder="01 DIGITAL MARKETING, 02 CONTENT AND REPUTATION, etc.">
                            </div>

                            <div class="form-group" id="group_desc_field">
                                <label for="menu_desc">Short Subtitle / Description</label>
                                <input type="text" id="menu_desc" name="description" class="form-control" placeholder="e.g. Campaigns judged by the inquiries they create.">
                            </div>

                            <div class="form-group" id="group_icon_field" style="display:none;">
                                <label for="menu_icon">Service Dropdown Icon</label>
                                <select id="menu_icon" name="icon" class="form-control">
                                    <option value="">-- Select Icon --</option>
                                    <option value="search">Search Glass (SEO)</option>
                                    <option value="camera">Instagram Camera (Social Media Marketing)</option>
                                    <option value="trending-up">Trending Up Arrow (Lead Generation)</option>
                                    <option value="download">Inbound Arrow / Tray (Inbound Marketing)</option>
                                    <option value="layout">Layout / Browser Window (Digital Media Planning)</option>
                                    <option value="file-text">Document / Text File (Content Marketing)</option>
                                    <option value="video">Video Camera (Video Marketing)</option>
                                    <option value="users">Users / Group (Influencer Marketing)</option>
                                    <option value="star">Star Badge (Online Reputation Management)</option>
                                    <option value="bar-chart-2">Bar Chart (Social Media Analytics)</option>
                                    <option value="monitor">Monitor Screen (Website Design &amp; Development)</option>
                                    <option value="smartphone">Smartphone Device (Mobile Application Development)</option>
                                    <option value="cpu">Automation Sun / Gear (Marketing Automation)</option>
                                    <option value="smile">Smiley Face (Sentiment Analysis)</option>
                                    <option value="cloud">Cloud (DevOps Services)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="menu_sort">Sort Order (Lower = First)</label>
                                <input type="number" id="menu_sort" name="sort_order" class="form-control" value="0">
                            </div>
                        </div>

                        <div style="margin-top: 1.25rem; display: flex; align-items: center; gap: 15px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: var(--admin-text-main);">
                                <input type="checkbox" name="is_active" value="1" checked style="width: 18px; height: 18px;">
                                Active on Frontend
                            </label>
                            <button type="submit" class="btn-submit" style="margin: 0;">Add Menu Item</button>
                        </div>
                    </form>
                </div>

                <!-- Main Header Nav Table -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <h2>Main Header Navigation Links</h2>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Label</th>
                                    <th>Destination URL</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuItems->where('menu_type', 'header') as $hItem)
                                    <tr>
                                        <td><strong>{{ $hItem->sort_order }}</strong></td>
                                        <td><strong>{{ $hItem->title }}</strong></td>
                                        <td><code>{{ $hItem->url }}</code></td>
                                        <td>
                                            @if($hItem->is_active)
                                                <span style="background: rgba(46,213,115,0.15); color: #2ed573; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">Active</span>
                                            @else
                                                <span style="background: rgba(255,71,87,0.15); color: #ff4757; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">Hidden</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-menu-btn" 
                                                data-id="{{ $hItem->id }}"
                                                data-title="{{ $hItem->title }}"
                                                data-url="{{ $hItem->url }}"
                                                data-type="{{ $hItem->menu_type }}"
                                                data-category="{{ $hItem->category_group ?? '' }}"
                                                data-description="{{ $hItem->description ?? '' }}"
                                                data-sort="{{ $hItem->sort_order }}"
                                                data-active="{{ $hItem->is_active ? '1' : '0' }}"
                                                onclick="openMenuEditModal(this)"
                                                title="Edit Menu Item">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.menu.delete', $hItem->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this menu item?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Menu Item"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--admin-text-muted); padding: 2rem;">No header menu items found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mega-Menu (Services) Items Table -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <h2>Services Mega-Menu Dropdown Items (Categorized by Columns)</h2>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Column Category</th>
                                    <th>Order</th>
                                    <th>Icon</th>
                                    <th>Service Title</th>
                                    <th>Subtitle / Tagline</th>
                                    <th>URL</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuItems->where('menu_type', 'mega_services') as $mItem)
                                    <tr>
                                        <td><span style="font-weight: 600; color: var(--admin-gold, #c5a880);">{{ $mItem->category_group ?? '01 DIGITAL MARKETING' }}</span></td>
                                        <td>{{ $mItem->sort_order }}</td>
                                        <td>
                                            <div style="display:inline-flex; align-items:center; gap:6px;">
                                                <span style="display:inline-flex; align-items:center; justify-content:center; width:28px; height:28px; background:rgba(255,255,255,0.06); border-radius:6px; color:#5ccbb3;">
                                                    {!! service_icon($mItem->icon, $mItem->url) !!}
                                                </span>
                                                <code style="font-size:0.75rem; color:#94a3b8;">{{ $mItem->icon ?? 'search' }}</code>
                                            </div>
                                        </td>
                                        <td><strong>{{ $mItem->title }}</strong></td>
                                        <td style="color: var(--admin-text-muted); font-size: 0.85rem;">{{ $mItem->description }}</td>
                                        <td><code>{{ $mItem->url }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-menu-btn" 
                                                data-id="{{ $mItem->id }}"
                                                data-title="{{ $mItem->title }}"
                                                data-url="{{ $mItem->url }}"
                                                data-type="{{ $mItem->menu_type }}"
                                                data-category="{{ $mItem->category_group ?? '' }}"
                                                data-icon="{{ $mItem->icon ?? '' }}"
                                                data-description="{{ $mItem->description ?? '' }}"
                                                data-sort="{{ $mItem->sort_order }}"
                                                data-active="{{ $mItem->is_active ? '1' : '0' }}"
                                                onclick="openMenuEditModal(this)"
                                                title="Edit Mega-Menu Item">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.menu.delete', $mItem->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this mega-menu item?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Mega-Menu Item"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: var(--admin-text-muted); padding: 2rem;">No mega-menu items found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Portfolio Dropdown Menu Items Table -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <h2>Portfolio Dropdown Menu Links</h2>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuItems->where('menu_type', 'portfolio_menu') as $pItem)
                                    <tr>
                                        <td>{{ $pItem->sort_order }}</td>
                                        <td><strong>{{ $pItem->title }}</strong></td>
                                        <td style="color: var(--admin-text-muted);">{{ $pItem->description }}</td>
                                        <td><code>{{ $pItem->url }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-menu-btn" 
                                                data-id="{{ $pItem->id }}"
                                                data-title="{{ $pItem->title }}"
                                                data-url="{{ $pItem->url }}"
                                                data-type="{{ $pItem->menu_type }}"
                                                data-category=""
                                                data-description="{{ $pItem->description ?? '' }}"
                                                data-sort="{{ $pItem->sort_order }}"
                                                data-active="{{ $pItem->is_active ? '1' : '0' }}"
                                                onclick="openMenuEditModal(this)"
                                                title="Edit Portfolio Link">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.menu.delete', $pItem->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this item?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Portfolio Link"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--admin-text-muted); padding: 2rem;">No portfolio menu items found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- FOOTER BUILDER TAB -->
            <div class="tab-panel @if($activeTab === 'footermenu') active @endif" id="tab-footermenu">
                <!-- Footer General Information -->
                <div class="admin-card">
                    <h2>Footer Brand & Information</h2>
                    <form action="{{ route('admin.page-contents.update') }}" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Footer Tagline</label>
                                <input type="text" name="contents[footer][about][tagline]" class="form-control" value="{{ \App\Models\PageContent::getValue('footer', 'about', 'tagline', 'Social · Mobile · Analytics · Cloud') }}" required>
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Footer Description / Blurb</label>
                                <textarea name="contents[footer][about][description]" rows="3" class="form-control" required>{{ \App\Models\PageContent::getValue('footer', 'about', 'description', 'Performance-driven digital marketing agency across India and the US.') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Column 1 Heading</label>
                                <input type="text" name="contents[footer][headings][col1]" class="form-control" value="{{ \App\Models\PageContent::getValue('footer', 'headings', 'col1', 'Our Services') }}">
                            </div>
                            <div class="form-group">
                                <label>Column 2 Heading</label>
                                <input type="text" name="contents[footer][headings][col2]" class="form-control" value="{{ \App\Models\PageContent::getValue('footer', 'headings', 'col2', 'Quick Links') }}">
                            </div>
                            <div class="form-group">
                                <label>Column 3 Heading</label>
                                <input type="text" name="contents[footer][headings][col3]" class="form-control" value="{{ \App\Models\PageContent::getValue('footer', 'headings', 'col3', 'Subscription') }}">
                            </div>
                            <div class="form-group">
                                <label>Column 4 Heading</label>
                                <input type="text" name="contents[footer][headings][col4]" class="form-control" value="{{ \App\Models\PageContent::getValue('footer', 'headings', 'col4', 'Legal') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Copyright Notice</label>
                                <input type="text" name="contents[footer][bottom][copyright]" class="form-control" value="{{ \App\Models\PageContent::getValue('footer', 'bottom', 'copyright', '© ' . date('Y') . ' SMAC Digital. All rights reserved.') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit" style="margin-top: 1rem;">Save Footer Information</button>
                    </form>
                </div>

                <!-- Footer Links Management (Columns 1 to 4) -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <h2>Manage Footer Links by Column</h2>
                    <p style="font-size:0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -0.5rem;">
                        Add and edit navigation links for each column in the site footer.
                    </p>

                    <!-- Add Footer Link Form -->
                    <form action="{{ route('admin.menu.store') }}" method="POST" style="background: var(--admin-card-inner-bg, #141418); padding: 1.25rem; border-radius: 8px; border: 1px solid var(--admin-border, #2d2d38); margin-bottom: 1.5rem;">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Select Footer Column</label>
                                <select name="menu_type" class="form-control" required>
                                    <option value="footer_col1">Column 1: Services</option>
                                    <option value="footer_col2">Column 2: Company / Quick Links</option>
                                    <option value="footer_col3">Column 3: Resources</option>
                                    <option value="footer_col4">Column 4: Legal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Link Title / Label</label>
                                <input type="text" name="title" class="form-control" placeholder="e.g. Search Engine Optimization" required>
                            </div>
                            <div class="form-group">
                                <label>Link URL</label>
                                <input type="text" name="url" class="form-control" placeholder="e.g. /services/search-engine-optimization" required>
                            </div>
                            <div class="form-group">
                                <label>Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" value="0">
                            </div>
                        </div>
                        <div style="margin-top: 1rem; display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn-submit" style="margin: 0;">Add Link to Column</button>
                        </div>
                    </form>

                    <!-- Column 1 Services Links -->
                    <h3 style="font-size: 1.05rem; color: var(--admin-gold, #c5a880); margin: 1.5rem 0 0.75rem 0;">Column 1: Services Links</h3>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Link Label</th>
                                    <th>URL</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuItems->where('menu_type', 'footer_col1') as $f1)
                                    <tr>
                                        <td>{{ $f1->sort_order }}</td>
                                        <td><strong>{{ $f1->title }}</strong></td>
                                        <td><code>{{ $f1->url }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-menu-btn" 
                                                data-id="{{ $f1->id }}"
                                                data-title="{{ $f1->title }}"
                                                data-url="{{ $f1->url }}"
                                                data-type="{{ $f1->menu_type }}"
                                                data-category=""
                                                data-description=""
                                                data-sort="{{ $f1->sort_order }}"
                                                data-active="{{ $f1->is_active ? '1' : '0' }}"
                                                onclick="openMenuEditModal(this)"
                                                title="Edit Footer Link">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.menu.delete', $f1->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this link?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Footer Link"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align: center; color: var(--admin-text-muted);">No links in Column 1.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Column 2 Quick Links -->
                    <h3 style="font-size: 1.05rem; color: var(--admin-gold, #c5a880); margin: 2rem 0 0.75rem 0;">Column 2: Company / Quick Links</h3>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Link Label</th>
                                    <th>URL</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuItems->where('menu_type', 'footer_col2') as $f2)
                                    <tr>
                                        <td>{{ $f2->sort_order }}</td>
                                        <td><strong>{{ $f2->title }}</strong></td>
                                        <td><code>{{ $f2->url }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-menu-btn" 
                                                data-id="{{ $f2->id }}"
                                                data-title="{{ $f2->title }}"
                                                data-url="{{ $f2->url }}"
                                                data-type="{{ $f2->menu_type }}"
                                                data-category=""
                                                data-description=""
                                                data-sort="{{ $f2->sort_order }}"
                                                data-active="{{ $f2->is_active ? '1' : '0' }}"
                                                onclick="openMenuEditModal(this)"
                                                title="Edit Footer Link">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.menu.delete', $f2->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this link?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Footer Link"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align: center; color: var(--admin-text-muted);">No links in Column 2.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Column 3 Resources Links -->
                    <h3 style="font-size: 1.05rem; color: var(--admin-gold, #c5a880); margin: 2rem 0 0.75rem 0;">Column 3: Resources Links</h3>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Link Label</th>
                                    <th>URL</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuItems->where('menu_type', 'footer_col3') as $f3)
                                    <tr>
                                        <td>{{ $f3->sort_order }}</td>
                                        <td><strong>{{ $f3->title }}</strong></td>
                                        <td><code>{{ $f3->url }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-menu-btn" 
                                                data-id="{{ $f3->id }}"
                                                data-title="{{ $f3->title }}"
                                                data-url="{{ $f3->url }}"
                                                data-type="{{ $f3->menu_type }}"
                                                data-category=""
                                                data-description=""
                                                data-sort="{{ $f3->sort_order }}"
                                                data-active="{{ $f3->is_active ? '1' : '0' }}"
                                                onclick="openMenuEditModal(this)"
                                                title="Edit Footer Link">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.menu.delete', $f3->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this link?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Footer Link"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align: center; color: var(--admin-text-muted);">No links in Column 3.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Column 4 Legal Links -->
                    <h3 style="font-size: 1.05rem; color: var(--admin-gold, #c5a880); margin: 2rem 0 0.75rem 0;">Column 4: Legal &amp; Policy Links</h3>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Link Label</th>
                                    <th>URL</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menuItems->where('menu_type', 'footer_col4') as $f4)
                                    <tr>
                                        <td>{{ $f4->sort_order }}</td>
                                        <td><strong>{{ $f4->title }}</strong></td>
                                        <td><code>{{ $f4->url }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-menu-btn" 
                                                data-id="{{ $f4->id }}"
                                                data-title="{{ $f4->title }}"
                                                data-url="{{ $f4->url }}"
                                                data-type="{{ $f4->menu_type }}"
                                                data-category=""
                                                data-description=""
                                                data-sort="{{ $f4->sort_order }}"
                                                data-active="{{ $f4->is_active ? '1' : '0' }}"
                                                onclick="openMenuEditModal(this)"
                                                title="Edit Footer Link">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.menu.delete', $f4->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this link?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Footer Link"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align: center; color: var(--admin-text-muted);">No links in Column 4.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 3. HOMEPAGE SLIDER TAB -->
                        <!-- 3. HOMEPAGE HERO BANNER & SLIDES TAB -->
            <div class="tab-panel @if($activeTab === 'slider') active @endif" id="tab-slider">
                <!-- Homepage Hero Banner Copy & Stats -->
                <div class="admin-card">
                    <h2>Homepage Hero Banner Content</h2>
                    <p style="font-size:0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -0.5rem;">
                        Control the main hero headline, pill badge, descriptive lede, and key stat metrics on your homepage.
                    </p>
                    <form action="{{ route('admin.page-contents.update') }}" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Hero Pill Badge</label>
                                <input type="text" name="contents[home][hero][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'badge', 'Social · Mobile · Analytics · Cloud') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Main Headline</label>
                                <input type="text" name="contents[home][hero][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'title', 'Turn attention into revenue.') }}" required>
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Hero Subtitle / Description</label>
                                <textarea name="contents[home][hero][subtitle]" rows="3" class="form-control" required>{{ \App\Models\PageContent::getValue('home', 'hero', 'subtitle', 'We combine strategy, creativity, technology, and performance marketing to help ambitious businesses reach the right audience and generate meaningful results.') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Primary CTA Button Text</label>
                                <input type="text" name="contents[home][hero][cta1_text]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'cta1_text', 'See the work') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Primary CTA Button Link</label>
                                <input type="text" name="contents[home][hero][cta1_url]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'cta1_url', '/portfolios') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Secondary CTA Button Text</label>
                                <input type="text" name="contents[home][hero][cta2_text]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'cta2_text', 'Get a free consultation') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Secondary CTA Button Link</label>
                                <input type="text" name="contents[home][hero][cta2_url]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'cta2_url', '#contact') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Metric / Stat 1 (Number)</label>
                                <input type="text" name="contents[home][hero][stat1_number]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'stat1_number', '$2Million+') }}">
                            </div>
                            <div class="form-group">
                                <label>Metric / Stat 1 (Label)</label>
                                <input type="text" name="contents[home][hero][stat1_label]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'hero', 'stat1_label', 'Monthly online sales') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit" style="margin-top: 1rem;">Save Hero Banner Content</button>
                    </form>
                </div>

                <!-- Add New Slide -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 10px;">
                        <h2 style="margin: 0;">Add Homepage Hero Slide (Optional Slideshow)</h2>
                    </div>
                    <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="slide_title">Slide Title</label>
                                <input type="text" id="slide_title" name="title" class="form-control" required placeholder="Enter slide main title">
                            </div>
                            <div class="form-group">
                                <label for="slide_subtitle">Slide Subtitle</label>
                                <input type="text" id="slide_subtitle" name="subtitle" class="form-control" placeholder="Enter supporting subtitle">
                            </div>
                            <div class="form-group">
                                <label for="slide_btn_text">Button Text</label>
                                <input type="text" id="slide_btn_text" name="button_text" class="form-control" placeholder="e.g. Explore Services">
                            </div>
                            <div class="form-group">
                                <label for="slide_btn_link">Button Link</label>
                                <input type="text" id="slide_btn_link" name="button_link" class="form-control" placeholder="e.g. /services">
                            </div>
                            <div class="form-group">
                                <label for="slide_order">Sort Order</label>
                                <input type="number" id="slide_order" name="sort_order" class="form-control" value="0">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit" style="margin-top: 1rem;">Add Hero Slide</button>
                    </form>
                </div>

                <!-- Existing Slides List -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <h2>Active Hero Slides</h2>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Button</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($slides as $slide)
                                    <tr>
                                        <td><strong>{{ $slide->sort_order }}</strong></td>
                                        <td><strong>{{ $slide->title }}</strong></td>
                                        <td style="color: var(--admin-text-muted); font-size: 0.85rem;">{{ $slide->subtitle }}</td>
                                        <td><code>{{ $slide->button_text ?? 'None' }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-slide-btn"
                                                data-id="{{ $slide->id }}"
                                                data-title="{{ $slide->title }}"
                                                data-subtitle="{{ $slide->subtitle }}"
                                                data-button_text="{{ $slide->button_text }}"
                                                data-button_link="{{ $slide->button_link }}"
                                                data-sort="{{ $slide->sort_order }}"
                                                data-image="{{ $slide->image_path }}"
                                                onclick="openSlideEditModal(this)"
                                                title="Edit Hero Slide">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.slides.delete', $slide->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this slide?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Slide"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" style="text-align: center; color: var(--admin-text-muted); padding: 2rem;">No slides added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- HOMEPAGE SECTIONS TAB -->
            <div class="tab-panel @if($activeTab === 'homesections') active @endif" id="tab-homesections">
                <!-- Section 1: Partner / Client Logos -->
                <div class="admin-card">
                    <h2>Client &amp; Partner Brand Logos (Marquee Strip)</h2>
                    <p style="font-size:0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -0.5rem;">
                        Add, edit, or delete the client brand logos shown on the homepage ticker (e.g. Livguard, Uber, Zee News, LG, Flyrobe, Stone Hub India, Tumbledry, etc.).
                    </p>

                    <!-- Add Partner Form -->
                    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" style="background: var(--admin-card-inner-bg, #141418); padding: 1.25rem; border-radius: 8px; border: 1px solid var(--admin-border, #2d2d38); margin-bottom: 1.5rem;">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Brand / Client Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Tumbledry, Uber" required>
                            </div>
                            <div class="form-group">
                                <label>Brand Logo (Upload File)</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label>Or Logo Path / URL</label>
                                <input type="text" name="logo_url" class="form-control" placeholder="assets/clients/uber.png">
                            </div>
                            <div class="form-group">
                                <label>Website Link (Optional)</label>
                                <input type="text" name="website_url" class="form-control" placeholder="https://example.com">
                            </div>
                            <div class="form-group">
                                <label>Sort Order</label>
                                <input type="number" name="sort_order" class="form-control" value="0">
                            </div>
                        </div>
                        <div style="margin-top: 1rem; display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn-submit" style="margin: 0;">Add Client Logo</button>
                        </div>
                    </form>

                    <!-- Partners Table -->
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Logo Preview</th>
                                    <th>Client / Brand Name</th>
                                    <th>Website</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partnerLogos as $pLogo)
                                    <tr>
                                        <td>{{ $pLogo->sort_order }}</td>
                                        <td>
                                            @if($pLogo->logo_path)
                                                <img src="{{ asset($pLogo->logo_path) }}" alt="{{ $pLogo->name }}" style="max-height: 35px; max-width: 90px; object-fit: contain; background: rgba(255,255,255,0.05); padding: 4px; border-radius: 4px;">
                                            @else
                                                <span style="color: var(--admin-text-muted); font-size: 0.8rem;">Text Logo</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $pLogo->name }}</strong></td>
                                        <td><code>{{ $pLogo->website_url ?? 'None' }}</code></td>
                                        <td style="text-align: right;">
                                            <button type="button" class="btn-action edit edit-partner-btn"
                                                data-id="{{ $pLogo->id }}"
                                                data-name="{{ $pLogo->name }}"
                                                data-logo="{{ $pLogo->logo_path }}"
                                                data-website="{{ $pLogo->website_url }}"
                                                data-sort="{{ $pLogo->sort_order }}"
                                                data-active="{{ $pLogo->is_active ? '1' : '0' }}"
                                                onclick="openPartnerEditModal(this)"
                                                title="Edit Brand Logo">
                                                <i data-lucide="edit-2"></i>
                                            </button>
                                            <form action="{{ route('admin.partners.delete', $pLogo->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this brand logo?');">
                                                @csrf
                                                <button type="submit" class="btn-action delete" title="Delete Brand Logo"><i data-lucide="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" style="text-align: center; color: var(--admin-text-muted);">No client logos yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section 2: Why SMAC Digital / Value Propositions -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <h2>Why Choose SMAC Digital (4 Core Pillars)</h2>
                    <form action="{{ route('admin.page-contents.update') }}" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Section Badge</label>
                                <input type="text" name="contents[home][why_us][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'why_us', 'badge', 'WHY CHOOSE SMAC') }}">
                            </div>
                            <div class="form-group">
                                <label>Section Heading</label>
                                <input type="text" name="contents[home][why_us][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'why_us', 'title', 'Why forward-thinking brands choose SMAC Digital') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Section Subtitle</label>
                                <input type="text" name="contents[home][why_us][subtitle]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'why_us', 'subtitle', 'We combine performance science with creative storytelling and rock-solid tech.') }}">
                            </div>
                        </div>

                        <!-- 4 Pillars -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem; margin-top: 1.25rem;">
                            <div style="background: var(--admin-card-inner-bg, #141418); border: 1px solid var(--admin-border, #2d2d38); padding: 1.25rem; border-radius: 8px;">
                                <h3 style="font-size: 1rem; color: var(--admin-gold, #c5a880); margin-top: 0;">Pillar 1</h3>
                                <div class="form-group" style="margin-bottom: 0.75rem;">
                                    <label>Title</label>
                                    <input type="text" name="contents[home][why_us][p1_title]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'why_us', 'p1_title', 'Attribution & Data-First Thinking') }}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="contents[home][why_us][p1_desc]" rows="3" class="form-control">{{ \App\Models\PageContent::getValue('home', 'why_us', 'p1_desc', 'Zero guesswork. Every campaign is backed by cross-channel tracking and revenue attribution models.') }}</textarea>
                                </div>
                            </div>

                            <div style="background: var(--admin-card-inner-bg, #141418); border: 1px solid var(--admin-border, #2d2d38); padding: 1.25rem; border-radius: 8px;">
                                <h3 style="font-size: 1rem; color: var(--admin-gold, #c5a880); margin-top: 0;">Pillar 2</h3>
                                <div class="form-group" style="margin-bottom: 0.75rem;">
                                    <label>Title</label>
                                    <input type="text" name="contents[home][why_us][p2_title]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'why_us', 'p2_title', 'Full-Stack Agency Capabilities') }}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="contents[home][why_us][p2_desc]" rows="3" class="form-control">{{ \App\Models\PageContent::getValue('home', 'why_us', 'p2_desc', 'From SEO and paid ads to custom code, apps, and conversion architecture under one roof.') }}</textarea>
                                </div>
                            </div>

                            <div style="background: var(--admin-card-inner-bg, #141418); border: 1px solid var(--admin-border, #2d2d38); padding: 1.25rem; border-radius: 8px;">
                                <h3 style="font-size: 1rem; color: var(--admin-gold, #c5a880); margin-top: 0;">Pillar 3</h3>
                                <div class="form-group" style="margin-bottom: 0.75rem;">
                                    <label>Title</label>
                                    <input type="text" name="contents[home][why_us][p3_title]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'why_us', 'p3_title', 'Transparent Weekly Reporting') }}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="contents[home][why_us][p3_desc]" rows="3" class="form-control">{{ \App\Models\PageContent::getValue('home', 'why_us', 'p3_desc', 'Live client dashboards and transparent weekly sprints. You always know what is performing.') }}</textarea>
                                </div>
                            </div>

                            <div style="background: var(--admin-card-inner-bg, #141418); border: 1px solid var(--admin-border, #2d2d38); padding: 1.25rem; border-radius: 8px;">
                                <h3 style="font-size: 1rem; color: var(--admin-gold, #c5a880); margin-top: 0;">Pillar 4</h3>
                                <div class="form-group" style="margin-bottom: 0.75rem;">
                                    <label>Title</label>
                                    <input type="text" name="contents[home][why_us][p4_title]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'why_us', 'p4_title', 'Obsession With Bottom-Line Growth') }}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="contents[home][why_us][p4_desc]" rows="3" class="form-control">{{ \App\Models\PageContent::getValue('home', 'why_us', 'p4_desc', 'We don\'t celebrate vanity clicks. We celebrate pipeline, lower customer acquisition cost, and revenue.') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" style="margin-top: 1.25rem;">Save Why SMAC Pillars</button>
                    </form>
                </div>

                <!-- Section 3: Bottom Conversion CTA Banner -->
                <div class="admin-card" style="margin-top: 1.5rem;">
                    <h2>Bottom Conversion CTA Banner</h2>
                    <form action="{{ route('admin.page-contents.update') }}" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Badge Label</label>
                                <input type="text" name="contents[home][cta_banner][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'cta_banner', 'badge', 'GET STARTED TODAY') }}">
                            </div>
                            <div class="form-group">
                                <label>Banner Heading</label>
                                <input type="text" name="contents[home][cta_banner][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'cta_banner', 'title', 'Ready to scale your digital presence and outperform competitors?') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Banner Subtitle / Description</label>
                                <textarea name="contents[home][cta_banner][subtitle]" rows="2" class="form-control">{{ \App\Models\PageContent::getValue('home', 'cta_banner', 'subtitle', 'Get in touch for a bespoke digital audit and growth roadmap crafted specifically for your brand.') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Primary Button Text</label>
                                <input type="text" name="contents[home][cta_banner][btn1_text]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'cta_banner', 'btn1_text', 'REQUEST FREE AUDIT') }}">
                            </div>
                            <div class="form-group">
                                <label>Primary Button URL</label>
                                <input type="text" name="contents[home][cta_banner][btn1_url]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'cta_banner', 'btn1_url', '/contact') }}">
                            </div>
                            <div class="form-group">
                                <label>Secondary Button Text</label>
                                <input type="text" name="contents[home][cta_banner][btn2_text]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'cta_banner', 'btn2_text', 'CALL OUR DIRECTORS') }}">
                            </div>
                            <div class="form-group">
                                <label>Secondary Button URL</label>
                                <input type="text" name="contents[home][cta_banner][btn2_url]" class="form-control" value="{{ \App\Models\PageContent::getValue('home', 'cta_banner', 'btn2_url', 'tel:+919829069519') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit" style="margin-top: 1rem;">Save CTA Banner</button>
                    </form>
                </div>
            </div>

            <!-- 4. TESTIMONIALS TAB -->
            <div class="tab-panel @if($activeTab === 'testimonials') active @endif" id="tab-testimonials">
                <!-- AI Sync Testimonials Card -->
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <h2>Import Google My Business Reviews</h2>
                            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-top: -5px; margin-bottom: 0;">
                                Sync reviews automatically based on the Google My Business link configured in General Settings.
                            </p>
                        </div>
                        <button type="button" id="btn-sync-gmb" class="btn-submit" style="background-color: #4285F4; color: white; display: flex; align-items: center; gap: 8px; width: auto; padding: 0.6rem 1.2rem; font-size: 0.85rem;" onclick="syncGmbReviews()">
                            <i data-lucide="refresh-cw" id="icon-sync-gmb" style="width: 16px; height: 16px;"></i> Sync GMB Reviews via AI
                        </button>
                    </div>
                </div>

                <!-- Add New Testimonial -->
                <div class="admin-card">
                    <h2>Add New Customer Testimonial</h2>
                    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="test_name">Client Name</label>
                                <input type="text" id="test_name" name="name" class="form-control" required placeholder="Vikram Sharma">
                            </div>
                            <div class="form-group">
                                <label for="test_role">Client Subtitle/Role</label>
                                <input type="text" id="test_role" name="role" class="form-control" placeholder="Government Teacher, Jaipur">
                            </div>
                            <div class="form-group">
                                <label for="test_rating">Rating (1 to 5 Stars)</label>
                                <select id="test_rating" name="rating" class="form-control" required>
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="test_avatar">Client Avatar (Upload File)</label>
                                <input type="file" id="test_avatar" name="avatar" class="form-control" accept="image/*">
                                <div style="margin-top: 10px;">
                                    <label for="test_avatar_url">Or Paste Avatar URL</label>
                                    <input type="text" id="test_avatar_url" name="avatar_url" class="form-control" placeholder="https://images.drsumitz.com/avatar.webp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="test_sort">Sort Order</label>
                                <input type="number" id="test_sort" name="sort_order" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:1.25rem;">
                            <label for="test_content">Testimonial Review Content</label>
                            <textarea id="test_content" name="content" class="form-control" required placeholder="Write review feedback here..."></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Add Testimonial</button>
                    </form>
                </div>

                <!-- Existing Testimonials List -->
                <div class="admin-card">
                    <h2>Current Active Testimonials</h2>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Content</th>
                                    <th>Rating</th>
                                    <th>Sort</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($testimonials as $test)
                                    <tr>
                                        <td>
                                            <div class="image-preview" style="border-radius: 50%;">
                                                @if($test->avatar_path)
                                                    <img src="{{ site_image($test->avatar_path) }}" alt="Avatar">
                                                @else
                                                    <!-- Initials -->
                                                    <div style="background-color:var(--primary-teal); color:white; width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                                                        {{ substr($test->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td><strong>{{ $test->name }}</strong></td>
                                        <td>{{ $test->role }}</td>
                                        <td>{{ Str::limit($test->content, 80) }}</td>
                                        <td style="color:#ffb100;">
                                            @for($i = 0; $i < $test->rating; $i++)★@endfor
                                        </td>
                                        <td>{{ $test->sort_order }}</td>
                                        <td>
                                            <div class="action-btns">
                                                <button type="button" class="btn-action edit edit-testimonial-btn"
                                                    data-id="{{ $test->id }}"
                                                    data-name="{{ $test->name }}"
                                                    data-role="{{ $test->role }}"
                                                    data-rating="{{ $test->rating }}"
                                                    data-content="{{ $test->content }}"
                                                    data-sort="{{ $test->sort_order }}"
                                                    data-avatar="{{ $test->avatar_path }}"
                                                    onclick="openTestimonialEditModal(this)"
                                                    title="Edit Testimonial">
                                                    <i data-lucide="edit-2"></i>
                                                </button>
                                                <form action="{{ route('admin.testimonials.delete', $test->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial?')">
                                                    @csrf
                                                    <button type="submit" class="btn-action delete" title="Delete Testimonial"><i data-lucide="trash-2"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; color: var(--admin-text-muted);">No testimonials found in database. Showing defaults as fallback.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 5. SECTION STYLING & BACKGROUNDS TAB -->
            <div class="tab-panel @if($activeTab === 'styling') active @endif" id="tab-styling">
                <form action="{{ route('admin.parameters.update') }}" method="POST">
                    @csrf
                    <div class="admin-card">
                        <h2>Section Styling & Backgrounds</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Customize background values for different sections of your homepage. You can use hexadecimal color codes (e.g. <code>#ffffff</code>), CSS gradients (e.g. <code>linear-gradient(135deg, #eef7f7 0%, #ffffff 100%)</code>), or even image URLs (e.g. <code>url('/storage/uploads/filename.webp') center/cover</code>).
                        </p>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="index_hero_bg">Home Hero Section Background</label>
                                <input type="text" id="index_hero_bg" name="index_hero_bg" class="form-control" value="{{ $site['index_hero_bg'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="index_services_bg">Home Services Section Background</label>
                                <input type="text" id="index_services_bg" name="index_services_bg" class="form-control" value="{{ $site['index_services_bg'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="index_about_bg">Home About Section Background</label>
                                <input type="text" id="index_about_bg" name="index_about_bg" class="form-control" value="{{ $site['index_about_bg'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="index_why_bg">Home Why Choose Us Background</label>
                                <input type="text" id="index_why_bg" name="index_why_bg" class="form-control" value="{{ $site['index_why_bg'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="index_testimonials_bg">Home Testimonials Background</label>
                                <input type="text" id="index_testimonials_bg" name="index_testimonials_bg" class="form-control" value="{{ $site['index_testimonials_bg'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="index_faq_bg">Home FAQ Background</label>
                                <input type="text" id="index_faq_bg" name="index_faq_bg" class="form-control" value="{{ $site['index_faq_bg'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="index_cta_bg">Home CTA Section Background</label>
                                <input type="text" id="index_cta_bg" name="index_cta_bg" class="form-control" value="{{ $site['index_cta_bg'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">Save Background Styles</button>
                </form>
            </div>

            <!-- 6. PAGE EDITOR TAB -->
                        <!-- PAGE CONTENT EDITOR TAB (INTERNAL PAGES) -->
            <div class="tab-panel @if($activeTab === 'pagecontents') active @endif" id="tab-pagecontents">
                <form action="{{ route('admin.page-contents.update') }}" method="POST">
                    @csrf

                    <!-- 1. About Us Page Content -->
                    <div class="admin-card">
                        <h2>About Us Page Content</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Hero Badge</label>
                                <input type="text" name="contents[about][hero][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('about', 'hero', 'badge', 'ABOUT SMAC DIGITAL') }}">
                            </div>
                            <div class="form-group">
                                <label>Hero Heading</label>
                                <input type="text" name="contents[about][hero][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('about', 'hero', 'title', 'Social. Mobile. Analytics. Cloud.') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Hero Subtitle / Mission Statement</label>
                                <textarea name="contents[about][hero][subtitle]" rows="3" class="form-control">{{ \App\Models\PageContent::getValue('about', 'hero', 'subtitle', 'Founded in 2012, SMAC Digital is a premier performance marketing and technology consultancy helping national enterprises and fast-growing brands scale sustainably.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Services Directory Page Content -->
                    <div class="admin-card" style="margin-top: 1.5rem;">
                        <h2>Services Directory Page Content</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Hero Badge</label>
                                <input type="text" name="contents[services][hero][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('services', 'hero', 'badge', 'FULL-SERVICE AGENCY') }}">
                            </div>
                            <div class="form-group">
                                <label>Hero Heading</label>
                                <input type="text" name="contents[services][hero][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('services', 'hero', 'title', 'Digital Marketing & Growth Services') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Hero Subtitle</label>
                                <textarea name="contents[services][hero][subtitle]" rows="3" class="form-control">{{ \App\Models\PageContent::getValue('services', 'hero', 'subtitle', 'SEO, social media, inbound, websites, apps, video, automation, and more from SMAC Digital.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Portfolios Page Content -->
                    <div class="admin-card" style="margin-top: 1.5rem;">
                        <h2>Portfolio &amp; Case Studies Page Content</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Hero Badge</label>
                                <input type="text" name="contents[portfolios][hero][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('portfolios', 'hero', 'badge', 'SELECTED WORK') }}">
                            </div>
                            <div class="form-group">
                                <label>Hero Heading</label>
                                <input type="text" name="contents[portfolios][hero][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('portfolios', 'hero', 'title', 'Work That Speaks For Itself') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Hero Subtitle</label>
                                <textarea name="contents[portfolios][hero][subtitle]" rows="3" class="form-control">{{ \App\Models\PageContent::getValue('portfolios', 'hero', 'subtitle', 'Selected client work from SMAC Digital — websites and growth projects across India.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Contact Us Page Content -->
                    <div class="admin-card" style="margin-top: 1.5rem;">
                        <h2>Contact Us Page Content &amp; Office Locations</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Hero Badge</label>
                                <input type="text" name="contents[contact][hero][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('contact', 'hero', 'badge', 'LET\'S COLLABORATE') }}">
                            </div>
                            <div class="form-group">
                                <label>Hero Heading</label>
                                <input type="text" name="contents[contact][hero][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('contact', 'hero', 'title', 'Start the conversation that transforms your growth trajectory.') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Hero Subtitle</label>
                                <textarea name="contents[contact][hero][subtitle]" rows="2" class="form-control">{{ \App\Models\PageContent::getValue('contact', 'hero', 'subtitle', 'Have an upcoming launch or want to audit your existing digital marketing channels? Tell us what you need.') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Jaipur Office Address</label>
                                <input type="text" name="contents[contact][jaipur][address]" class="form-control" value="{{ \App\Models\PageContent::getValue('contact', 'jaipur', 'address', 'Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur 302020') }}">
                            </div>
                            <div class="form-group">
                                <label>Kolkata Office Address</label>
                                <input type="text" name="contents[contact][kolkata][address]" class="form-control" value="{{ \App\Models\PageContent::getValue('contact', 'kolkata', 'address', 'Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur, Kolkata 700099') }}">
                            </div>
                        </div>
                    </div>

                    <!-- 5. Careers Page Content -->
                    <div class="admin-card" style="margin-top: 1.5rem;">
                        <h2>Careers Page Content</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Hero Badge</label>
                                <input type="text" name="contents[career][hero][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('career', 'hero', 'badge', 'JOIN OUR TEAM') }}">
                            </div>
                            <div class="form-group">
                                <label>Hero Heading</label>
                                <input type="text" name="contents[career][hero][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('career', 'hero', 'title', 'Build the future of digital marketing with us.') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Hero Subtitle</label>
                                <textarea name="contents[career][hero][subtitle]" rows="2" class="form-control">{{ \App\Models\PageContent::getValue('career', 'hero', 'subtitle', 'We are always looking for curious, data-driven marketers, brilliant copywriters, and skilled developers.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Events Page Content -->
                    <div class="admin-card" style="margin-top: 1.5rem;">
                        <h2>Events &amp; Workshops Page Content</h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Hero Badge</label>
                                <input type="text" name="contents[events][hero][badge]" class="form-control" value="{{ \App\Models\PageContent::getValue('events', 'hero', 'badge', 'COMMUNITY & KNOWLEDGE') }}">
                            </div>
                            <div class="form-group">
                                <label>Hero Heading</label>
                                <input type="text" name="contents[events][hero][title]" class="form-control" value="{{ \App\Models\PageContent::getValue('events', 'hero', 'title', 'Workshops, Keynotes, and Growth Sessions') }}">
                            </div>
                            <div class="form-group" style="grid-column: 1 / -1;">
                                <label>Hero Subtitle</label>
                                <textarea name="contents[events][hero][subtitle]" rows="2" class="form-control">{{ \App\Models\PageContent::getValue('events', 'hero', 'subtitle', 'Catch our leadership team speaking on performance marketing, conversion design, and SEO architectures.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" style="margin-top: 1.5rem; font-size: 1.1rem; padding: 12px 28px;">Save All Internal Pages Content</button>
                </form>
            </div>

            <!-- 11. CMS PAGES MANAGER TAB -->
            <div class="tab-panel @if($activeTab === 'cms_pages') active @endif" id="tab-cms_pages">
                <div class="admin-card">
                    <h2 id="cms-form-title-text">Add New CMS Page</h2>
                    <form id="cms-form" action="{{ route('admin.cms_pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="cms-form-method" value="POST">
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="cms_title">Page Title</label>
                                <input type="text" id="cms_title" name="title" class="form-control" required placeholder="Disclaimer">
                            </div>
                            <div class="form-group">
                                <label for="cms_slug">Custom Slug</label>
                                <input type="text" id="cms_slug" name="slug" class="form-control" required placeholder="disclaimer">
                            </div>
                            <div class="form-group">
                                <label for="cms_image">Page Header/Featured Image</label>
                                <input type="file" id="cms_image" name="image" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="cms_image_url">Or Image URL</label>
                                <input type="text" id="cms_image_url" name="image_url" class="form-control" placeholder="uploads/page/disclaimer.jpg">
                            </div>
                            <div class="form-group">
                                <label for="cms_metatitle">Meta Title (SEO)</label>
                                <input type="text" id="cms_metatitle" name="metatitle" class="form-control" placeholder="Disclaimer | SumitZ Clinic">
                            </div>
                            <div class="form-group">
                                <label for="cms_metakeywords">Meta Keywords (comma separated)</label>
                                <input type="text" id="cms_metakeywords" name="metakeywords" class="form-control" placeholder="disclaimer, clinic rules">
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 1rem;">
                            <label for="cms_metadescription">Meta Description (SEO)</label>
                            <textarea id="cms_metadescription" name="metadescription" class="form-control" rows="2" placeholder="Disclaimer for SumitZ Clinic services."></textarea>
                        </div>

                        <div class="form-group" style="margin-top: 1rem;">
                            <label for="cms_description">Page HTML Content</label>
                            <textarea id="cms_description" name="description" class="form-control" rows="10" placeholder="Write page content here..."></textarea>
                        </div>

                        <div class="form-group" style="margin-top: 1rem;">
                            <label for="cms_schema_markup">Custom Schema Markup (JSON-LD)</label>
                            <div style="display: flex; gap: 10px; margin-bottom: 0.5rem;">
                                <button type="button" class="btn-submit" style="background-color: var(--accent-blue); padding: 4px 10px; font-size: 0.8rem;" onclick="generateAiSchemaForType('cms_page')">
                                    <i data-lucide="sparkles" style="width: 14px; height: 14px; display: inline; vertical-align: middle;"></i> Generate with AI
                                </button>
                            </div>
                            <textarea id="cms_schema_markup" name="schema_markup" class="form-control" rows="4" placeholder="<script type='application/ld+json'>...</script>"></textarea>
                        </div>

                        <div class="form-group" style="margin-top: 1rem; display: flex; align-items: center; gap: 8px;">
                            <input type="checkbox" id="cms_status" name="status" value="1" checked style="width: 18px; height: 18px; cursor: pointer;">
                            <label for="cms_status" style="margin-bottom: 0; cursor: pointer;">Is Active / Published</label>
                        </div>

                        <div style="margin-top: 1.5rem; display: flex; gap: 10px;">
                            <button type="submit" class="btn-submit">Save Page</button>
                            <button type="button" class="btn-submit" id="cms-cancel-btn" style="background-color: var(--admin-input-bg); color: #fff; display: none;" onclick="cancelCmsPageEdit()">Cancel Edit</button>
                        </div>
                    </form>
                </div>

                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 1rem;">
                        <h2 style="margin: 0;">CMS Pages & SEO Metadata ({{ count($cmsPages) }})</h2>
                        <input type="text" id="cms-search-input" placeholder="Search page title, slug, or URL..." class="form-control" style="max-width: 320px; padding: 6px 12px; font-size: 0.9rem;" onkeyup="filterCmsPagesTable()">
                    </div>
                    <div class="admin-table-wrap">
                        <table class="admin-table" id="cms-pages-table">
                            <thead>
                                <tr>
                                    <th>Page Title</th>
                                    <th>Page URL / Slug</th>
                                    <th>Meta Title (SEO)</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cmsPages as $cp)
                                    <tr>
                                        <td>
                                            <div style="font-weight: 600; color: #fff;">{{ $cp->title }}</div>
                                            @if($cp->metadescription)
                                                <div style="font-size: 0.75rem; color: var(--admin-text-muted); max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $cp->metadescription }}">
                                                    {{ $cp->metadescription }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url($cp->slug === 'home' ? '/' : $cp->slug) }}" target="_blank" style="color: var(--accent-blue); text-decoration: none; font-size: 0.85rem;" title="View page in frontend">
                                                <code>{{ $cp->slug === 'home' ? '/' : '/' . $cp->slug }}</code> ↗
                                            </a>
                                        </td>
                                        <td style="font-size: 0.85rem; max-width: 250px;">
                                            <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $cp->metatitle }}">
                                                {{ $cp->metatitle ?: '—' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($cp->status)
                                                <span style="color: var(--accent-teal); font-size: 0.85rem; font-weight: 600;">● Active</span>
                                            @else
                                                <span style="color: var(--admin-text-muted); font-size: 0.85rem;">● Inactive</span>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="action-btns" style="justify-content: flex-end;">
                                                <button type="button" class="btn-submit" style="padding: 4px 10px; font-size: 0.8rem; background-color: var(--admin-input-bg); color: #fff;" 
                                                    onclick="editCmsPage({{ json_encode($cp) }})">
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.cms_pages.delete', $cp->id) }}" method="POST" onsubmit="return confirm('Delete this CMS page?')" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-submit" style="padding: 4px 10px; font-size: 0.8rem; background-color: rgba(239, 68, 68, 0.2); color: #f87171;">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--admin-text-muted);">No CMS pages configured.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- DUMMY BANKS TAB Panel (hidden to prevent JS errors if any script references switchTab('banks')) -->
            <div class="tab-panel" id="tab-banks" style="display: none;"></div>

            <!-- 7. BLOG MANAGER TAB -->
            <div class="tab-panel @if($activeTab === 'blogs') active @endif" id="tab-blogs">
                <!-- Add Blog Card -->
                <div class="admin-card" id="blog-form-container">
                    <h2 id="blog-form-title">
                        <span id="blog-form-title-text">Create New Blog Article</span>
                        <button type="button" class="btn-ai-sparkle" id="blog-ai-btn" onclick="openAiModal('blog')">
                            <i data-lucide="sparkles"></i> Generate with AI
                        </button>
                    </h2>
                    <form id="blog-form" action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="blog-form-method" value="POST">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="blog_title">Article Title</label>
                                <input type="text" id="blog_title" name="title" class="form-control" required placeholder="e.g. Complete Guide to Italian Marble Slabs">
                            </div>
                            <div class="form-group">
                                <label for="blog_slug">URL Slug (leave empty to auto-generate)</label>
                                <input type="text" id="blog_slug" name="slug" class="form-control" placeholder="complete-guide-italian-marble-slabs">
                            </div>
                            <div class="form-group">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                                    <label for="blog_category" style="margin: 0;">Category</label>
                                    <button type="button" class="btn-action" style="padding: 2px 10px; font-size: 0.78rem; background: rgba(92, 203, 179, 0.15); color: var(--mint-green); border: 1px solid rgba(92, 203, 179, 0.3); border-radius: var(--radius-sm); cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" onclick="openAddCategoryModal('blog_category')">
                                        <i data-lucide="plus" style="width: 13px; height: 13px;"></i> Add Category
                                    </button>
                                </div>
                                <select id="blog_category" name="category" class="form-control category-dropdown-select" required onchange="handleCategoryDropdownChange(this)">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                    @endforeach
                                    <option value="__add_new_category__" style="color: var(--mint-green); font-weight: 600;">+ Add New Category...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="blog_published_at">Publish Date</label>
                                <input type="datetime-local" id="blog_published_at" name="published_at" class="form-control" value="{{ date('Y-m-d\TH:i') }}">
                            </div>
                            <div class="form-group">
                                <label for="blog_image">Cover Image (Upload File)</label>
                                <input type="file" id="blog_image" name="image" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="blog_image_url">Or Paste Cover Image URL</label>
                                <input type="text" id="blog_image_url" name="image_url" class="form-control" placeholder="https://images.drsumitz.com/cover.webp">
                            </div>
                        </div>
                        <h4 style="margin-top: 1.5rem; margin-bottom: 0.5rem; color: var(--accent-teal);">SEO Metadata (Optional)</h4>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="blog_metatitle">Meta Title (SEO)</label>
                                <input type="text" id="blog_metatitle" name="metatitle" class="form-control" placeholder="Article Meta Title">
                            </div>
                            <div class="form-group">
                                <label for="blog_metakeywords">Meta Keywords (Comma separated)</label>
                                <input type="text" id="blog_metakeywords" name="metakeywords" class="form-control" placeholder="imported marble, italian marble, kishangarh">
                            </div>
                            <div class="form-group" style="grid-column: span 2;">
                                <label for="blog_metadescription">Meta Description (SEO)</label>
                                <textarea id="blog_metadescription" name="metadescription" class="form-control" rows="2" placeholder="SEO optimized description for search engines"></textarea>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 1.25rem;">

                            <label for="blog_summary">Short Summary (shown in blog listing card)</label>
                            <textarea id="blog_summary" name="summary" class="form-control" required placeholder="A brief 1-2 sentence description of the article..." rows="2"></textarea>
                        </div>
                        <div class="form-group" style="margin-top: 1.25rem;">
                            <label for="blog_schema_markup">Custom Schema Markup (JSON-LD script)</label>
                            <textarea id="blog_schema_markup" name="schema_markup" class="form-control" placeholder='<script type="application/ld+json">...</script>' rows="3"></textarea>
                            <span style="font-size: 0.75rem; color: var(--admin-text-muted);">Paste the complete <code>&lt;script type="application/ld+json"&gt;...&lt;/script&gt;</code> block to override the default blog posting schema.</span>
                        </div>
                        <div class="form-group" style="margin-top: 1.25rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                                <label for="blog_content" style="margin: 0;">Article Content (HTML Editor)</label>
                                <button type="button" class="btn-action" style="padding: 2px 10px; font-size: 0.78rem; background: rgba(92, 203, 179, 0.15); color: var(--mint-green); border: 1px solid rgba(92, 203, 179, 0.3); border-radius: var(--radius-sm); cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" onclick="openEditorSource('blog_content')" title="View and edit raw HTML tags (&lt;p&gt;, &lt;h2&gt;, &lt;strong&gt;, etc.)">
                                    <i data-lucide="code" style="width: 13px; height: 13px;"></i> &lt;&gt; HTML Source
                                </button>
                            </div>
                            <textarea id="blog_content" name="content" class="form-control" placeholder="Write article content here..."></textarea>
                        </div>
                        <div style="margin-top: 1.5rem; display: flex; gap: 10px;">
                            <button type="submit" class="btn-submit" id="blog-submit-btn">Publish Blog Article</button>
                            <button type="button" class="btn-submit" id="blog-cancel-btn" style="background-color: var(--admin-input-bg); color: #fff; display: none;" onclick="cancelBlogEdit()">Cancel Edit</button>
                        </div>
                    </form>
                </div>

                <!-- Existing Blogs List -->
                <div class="admin-card">
                    <h2>Published Blog Articles</h2>
                    <div class="admin-table-wrap" id="blogs-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Cover Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Published Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="blogs-table-body">
                                @forelse($blogs as $b)
                                    <tr id="blog-row-{{ $b->id }}">
                                        <td>
                                            <div class="image-preview">
                                                @if($b->image_path)
                                                    <img src="{{ site_image($b->image_path) }}" alt="Cover">
                                                @else
                                                    <span style="font-size:0.75rem; color:var(--admin-text-muted);">No Image</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td><strong>{{ $b->title }}</strong></td>
                                        <td><span class="badge-webp" style="background-color: var(--primary-teal);">{{ $b->category }}</span></td>
                                        <td><code>{{ $b->slug }}</code></td>
                                        <td>{{ $b->published_at ? $b->published_at->format('M d, Y H:i') : $b->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <div class="action-btns">
                                                <button type="button" class="btn-action edit" title="Edit Article" onclick="editBlog({{ $b->id }})"><i data-lucide="edit"></i></button>
                                                <button type="button" class="btn-action" style="background-color: rgba(66, 133, 244, 0.1); color: #4285f4; border: 1px solid rgba(66, 133, 244, 0.3);" title="Share to Google Business Profile" 
                                                    onclick="openGmbShareModal('blog', {id: {{ $b->id }}, title: '{{ addslashes($b->title) }}', summary: ''})"><i data-lucide="share-2"></i></button>
                                                <form action="{{ route('admin.blogs.delete', $b->id) }}" method="POST" onsubmit="return confirm('Delete this blog post?')">
                                                    @csrf
                                                    <button type="submit" class="btn-action delete" title="Delete"><i data-lucide="trash-2"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: var(--admin-text-muted);">No blog posts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="admin-pagination" style="margin-top: 1.5rem; display: flex; justify-content: center; align-items: center; gap: 1rem;">
                        @if ($blogs->onFirstPage())
                            <span class="btn-action" style="opacity: 0.5; cursor: not-allowed; padding: 0.5rem 1rem;"><i data-lucide="chevron-left"></i> Previous</span>
                        @else
                            <a href="{{ $blogs->previousPageUrl() }}#tab-blogs" class="btn-action" style="padding: 0.5rem 1rem; color: #fff; background: var(--admin-input-bg); border-radius: var(--radius-md);"><i data-lucide="chevron-left"></i> Previous</a>
                        @endif

                        <span style="color: var(--admin-text-muted); font-size: 0.9rem;">Page {{ $blogs->currentPage() }} of {{ $blogs->lastPage() }}</span>

                        @if ($blogs->hasMorePages())
                            <a href="{{ $blogs->nextPageUrl() }}#tab-blogs" class="btn-action" style="padding: 0.5rem 1rem; color: #fff; background: var(--admin-input-bg); border-radius: var(--radius-md);">Next <i data-lucide="chevron-right"></i></a>
                        @else
                            <span class="btn-action" style="opacity: 0.5; cursor: not-allowed; padding: 0.5rem 1rem;">Next <i data-lucide="chevron-right"></i></span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- CATEGORIES MANAGER TAB -->
            <div class="tab-panel @if($activeTab === 'categories') active @endif" id="tab-categories">
                <!-- Add / Edit Category Card -->
                <div class="admin-card" id="category-form-container">
                    <h2 id="category-form-title">
                        <span id="category-form-title-text">Create New Category</span>
                    </h2>
                    <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -0.5rem;">
                        Manage categories used across services, blogs, products, and stone collections. Any category added, edited, or removed here is dynamically updated in dropdowns across the admin panel.
                    </p>
                    <form id="category-form" action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="category-form-method" value="POST">
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="category_name">Category Name <span style="color: #ef4444;">*</span></label>
                                <input type="text" id="category_name" name="name" class="form-control" required placeholder="e.g. Italian Marble" oninput="autoGenerateCategorySlug(this.value)">
                            </div>
                            <div class="form-group">
                                <label for="category_slug">URL Slug (leave empty to auto-generate)</label>
                                <input type="text" id="category_slug" name="slug" class="form-control" placeholder="italian-marble">
                            </div>
                            <div class="form-group">
                                <label for="category_type">Category Type</label>
                                <select id="category_type" name="type" class="form-control">
                                    <option value="service">Service / Product</option>
                                    <option value="blog">Blog / Article</option>
                                    <option value="collection">Stone Collection</option>
                                    <option value="general">General</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category_sort_order">Sort Order</label>
                                <input type="number" id="category_sort_order" name="sort_order" class="form-control" value="0" min="0">
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 1rem;">
                            <label for="category_description">Description (Optional)</label>
                            <textarea id="category_description" name="description" class="form-control" rows="3" placeholder="Brief description of this category..."></textarea>
                        </div>

                        <div class="form-group" style="margin-top: 1rem;">
                            <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="checkbox" id="category_status" name="status" value="1" checked style="width: 16px; height: 16px; accent-color: var(--mint-green);">
                                Active / Visible
                            </label>
                        </div>

                        <div style="margin-top: 1.5rem; display: flex; gap: 10px;">
                            <button type="submit" class="btn-submit" id="category-submit-btn">Save Category</button>
                            <button type="button" class="btn-submit" id="category-cancel-btn" style="background-color: var(--admin-input-bg); color: #fff; display: none;" onclick="cancelCategoryEdit()">Cancel Edit</button>
                        </div>
                    </form>
                </div>

                <!-- Existing Categories List -->
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                        <h2 style="margin: 0;">Existing Categories ({{ count($categories) }})</h2>
                    </div>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Sort Order</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $index => $c)
                                    <tr id="category-row-{{ $c->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td><strong>{{ $c->name }}</strong></td>
                                        <td><code>{{ $c->slug }}</code></td>
                                        <td><span class="badge" style="background: rgba(255,255,255,0.06); color: var(--mint-green); padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">{{ ucfirst($c->type ?? 'service') }}</span></td>
                                        <td>
                                            @if($c->status)
                                                <span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #10b981; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Active</span>
                                            @else
                                                <span class="badge" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem;">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $c->sort_order }}</td>
                                        <td>
                                            <div class="action-btns">
                                                <button type="button" class="btn-action edit" title="Edit Category" onclick="editCategory({{ $c->id }})"><i data-lucide="edit"></i></button>
                                                <form action="{{ route('admin.categories.delete', $c->id) }}" method="POST" onsubmit="return confirm('Delete category \'{{ addslashes($c->name) }}\'?')">
                                                    @csrf
                                                    <button type="submit" class="btn-action delete" title="Delete"><i data-lucide="trash-2"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; color: var(--admin-text-muted);">No categories found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 8. MEDIA MANAGER TAB -->
            <div class="tab-panel @if($activeTab === 'media') active @endif" id="tab-media">
                <div class="admin-card">
                    <h2>
                        <span>Upload Media File</span>
                        <button type="button" class="btn-ai-sparkle" onclick="openAiModal('image')">
                            <i data-lucide="sparkles"></i> Generate Image with AI
                        </button>
                    </h2>
                    <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                        Upload any JPEG, PNG, GIF, WebP, or SVG image. Standard raster formats are automatically compressed and converted to the highly efficient <strong>WebP format</strong> on the server.
                    </p>
                    <form id="media-upload-form" action="{{ route('admin.media.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div style="border: 2px dashed var(--admin-border); padding: 3rem; text-align: center; border-radius: var(--radius-lg); background: rgba(255,255,255,0.01); cursor: pointer;" onclick="document.getElementById('media-file-input').click()">
                            <i data-lucide="upload-cloud" style="width: 48px; height: 48px; color: var(--mint-green); margin-bottom: 1rem;"></i>
                            <p style="margin: 0; font-weight: 500;">Click to select an image from your computer</p>
                            <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: var(--admin-text-muted);">Maximum size: 10 MB (JPEG, PNG, GIF, WEBP, SVG)</p>
                            <input type="file" id="media-file-input" name="file" style="display: none;" onchange="uploadMediaFile(this)">
                        </div>
                    </form>
                    <div id="media-upload-progress" style="display: none; margin-top: 1rem;">
                        <div style="background-color: var(--admin-border); border-radius: 10px; height: 6px; width: 100%; overflow: hidden;">
                            <div id="media-progress-bar" style="background-color: var(--mint-green); height: 100%; width: 0%; transition: width 0.3s ease;"></div>
                        </div>
                        <p style="font-size: 0.8rem; margin-top: 5px; color: var(--mint-green);">Uploading and optimizing image...</p>
                    </div>
                </div>

                <div class="admin-card">
                    <h2 style="display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <span>Media Library</span>
                        <button type="button" class="btn-ai-sparkle" style="background: var(--blue-gradient, linear-gradient(135deg, #2563eb 0%, #3b82f6 100%)); border-color: #2563eb;" onclick="syncLocalImagesToR2(this)">
                            <i data-lucide="refresh-cw"></i> Sync Local Images to R2
                        </button>
                    </h2>
                    <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                        Click on any image's <strong>Copy URL</strong> button to use its link in slider images, blog covers, page contents, or background section styles.
                    </p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.25rem;">
                        @forelse($mediaFiles as $media)
                            <div style="background: rgba(255,255,255,0.01); border: 1px solid var(--admin-border); border-radius: var(--radius-md); overflow: hidden; display: flex; flex-direction: column;">
                                <div style="height: 120px; background: rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                                    <img src="{{ $media['url'] }}" alt="{{ $media['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    <span class="badge-webp" style="position: absolute; bottom: 5px; right: 5px; font-size: 0.65rem;">{{ strtoupper(pathinfo($media['name'], PATHINFO_EXTENSION)) }}</span>
                                </div>
                                <div style="padding: 10px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div>
                                        <p style="margin: 0; font-size: 0.8rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $media['name'] }}">{{ $media['name'] }}</p>
                                        <p style="margin: 2px 0 0 0; font-size: 0.7rem; color: var(--admin-text-muted);">{{ round($media['size'] / 1024, 1) }} KB</p>
                                    </div>
                                    <button class="btn-submit" style="width: 100%; padding: 5px; font-size: 0.75rem; margin-top: 10px; border-radius: 4px; display: flex; align-items: center; justify-content: center; gap: 4px;" onclick="copyToClipboard('{{ $media['url'] }}', this)">
                                        <i data-lucide="copy" style="width: 12px; height: 12px;"></i> Copy URL
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p style="grid-column: 1 / -1; text-align: center; color: var(--admin-text-muted); padding: 20px 0;">No media files uploaded yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            @if($hasAccess('analytics'))
            <!-- Analytics Tab -->
            <div class="tab-panel @if($activeTab === 'analytics') active @endif" id="tab-analytics">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 10px; border-bottom: 1px solid var(--admin-border); padding-bottom: 1rem;">
                    <h2 style="margin: 0; font-size: 1.5rem; display: flex; align-items: center; gap: 8px;"><i data-lucide="bar-chart-3" style="color: var(--mint-green);"></i> Analytics Dashboard</h2>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label for="analytics_date_range" style="font-size: 0.85rem; color: var(--admin-text-muted); margin: 0;">Date Range:</label>
                        <select id="analytics_date_range" class="form-control" style="width: auto; padding: 0.4rem 1.5rem; font-size: 0.85rem; background: rgba(255,255,255,0.05); border-color: var(--admin-border); color: #fff; cursor: pointer;" onchange="fetchGoogleAnalytics(this.value)">
                            <option value="last_7_days" selected>Last 7 Days</option>
                            <option value="last_30_days">Last 30 Days</option>
                            <option value="last_90_days">Last 90 Days</option>
                        </select>
                    </div>
                </div>
                <!-- Demo/Live Banner Indicator -->
                <div id="google-analytics-demo-banner" class="alert-success" style="display: none; background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3); color: #60a5fa; margin-bottom: 1.5rem;">
                    <i data-lucide="info"></i>
                    <span><strong>Live Demo Mode:</strong> Showing simulated traffic data. Configure your Google API credentials below to load live website data.</span>
                </div>


                <!-- Loader Block -->
                <div id="google-analytics-loader" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 4rem 2rem; background: var(--theme-bg-card); border-radius: 12px; border: 1px solid var(--theme-bg-border); margin-bottom: 2rem;">
                    <div class="ai-sparkle-loader"></div>
                    <p style="margin-top: 1rem; color: var(--admin-text-muted);">Fetching reports from Google APIs...</p>
                </div>

                <!-- Dashboard Content Container (initially hidden until AJAX loads) -->
                <div id="google-analytics-dashboard" style="display: none;">
                    
                    <!-- KPI Cards Row -->
                    <h2 style="margin-bottom: 1rem; font-size: 1.25rem; display: flex; align-items: center; gap: 8px;"><i data-lucide="bar-chart-3" style="color: var(--mint-green);"></i> Website Traffic & Engagement (GA4)</h2>
                    <div class="form-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid var(--mint-green);">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Total Sessions</span>
                            <h3 id="ga-sessions" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #3b82f6;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Unique Users</span>
                            <h3 id="ga-users" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #a855f7;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Returning Users</span>
                            <h3 id="ga-returning" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #f43f5e;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Bounce Rate</span>
                            <h3 id="ga-bounce" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0%</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #ec4899;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Time on Site</span>
                            <h3 id="ga-time" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0s</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #eab308;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Pages/Session</span>
                            <h3 id="ga-pages-per-session" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0</h3>
                        </div>
                    </div>

                    <!-- GSC Stats & Search Impression Cards -->
                    <h2 style="margin-bottom: 1rem; font-size: 1.25rem; display: flex; align-items: center; gap: 8px;"><i data-lucide="search" style="color: var(--mint-green);"></i> Organic Search Performance (Search Console)</h2>
                    <div class="form-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #06b6d4;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Search Clicks</span>
                            <h3 id="gsc-clicks" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #10b981;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Impressions</span>
                            <h3 id="gsc-impressions" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #fb923c;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Average CTR</span>
                            <h3 id="gsc-ctr" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0%</h3>
                        </div>
                        <div class="admin-card" style="padding: 1.25rem; text-align: center; border-left: 4px solid #6366f1;">
                            <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted);">Average Position</span>
                            <h3 id="gsc-position" style="font-size: 1.8rem; margin: 0.5rem 0 0; color: #fff;">0</h3>
                        </div>
                    </div>

                    <!-- Daily Trend Chart Card -->
                    <div class="admin-card" style="margin-bottom: 2rem;">
                        <h2>Daily Sessions & Clicks Trend</h2>
                        <div style="height: 320px; position: relative;">
                            <canvas id="googleAnalyticsChart"></canvas>
                        </div>
                    </div>

                    <!-- Keywords and Top Pages Grid -->
                    <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                        <!-- Top Keywords -->
                        <div class="admin-card">
                            <h2>Top Search Queries (Keywords)</h2>
                            <div class="admin-table-wrap">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>Query</th>
                                            <th style="text-align: right;">Clicks</th>
                                            <th style="text-align: right;">Impressions</th>
                                            <th style="text-align: right;">CTR</th>
                                            <th style="text-align: right;">Pos</th>
                                        </tr>
                                    </thead>
                                    <tbody id="gsc-keywords-tbody">
                                        <!-- Dynamic rows -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Top Pages -->
                        <div class="admin-card">
                            <h2>Top Visited Landing Pages</h2>
                            <div class="admin-table-wrap">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th>Page URL</th>
                                            <th style="text-align: right;">Clicks</th>
                                            <th style="text-align: right;">Impressions</th>
                                            <th style="text-align: right;">CTR</th>
                                        </tr>
                                    </thead>
                                    <tbody id="gsc-pages-tbody">
                                        <!-- Dynamic rows -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                                        <!-- Top Traffic Locations by Zip/Postal Code -->
                    <div class="admin-card" style="margin-bottom: 2rem;">
                        <h2 style="font-size: 1.1rem; display: flex; align-items: center; gap: 8px; margin-bottom: 1rem;"><i data-lucide="map-pin" style="color: var(--mint-green);"></i> Top Traffic Locations (by Zip/Postal Code)</h2>
                        <div class="admin-table-wrap">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Zip/Postal Code</th>
                                        <th>City / Area</th>
                                        <th style="text-align: right;">Active Users</th>
                                    </tr>
                                </thead>
                                <tbody id="ga-zipcodes-tbody">
                                    <!-- Dynamic rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Google My Business Metrics Card -->
                    <h2 style="margin-bottom: 1rem; font-size: 1.25rem; display: flex; align-items: center; gap: 8px;"><i data-lucide="map-pin" style="color: var(--mint-green);"></i> Local Business Profile Performance (GMB)</h2>
                    <div class="form-grid" style="grid-template-columns: 2fr 3fr; gap: 1.5rem; margin-bottom: 2rem;">
                        <!-- GBP Mini KPIs -->
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <div class="admin-card" style="padding: 1.2rem; display: flex; align-items: center; gap: 15px;">
                                <div style="background: rgba(92, 203, 179, 0.1); border-radius: 8px; padding: 10px; color: var(--mint-green);">
                                    <i data-lucide="users" style="width: 24px; height: 24px;"></i>
                                </div>
                                <div style="text-align: left;">
                                    <span style="font-size: 0.75rem; color: var(--admin-text-muted);">GMB Location Visitors</span>
                                    <h4 id="gmb-visitors" style="font-size: 1.4rem; margin: 0; color: #fff;">0</h4>
                                </div>
                            </div>
                            <div class="admin-card" style="padding: 1.2rem; display: flex; align-items: center; gap: 15px;">
                                <div style="background: rgba(59, 130, 246, 0.1); border-radius: 8px; padding: 10px; color: #3b82f6;">
                                    <i data-lucide="eye" style="width: 24px; height: 24px;"></i>
                                </div>
                                <div style="text-align: left;">
                                    <span style="font-size: 0.75rem; color: var(--admin-text-muted);">Search & Map Views</span>
                                    <h4 id="gmb-views" style="font-size: 1.4rem; margin: 0; color: #fff;">0</h4>
                                </div>
                            </div>
                            <div class="admin-card" style="padding: 1.2rem; display: flex; align-items: center; gap: 15px;">
                                <div style="background: rgba(168, 85, 247, 0.1); border-radius: 8px; padding: 10px; color: #a855f7;">
                                    <i data-lucide="phone-call" style="width: 24px; height: 24px;"></i>
                                </div>
                                <div style="text-align: left;">
                                    <span style="font-size: 0.75rem; color: var(--admin-text-muted);">Total Phone Calls</span>
                                    <h4 id="gmb-calls" style="font-size: 1.4rem; margin: 0; color: #fff;">0</h4>
                                </div>
                            </div>
                            <div class="admin-card" style="padding: 1.2rem; display: flex; align-items: center; gap: 15px;">
                                <div style="background: rgba(236, 72, 153, 0.1); border-radius: 8px; padding: 10px; color: #ec4899;">
                                    <i data-lucide="globe" style="width: 24px; height: 24px;"></i>
                                </div>
                                <div style="text-align: left;">
                                    <span style="font-size: 0.75rem; color: var(--admin-text-muted);">Website Clicks from Profile</span>
                                    <h4 id="gmb-webclicks" style="font-size: 1.4rem; margin: 0; color: #fff;">0</h4>
                                </div>
                            </div>
                            <div class="admin-card" style="padding: 1.2rem; display: flex; align-items: center; gap: 15px;">
                                <div style="background: rgba(234, 179, 8, 0.1); border-radius: 8px; padding: 10px; color: #eab308;">
                                    <i data-lucide="navigation" style="width: 24px; height: 24px;"></i>
                                </div>
                                <div style="text-align: left;">
                                    <span style="font-size: 0.75rem; color: var(--admin-text-muted);">Driving Direction Requests</span>
                                    <h4 id="gmb-directions" style="font-size: 1.4rem; margin: 0; color: #fff;">0</h4>
                                </div>
                            </div>
                        </div>

                        <!-- GMB Graph -->
                        <div class="admin-card">
                            <h2>Local Interactions Trend</h2>
                            <div style="height: 330px; position: relative;">
                                <canvas id="gmbPerformanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- API Credentials Config Form (General settings submit) -->
                <div class="admin-card" style="margin-top: 2rem;">
                    <h2><i data-lucide="settings" style="display: inline-block; vertical-align: middle; margin-right: 5px;"></i> Google API Credentials & Configuration</h2>
                    <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                        Connect your live Google Analytics properties, Search Console verification, and Google Business Profile location. You can configure either a Service Account JSON key (Recommended) or OAuth refresh token keys.
                    </p>
                    
                    <form action="{{ route('admin.parameters.update') }}" method="POST">
                        @csrf
                        
                        <div class="form-grid" style="margin-bottom: 1.25rem;">
                            <div class="form-group">
                                <label for="google_analytics_property_id">Google Analytics 4 Property ID</label>
                                <div style="display: flex; gap: 10px; flex-direction: column;">
                                    <select id="google_analytics_property_id_select" class="form-control" style="display: none;">
                                        <option value="">-- Select GA4 Property --</option>
                                    </select>
                                    <input type="text" id="google_analytics_property_id" name="google_analytics_property_id" class="form-control" value="{{ $site['google_analytics_property_id'] ?? '' }}" placeholder="e.g. 123456789" autocomplete="off">
                                </div>
                                <small style="color: var(--admin-text-muted); font-size: 0.75rem;">Found in GA4 Admin Settings under Property Details.</small>
                            </div>
                            <div class="form-group">
                                <label for="google_search_console_site_url">Search Console Site URL</label>
                                <div style="display: flex; gap: 10px; flex-direction: column;">
                                    <select id="google_search_console_site_url_select" class="form-control" style="display: none;">
                                        <option value="">-- Select Search Console Site --</option>
                                    </select>
                                    <input type="text" id="google_search_console_site_url" name="google_search_console_site_url" class="form-control" value="{{ $site['google_search_console_site_url'] ?? '' }}" placeholder="e.g. https://www.yourdomain.com" autocomplete="off">
                                </div>
                                <small style="color: var(--admin-text-muted); font-size: 0.75rem;">The verified domain or prefix URL exactly as verified in Search Console.</small>
                            </div>
                            <div class="form-group">
                                <label for="gmb_location_id_analytics">Google My Business Location ID</label>
                                <div style="display: flex; gap: 10px; flex-direction: column;">
                                    <select id="gmb_location_id_select" class="form-control" style="display: none;">
                                        <option value="">-- Select GMB Location --</option>
                                    </select>
                                    <input type="text" id="gmb_location_id_analytics" name="gmb_location_id" class="form-control" value="{{ $site['gmb_location_id'] ?? '' }}" placeholder="e.g. locations/1234567890" autocomplete="off">
                                </div>
                                <small style="color: var(--admin-text-muted); font-size: 0.75rem;">Your GMB location resource name.</small>
                            </div>
                        </div>

                        <div style="border-top: 1px solid var(--theme-bg-border); margin: 1.5rem 0; padding-top: 1.5rem;">
                            <h3 style="font-size: 1rem; margin-bottom: 1rem; color: #fff;">Option A: Google Service Account Credentials (Recommended)</h3>
                            <div class="form-group">
                                <label for="google_service_account_json">Service Account JSON Key File Content</label>
                                <textarea id="google_service_account_json" name="google_service_account_json" class="form-control" rows="5" placeholder='Paste full content of your downloaded service account JSON key file here...' style="font-family: monospace; font-size: 0.8rem;">{{ $site['google_service_account_json'] ?? '' }}</textarea>
                                <small style="color: var(--admin-text-muted); font-size: 0.75rem;">Enable Analytics API, Search Console API, and My Business API in Google Cloud Console. Invite the service account email (e.g. <code>xxx@project.iam.gserviceaccount.com</code>) to your GA4 property and Search Console property as a viewer.</small>
                            </div>
                        </div>

                        <div style="border-top: 1px solid var(--theme-bg-border); margin: 1.5rem 0; padding-top: 1.5rem;">
                            <h3 style="font-size: 1rem; margin-bottom: 1rem; color: #fff;">Option B: Connect Google Account (OAuth)</h3>
                            
                            @if(!empty($site['google_oauth_refresh_token']))
                                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: 50%;">
                                            <i data-lucide="check-circle" style="width: 20px; height: 20px;"></i>
                                        </span>
                                        <div>
                                            <h4 style="margin: 0; color: #fff; font-size: 0.95rem;">Google Account Connected</h4>
                                            <p style="margin: 0; font-size: 0.8rem; color: var(--admin-text-muted);">Successfully authorized access. You can now use the auto-detect feature below.</p>
                                        </div>
                                    </div>
                                    <div style="display: flex; gap: 10px;">
                                        <button type="button" id="btn-fetch-properties" class="btn-submit" style="background: #3b82f6; border-color: #3b82f6; padding: 0.5rem 1rem; font-size: 0.85rem; width: auto; display: inline-flex; align-items: center; gap: 5px;">
                                            <i data-lucide="refresh-cw" style="width: 14px; height: 14px;"></i> Auto-Detect Properties
                                        </button>
                                        <button type="button" onclick="document.getElementById('disconnect-form').submit();" class="btn-submit" style="background: #ef4444; border-color: #ef4444; padding: 0.5rem 1rem; font-size: 0.85rem; width: auto;">Disconnect</button>
                                    </div>
                                </div>
                            @else
                                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(59, 130, 246, 0.2); color: #3b82f6; border-radius: 50%;">
                                            <i data-lucide="info" style="width: 20px; height: 20px;"></i>
                                        </span>
                                        <div>
                                            <h4 style="margin: 0; color: #fff; font-size: 0.95rem;">Connect to Google Account</h4>
                                            <p style="margin: 0; font-size: 0.8rem; color: var(--admin-text-muted);">Link your account automatically to easily select your properties from a list.</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.google.auth') }}" class="btn-submit" style="background: #3b82f6; border-color: #3b82f6; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1rem; font-size: 0.85rem; width: auto; gap: 5px;">
                                        <i data-lucide="link" style="width: 14px; height: 14px;"></i> Connect Google
                                    </a>
                                </div>
                            @endif

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="google_oauth_client_id">OAuth Client ID</label>
                                    <input type="text" id="google_oauth_client_id" name="google_oauth_client_id" class="form-control" value="{{ $site['google_oauth_client_id'] ?? '' }}" placeholder="e.g. 123456-xxx.apps.googleusercontent.com" autocomplete="off">
                                    <small style="color: var(--admin-text-muted); font-size: 0.75rem;">Create a Web Application OAuth Client ID in your Google Cloud Console Credentials.</small>
                                </div>
                                <div class="form-group">
                                    <label for="google_oauth_client_secret">OAuth Client Secret</label>
                                    <input type="password" id="google_oauth_client_secret" name="google_oauth_client_secret" class="form-control" value="{{ $site['google_oauth_client_secret'] ?? '' }}" placeholder="Enter Client Secret..." autocomplete="new-password">
                                    <small style="color: var(--admin-text-muted); font-size: 0.75rem;">Set Authorized Redirect URIs in your Google Console to: <code>{{ route('admin.google.callback') }}</code></small>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" style="width: auto; padding: 0.6rem 1.5rem;">Save Google Settings</button>
                    </form>
                    <form id="disconnect-form" action="{{ route('admin.google.disconnect') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                    <div id="google-analytics-warning-banner" class="alert-success" style="display: none; background-color: rgba(245, 158, 11, 0.1); border-color: rgba(245, 158, 11, 0.3); color: #fbbf24; margin-top: 1.5rem; margin-bottom: 1.5rem;">
                        <i data-lucide="alert-triangle"></i>
                        <span id="google-analytics-warning-msg"></span>
                    </div>
            </div>
            @endif

            <!-- SEO OPTIMIZER TAB -->
            <div class="tab-panel @if($activeTab === 'seo') active @endif" id="tab-seo">
                @php
                    $savedRootUrl = \App\Models\PageContent::where('page', 'seo')->where('section', 'settings')->where('key', 'base_url')->value('value') 
                                    ?: (\App\Models\SiteParameter::where('id', 'site_root_url')->value('value') ?: 'https://www.stonehubindia.com');
                    
                    $sitemapExists = is_file(public_path('sitemap.xml'));
                    $sitemapSize = $sitemapExists ? round(filesize(public_path('sitemap.xml')) / 1024, 1) . ' KB' : 'Not generated';
                    $sitemapTime = $sitemapExists ? date('d M Y, h:i A', filemtime(public_path('sitemap.xml'))) : 'Never';

                    $robotsExists = is_file(public_path('robots.txt'));
                    $robotsSize = $robotsExists ? round(filesize(public_path('robots.txt')) / 1024, 1) . ' KB' : 'Not generated';
                    $robotsTime = $robotsExists ? date('d M Y, h:i A', filemtime(public_path('robots.txt'))) : 'Never';

                    $llmsExists = is_file(public_path('llms.txt'));
                    $llmsSize = $llmsExists ? round(filesize(public_path('llms.txt')) / 1024, 1) . ' KB' : 'Not generated';
                    $llmsTime = $llmsExists ? date('d M Y, h:i A', filemtime(public_path('llms.txt'))) : 'Never';
                @endphp

                <!-- 1. SEO & LLMO Engine: Sitemap, Robots.txt, and LLMS.txt Generator -->
                <div class="admin-card" id="seo-files-generator-card">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:1.25rem; flex-wrap:wrap; gap:12px;">
                        <div>
                            <h2 style="display:flex; align-items:center; gap:8px; margin:0 0 6px 0;">
                                <i data-lucide="network" style="width:24px;height:24px;color:var(--admin-gold, #c5a880);"></i>
                                Search Engine & AI Optimization (Sitemap, Robots.txt & LLMO)
                            </h2>
                            <p style="font-size: 0.85rem; color: var(--admin-text-muted, #8e8e9f); margin: 0;">
                                Regenerate your dynamic <strong>sitemap.xml</strong>, crawler directives <strong>robots.txt</strong>, and modern AI resource index <strong>llms.txt / llms-full.txt (LLMO)</strong> with your custom canonical Root URL.
                            </p>
                        </div>
                    </div>

                    <!-- Root URL Input Box -->
                    <div style="background: var(--admin-card-inner-bg, #18181e); padding: 1.25rem; border-radius: 10px; border: 1px solid var(--admin-border, #2d2d38); margin-bottom: 1.5rem;">
                        <div class="form-group" style="margin-bottom: 0.5rem;">
                            <label for="seo_root_url" style="font-weight: 600; display:flex; justify-content:space-between; align-items:center;">
                                <span>Main Website Root URL (Canonical Domain)</span>
                                <span style="font-size:0.75rem; color:var(--admin-gold, #c5a880);">All sitemap & LLMO links will use this prefix</span>
                            </label>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <div style="position: relative; flex-grow: 1; min-width: 260px;">
                                    <input type="url" id="seo_root_url" class="form-control" value="{{ $savedRootUrl }}" placeholder="https://www.stonehubindia.com" required style="font-family: monospace; font-size: 0.95rem; padding-left: 36px;">
                                    <i data-lucide="globe" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--admin-text-muted);"></i>
                                </div>
                                <button type="button" class="btn-submit" onclick="regenerateAllSeoFiles()" id="btn-regen-all" style="width: auto; padding: 0.65rem 1.4rem; white-space: nowrap; display: flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #c5a880 0%, #a48255 100%); color: #000; font-weight: 700; border: none; border-radius: 6px; cursor: pointer;">
                                    <i data-lucide="refresh-cw" style="width: 16px; height: 16px;"></i>
                                    Regenerate All Files
                                </button>
                            </div>
                            <small style="color: var(--admin-text-muted); font-size: 0.78rem; display: block; margin-top: 6px;">
                                e.g. <code>https://www.stonehubindia.com</code> (Use your live production domain or staging domain).
                            </small>
                        </div>
                    </div>

                    <!-- 3 Individual File Control Cards -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 1.25rem;">
                        
                        <!-- 1. Sitemap.xml Card -->
                        <div style="background: var(--admin-card-inner-bg, #141418); border: 1px solid var(--admin-border, #2d2d38); border-radius: 10px; padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                    <h3 style="margin: 0; font-size: 1rem; color: #fff; display: flex; align-items: center; gap: 6px;">
                                        <i data-lucide="file-code" style="width: 18px; height: 18px; color: #4ade80;"></i>
                                        sitemap.xml
                                    </h3>
                                    <span id="sitemap-status-badge" style="font-size: 0.72rem; padding: 2px 8px; border-radius: 12px; background: rgba(74, 222, 128, 0.15); color: #4ade80; font-weight: 600;">
                                        {{ $sitemapSize }}
                                    </span>
                                </div>
                                <p style="font-size: 0.8rem; color: var(--admin-text-muted); line-height: 1.4; margin-bottom: 0.75rem;">
                                    Indexes all pages, collections (19), marble slabs (113+), and blogs (268) for Google & Bing web crawlers.
                                </p>
                                <div style="font-size: 0.75rem; color: var(--admin-text-muted); margin-bottom: 1rem;">
                                    Last generated: <span id="sitemap-time" style="color: #fff;">{{ $sitemapTime }}</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <button type="button" class="btn-submit" onclick="regenerateSpecificSeoFile('sitemap')" id="btn-regen-sitemap" style="flex: 1; padding: 0.5rem 0.75rem; font-size: 0.8rem; background: rgba(255,255,255,0.06); border: 1px solid var(--admin-border); color: #fff; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 5px;">
                                    <i data-lucide="refresh-cw" style="width: 13px; height: 13px;"></i> Regenerate
                                </button>
                                <a id="sitemap-view-link" href="{{ url('/sitemap.xml') }}" target="_blank" rel="noopener" style="padding: 0.5rem 0.85rem; font-size: 0.8rem; background: rgba(197,168,128,0.15); border: 1px solid rgba(197,168,128,0.3); color: var(--admin-gold, #c5a880); border-radius: 6px; text-decoration: none; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                                    View <i data-lucide="external-link" style="width: 12px; height: 12px;"></i>
                                </a>
                            </div>
                        </div>

                        <!-- 2. Robots.txt Card -->
                        <div style="background: var(--admin-card-inner-bg, #141418); border: 1px solid var(--admin-border, #2d2d38); border-radius: 10px; padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                    <h3 style="margin: 0; font-size: 1rem; color: #fff; display: flex; align-items: center; gap: 6px;">
                                        <i data-lucide="bot" style="width: 18px; height: 18px; color: #60a5fa;"></i>
                                        robots.txt
                                    </h3>
                                    <span id="robots-status-badge" style="font-size: 0.72rem; padding: 2px 8px; border-radius: 12px; background: rgba(96, 165, 250, 0.15); color: #60a5fa; font-weight: 600;">
                                        {{ $robotsSize }}
                                    </span>
                                </div>
                                <p style="font-size: 0.8rem; color: var(--admin-text-muted); line-height: 1.4; margin-bottom: 0.75rem;">
                                    Controls bot access rules, protects admin routes, and explicitly authorizes AI crawlers (GPTBot, Claude, Perplexity).
                                </p>
                                <div style="font-size: 0.75rem; color: var(--admin-text-muted); margin-bottom: 1rem;">
                                    Last generated: <span id="robots-time" style="color: #fff;">{{ $robotsTime }}</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <button type="button" class="btn-submit" onclick="regenerateSpecificSeoFile('robots')" id="btn-regen-robots" style="flex: 1; padding: 0.5rem 0.75rem; font-size: 0.8rem; background: rgba(255,255,255,0.06); border: 1px solid var(--admin-border); color: #fff; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 5px;">
                                    <i data-lucide="refresh-cw" style="width: 13px; height: 13px;"></i> Regenerate
                                </button>
                                <a id="robots-view-link" href="{{ url('/robots.txt') }}" target="_blank" rel="noopener" style="padding: 0.5rem 0.85rem; font-size: 0.8rem; background: rgba(197,168,128,0.15); border: 1px solid rgba(197,168,128,0.3); color: var(--admin-gold, #c5a880); border-radius: 6px; text-decoration: none; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                                    View <i data-lucide="external-link" style="width: 12px; height: 12px;"></i>
                                </a>
                            </div>
                        </div>

                        <!-- 3. LLMS.txt / LLMO Card -->
                        <div style="background: var(--admin-card-inner-bg, #141418); border: 1px solid var(--admin-border, #2d2d38); border-radius: 10px; padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                    <h3 style="margin: 0; font-size: 1rem; color: #fff; display: flex; align-items: center; gap: 6px;">
                                        <i data-lucide="sparkles" style="width: 18px; height: 18px; color: #f43f5e;"></i>
                                        llms.txt (LLMO)
                                    </h3>
                                    <span id="llms-status-badge" style="font-size: 0.72rem; padding: 2px 8px; border-radius: 12px; background: rgba(244, 63, 94, 0.15); color: #f43f5e; font-weight: 600;">
                                        {{ $llmsSize }}
                                    </span>
                                </div>
                                <p style="font-size: 0.8rem; color: var(--admin-text-muted); line-height: 1.4; margin-bottom: 0.75rem;">
                                    LLM Markdown Optimization standard file that feeds your full marble inventory and stone guides to ChatGPT, Claude, and Gemini.
                                </p>
                                <div style="font-size: 0.75rem; color: var(--admin-text-muted); margin-bottom: 1rem;">
                                    Last generated: <span id="llms-time" style="color: #fff;">{{ $llmsTime }}</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <button type="button" class="btn-submit" onclick="regenerateSpecificSeoFile('llms')" id="btn-regen-llms" style="flex: 1; padding: 0.5rem 0.75rem; font-size: 0.8rem; background: rgba(255,255,255,0.06); border: 1px solid var(--admin-border); color: #fff; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 5px;">
                                    <i data-lucide="refresh-cw" style="width: 13px; height: 13px;"></i> Regenerate
                                </button>
                                <a id="llms-view-link" href="{{ url('/llms.txt') }}" target="_blank" rel="noopener" style="padding: 0.5rem 0.85rem; font-size: 0.8rem; background: rgba(197,168,128,0.15); border: 1px solid rgba(197,168,128,0.3); color: var(--admin-gold, #c5a880); border-radius: 6px; text-decoration: none; display: flex; align-items: center; gap: 4px; font-weight: 600;">
                                    View <i data-lucide="external-link" style="width: 12px; height: 12px;"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Live Content Inspector Box (Collapsible) -->
                    <div id="seo-file-preview-wrap" style="display: none; margin-top: 1.5rem; background: var(--admin-card-inner-bg, #101014); border: 1px solid var(--admin-border, #2d2d38); border-radius: 10px; overflow: hidden;">
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.25rem; background: #16161c; border-bottom: 1px solid var(--admin-border, #2d2d38);">
                            <span id="seo-preview-filename" style="font-family: monospace; font-size: 0.85rem; color: var(--admin-gold, #c5a880); font-weight: 600;">sitemap.xml Preview</span>
                            <button type="button" onclick="document.getElementById('seo-file-preview-wrap').style.display='none'" style="background: none; border: none; color: #a1a1aa; cursor: pointer; font-size: 1.2rem; line-height: 1;">&times;</button>
                        </div>
                        <pre id="seo-preview-content" style="margin: 0; padding: 1.25rem; font-family: monospace; font-size: 0.78rem; color: #e2e8f0; max-height: 320px; overflow-y: auto; white-space: pre-wrap; word-break: break-all;"></pre>
                    </div>
                </div>

                <!-- 2. AI SEO Recommendations & Blueprint -->
                <div class="admin-card">
                    <h2><i data-lucide="trending-up" style="display: inline-block; vertical-align: middle; margin-right: 5px;"></i> AI SEO Recommendations & Link-Building Blueprint</h2>
                    <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                        Enter the target keywords or topics you want to rank for. Our AI will analyze search intent and draft a comprehensive blueprint of content ideas, guest articles, Quora answers, social copy, bookmarking platforms, and backlink opportunities.
                    </p>
                    <div class="form-group">
                        <label for="seo_keywords">Target Keywords (comma-separated or one per line)</label>
                        <textarea id="seo_keywords" class="form-control" rows="3" placeholder="e.g. knee replacement baner pune, best orthopedic doctor, physiotherapy at home pune"></textarea>
                    </div>
                    <button type="button" class="btn-ai-sparkle" onclick="generateSeoRecommendations()" style="margin-top: 1rem; padding: 0.75rem 1.5rem; font-size: 0.95rem;">
                        <i data-lucide="sparkles"></i> Generate SEO Blueprint
                    </button>
                </div>

                <div class="admin-card" id="seo-loader" style="display: none; padding: 4rem 2rem; text-align: center;">
                    <div class="ai-sparkle-loader" style="margin: 0 auto 1.5rem auto;"></div>
                    <h3 style="margin: 0; font-size: 1.25rem;">Analyzing Keywords & Formulating SEO Blueprint...</h3>
                    <p style="color: var(--admin-text-muted); margin-top: 5px; font-size: 0.9rem;">Gemini is researching backlink strategies and content maps in the background.</p>
                </div>

                <div id="seo-results" style="display: none;">
                    <!-- Quick tabs inside results to switch categories -->
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 1.5rem; border-bottom: 1px solid var(--admin-border); padding-bottom: 10px; flex-wrap: wrap;">
                        <div style="display: flex; gap: 8px; overflow-x: auto; flex-grow: 1; padding-bottom: 5px;">
                            <button type="button" class="btn-submit active" id="seo-tab-btn-content" onclick="switchSeoResultTab('content')" style="width: auto; padding: 0.5rem 1rem; font-size: 0.85rem;">Pages & Blogs</button>
                            <button type="button" class="btn-submit" id="seo-tab-btn-backlinks" onclick="switchSeoResultTab('backlinks')" style="width: auto; padding: 0.5rem 1rem; font-size: 0.85rem; background-color: var(--admin-input-bg); color: #fff;">Backlink Targets</button>
                            <button type="button" class="btn-submit" id="seo-tab-btn-quora" onclick="switchSeoResultTab('quora')" style="width: auto; padding: 0.5rem 1rem; font-size: 0.85rem; background-color: var(--admin-input-bg); color: #fff;">Quora & Q&A</button>
                            <button type="button" class="btn-submit" id="seo-tab-btn-social" onclick="switchSeoResultTab('social')" style="width: auto; padding: 0.5rem 1rem; font-size: 0.85rem; background-color: var(--admin-input-bg); color: #fff;">Social & Pinterest</button>
                            <button type="button" class="btn-submit" id="seo-tab-btn-bookmarking" onclick="switchSeoResultTab('bookmarking')" style="width: auto; padding: 0.5rem 1rem; font-size: 0.85rem; background-color: var(--admin-input-bg); color: #fff;">Bookmarking & Syndication</button>
                            <button type="button" class="btn-submit" id="seo-tab-btn-other" onclick="switchSeoResultTab('other')" style="width: auto; padding: 0.5rem 1rem; font-size: 0.85rem; background-color: var(--admin-input-bg); color: #fff;">Growth Tactics</button>
                        </div>
                        <div>
                            <button type="button" class="btn-submit" onclick="downloadSeoPdf()" style="width: auto; padding: 0.5rem 1.25rem; font-size: 0.85rem; background-color: transparent; border: 1px solid #ffffff; color: #ffffff; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; border-radius: var(--radius-md);">
                                <i data-lucide="download" style="width: 16px; height: 16px;"></i> Download PDF Report
                            </button>
                        </div>
                    </div>

                    <!-- Result Panels -->
                    <!-- 1. Content Panel -->
                    <div class="seo-result-panel active" id="seo-panel-content">
                        <div class="admin-card">
                            <h2>On-Site Content Structure Recommendations</h2>
                            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Create new pages or write detailed blog posts for these target keywords to establish topical authority.</p>
                            <div class="admin-table-wrap">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%;">Type</th>
                                            <th style="width: 25%;">Recommended Title</th>
                                            <th style="width: 20%;">Target Keywords</th>
                                            <th style="width: 40%;">Content Outline & Search Intent</th>
                                        </tr>
                                    </thead>
                                    <tbody id="seo-table-content"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Backlinks Panel -->
                    <div class="seo-result-panel" id="seo-panel-backlinks" style="display: none;">
                        <div class="admin-card">
                            <h2>Third-Party Off-Site Content & Backlinks</h2>
                            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Draft guest posts or articles to pitch to financial portals and external platforms to build domain authority.</p>
                            <div class="admin-table-wrap">
                                <table class="admin-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;">Platform Type</th>
                                            <th style="width: 30%;">Article Title Idea</th>
                                            <th style="width: 20%;">Target Anchor Keywords</th>
                                            <th style="width: 30%;">Backlink Integration Context</th>
                                        </tr>
                                    </thead>
                                    <tbody id="seo-table-backlinks"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Quora Panel -->
                    <div class="seo-result-panel" id="seo-panel-quora" style="display: none;">
                        <div class="admin-card">
                            <h2>Quora Authority Building & Referral Traffic</h2>
                            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Answer these questions on Quora to capture high-intent referral traffic and establish financial niche expertise.</p>
                            <div id="seo-cards-quora" style="display: flex; flex-direction: column; gap: 1rem;"></div>
                        </div>
                    </div>

                    <!-- 4. Social & Pinterest Panel -->
                    <div class="seo-result-panel" id="seo-panel-social" style="display: none;">
                        <div class="form-grid">
                            <div class="admin-card">
                                <h2>Pinterest Graphic & Post Layouts</h2>
                                <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Create high-engagement pins targeting financial boards.</p>
                                <div class="admin-table-wrap">
                                    <table class="admin-table">
                                        <thead>
                                            <tr>
                                                <th>Overlay Bold Text</th>
                                                <th>Visual Graphic Concept</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody id="seo-table-pinterest"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="admin-card">
                                <h2>Written Social Media Posts</h2>
                                <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Ready-to-use captions and concepts for LinkedIn, Facebook, and Instagram.</p>
                                <div id="seo-cards-social" style="display: flex; flex-direction: column; gap: 1rem;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Bookmarking & Syndication Panel -->
                    <div class="seo-result-panel" id="seo-panel-bookmarking" style="display: none;">
                        <div class="form-grid">
                            <div class="admin-card">
                                <h2>Bookmarking Websites & Submission Strategy</h2>
                                <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Share links to your newly written pages on these social bookmarking platforms.</p>
                                <div class="admin-table-wrap">
                                    <table class="admin-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%;">Platform</th>
                                                <th style="width: 75%;">Tactical Submission Strategy</th>
                                            </tr>
                                        </thead>
                                        <tbody id="seo-table-bookmarking"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="admin-card">
                                <h2>Blog Promotion & Syndication Websites</h2>
                                <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Republish or syndicate your blog posts to reach wider audiences.</p>
                                <div class="admin-table-wrap">
                                    <table class="admin-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%;">Platform</th>
                                                <th style="width: 75%;">Tactical Syndication Strategy</th>
                                            </tr>
                                        </thead>
                                        <tbody id="seo-table-syndication"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Other growth tactics -->
                    <div class="seo-result-panel" id="seo-panel-other" style="display: none;">
                        <div class="admin-card">
                            <h2>Growth Tactics & Backlink Submission Blueprints</h2>
                            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">Implement these white-hat link acquisition strategies to grow domain authority.</p>
                            <div id="seo-cards-other" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;"></div>
                        </div>
                    </div>
                </div>

                <!-- XML Sitemap Generator Card -->
                <div class="admin-card" style="margin-top: 2rem;">
                    <h2><i data-lucide="map" style="display: inline-block; vertical-align: middle; margin-right: 5px;"></i> XML Sitemap Generator</h2>
                    <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                        Regenerate the website XML sitemap to include all newly created service pages, blog articles, and landing pages for search engines like Google.
                    </p>
                    <form action="{{ route('admin.sitemap.generate') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-submit" style="width: auto; padding: 0.75rem 1.5rem;">
                            <i data-lucide="refresh-cw" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle; margin-right: 4px;"></i> Regenerate Sitemap
                        </button>
                    </form>
                    <p style="font-size: 0.85rem; margin-top: 10px; color: var(--admin-text-muted);">
                        Sitemap URL: <a href="/sitemap.xml" target="_blank" style="color: var(--mint-green); text-decoration: underline;">/sitemap.xml</a>
                    </p>
                </div>
            </div>

            @if($isSuper)
            <!-- Admin Users Tab Panel -->
            <div class="tab-panel @if($activeTab === 'users') active @endif" id="tab-users">
                <div class="admin-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 15px;">
                        <div>
                            <h2 style="margin: 0;"><i data-lucide="user" style="display: inline-block; vertical-align: middle; margin-right: 5px;"></i> Admin Users Management</h2>
                            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin: 5px 0 0 0;">
                                Add more administrators, change their email/password, and fine-tune their module permissions.
                            </p>
                        </div>
                        <button type="button" class="btn-submit" onclick="openCreateUserModal()" style="width: auto; padding: 0.65rem 1.25rem; font-size: 0.85rem; background-color: var(--mint-green); color: #0d1718; display: inline-flex; align-items: center; gap: 6px;">
                            <i data-lucide="user-plus" style="width: 16px; height: 16px;"></i> Create Admin User
                        </button>
                    </div>

                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ID</th>
                                    <th style="width: 20%;">Name</th>
                                    <th style="width: 25%;">Email</th>
                                    <th style="width: 15%;">Role</th>
                                    <th style="width: 20%;">Module Permissions</th>
                                    <th style="width: 15%; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $usr)
                                    <tr>
                                        <td>{{ $usr->id }}</td>
                                        <td><strong>{{ $usr->name }}</strong></td>
                                        <td>{{ $usr->email }}</td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $usr->role === 'superadmin' ? 'rgba(92, 203, 179, 0.15)' : 'rgba(255,255,255,0.06)' }}; color: {{ $usr->role === 'superadmin' ? 'var(--mint-green)' : '#fff' }}; border: 1px solid {{ $usr->role === 'superadmin' ? 'rgba(92, 203, 179, 0.3)' : 'rgba(255,255,255,0.1)' }}; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem; text-transform: uppercase;">
                                                {{ $usr->role }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($usr->role === 'superadmin' || (is_array($usr->permissions) && in_array('all', $usr->permissions)))
                                                <span style="color: var(--mint-green); font-size: 0.8rem;">All Modules (*)</span>
                                            @else
                                                <span style="font-size: 0.8rem; line-height: 1.4; display: block; color: var(--admin-text-muted);">
                                                    {{ implode(', ', array_map(function($p) use ($modules) { return $modules[$p] ?? $p; }, is_array($usr->permissions) ? $usr->permissions : (json_decode($usr->permissions ?? '[]', true) ?: []))) ?: 'None' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                                <button type="button" class="btn-action edit" title="Edit Admin" onclick="openEditUserModal('{{ json_encode($usr) }}')">
                                                    <i data-lucide="edit" style="width: 14px; height: 14px;"></i>
                                                </button>
                                                @if(Auth::id() !== $usr->id)
                                                    <form action="{{ route('admin.users.delete', $usr->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin user?');" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn-action delete" title="Delete Admin">
                                                            <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif


            @if($hasAccess('seo'))
            <!-- Web Notifications Management Tab Panel -->
            <div class="tab-panel @if($activeTab === 'notifications') active @endif" id="tab-notifications">
                <div class="form-grid" style="grid-template-columns: 2fr 1fr; gap: 1.5rem; align-items: start;">
                    
                    <!-- Broadcaster Form Card -->
                    <div class="admin-card">
                        <h2><i data-lucide="bell" style="display: inline-block; vertical-align: middle; margin-right: 5px;"></i> Push Notification Broadcaster</h2>
                        <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem; margin-top: -1rem;">
                            Compose a notification to broadcast instantly to all subscribed visitor browsers. You can select an existing site entity to auto-fill the details.
                        </p>
                        
                        <form action="{{ route('admin.notifications.broadcast') }}" method="POST" id="broadcast-form">
                            @csrf
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label for="broadcast_type">Link Notification To:</label>
                                <select id="broadcast_type" name="type" class="form-control" onchange="handleBroadcastTypeChange(this.value)">
                                    <option value="custom">Custom Message (Manual URL)</option>
                                    <option value="blog">Blog Post</option>
                                    <option value="service">Service Page</option>
                                    <option value="cms_page">Custom CMS Page</option>
                                    <option value="landing">AI Landing Page</option>
                                    <option value="specialist">Specialist Doctor Profile</option>
                                </select>
                            </div>

                            <!-- Dynamic Selectors (initially hidden) -->
                            <div class="form-group" id="group-select-blog" style="display: none; margin-bottom: 1rem;">
                                <label for="select_blog">Select Blog Article:</label>
                                <select id="select_blog" class="form-control" onchange="autoFillFromEntity('blog', this.value)">
                                    <option value="">-- Choose Blog --</option>
                                    @foreach($blogs as $b)
                                        <option value="{{ $b->id }}" data-title="{{ $b->title }}" data-summary="{{ Str::limit(strip_tags($b->summary), 150) }}" data-url="{{ route('blog.show', $b->slug) }}">{{ $b->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="group-select-service" style="display: none; margin-bottom: 1rem;">
                                <label for="select_service">Select Collection:</label>
                                <select id="select_service" class="form-control" onchange="autoFillFromEntity('service', this.value)">
                                    <option value="">-- Choose Collection --</option>
                                    @foreach($collections as $s)
                                        <option value="{{ $s->id }}" data-title="{{ $s->name }}" data-summary="{{ Str::limit(strip_tags($s->description), 150) }}" data-url="{{ Route::has('collections.show') ? route('collections.show', $s->slug) : url('/collection/' . $s->slug) }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="group-select-cms_page" style="display: none; margin-bottom: 1rem;">
                                <label for="select_cms_page">Select Custom Page:</label>
                                <select id="select_cms_page" class="form-control" onchange="autoFillFromEntity('cms_page', this.value)">
                                    <option value="">-- Choose CMS Page --</option>
                                    @foreach($cmsPages as $cp)
                                        <option value="{{ $cp->id }}" data-title="{{ $cp->title }}" data-summary="Learn more about our clinic services: {{ $cp->title }}" data-url="{{ url('/' . $cp->slug) }}">{{ $cp->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="group-select-landing" style="display: none; margin-bottom: 1rem;">
                                <label for="select_landing">Select AI Landing Page:</label>
                                <select id="select_landing" class="form-control" onchange="autoFillFromEntity('landing', this.value)">
                                    <option value="">-- Choose Landing Page --</option>
                                    @foreach($landingPages as $lp)
                                        <option value="{{ $lp->id }}" data-title="{{ $lp->target_title }}" data-summary="{{ Str::limit(strip_tags($lp->hero_subtitle), 150) }}" data-url="{{ Route::has('landing.show') ? route('landing.show', $lp->slug) : url('/landing/' . $lp->slug) }}">{{ $lp->target_title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="group-select-specialist" style="display: none; margin-bottom: 1rem;">
                                <label for="select_specialist">Select Specialist Profile:</label>
                                <select id="select_specialist" class="form-control" onchange="autoFillFromEntity('specialist', this.value)">
                                    <option value="">-- Choose Specialist --</option>
                                    @foreach($specialists as $sp)
                                        <option value="{{ $sp->id }}" data-title="{{ $sp->name }}" data-summary="{{ $sp->designation }} - specialist profile." data-url="{{ route('specialists.show', $sp->slug) }}">{{ $sp->name }} ({{ $sp->designation }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Title, Message, URL -->
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label for="broadcast_title">Notification Title</label>
                                <input type="text" id="broadcast_title" name="title" class="form-control" required placeholder="e.g. New Treatment Available!" oninput="updateLivePreview()">
                            </div>

                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label for="broadcast_message">Message Body</label>
                                <textarea id="broadcast_message" name="message" class="form-control" rows="3" required placeholder="Enter description details (keep under 200 characters)..." oninput="updateLivePreview()"></textarea>
                            </div>

                            <div class="form-group" style="margin-bottom: 1.5rem;">
                                <label for="broadcast_url">Notification Redirect URL</label>
                                <input type="url" id="broadcast_url" name="url" class="form-control" placeholder="e.g. https://www.drsumitz.com/blogs/my-post" oninput="updateLivePreview()">
                            </div>

                            <button type="submit" class="btn-submit" style="background-color: var(--mint-green); color: #0d1718; font-weight: 700; width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <i data-lucide="send"></i> Broadcast Push Alert
                            </button>
                        </form>
                    </div>

                    <!-- Live Preview Card -->
                    <div class="admin-card" style="position: sticky; top: 20px;">
                        <h2>Live Preview</h2>
                        <p style="font-size: 0.8rem; color: var(--admin-text-muted); margin-bottom: 1rem; margin-top: -0.5rem;">
                            How this notification will display on visitor browsers:
                        </p>
                        
                        <div style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3); font-family: sans-serif; display: flex; gap: 12px; align-items: start; color: white;">
                            <div style="width: 36px; height: 36px; border-radius: 6px; background-color: var(--mint-green); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i data-lucide="bell" style="width: 18px; height: 18px; color: #0d1718;"></i>
                            </div>
                            <div style="flex-grow: 1; overflow: hidden;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2px;">
                                    <strong id="preview-title" style="font-size: 0.85rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px;">Dr. Sumitz Clinic</strong>
                                    <span style="font-size: 0.65rem; color: #94a3b8;">now</span>
                                </div>
                                <p id="preview-message" style="margin: 0; font-size: 0.75rem; color: #cbd5e1; line-height: 1.3; word-break: break-word;">Waiting for input details...</p>
                                <span id="preview-url" style="display: block; font-size: 0.65rem; color: var(--mint-green); margin-top: 4px; text-decoration: underline; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px;">https://www.drsumitz.com</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Sent Notifications Log -->
                <div class="admin-card" style="margin-top: 2rem;">
                    <h2>Sent Notifications History</h2>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ID</th>
                                    <th style="width: 20%;">Title</th>
                                    <th style="width: 40%;">Message Details</th>
                                    <th style="width: 20%;">Redirect URL</th>
                                    <th style="width: 15%;">Broadcast Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notificationsLog as $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td><strong>{{ $log->title }}</strong></td>
                                        <td>{{ $log->message }}</td>
                                        <td>
                                            @if($log->url)
                                                <a href="{{ $log->url }}" target="_blank" style="color: var(--mint-green); text-decoration: underline; font-size: 0.8rem;">{{ Str::limit($log->url, 40) }}</a>
                                            @else
                                                <span style="color: var(--admin-text-muted); font-size: 0.8rem;">None</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, h:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: var(--admin-text-muted);">No broadcast alerts sent yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top: 1rem;">
                        {{ $notificationsLog->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>


    </div>

    <!-- AI Toast Notification Container -->
    <div id="ai-toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 999999; display: flex; flex-direction: column; gap: 10px;"></div>

    <!-- AI Landing Page Generator Modal -->
    <div class="ai-modal-overlay" id="ai-landing-modal">
        <div class="ai-modal-card">
            <button class="ai-modal-close" onclick="closeAiModal('landing')">&times;</button>
            <h3><i data-lucide="sparkles"></i> AI Landing Page Generator</h3>
            
            <input type="hidden" id="ai_landing_id" value="">
            <div id="ai-landing-form-wrapper">
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label>Page Title</label>
                    <input type="text" id="ai_landing_target_title" class="form-control" readonly style="opacity: 0.7;">
                </div>
                <div class="form-group">
                    <label for="ai_landing_prompt">Prompt / Describe the topic for this Landing Page</label>
                    <textarea id="ai_landing_prompt" class="form-control" rows="4" placeholder="e.g. Special knee joint replacement consultation campaign for senior citizens in Pune with computerized navigation and rapid recovery details..."></textarea>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <button type="button" class="btn-ai-sparkle" onclick="generateAiLandingPage()"><i data-lucide="sparkles"></i> Generate Content</button>
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff; width: auto;" onclick="closeAiModal('landing')">Cancel</button>
                </div>
            </div>
            
            <div class="ai-loader-container" id="ai-landing-loader">
                <div class="ai-sparkle-loader"></div>
                <p class="ai-loader-text">Gemini is designing and writing your landing page...</p>
                <p class="ai-loader-subtext">This can take up to 10-15 seconds.</p>
            </div>
        </div>
    </div>

    <!-- AI Blog Generator Modal -->
    <div class="ai-modal-overlay" id="ai-blog-modal">
        <div class="ai-modal-card">
            <button class="ai-modal-close" onclick="closeAiModal('blog')">&times;</button>
            <h3><i data-lucide="sparkles"></i> AI Blog Article Generator</h3>
            
            <div id="ai-blog-form-wrapper">
                <div class="form-group">
                    <label for="ai_blog_prompt">What should the blog article be about?</label>
                    <textarea id="ai_blog_prompt" class="form-control" rows="4" placeholder="e.g. Benefits of physiotherapy for chronic joint pain, recovering post knee surgery, or preventing back pain at a desk job..."></textarea>

                </div>
                
                <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="ai_blog_tone">Writing Tone</label>
                        <select id="ai_blog_tone" class="form-control">
                            <option value="Professional & Informative">Professional & Informative</option>
                            <option value="Conversational & Friendly">Conversational & Friendly</option>
                            <option value="Persuasive & Engaging">Persuasive & Engaging</option>
                            <option value="Simple & Clear">Simple & Clear</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: flex; align-items: center; margin-top: 1.5rem;">
                        <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.85rem;">
                            <input type="checkbox" id="ai_blog_gen_image" value="1" checked style="width: 16px; height: 16px; accent-color: var(--mint-green);">
                            Generate Cover Image
                        </label>
                    </div>
                </div>
                
                <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff;" onclick="closeAiModal('blog')">Cancel</button>
                    <button type="button" class="btn-ai-sparkle" onclick="generateAiBlog()"><i data-lucide="sparkles"></i> Generate Draft</button>
                </div>
            </div>
            
            <div class="ai-loader-container" id="ai-blog-loader">
                <div class="ai-sparkle-loader"></div>
                <p class="ai-loader-text">Gemini is writing your article...</p>
                <p class="ai-loader-subtext">This can take up to 20-30 seconds depending on image generation.</p>
            </div>
        </div>
    </div>

    <!-- GMB Sharing Modal -->
    <div class="ai-modal-overlay" id="gmb-share-modal">
        <div class="ai-modal-card">
            <button class="ai-modal-close" onclick="closeGmbModal()">&times;</button>
            <h3><i data-lucide="share-2" style="color: #4285F4; display: inline-block; vertical-align: middle;"></i> Share to Google Business Profile</h3>
            
            <div id="gmb-form-wrapper">
                <input type="hidden" id="gmb_post_type">
                <input type="hidden" id="gmb_post_id">
                <input type="hidden" id="gmb_target_url">
                
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label><strong>Post Text Copy (AI Generated or Custom)</strong></label>
                    <textarea id="gmb_post_text" class="form-control" rows="8" placeholder="Drafting your GMB post..."></textarea>
                </div>
                
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label><strong>Action Button (CTA) Target Link</strong></label>
                    <input type="text" id="gmb_post_cta_url" class="form-control" readonly style="background-color: var(--admin-input-bg); opacity: 0.8;">
                    <span style="font-size: 0.75rem; color: var(--admin-text-muted); display: block; margin-top: 5px;">
                        This CTA button redirects users to the page above with the label "Learn More".
                    </span>
                </div>
                
                <div style="background: rgba(232, 92, 36, 0.1); border: 1px solid rgba(232, 92, 36, 0.3); border-radius: var(--radius-sm); padding: 12px; margin-bottom: 1.5rem; font-size: 0.85rem;" id="gmb-manual-notice">
                    <strong style="color: var(--accent-orange);"><i data-lucide="info" style="width: 14px; height: 14px; display: inline; vertical-align: middle;"></i> Tip:</strong>
                    Copy the draft and use the "Open GMB Dashboard" button to publish it manually on Google Business Profile if GBP API is not configured.
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <button type="button" class="btn-ai-sparkle" onclick="generateGmbDraft()" id="gmb-draft-btn" style="padding: 0.5rem 1rem; font-size: 0.85rem; width: auto;">
                            <i data-lucide="sparkles"></i> Draft with AI
                        </button>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff; width: auto;" onclick="closeGmbModal()">Cancel</button>
                        
                        @if(!empty($site['gmb_location_id']) && !empty($site['gmb_access_token']))
                            <button type="button" class="btn-submit" style="background-color: #4285F4; color: #fff; width: auto;" onclick="publishGmbPostDirect()" id="gmb-publish-btn">
                                <i data-lucide="check"></i> Publish Now
                            </button>
                        @endif
                        
                        <button type="button" class="btn-submit" style="background-color: var(--mint-green); color: var(--primary-teal-dark); width: auto;" onclick="copyAndOpenGmb()" id="gmb-manual-btn">
                            <i data-lucide="external-link"></i> Copy & Open Dashboard
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="ai-loader-container" id="gmb-loader" style="display: none;">
                <div class="ai-sparkle-loader" style="margin: 0 auto 1.5rem auto;"></div>
                <p class="ai-loader-text" id="gmb-loader-text">Drafting post with Gemini AI...</p>
            </div>
        </div>
    </div>

    <!-- AI Service Page Generator Modal -->
    <div class="ai-modal-overlay" id="ai-service-modal">
        <div class="ai-modal-card">
            <button class="ai-modal-close" onclick="closeAiModal('service')">&times;</button>
            <h3><i data-lucide="sparkles"></i> AI Service Page Generator</h3>
            
            <div id="ai-service-form-wrapper">
                <div class="form-group">
                    <label for="ai_service_prompt">Describe the Service Page you want to create:</label>
                    <textarea id="ai_service_prompt" class="form-control" rows="4" placeholder="e.g. Robotic Joint Replacement: covering clinical precision, recovery timelines, hospital stay durations, and patient consulting hours."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="ai_service_tone">Writing Tone</label>
                    <select id="ai_service_tone" class="form-control">
                        <option value="Professional & Clinical">Professional & Clinical</option>
                        <option value="Informative & Helpful">Informative & Helpful</option>
                        <option value="Persuasive & Patient-Oriented">Persuasive & Patient-Oriented</option>
                    </select>
                </div>

                
                <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff;" onclick="closeAiModal('service')">Cancel</button>
                    <button type="button" class="btn-ai-sparkle" onclick="generateAiService()"><i data-lucide="sparkles"></i> Generate Service</button>
                </div>
            </div>
            
            <div class="ai-loader-container" id="ai-service-loader">
                <div class="ai-sparkle-loader"></div>
                <p class="ai-loader-text">Gemini is generating service page details...</p>
                <p class="ai-loader-subtext">Structuring Hero content, eligibility criteria, required documents, and FAQs.</p>
            </div>
        </div>
    </div>

    <!-- AI Picture Generator Modal -->
    <div class="ai-modal-overlay" id="ai-image-modal">
        <div class="ai-modal-card">
            <button class="ai-modal-close" onclick="closeAiModal('image')">&times;</button>
            <h3><i data-lucide="sparkles"></i> AI Picture Generator (Imagen 3)</h3>
            
            <div id="ai-image-form-wrapper">
                <div class="form-group">
                    <label for="ai_image_prompt">Describe the image you want to generate:</label>
                    <textarea id="ai_image_prompt" class="form-control" rows="4" placeholder="e.g. A realistic photo of a young couple receiving keys to their new home, warm lighting, high detail..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="ai_image_aspect_ratio">Aspect Ratio</label>
                    <select id="ai_image_aspect_ratio" class="form-control">
                        <option value="1:1">1:1 Square (Default)</option>
                        <option value="16:9">16:9 Landscape (Slider / Blog cover)</option>
                        <option value="4:3">4:3 Standard</option>
                    </select>
                </div>
                
                <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff;" onclick="closeAiModal('image')">Cancel</button>
                    <button type="button" class="btn-ai-sparkle" onclick="generateAiImage()"><i data-lucide="sparkles"></i> Generate Picture</button>
                </div>
            </div>
            
            <div class="ai-loader-container" id="ai-image-loader">
                <div class="ai-sparkle-loader"></div>
                <p class="ai-loader-text">Imagen is rendering your picture...</p>
                <p class="ai-loader-subtext">This will take 10-15 seconds. Please do not close this modal.</p>
            </div>

            <!-- Preview box of generated image -->
            <div class="ai-img-preview-box" id="ai-image-preview-container">
                <img id="ai-image-preview-img" src="" alt="Generated Preview">
                <div class="info">
                    <span style="font-size: 0.8rem; color: var(--admin-text-muted);" id="ai-image-status-text">Saved to Media Library!</span>
                    <button type="button" class="btn-submit" style="padding: 5px 12px; font-size: 0.8rem;" id="ai-image-copy-btn">
                        <i data-lucide="copy" style="width: 14px; height: 14px; display: inline; vertical-align: middle;"></i> Copy URL
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- AI Slider Generator Modal -->
    <div class="ai-modal-overlay" id="ai-slider-modal">
        <div class="ai-modal-card">
            <button class="ai-modal-close" onclick="closeAiModal('slider')">&times;</button>
            <h3><i data-lucide="sparkles"></i> Generate Homepage Slide with AI</h3>
            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.5rem;">
                Enter a topic or offer, and Gemini will generate a compelling heading, subheading, call to action text, and a matched background image for the homepage slider.
            </p>
            <div id="ai-slider-form-wrapper">
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label for="ai_slider_prompt">What is the slider slide about? (e.g. Spine recovery program, Knee replacement offer)</label>
                    <textarea id="ai_slider_prompt" class="form-control" rows="3" placeholder="Describe the offer, treatment, or campaign detail for this slide..."></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: white;">
                        <input type="checkbox" id="ai_slider_gen_image" value="1" checked style="width: 16px; height: 16px; accent-color: var(--mint-green);">
                        Generate Background Image using AI
                    </label>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff; width: auto;" onclick="closeAiModal('slider')">Cancel</button>
                    <button type="button" class="btn-ai-sparkle" style="width: auto;" onclick="generateAiSlider()"><i data-lucide="sparkles"></i> Generate Slide</button>
                </div>
            </div>
            <div class="ai-loader-container" id="ai-slider-loader" style="display: none;">
                <div class="ai-sparkle-loader"></div>
                <p class="ai-loader-text">Gemini is designing and writing your slide...</p>
                <p class="ai-loader-subtext">This will take 10-15 seconds. Please do not close this modal.</p>
            </div>
        </div>
    </div>

    <!-- Quick Add Category Modal -->
    <div class="ai-modal-overlay" id="add-category-modal" style="display: none;">
        <div class="ai-modal-card" style="max-width: 480px; border-color: rgba(92, 203, 179, 0.4); box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            <button type="button" class="ai-modal-close" onclick="closeAddCategoryModal()">&times;</button>
            <h3><i data-lucide="tag" style="color: var(--mint-green);"></i> Add New Category</h3>
            <p style="font-size: 0.85rem; color: var(--admin-text-muted); margin-bottom: 1.25rem;">
                Create a new category. It will instantly be added to all category dropdowns and saved in the database.
            </p>
            <form id="quick-add-category-form" onsubmit="submitQuickAddCategory(event)">
                <input type="hidden" id="quick_cat_target_dropdown" value="blog_category">
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="quick_cat_name">Category Name <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="quick_cat_name" class="form-control" placeholder="e.g. Italian Marble" required autofocus>
                </div>
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="quick_cat_desc">Description (Optional)</label>
                    <textarea id="quick_cat_desc" class="form-control" rows="2" placeholder="Brief note about this category..."></textarea>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff;" onclick="closeAddCategoryModal()">Cancel</button>
                    <button type="submit" class="btn-submit" id="quick_cat_submit_btn" style="background-color: var(--mint-green); color: #071526; font-weight: 700;">Save Category</button>
                </div>
            </form>
        </div>
    </div>


    <!-- TinyMCE CSS custom overrides -->
    <style>
        .tox-tinymce {
            border-radius: 8px !important;
            border: 1px solid var(--admin-border) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .tox .tox-toolbar, .tox .tox-toolbar__overflow, .tox .tox-toolbar__primary {
            background-color: #f1f5f9 !important;
            border-bottom: 1px solid #cbd5e1 !important;
        }
        .tox .tox-tbtn {
            cursor: pointer;
        }
        .tox .tox-tbtn:hover {
            background: #e2e8f0 !important;
        }
        .tox .tox-dialog {
            border-radius: 12px !important;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4) !important;
        }
        .tox .tox-statusbar {
            border-top: 1px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
        }
    </style>

    <!-- Lucide CDN, TinyMCE CDN & Chart.js -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- html2pdf.js CDN for PDF Download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        lucide.createIcons();

        // Global variables declared at the top to prevent Temporal Dead Zone (TDZ) ReferenceErrors
        let cloudflareChartInstance = null;
        let currentAdminSessionId = null;
        let adminSessionsPoll = null;
        let adminMessagesPoll = null;
        let lastSessionsJson = '';
        let lastMessagesJson = '';


        function syncLocalImagesToR2(btn) {
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="ai-toast-spinner" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 5px;"></span> Syncing...';

            showToast('Syncing local backups to your Cloudflare R2 bucket...', 'info');

            fetch("{{ route('admin.media.sync') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                if (res.success) {
                    showToast(res.message, 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    showToast(res.message || 'Sync failed.', 'error');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                showToast('Sync failed: ' + err.message, 'error');
            });
        }

        function pushLocalDatabaseToLive(btn) {
            const liveUrlInput = document.getElementById('live_site_url');
            const liveUrl = liveUrlInput ? liveUrlInput.value.trim() : 'https://drsumitz.com';
            
            if (!liveUrl) {
                showToast('Please enter a valid Live Site Base URL first.', 'error');
                return;
            }

            if (!confirm('Are you sure you want to push your local database content to the live server? This will overwrite the live server\'s Settings, Slides, Blogs, Services, and Page Contents with your local ones.')) {
                return;
            }

            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="ai-toast-spinner" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle; margin-right: 5px;"></span> Pushing...';

            showToast('Gathering local records and pushing to live server...', 'info');

            fetch("{{ route('admin.database.push-to-live') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    live_site_url: liveUrl
                })
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                if (res.success) {
                    showToast(res.message, 'success');
                } else {
                    showToast(res.message || 'Push failed.', 'error');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                showToast('Push network error: ' + err.message, 'error');
            });
        }

        function fetchCloudflareAnalytics() {
            const loader = document.getElementById('analytics-loader');
            const errorDiv = document.getElementById('analytics-error');
            const errorMsg = document.getElementById('analytics-error-msg');
            const dashboard = document.getElementById('analytics-dashboard');

            if (!loader) return;

            loader.style.display = 'flex';
            errorDiv.style.display = 'none';
            dashboard.style.display = 'none';

            fetch("{{ route('admin.cloudflare.analytics') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(res => res.json())
            .then(res => {
                if (res.success && res.data) {
                    const data = res.data;
                    
                    let totalPageviews = 0;
                    let totalRequests = 0;
                    let totalBytes = 0;
                    let totalCachedRequests = 0;
                    
                    const labels = [];
                    const pageviewsSeries = [];
                    const requestsSeries = [];

                    data.forEach(day => {
                        const sum = day.sum;
                        totalPageviews += parseInt(sum.pageViews || 0);
                        totalRequests += parseInt(sum.requests || 0);
                        totalBytes += parseInt(sum.bytes || 0);
                        totalCachedRequests += parseInt(sum.cachedRequests || 0);

                        // Format date nicely (YYYY-MM-DD to DD MMM)
                        const dateObj = new Date(day.dimensions.date);
                        const formattedDate = dateObj.toLocaleDateString('en-US', { day: 'numeric', month: 'short' });

                        labels.push(formattedDate);
                        pageviewsSeries.push(sum.pageViews || 0);
                        requestsSeries.push(sum.requests || 0);
                    });

                    document.getElementById('stat-pageviews').innerText = totalPageviews.toLocaleString();
                    document.getElementById('stat-requests').innerText = totalRequests.toLocaleString();
                    
                    const cacheRate = totalRequests > 0 ? Math.round((totalCachedRequests / totalRequests) * 100) : 0;
                    document.getElementById('stat-cache').innerText = cacheRate + '%';
                    
                    const bandwidthMb = (totalBytes / (1024 * 1024)).toFixed(1);
                    document.getElementById('stat-bandwidth').innerText = parseFloat(bandwidthMb).toLocaleString() + ' MB';

                    loader.style.display = 'none';
                    dashboard.style.display = 'block';

                    // Render Chart.js
                    const chartCanvas = document.getElementById('cloudflareChart');
                    if (chartCanvas) {
                        const ctx = chartCanvas.getContext('2d');
                        if (cloudflareChartInstance) {
                            cloudflareChartInstance.destroy();
                        }

                        cloudflareChartInstance = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [
                                    {
                                        label: 'Pageviews',
                                        data: pageviewsSeries,
                                        borderColor: '#5ccbb3',
                                        backgroundColor: 'rgba(92, 203, 179, 0.15)',
                                        tension: 0.3,
                                        fill: true,
                                        borderWidth: 3,
                                        pointBackgroundColor: '#5ccbb3',
                                        pointBorderColor: '#ffffff',
                                        pointHoverRadius: 6
                                    },
                                    {
                                        label: 'Requests',
                                        data: requestsSeries,
                                        borderColor: '#3b82f6',
                                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                        tension: 0.3,
                                        fill: true,
                                        borderWidth: 2,
                                        borderDash: [5, 5],
                                        pointBackgroundColor: '#3b82f6',
                                        pointBorderColor: '#ffffff',
                                        pointHoverRadius: 5
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        labels: {
                                            color: '#ffffff',
                                            font: { family: 'Outfit', size: 12 }
                                        }
                                    },
                                    tooltip: {
                                        mode: 'index',
                                        intersect: false,
                                        bodyFont: { family: 'Outfit' },
                                        titleFont: { family: 'Outfit', weight: 'bold' }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                        ticks: { color: 'rgba(255, 255, 255, 0.6)', font: { family: 'Outfit' } }
                                    },
                                    y: {
                                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                        ticks: { color: 'rgba(255, 255, 255, 0.6)', font: { family: 'Outfit' } }
                                    }
                                }
                            }
                        });
                    }
                } else {
                    loader.style.display = 'none';
                    errorDiv.style.display = 'block';
                    errorMsg.innerText = res.error || 'Failed to retrieve Cloudflare analytics data.';
                }
            })
            .catch(err => {
                loader.style.display = 'none';
                errorDiv.style.display = 'block';
                errorMsg.innerText = 'Network error fetching Cloudflare analytics: ' + err.message;
            });
        }

        // Switch Tabs logic (Route-based redirect)
        function switchTab(tabId) {
            window.location.href = "{{ url('/admin') }}/" + tabId;
        }

        // Toggle Sidebar drawer on mobile or collapse on desktop
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (sidebar) {
                if (window.innerWidth >= 992) {
                    document.body.classList.toggle('sidebar-collapsed');
                } else {
                    sidebar.classList.toggle('show');
                    if (backdrop) {
                        backdrop.classList.toggle('show');
                    }
                }
            }
        }

        // Initialize active tab from URL segment or activeTab passed from controller
        function initActiveTab() {
            const activeTab = "{{ $activeTab }}";

            // Sync layout classes with the active tab
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn, .mobile-tab-btn').forEach(b => b.classList.remove('active'));

            const targetPanel = document.getElementById('tab-' + activeTab);
            const targetBtn = document.getElementById('btn-' + activeTab);
            const mobileBtn = document.getElementById('m-btn-' + activeTab);

            if (targetPanel) targetPanel.classList.add('active');
            if (targetBtn) targetBtn.classList.add('active');
            if (mobileBtn) {
                mobileBtn.classList.add('active');
                mobileBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }

            // Manage analytics pageviews loading
            if (activeTab === 'analytics') {
                if (typeof fetchGoogleAnalytics === 'function') {
                    const savedRange = document.getElementById('analytics_date_range').value || 'last_7_days';
                    fetchGoogleAnalytics(savedRange);
                }
            }

            // Save to localStorage as fallback
            localStorage.setItem('active_tab', activeTab);

            // Manage analytics pageviews loading
            if (activeTab === 'analytics') {
                if (typeof fetchCloudflareAnalytics === 'function') {
                    fetchCloudflareAnalytics();
                }
            }

            // Manage chat pollings
            if (activeTab === 'livechat') {
                if (typeof loadAdminChatSessions === 'function') {
                    loadAdminChatSessions();
                }
            } else {
                if (typeof adminSessionsPoll !== 'undefined') clearInterval(adminSessionsPoll);
                if (typeof adminMessagesPoll !== 'undefined') clearInterval(adminMessagesPoll);
            }


        }

        // Initialize defensively on page load or immediately if DOM is ready
        if (document.readyState === 'loading') {
            window.addEventListener('DOMContentLoaded', initActiveTab);
        } else {
            initActiveTab();
        }

        // SEO Recommendations Switch Result Tab
        function switchSeoResultTab(tabId) {
            // Remove active class from all buttons and add background styling
            document.querySelectorAll('[id^="seo-tab-btn-"]').forEach(btn => {
                btn.classList.remove('active');
                btn.style.backgroundColor = 'var(--admin-input-bg)';
                btn.style.color = '#fff';
            });
            // Hide all subpanels
            document.querySelectorAll('.seo-result-panel').forEach(panel => {
                panel.style.display = 'none';
            });
            
            // Activate the clicked button
            const activeBtn = document.getElementById('seo-tab-btn-' + tabId);
            if (activeBtn) {
                activeBtn.classList.add('active');
                activeBtn.style.backgroundColor = 'var(--mint-green)';
                activeBtn.style.color = 'var(--primary-teal-dark)';
            }
            // Show the clicked panel
            const activePanel = document.getElementById('seo-panel-' + tabId);
            if (activePanel) {
                activePanel.style.display = activePanel.classList.contains('form-grid') ? 'grid' : 'block';
            }
        }

        let latestSeoData = null;


        let googleAnalyticsChartInstance = null;
        let gmbPerformanceChartInstance = null;

        function fetchGoogleAnalytics(dateRange = 'last_7_days') {
            const loader = document.getElementById('google-analytics-loader');
            const dashboard = document.getElementById('google-analytics-dashboard');
            const demoBanner = document.getElementById('google-analytics-demo-banner');
            const warningBanner = document.getElementById('google-analytics-warning-banner');
            const warningMsg = document.getElementById('google-analytics-warning-msg');

            if (!loader) return;

            loader.style.display = 'flex';
            dashboard.style.display = 'none';
            demoBanner.style.display = 'none';
            warningBanner.style.display = 'none';

            fetch("{{ route('admin.google.analytics') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    date_range: dateRange
                })
            })
            .then(res => res.json())
            .then(res => {
                loader.style.display = 'none';
                dashboard.style.display = 'block';

                if (res.success && res.data) {
                    const data = res.data;

                    // Update banners
                    if (res.is_demo) {
                        demoBanner.style.display = 'flex';
                    } else {
                        demoBanner.style.display = 'none';
                    }
                    if (res.warning) {
                        warningMsg.innerText = res.warning;
                        warningBanner.style.display = 'flex';
                    } else {
                        warningBanner.style.display = 'none';
                    }

                    // 1. Google Analytics 4 (GA4) Stats
                    const ga = data.analytics;
                    document.getElementById('ga-sessions').innerText = ga.sessions.toLocaleString();
                    document.getElementById('ga-users').innerText = ga.unique_users.toLocaleString();
                    document.getElementById('ga-returning').innerText = ga.repeated_users.toLocaleString();
                    document.getElementById('ga-bounce').innerText = parseFloat(ga.bounce_rate).toFixed(1) + '%';
                    document.getElementById('ga-time').innerText = ga.time_on_site;
                    document.getElementById('ga-pages-per-session').innerText = parseFloat(ga.avg_pages_per_session).toFixed(1);

                    // 2. Google Search Console (GSC) Stats
                    const gsc = data.search_console;
                    document.getElementById('gsc-clicks').innerText = gsc.clicks.toLocaleString();
                    document.getElementById('gsc-impressions').innerText = gsc.impressions.toLocaleString();
                    document.getElementById('gsc-ctr').innerText = parseFloat(gsc.ctr).toFixed(2) + '%';
                    document.getElementById('gsc-position').innerText = parseFloat(gsc.position).toFixed(1);

                    // Top Keywords Table
                    const kwTbody = document.getElementById('gsc-keywords-tbody');
                    kwTbody.innerHTML = '';
                    if (gsc.keywords && gsc.keywords.length > 0) {
                        gsc.keywords.forEach(kw => {
                            kwTbody.innerHTML += `
                                <tr>
                                    <td><strong>${kw.keyword}</strong></td>
                                    <td style="text-align: right;">${kw.clicks.toLocaleString()}</td>
                                    <td style="text-align: right;">${kw.impressions.toLocaleString()}</td>
                                    <td style="text-align: right; color: var(--mint-green);">${kw.ctr}%</td>
                                    <td style="text-align: right; color: #60a5fa;">${kw.position}</td>
                                </tr>
                            `;
                        });
                    } else {
                        kwTbody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: var(--admin-text-muted);">No query data available.</td></tr>';
                    }

                    // Top Pages Table
                    const pgTbody = document.getElementById('gsc-pages-tbody');
                    pgTbody.innerHTML = '';
                    if (gsc.pages && gsc.pages.length > 0) {
                        gsc.pages.forEach(pg => {
                            pgTbody.innerHTML += `
                                <tr>
                                    <td><span style="font-size: 0.85rem; word-break: break-all; color: var(--admin-text-muted);">${pg.page}</span></td>
                                    <td style="text-align: right;">${pg.clicks.toLocaleString()}</td>
                                    <td style="text-align: right;">${pg.impressions.toLocaleString()}</td>
                                    <td style="text-align: right; color: var(--mint-green);">${pg.ctr}%</td>
                                </tr>
                            `;
                        });
                    } else {
                        pgTbody.innerHTML = '<tr><td colspan="4" style="text-align: center; color: var(--admin-text-muted);">No page data available.</td></tr>';
                    }

                    // 3. Google My Business (GMB) Stats
                    const gmb = data.my_business;
                    document.getElementById('gmb-visitors').innerText = gmb.visitors.toLocaleString();
                    document.getElementById('gmb-views').innerText = gmb.search_appearance.toLocaleString();
                    document.getElementById('gmb-calls').innerText = gmb.calls.toLocaleString();
                    document.getElementById('gmb-webclicks').innerText = gmb.website_visits.toLocaleString();
                    document.getElementById('gmb-directions').innerText = gmb.directions.toLocaleString();

                    // 4. Render Chart 1: Daily Sessions & Clicks Trend
                    const chartCanvas = document.getElementById('googleAnalyticsChart');
                    if (chartCanvas) {
                        const ctx = chartCanvas.getContext('2d');
                        if (googleAnalyticsChartInstance) {
                            googleAnalyticsChartInstance.destroy();
                        }

                        const dates = ga.daily.map(day => day.date);
                        const sessionsData = ga.daily.map(day => day.sessions);
                        const clicksData = gsc.daily.map(day => day.clicks);

                        googleAnalyticsChartInstance = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: dates,
                                datasets: [
                                    {
                                        label: 'Traffic Sessions (GA4)',
                                        data: sessionsData,
                                        borderColor: '#5ccbb3',
                                        backgroundColor: 'rgba(92, 203, 179, 0.15)',
                                        tension: 0.35,
                                        fill: true,
                                        borderWidth: 3,
                                        pointBackgroundColor: '#5ccbb3',
                                        pointBorderColor: '#ffffff',
                                        pointHoverRadius: 6
                                    },
                                    {
                                        label: 'Google Search Clicks (GSC)',
                                        data: clicksData,
                                        borderColor: '#3b82f6',
                                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                        tension: 0.35,
                                        fill: true,
                                        borderWidth: 2,
                                        borderDash: [4, 4],
                                        pointBackgroundColor: '#3b82f6',
                                        pointBorderColor: '#ffffff',
                                        pointHoverRadius: 5
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        labels: { color: '#ffffff', font: { family: 'Outfit', size: 12 } }
                                    },
                                    tooltip: {
                                        mode: 'index',
                                        intersect: false,
                                        bodyFont: { family: 'Outfit' },
                                        titleFont: { family: 'Outfit', weight: 'bold' }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                        ticks: { color: 'rgba(255, 255, 255, 0.6)', font: { family: 'Outfit' } }
                                    },
                                    y: {
                                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                        ticks: { color: 'rgba(255, 255, 255, 0.6)', font: { family: 'Outfit' } }
                                    }
                                }
                            }
                        });
                    }

                    // 5. Render Chart 2: GBP Interactions Trend
                    const gmbCanvas = document.getElementById('gmbPerformanceChart');
                    if (gmbCanvas) {
                        const ctx = gmbCanvas.getContext('2d');
                        if (gmbPerformanceChartInstance) {
                            gmbPerformanceChartInstance.destroy();
                        }

                        const dates = gmb.daily.map(day => day.date);
                        const viewsData = gmb.daily.map(day => day.visitors);
                        const callsData = gmb.daily.map(day => day.calls);
                        const webData = gmb.daily.map(day => day.website_visits);
                        const dirData = gmb.daily.map(day => day.directions);

                        gmbPerformanceChartInstance = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: dates,
                                datasets: [
                                    {
                                        label: 'Profile Views',
                                        data: viewsData,
                                        backgroundColor: 'rgba(59, 130, 246, 0.65)',
                                        borderColor: '#3b82f6',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Website Clicks',
                                        data: webData,
                                        backgroundColor: 'rgba(236, 72, 153, 0.65)',
                                        borderColor: '#ec4899',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Calls',
                                        data: callsData,
                                        backgroundColor: 'rgba(168, 85, 247, 0.65)',
                                        borderColor: '#a855f7',
                                        borderWidth: 1
                                    },
                                    {
                                        label: 'Directions',
                                        data: dirData,
                                        backgroundColor: 'rgba(234, 179, 8, 0.65)',
                                        borderColor: '#eab308',
                                        borderWidth: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        labels: { color: '#ffffff', font: { family: 'Outfit', size: 12 } }
                                    },
                                    tooltip: {
                                        mode: 'index',
                                        intersect: false,
                                        bodyFont: { family: 'Outfit' }
                                    }
                                },
                                scales: {
                                    x: {
                                        stacked: true,
                                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                        ticks: { color: 'rgba(255, 255, 255, 0.6)', font: { family: 'Outfit' } }
                                    },
                                    y: {
                                        stacked: true,
                                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                                        ticks: { color: 'rgba(255, 255, 255, 0.6)', font: { family: 'Outfit' } }
                                    }
                                }
                            }
                        });
                    }
                } else {
                    showToast(res.error || 'Failed to load Google analytics.', 'error');
                }
            })
            .catch(err => {
                loader.style.display = 'none';
                showToast('Network error loading Google Analytics: ' + err.message, 'error');
            });
        }


        // Initialize Google OAuth dropdown and auto-detect triggers
        document.addEventListener('DOMContentLoaded', function() {
            const gaSelect = document.getElementById('google_analytics_property_id_select');
            const scSelect = document.getElementById('google_search_console_site_url_select');
            const gmbSelect = document.getElementById('gmb_location_id_select');

            if (gaSelect) {
                gaSelect.addEventListener('change', function() {
                    if (this.value) document.getElementById('google_analytics_property_id').value = this.value;
                });
            }
            if (scSelect) {
                scSelect.addEventListener('change', function() {
                    if (this.value) document.getElementById('google_search_console_site_url').value = this.value;
                });
            }
            if (gmbSelect) {
                gmbSelect.addEventListener('change', function() {
                    if (this.value) document.getElementById('gmb_location_id_analytics').value = this.value;
                });
            }

            const btnFetch = document.getElementById('btn-fetch-properties');
            if (btnFetch) {
                btnFetch.addEventListener('click', function() {
                    const originalText = btnFetch.innerHTML;
                    btnFetch.disabled = true;
                    btnFetch.innerHTML = '<i data-lucide="loader" class="animate-spin" style="width: 14px; height: 14px;"></i> Fetching...';
                    if (typeof lucide !== 'undefined') lucide.createIcons();

                    fetch("{{ route('admin.google.properties') }}")
                        .then(res => {
                            if (!res.ok) throw new Error('Authorization required or API failed');
                            return res.json();
                        })
                        .then(res => {
                            btnFetch.disabled = false;
                            btnFetch.innerHTML = originalText;
                            if (typeof lucide !== 'undefined') lucide.createIcons();

                            if (res.success) {
                                showToast('Properties fetched successfully!', 'success');

                                // 1. GA4 properties
                                if (res.analytics && res.analytics.length > 0) {
                                    gaSelect.innerHTML = '<option value="">-- Select GA4 Property --</option>';
                                    res.analytics.forEach(item => {
                                        const opt = document.createElement('option');
                                        opt.value = item.id;
                                        opt.textContent = item.name;
                                        if (item.id === document.getElementById('google_analytics_property_id').value) {
                                            opt.selected = true;
                                        }
                                        gaSelect.appendChild(opt);
                                    });
                                    gaSelect.style.display = 'block';
                                }

                                // 2. Search Console sites
                                if (res.search_console && res.search_console.length > 0) {
                                    scSelect.innerHTML = '<option value="">-- Select Search Console Site --</option>';
                                    res.search_console.forEach(item => {
                                        const opt = document.createElement('option');
                                        opt.value = item.id;
                                        opt.textContent = item.name;
                                        if (item.id === document.getElementById('google_search_console_site_url').value) {
                                            opt.selected = true;
                                        }
                                        scSelect.appendChild(opt);
                                    });
                                    scSelect.style.display = 'block';
                                }

                                // 3. GMB Locations
                                if (res.my_business && res.my_business.length > 0) {
                                    gmbSelect.innerHTML = '<option value="">-- Select GMB Location --</option>';
                                    res.my_business.forEach(item => {
                                        const opt = document.createElement('option');
                                        opt.value = 'locations/' + item.id;
                                        opt.textContent = item.name;
                                        if ('locations/' + item.id === document.getElementById('gmb_location_id_analytics').value || item.id === document.getElementById('gmb_location_id_analytics').value) {
                                            opt.selected = true;
                                        }
                                        gmbSelect.appendChild(opt);
                                    });
                                    gmbSelect.style.display = 'block';
                                }
                            } else {
                                showToast('Failed to fetch properties: ' + res.message, 'error');
                            }
                        })
                        .catch(err => {
                            btnFetch.disabled = false;
                            btnFetch.innerHTML = originalText;
                            if (typeof lucide !== 'undefined') lucide.createIcons();
                            showToast(err.message, 'error');
                        });
                });
            }
        });


        // AJAX Generate SEO Strategy
        function generateSeoRecommendations() {
            const keywords = document.getElementById('seo_keywords').value.trim();
            if (!keywords) {
                alert('Please enter at least one target keyword.');
                return;
            }

            const loader = document.getElementById('seo-loader');
            const results = document.getElementById('seo-results');
            loader.style.display = 'block';
            results.style.display = 'none';
            loader.scrollIntoView({ behavior: 'smooth' });

            fetch("{{ route('admin.ai.seo-recommendations') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    keywords: keywords
                })
            })
            .then(res => res.json())
            .then(res => {
                loader.style.display = 'none';
                if (res.success && res.data) {
                    const data = res.data;
                    latestSeoData = data;
                    
                    // Render 1. On-Site Content Table
                    const contentTbody = document.getElementById('seo-table-content');
                    contentTbody.innerHTML = '';
                    if (data.pages_blogs && data.pages_blogs.length) {
                        data.pages_blogs.forEach(item => {
                            contentTbody.innerHTML += `
                                <tr>
                                    <td><span class="badge" style="background-color: rgba(92, 203, 179, 0.1); color: var(--mint-green); border: 1px solid rgba(92, 203, 179, 0.3); font-size: 0.75rem;">${item.type}</span></td>
                                    <td><strong>${item.title}</strong></td>
                                    <td><code style="font-size: 0.8rem; background: rgba(255,255,255,0.05); padding: 2px 4px; border-radius: 4px;">${item.keywords}</code></td>
                                    <td>${item.summary}</td>
                                </tr>
                            `;
                        });
                    } else {
                        contentTbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">No content ideas generated.</td></tr>';
                    }

                    // Render 2. Backlinks Table
                    const backlinksTbody = document.getElementById('seo-table-backlinks');
                    backlinksTbody.innerHTML = '';
                    if (data.third_party_articles && data.third_party_articles.length) {
                        data.third_party_articles.forEach(item => {
                            backlinksTbody.innerHTML += `
                                <tr>
                                    <td><strong>${item.platform_type}</strong></td>
                                    <td>${item.title}</td>
                                    <td><code style="font-size: 0.8rem; background: rgba(255,255,255,0.05); padding: 2px 4px; border-radius: 4px;">${item.keywords}</code></td>
                                    <td>${item.context}</td>
                                </tr>
                            `;
                        });
                    } else {
                        backlinksTbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">No off-site article suggestions.</td></tr>';
                    }

                    // Render 3. Quora Cards
                    const quoraContainer = document.getElementById('seo-cards-quora');
                    quoraContainer.innerHTML = '';
                    if (data.quora_questions && data.quora_questions.length) {
                        data.quora_questions.forEach(item => {
                            quoraContainer.innerHTML += `
                                <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--admin-border); border-radius: var(--radius-md); padding: 1.5rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; flex-wrap: wrap; gap: 8px;">
                                        <span class="badge" style="background-color: rgba(232, 92, 36, 0.1); color: var(--accent-orange); font-size: 0.75rem;">${item.topic}</span>
                                        <a href="https://www.quora.com/search?q=${encodeURIComponent(item.question_direction)}" target="_blank" class="btn-submit" style="width: auto; padding: 4px 10px; font-size: 0.75rem; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                            <i data-lucide="external-link" style="width: 12px; height: 12px;"></i> Search on Quora
                                        </a>
                                    </div>
                                    <h4 style="margin: 0 0 1rem 0; font-size: 1.1rem; color: #fff;">${item.question_direction}</h4>
                                    <strong style="font-size: 0.85rem; color: var(--mint-green); display: block; margin-bottom: 0.5rem;">Tactical Answer Blueprint:</strong>
                                    <ul style="margin: 0; padding-left: 1.25rem; font-size: 0.9rem; color: rgba(255,255,255,0.85);">
                                        ${item.draft_answer_points.split('\n').map(pt => pt.trim() ? ('<li>' + pt.replace(/^[-\*\d\.]+\s*/, '') + '</li>') : '').join('')}
                                    </ul>
                                </div>
                            `;
                        });
                    } else {
                        quoraContainer.innerHTML = '<p style="text-align: center; color: var(--admin-text-muted);">No Quora suggestions generated.</p>';
                    }

                    // Render 4. Pinterest Table
                    const pinterestTbody = document.getElementById('seo-table-pinterest');
                    pinterestTbody.innerHTML = '';
                    if (data.pinterest_posts && data.pinterest_posts.length) {
                        data.pinterest_posts.forEach(item => {
                            pinterestTbody.innerHTML += `
                                <tr>
                                    <td><strong style="color: #fff;">${item.overlay_text}</strong></td>
                                    <td>${item.visual_idea}</td>
                                    <td><span class="badge" style="background: rgba(255,255,255,0.05); color: #fff; font-size: 0.75rem;">${item.category}</span></td>
                                </tr>
                            `;
                        });
                    } else {
                        pinterestTbody.innerHTML = '<tr><td colspan="3" style="text-align: center;">No Pinterest suggestions.</td></tr>';
                    }

                    // Render 5. Social Media Cards
                    const socialContainer = document.getElementById('seo-cards-social');
                    socialContainer.innerHTML = '';
                    if (data.social_media && data.social_media.length) {
                        data.social_media.forEach((item, index) => {
                            const postTextEscaped = item.post_copy.replace(/`/g, '\\`').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                            socialContainer.innerHTML += `
                                <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--admin-border); border-radius: var(--radius-md); padding: 1.25rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                        <span class="badge" style="background-color: rgba(92, 102, 241, 0.1); color: #a855f7; font-size: 0.75rem;">${item.platform}</span>
                                        <button class="btn-submit" style="width: auto; padding: 4px 10px; font-size: 0.75rem;" onclick="copySeoSocialCopy(this, \`${postTextEscaped}\`)">
                                            <i data-lucide="copy" style="width: 12px; height: 12px; display: inline; vertical-align: middle;"></i> Copy Caption
                                        </button>
                                    </div>
                                    <p style="font-family: inherit; font-size: 0.9rem; white-space: pre-wrap; margin: 0 0 1rem 0; color: rgba(255,255,255,0.85);">${item.post_copy}</p>
                                    <div style="font-size: 0.8rem; background: rgba(0,0,0,0.15); padding: 8px 12px; border-radius: 4px;">
                                        <strong style="color: var(--mint-green);">Graphic Concept:</strong> ${item.graphic_concept}
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        socialContainer.innerHTML = '<p style="text-align: center; color: var(--admin-text-muted);">No social posts generated.</p>';
                    }

                    // Render 6. Bookmarking Platforms
                    const bookmarkingTbody = document.getElementById('seo-table-bookmarking');
                    bookmarkingTbody.innerHTML = '';
                    if (data.bookmarking_sites && data.bookmarking_sites.length) {
                        data.bookmarking_sites.forEach(item => {
                            const link = item.url.startsWith('http') ? item.url : 'https://' + item.url;
                            bookmarkingTbody.innerHTML += `
                                <tr>
                                    <td>
                                        <a href="${link}" target="_blank" style="color: var(--mint-green); font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                            ${item.name} <i data-lucide="external-link" style="width: 12px; height: 12px;"></i>
                                        </a>
                                    </td>
                                    <td>${item.strategy}</td>
                                </tr>
                            `;
                        });
                    } else {
                        bookmarkingTbody.innerHTML = '<tr><td colspan="2" style="text-align: center;">No bookmarking sites suggested.</td></tr>';
                    }

                    // Render 7. Syndication Platforms
                    const syndicationTbody = document.getElementById('seo-table-syndication');
                    syndicationTbody.innerHTML = '';
                    if (data.blog_promotion && data.blog_promotion.length) {
                        data.blog_promotion.forEach(item => {
                            const link = item.url.startsWith('http') ? item.url : 'https://' + item.url;
                            syndicationTbody.innerHTML += `
                                <tr>
                                    <td>
                                        <a href="${link}" target="_blank" style="color: var(--mint-green); font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                            ${item.name} <i data-lucide="external-link" style="width: 12px; height: 12px;"></i>
                                        </a>
                                    </td>
                                    <td>${item.strategy}</td>
                                </tr>
                            `;
                        });
                    } else {
                        syndicationTbody.innerHTML = '<tr><td colspan="2" style="text-align: center;">No syndication sites suggested.</td></tr>';
                    }

                    // Render 8. Other growth tactics
                    const otherContainer = document.getElementById('seo-cards-other');
                    otherContainer.innerHTML = '';
                    if (data.other_backlinks && data.other_backlinks.length) {
                        data.other_backlinks.forEach(item => {
                            otherContainer.innerHTML += `
                                <div style="background: rgba(255,255,255,0.02); border: 1px solid var(--admin-border); border-radius: var(--radius-md); padding: 1.25rem;">
                                    <h4 style="margin: 0 0 0.5rem 0; font-size: 1.05rem; color: var(--mint-green); font-weight: 600;">${item.strategy_name}</h4>
                                    <p style="font-size: 0.88rem; margin: 0; color: rgba(255,255,255,0.85);">${item.action_steps}</p>
                                </div>
                            `;
                        });
                    } else {
                        otherContainer.innerHTML = '<p style="grid-column: 1 / -1; text-align: center; color: var(--admin-text-muted);">No additional tactics generated.</p>';
                    }

                    // Trigger Lucide icons instantiation
                    setTimeout(() => lucide.createIcons(), 100);

                    // Show results and switch to Content Tab by default
                    results.style.display = 'block';
                    switchSeoResultTab('content');
                    results.scrollIntoView({ behavior: 'smooth' });
                } else {
                    alert('Error: ' + (res.error || 'Failed to generate SEO strategy.'));
                }
            })
            .catch(err => {
                loader.style.display = 'none';
                alert('Network Error: ' + err.message);
            });
        }

        // Generate and download a beautifully-styled PDF report on the client side
        function downloadSeoPdf() {
            if (!latestSeoData) {
                alert('No SEO data available to download. Please generate recommendations first.');
                return;
            }
            
            const keywords = document.getElementById('seo_keywords').value.trim();
            const dateStr = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
            
            // Build temporary off-screen container for rendering
            const printEl = document.createElement('div');
            printEl.style.padding = '20px';
            printEl.style.color = '#333333';
            printEl.style.backgroundColor = '#ffffff';
            printEl.style.fontFamily = "'Outfit', 'Inter', sans-serif";
            printEl.style.lineHeight = '1.5';
            
            let html = `
                <div style="border-bottom: 2px solid #5ccbb3; padding-bottom: 15px; margin-bottom: 25px;">
                    <h1 style="color: #0a1112; margin: 0 0 5px 0; font-size: 26px;">{{ $site['site_name'] ?? 'SumitZ Clinic' }} - AI SEO Recommendation Blueprint</h1>
                    <p style="color: #555; margin: 0; font-size: 13px;"><strong>Generated Date:</strong> ${dateStr} | <strong>Target Keywords:</strong> ${keywords}</p>
                </div>
                
                <h2 style="color: #0a1112; font-size: 18px; margin-top: 20px; border-bottom: 1px solid #ddd; padding-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">1. On-Site Content structure Recommendations</h2>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; margin-bottom: 30px;">
                    <thead>
                        <tr style="background-color: #f7f9f9; border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align: left; width: 15%; border: 1px solid #ddd; font-weight: bold;">Type</th>
                            <th style="padding: 10px; text-align: left; width: 30%; border: 1px solid #ddd; font-weight: bold;">Recommended Title</th>
                            <th style="padding: 10px; text-align: left; width: 20%; border: 1px solid #ddd; font-weight: bold;">Keywords</th>
                            <th style="padding: 10px; text-align: left; width: 35%; border: 1px solid #ddd; font-weight: bold;">Outline & Search Intent</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            if (latestSeoData.pages_blogs && latestSeoData.pages_blogs.length) {
                latestSeoData.pages_blogs.forEach(item => {
                    html += `
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 8px 10px; border: 1px solid #ddd; font-weight: bold; color: #0f766e;">${item.type}</td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd;"><strong>${item.title}</strong></td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd; font-family: monospace; background-color: #f8fafc;">${item.keywords}</td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd; color: #444;">${item.summary}</td>
                        </tr>
                    `;
                });
            } else {
                html += `<tr><td colspan="4" style="text-align: center; padding: 12px;">No content ideas.</td></tr>`;
            }
            
            html += `
                    </tbody>
                </table>
                
                <div style="page-break-after: always;"></div>
                
                <h2 style="color: #0a1112; font-size: 18px; margin-top: 20px; border-bottom: 1px solid #ddd; padding-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">2. Third-Party Off-Site Articles & Backlinks</h2>
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; margin-bottom: 30px;">
                    <thead>
                        <tr style="background-color: #f7f9f9; border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align: left; width: 20%; border: 1px solid #ddd; font-weight: bold;">Platform Type</th>
                            <th style="padding: 10px; text-align: left; width: 30%; border: 1px solid #ddd; font-weight: bold;">Article Title Idea</th>
                            <th style="padding: 10px; text-align: left; width: 20%; border: 1px solid #ddd; font-weight: bold;">Anchor Keywords</th>
                            <th style="padding: 10px; text-align: left; width: 30%; border: 1px solid #ddd; font-weight: bold;">Backlink Integration Context</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            if (latestSeoData.third_party_articles && latestSeoData.third_party_articles.length) {
                latestSeoData.third_party_articles.forEach(item => {
                    html += `
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 8px 10px; border: 1px solid #ddd; font-weight: bold;">${item.platform_type}</td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd;"><strong>${item.title}</strong></td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd; font-family: monospace; background-color: #f8fafc;">${item.keywords}</td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd; color: #444;">${item.context}</td>
                        </tr>
                    `;
                });
            } else {
                html += `<tr><td colspan="4" style="text-align: center; padding: 12px;">No guest posting suggestions.</td></tr>`;
            }
            
            html += `
                    </tbody>
                </table>
                
                <h2 style="color: #0a1112; font-size: 18px; margin-top: 30px; border-bottom: 1px solid #ddd; padding-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">3. Quora Q&A Authority Roadmap</h2>
                <div style="display: flex; flex-direction: column; gap: 15px; margin-top: 10px; margin-bottom: 30px;">
            `;
            
            if (latestSeoData.quora_questions && latestSeoData.quora_questions.length) {
                latestSeoData.quora_questions.forEach(item => {
                    html += `
                        <div style="border: 1px solid #ddd; padding: 15px; border-radius: 6px; background-color: #fafafa;">
                            <span style="font-size: 10px; font-weight: bold; background: #e85c24; color: white; padding: 2px 8px; border-radius: 4px; display: inline-block; margin-bottom: 8px; text-transform: uppercase;">${item.topic}</span>
                            <h4 style="margin: 0 0 10px 0; font-size: 14px; color: #0a1112; font-weight: bold;">Question: ${item.question_direction}</h4>
                            <p style="margin: 0 0 5px 0; font-size: 12px; color: #555; font-weight: bold;">Tactical Answer Outline:</p>
                            <ul style="margin: 0; padding-left: 20px; font-size: 12px; color: #444;">
                                ${item.draft_answer_points.split('\n').map(pt => pt.trim() ? ('<li>' + pt.replace(/^[-\*\d\.]+\s*/, '') + '</li>') : '').join('')}
                            </ul>
                        </div>
                    `;
                });
            } else {
                html += `<p style="font-size: 13px;">No Quora suggestions.</p>`;
            }
            
            html += `
                </div>
                
                <div style="page-break-after: always;"></div>
                
                <h2 style="color: #0a1112; font-size: 18px; margin-top: 20px; border-bottom: 1px solid #ddd; padding-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">4. Pinterest Graphics & Written Social Copy</h2>
                <h3 style="font-size: 14px; margin-top: 15px; margin-bottom: 8px; color: #333; font-weight: bold;">Pinterest Overlay Graphics</h3>
                <table style="width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 35px;">
                    <thead>
                        <tr style="background-color: #f7f9f9; border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align: left; width: 30%; border: 1px solid #ddd; font-weight: bold;">Overlay Bold Text</th>
                            <th style="padding: 10px; text-align: left; width: 50%; border: 1px solid #ddd; font-weight: bold;">Visual Graphic Concept</th>
                            <th style="padding: 10px; text-align: left; width: 20%; border: 1px solid #ddd; font-weight: bold;">Category</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            if (latestSeoData.pinterest_posts && latestSeoData.pinterest_posts.length) {
                latestSeoData.pinterest_posts.forEach(item => {
                    html += `
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 8px 10px; border: 1px solid #ddd; font-weight: bold;">${item.overlay_text}</td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd; color: #444;">${item.visual_idea}</td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd;">${item.category}</td>
                        </tr>
                    `;
                });
            } else {
                html += `<tr><td colspan="3" style="text-align: center; padding: 12px;">No Pinterest suggestions.</td></tr>`;
            }
            
            html += `
                    </tbody>
                </table>
                
                <h3 style="font-size: 14px; margin-top: 20px; margin-bottom: 10px; color: #333; font-weight: bold;">Social Media Written Copy</h3>
                <div style="display: flex; flex-direction: column; gap: 15px;">
            `;
            
            if (latestSeoData.social_media && latestSeoData.social_media.length) {
                latestSeoData.social_media.forEach(item => {
                    html += `
                        <div style="border: 1px solid #ddd; padding: 15px; border-radius: 6px; background-color: #fcfcfc;">
                            <strong style="color: #4f46e5; font-size: 12px; display: block; margin-bottom: 6px; text-transform: uppercase;">Platform: ${item.platform}</strong>
                            <p style="margin: 0 0 12px 0; font-size: 12px; white-space: pre-wrap; color: #333; line-height: 1.6; background-color: #fff; padding: 10px; border: 1px solid #eee; border-radius: 4px;">${item.post_copy}</p>
                            <div style="font-size: 11px; color: #444; background: #f1f5f9; padding: 8px 12px; border-radius: 4px; border-left: 3px solid #64748b;">
                                <strong>Graphic Concept:</strong> ${item.graphic_concept}
                            </div>
                        </div>
                    `;
                });
            } else {
                html += `<p style="font-size: 13px;">No social copy suggestions.</p>`;
            }
            
            html += `
                </div>
                
                <div style="page-break-after: always;"></div>
                
                <h2 style="color: #0a1112; font-size: 18px; margin-top: 20px; border-bottom: 1px solid #ddd; padding-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">5. Social Bookmarking & Syndication Directories</h2>
                <h3 style="font-size: 14px; margin-top: 15px; margin-bottom: 8px; color: #333; font-weight: bold;">Social Bookmarking Websites</h3>
                <table style="width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 30px;">
                    <thead>
                        <tr style="background-color: #f7f9f9; border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align: left; width: 30%; border: 1px solid #ddd; font-weight: bold;">Platform</th>
                            <th style="padding: 10px; text-align: left; width: 70%; border: 1px solid #ddd; font-weight: bold;">Tactical Submission Strategy</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            if (latestSeoData.bookmarking_sites && latestSeoData.bookmarking_sites.length) {
                latestSeoData.bookmarking_sites.forEach(item => {
                    html += `
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 8px 10px; border: 1px solid #ddd;"><strong>${item.name}</strong><br><span style="font-size: 10px; color: #666;">${item.url}</span></td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd; color: #444;">${item.strategy}</td>
                        </tr>
                    `;
                });
            } else {
                html += `<tr><td colspan="2" style="text-align: center; padding: 12px;">No bookmarking sites.</td></tr>`;
            }
            
            html += `
                    </tbody>
                </table>
                
                <h3 style="font-size: 14px; margin-top: 20px; margin-bottom: 8px; color: #333; font-weight: bold;">Blog Syndication Platforms</h3>
                <table style="width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 30px;">
                    <thead>
                        <tr style="background-color: #f7f9f9; border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align: left; width: 30%; border: 1px solid #ddd; font-weight: bold;">Platform</th>
                            <th style="padding: 10px; text-align: left; width: 70%; border: 1px solid #ddd; font-weight: bold;">Syndication Strategy</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            
            if (latestSeoData.blog_promotion && latestSeoData.blog_promotion.length) {
                latestSeoData.blog_promotion.forEach(item => {
                    html += `
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 8px 10px; border: 1px solid #ddd;"><strong>${item.name}</strong><br><span style="font-size: 10px; color: #666;">${item.url}</span></td>
                            <td style="padding: 8px 10px; border: 1px solid #ddd; color: #444;">${item.strategy}</td>
                        </tr>
                    `;
                });
            } else {
                html += `<tr><td colspan="2" style="text-align: center; padding: 12px;">No syndication sites.</td></tr>`;
            }
            
            html += `
                    </tbody>
                </table>
                
                <h2 style="color: #0a1112; font-size: 18px; margin-top: 20px; border-bottom: 1px solid #ddd; padding-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">6. Advanced Growth Tactics</h2>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 10px;">
            `;
            
            if (latestSeoData.other_backlinks && latestSeoData.other_backlinks.length) {
                latestSeoData.other_backlinks.forEach(item => {
                    html += `
                        <div style="border: 1px solid #ddd; padding: 12px; border-radius: 6px; background-color: #fafafa;">
                            <h4 style="margin: 0 0 6px 0; font-size: 13px; color: #0f766e; font-weight: bold;">${item.strategy_name}</h4>
                            <p style="margin: 0; font-size: 11px; color: #555; line-height: 1.5;">${item.action_steps}</p>
                        </div>
                    `;
                });
            } else {
                html += `<p style="font-size: 13px;">No additional tactics.</p>`;
            }
            
            html += `
                </div>
            `;
            
            printEl.innerHTML = html;
            
            const opt = {
                margin:       [15, 15, 15, 15],
                filename:     '{{ str_replace(' ', '_', $site['site_name'] ?? 'SumitZ_Clinic') }}_SEO_Blueprint_' + keywords.replace(/[^a-z0-9]+/gi, '_') + '.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
            };
            
            html2pdf().set(opt).from(printEl).save();
        }

        // GMB Modal Management
        function openGmbShareModal(type, data) {
            document.getElementById('gmb_post_type').value = type;
            document.getElementById('gmb_post_id').value = data.id;
            
            const baseUrl = '{{ rtrim($site['live_site_url'] ?? config('app.url'), '/') }}';
            let targetUrl = '';
            if (type === 'blog') {
                targetUrl = baseUrl + '/blogs/' + data.slug;
            } else if (type === 'service') {
                targetUrl = baseUrl + '/services/' + data.slug;
            } else {
                targetUrl = baseUrl + '/l/' + data.slug;
            }
            
            document.getElementById('gmb_target_url').value = targetUrl;
            document.getElementById('gmb_post_cta_url').value = targetUrl;
            document.getElementById('gmb_post_text').value = '';
            
            // Open modal
            document.getElementById('gmb-share-modal').classList.add('show');
            
            // Auto draft with AI
            generateGmbDraft();
        }

        function closeGmbModal() {
            document.getElementById('gmb-share-modal').classList.remove('show');
        }

        function generateGmbDraft() {
            const type = document.getElementById('gmb_post_type').value;
            const id = document.getElementById('gmb_post_id').value;
            const form = document.getElementById('gmb-form-wrapper');
            const loader = document.getElementById('gmb-loader');
            
            form.style.display = 'none';
            loader.style.display = 'block';
            
            fetch("{{ route('admin.ai.gmb-draft') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ type: type, id: id })
            })
            .then(res => res.json())
            .then(res => {
                loader.style.display = 'none';
                form.style.display = 'block';
                if (res.success && res.draft) {
                    document.getElementById('gmb_post_text').value = res.draft;
                } else {
                    alert('AI Drafting failed: ' + (res.error || 'Unknown error'));
                    document.getElementById('gmb_post_text').value = 'Failed to draft post. Please write manually.';
                }
            })
            .catch(err => {
                loader.style.display = 'none';
                form.style.display = 'block';
                alert('Network Error drafting post: ' + err.message);
            });
        }

        function copyAndOpenGmb() {
            const text = document.getElementById('gmb_post_text').value;
            if (!text) {
                alert('No text draft to copy!');
                return;
            }
            navigator.clipboard.writeText(text).then(() => {
                showToast('Post content copied to clipboard!', 'success');
                setTimeout(() => {
                    window.open('https://business.google.com/', '_blank');
                }, 800);
            }).catch(err => {
                alert('Failed to copy to clipboard.');
            });
        }

        function publishGmbPostDirect() {
            const text = document.getElementById('gmb_post_text').value;
            const url = document.getElementById('gmb_target_url').value;
            const publishBtn = document.getElementById('gmb-publish-btn');
            
            if (!text) {
                alert('Please enter post text.');
                return;
            }
            
            const originalHtml = publishBtn.innerHTML;
            publishBtn.disabled = true;
            publishBtn.innerHTML = 'Publishing...';
            
            fetch("{{ route('admin.gmb.publish') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ text: text, url: url })
            })
            .then(res => res.json())
            .then(res => {
                publishBtn.disabled = false;
                publishBtn.innerHTML = originalHtml;
                if (res.success) {
                    showToast('Successfully published post directly to Google Business Profile!', 'success');
                    closeGmbModal();
                } else {
                    alert('API Publish failed: ' + (res.error || 'Unknown error'));
                }
            })
            .catch(err => {
                publishBtn.disabled = false;
                publishBtn.innerHTML = originalHtml;
                alert('Network Error publishing: ' + err.message);
            });
        }

        // Toggle Lead Details
        function toggleLeadDetails(id) {
            const row = document.getElementById('lead-details-' + id);
            if (row.style.display === 'none') {
                row.style.display = 'table-row';
                setTimeout(() => lucide.createIcons(), 10);
            } else {
                row.style.display = 'none';
            }
        }

        // Bulk Lead Operations
        function toggleAllLeads(masterCheckbox) {
            const checkboxes = document.querySelectorAll('.lead-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = masterCheckbox.checked;
            });
            updateBulkDeleteState();
        }

        function updateBulkDeleteState() {
            const checkboxes = document.querySelectorAll('.lead-checkbox');
            const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);
            const bulkDeleteBtn = document.getElementById('btn-bulk-delete');
            const countSpan = document.getElementById('bulk-select-count');
            
            if (checkedBoxes.length > 0) {
                bulkDeleteBtn.style.display = 'inline-flex';
                countSpan.textContent = checkedBoxes.length;
            } else {
                bulkDeleteBtn.style.display = 'none';
                countSpan.textContent = '0';
            }
        }

        function submitBulkDelete() {
            if (confirm('Are you sure you want to permanently delete all selected leads?')) {
                document.getElementById('bulk-delete-form').submit();
            }
        }

        // Admin Live Chat Variables (declared at the top of script)

        // Chat pollings are managed globally inside the unified DOMContentLoaded listener

        function escapeHTML(str) {
            if (!str) return '';
            return str.replace(/[&<>'"]/g, 
                tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
            );
        }

        let previousUnreadSum = null;

        function playNotificationChime() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const context = new AudioContext();
                
                const playNote = (freq, start, duration) => {
                    const osc = context.createOscillator();
                    const gain = context.createGain();
                    
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, start);
                    
                    gain.gain.setValueAtTime(0.08, start);
                    gain.gain.exponentialRampToValueAtTime(0.001, start + duration);
                    
                    osc.connect(gain);
                    gain.connect(context.destination);
                    
                    osc.start(start);
                    osc.stop(start + duration);
                };
                
                const now = context.currentTime;
                playNote(523.25, now, 0.25); // C5
                playNote(659.25, now + 0.15, 0.4); // E5
            } catch (e) {
                console.error('Audio synthesizer chime failed:', e);
            }
        }

        function loadAdminChatSessions() {
            fetch('/admin/chats')
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        renderAdminChatSessions(data.sessions);
                    }
                })
                .catch(err => console.error('Error fetching admin chat sessions:', err));
        }

        function renderAdminChatSessions(sessions) {
            const list = document.getElementById('admin-chat-sessions-list');
            
            // Build signature to check for content and selection state changes
            const sessionsSignature = JSON.stringify(sessions.map(s => ({
                id: s.session_id,
                msg: s.message,
                unread: s.unread_count,
                selected: s.session_id === currentAdminSessionId,
                time: s.created_at
            })));
            
            // If nothing changed, return immediately to prevent sidebar DOM recreation & flickering
            if (sessionsSignature === lastSessionsJson) {
                return;
            }
            lastSessionsJson = sessionsSignature;
            
            // Update sidebar unread totals for menu badges
            let totalUnread = 0;
            sessions.forEach(s => totalUnread += s.unread_count);
            
            if (previousUnreadSum !== null && totalUnread > previousUnreadSum) {
                playNotificationChime();
                if (typeof showToast === 'function') {
                    showToast('New message received from visitor!', 'success');
                }
            }
            previousUnreadSum = totalUnread;
            
            const totalBadge = document.getElementById('admin-chat-total-badge');
            const mobileBadge = document.getElementById('admin-chat-mobile-badge');
            
            if (totalUnread > 0) {
                totalBadge.textContent = totalUnread;
                totalBadge.style.display = 'inline-flex';
                mobileBadge.textContent = totalUnread;
                mobileBadge.style.display = 'inline-flex';
            } else {
                totalBadge.style.display = 'none';
                mobileBadge.style.display = 'none';
            }

            if (sessions.length === 0) {
                list.innerHTML = `<div style="padding: 3rem 1.5rem; text-align: center; color: var(--admin-text-muted); font-size: 0.85rem;">No active chat conversations.</div>`;
                return;
            }

            list.innerHTML = '';
            sessions.forEach(s => {
                const isSelected = s.session_id === currentAdminSessionId;
                const time = new Date(s.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                
                const itemDiv = document.createElement('div');
                itemDiv.onclick = () => selectAdminChat(s.session_id);
                itemDiv.style.padding = '1rem 1.25rem';
                itemDiv.style.borderBottom = '1px solid var(--admin-border)';
                itemDiv.style.cursor = 'pointer';
                itemDiv.style.backgroundColor = isSelected ? 'rgba(92, 203, 179, 0.08)' : 'transparent';
                itemDiv.style.borderLeft = isSelected ? '4px solid var(--primary-teal)' : '4px solid transparent';
                itemDiv.style.transition = 'all 0.2s';
                
                itemDiv.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                        <strong style="color: ${isSelected ? 'var(--mint-green)' : '#ffffff'}; font-size: 0.9rem; font-family: 'Outfit';">Session ${s.session_id.substr(5, 6)}</strong>
                        <span style="font-size: 0.7rem; color: var(--admin-text-muted);">${time}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.8rem; color: #94a3b8; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                            ${s.sender === 'admin' ? 'You: ' : ''}${escapeHTML(s.message)}
                        </span>
                        ${s.unread_count > 0 ? `<span style="background-color: #ef4444; color: white; font-size: 0.65rem; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">${s.unread_count}</span>` : ''}
                    </div>
                `;
                
                itemDiv.onmouseover = () => { if (!isSelected) itemDiv.style.backgroundColor = 'rgba(255,255,255,0.02)'; };
                itemDiv.onmouseout = () => { if (!isSelected) itemDiv.style.backgroundColor = 'transparent'; };
                
                list.appendChild(itemDiv);
            });
        }

        function selectAdminChat(sessionId) {
            currentAdminSessionId = sessionId;
            lastMessagesJson = ''; // Clear message signature to force reload of messages panel
            loadAdminChatSessions();
            
            document.getElementById('admin-chat-input-wrap').style.display = 'flex';
            document.getElementById('admin-chat-delete-btn').style.display = 'inline-flex';
            document.getElementById('admin-chat-refresh-btn').style.display = 'inline-flex';
            
            document.getElementById('admin-chat-header-title').textContent = `Session ${sessionId.substr(5, 6)}`;
            document.getElementById('admin-chat-header-subtitle').textContent = `Full Session ID: ${sessionId}`;
            
            loadAdminChatMessages();
            
            clearInterval(adminMessagesPoll);
            adminMessagesPoll = setInterval(loadAdminChatMessages, 60000);
        }



        function loadAdminChatMessages() {
            if (!currentAdminSessionId) return;
            
            fetch(`/admin/chats/${currentAdminSessionId}`)
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        renderAdminChatMessages(data.messages);
                    }
                })
                .catch(err => console.error('Error fetching admin session messages:', err));
        }

        function renderAdminChatMessages(messages) {
            const wrap = document.getElementById('admin-chat-messages-wrap');
            
            const messagesSignature = JSON.stringify(messages.map(m => ({
                id: m.id,
                sender: m.sender,
                msg: m.message,
                time: m.created_at
            })));
            
            if (messagesSignature === lastMessagesJson) {
                return;
            }
            lastMessagesJson = messagesSignature;
            
            wrap.innerHTML = '';
            
            messages.forEach(msg => {
                const isMsgAdmin = msg.sender === 'admin';
                const msgDiv = document.createElement('div');
                msgDiv.style.display = 'flex';
                msgDiv.style.justifyContent = isMsgAdmin ? 'flex-end' : 'flex-start';
                
                const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                msgDiv.innerHTML = `
                    <div style="max-width: 70%; background-color: ${isMsgAdmin ? 'var(--primary-teal)' : 'var(--admin-dark-sidebar)'}; color: white; padding: 0.65rem 1rem; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); font-size: 0.9rem; line-height: 1.4; margin-bottom: 4px;">
                        <div style="word-break: break-word;">${escapeHTML(msg.message)}</div>
                        <div style="font-size: 0.65rem; text-align: right; margin-top: 4px; color: ${isMsgAdmin ? 'rgba(255,255,255,0.7)' : 'var(--admin-text-muted)'};">${time}</div>
                    </div>
                `;
                wrap.appendChild(msgDiv);
            });
            
            wrap.scrollTop = wrap.scrollHeight;
        }


        function handleAdminChatKey(e) {
            if (e.key === 'Enter') {
                sendAdminReply();
            }
        }

        function sendAdminReply() {
            if (!currentAdminSessionId) return;
            
            const input = document.getElementById('admin-chat-reply-input');
            const msg = input.value.trim();
            if (!msg) return;
            
            input.value = '';
            
            fetch(`/admin/chats/${currentAdminSessionId}/reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: msg })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    lastMessagesJson = '';
                    loadAdminChatMessages();
                    loadAdminChatSessions();
                }

            })
            .catch(err => console.error('Error sending admin reply:', err));
        }

        function deleteCurrentChat() {
            if (!currentAdminSessionId) return;
            
            if (confirm('Are you sure you want to permanently delete this chat session and all its messages?')) {
                fetch(`/admin/chats/${currentAdminSessionId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        currentAdminSessionId = null;
                        lastSessionsJson = '';
                        lastMessagesJson = '';
                        clearInterval(adminMessagesPoll);

                        
                        document.getElementById('admin-chat-messages-wrap').innerHTML = `
                            <div style="margin: auto; text-align: center; color: var(--admin-text-muted);">
                                <i data-lucide="message-square" style="width: 48px; height: 48px; stroke-width: 1.25; margin-bottom: 0.75rem; color: var(--admin-border);"></i>
                                <p style="font-size: 0.95rem; margin: 0;">No Chat Selected</p>
                            </div>
                        `;
                        document.getElementById('admin-chat-header-title').textContent = 'Select a Chat';
                        document.getElementById('admin-chat-header-subtitle').textContent = 'Please pick a patient chat session from the list to start responding.';
                        document.getElementById('admin-chat-delete-btn').style.display = 'none';
                        document.getElementById('admin-chat-refresh-btn').style.display = 'none';
                        document.getElementById('admin-chat-input-wrap').style.display = 'none';

                        
                        setTimeout(() => lucide.createIcons(), 10);
                        loadAdminChatSessions();
                    }
                })
                .catch(err => console.error('Error deleting chat:', err));
            }
        }

        // Initialize background silent badge checkers
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                if (localStorage.getItem('active_tab') === 'livechat' && "{{ $activeTab }}" !== 'livechat') {
                    switchTab('livechat');
                } else {
                    fetch('/admin/chats')
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                let totalUnread = 0;
                                data.sessions.forEach(s => totalUnread += s.unread_count);
                                const totalBadge = document.getElementById('admin-chat-total-badge');
                                const mobileBadge = document.getElementById('admin-chat-mobile-badge');
                                if (totalUnread > 0) {
                                    totalBadge.textContent = totalUnread;
                                    totalBadge.style.display = 'inline-flex';
                                    mobileBadge.textContent = totalUnread;
                                    mobileBadge.style.display = 'inline-flex';
                                }
                            }
                        });
                }
            }, 2000);
        });

        // ==============================================================
        // HTML WYSIWYG & SOURCE CODE EDITOR (TinyMCE with full HTML Tag & Heading support)
        // ==============================================================
        function createEditorWrapper(textareaId) {
            return {
                getData: function() {
                    if (typeof tinymce !== 'undefined') {
                        const ed = tinymce.get(textareaId);
                        if (ed) return ed.getContent();
                    }
                    const el = document.getElementById(textareaId);
                    return el ? el.value : '';
                },
                setData: function(val) {
                    if (typeof tinymce !== 'undefined') {
                        const ed = tinymce.get(textareaId);
                        if (ed) {
                            ed.setContent(val || '');
                        }
                    }
                    const el = document.getElementById(textareaId);
                    if (el) el.value = val || '';
                }
            };
        }

        const blogEditor = createEditorWrapper('blog_content');
        const serviceIntroEditor = createEditorWrapper('ser_intro_content');
        const serviceTipsEditor = createEditorWrapper('ser_tips_content');
        const treatmentEditor = createEditorWrapper('treat_description');
        const specialistEditor = createEditorWrapper('spec_description');
        const cmsEditor = createEditorWrapper('cms_description');

        function openEditorSource(textareaId) {
            if (typeof tinymce !== 'undefined') {
                const ed = tinymce.get(textareaId);
                if (ed) {
                    ed.execCommand('mceCodeEditor');
                    return;
                }
            }
            alert('Editor is still initializing. Please wait a second.');
        }

        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '#blog_content, #ser_intro_content, #ser_tips_content, #treat_description, #spec_description, #cms_description',
                plugins: 'code link image lists table fullscreen autolink media wordcount',
                toolbar: 'blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code fullscreen | undo redo',
                menubar: false,
                height: 440,
                branding: false,
                promotion: false,
                elementpath: true,
                convert_urls: false,
                relative_urls: false,
                remove_script_host: false,
                content_style: `
                    body {
                        font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                        font-size: 15px;
                        color: #1e293b;
                        line-height: 1.65;
                        padding: 12px;
                    }
                    h1, h2, h3, h4, h5, h6 {
                        font-weight: 700;
                        color: #0b1e36;
                        margin-top: 1.25rem;
                        margin-bottom: 0.5rem;
                    }
                    p {
                        margin-bottom: 1rem;
                    }
                    strong, b {
                        font-weight: 700;
                        color: #0b1e36;
                    }
                    code {
                        background: #f1f5f9;
                        padding: 2px 6px;
                        border-radius: 4px;
                        font-size: 0.9em;
                    }
                    table {
                        border-collapse: collapse;
                        width: 100%;
                        margin-bottom: 1rem;
                    }
                    th, td {
                        border: 1px solid #cbd5e1;
                        padding: 8px 12px;
                    }
                `,
                block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Blockquote=blockquote; Code Block=pre',
                setup: function(editor) {
                    editor.on('change keyup NodeChange SetContent', function() {
                        editor.save(); // Keep underlying textarea in sync
                    });
                }
            });
        }

        function escapeJsString(str) {
            if (!str) return '';
            return str.replace(/'/g, "\\'").replace(/"/g, '\\"');
        }

        // Blog Edit functions via dynamic AJAX
        function editBlog(id) {
            document.getElementById('blog-form-title-text').innerText = 'Loading Blog details...';
            
            fetch('/admin/blogs/' + id + '/detail')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('blog-form-title-text').innerText = 'Edit Blog Article: ' + data.title;
                    document.getElementById('blog-ai-btn').style.display = 'none';
                    document.getElementById('blog-form').action = '/admin/blogs/' + data.id + '/update';
                    document.getElementById('blog-form-method').value = 'POST';
                    document.getElementById('blog_title').value = data.title;
                    document.getElementById('blog_slug').value = data.slug;
                    if (data.category) {
                        const catSelect = document.getElementById('blog_category');
                        let exists = Array.from(catSelect.options).some(o => o.value === data.category);
                        if (!exists) {
                            const newOpt = new Option(data.category, data.category, true, true);
                            catSelect.add(newOpt, catSelect.options[1]);
                        }
                        catSelect.value = data.category;
                    }
                    document.getElementById('blog_published_at').value = data.published_at;
                    document.getElementById('blog_summary').value = data.summary;
                    document.getElementById('blog_schema_markup').value = data.schema_markup || '';
                    document.getElementById('blog_metatitle').value = data.metatitle || '';
                    document.getElementById('blog_metadescription').value = data.metadescription || '';
                    document.getElementById('blog_metakeywords').value = data.metakeywords || '';
                    if (blogEditor) {
                        blogEditor.setData(data.content || '');
                    } else {
                        document.getElementById('blog_content').value = data.content || '';
                    }
                    document.getElementById('blog-submit-btn').innerText = 'Update Blog Article';
                    document.getElementById('blog_image_url').value = (data.image_path && (data.image_path.startsWith('http') || data.image_path.startsWith('//'))) ? data.image_path : '';
                    document.getElementById('blog-cancel-btn').style.display = 'inline-block';
                    
                    document.getElementById('blog-form-container').scrollIntoView({ behavior: 'smooth' });
                })
                .catch(err => {
                    console.error('Error fetching blog details:', err);
                    alert('Failed to load blog details. Please try again.');
                    cancelBlogEdit();
                });
        }



        function cancelBlogEdit() {
            document.getElementById('blog-form-title-text').innerText = 'Create New Blog Article';
            document.getElementById('blog-ai-btn').style.display = 'inline-flex';
            document.getElementById('blog-form').action = "{{ route('admin.blogs.store') }}";
            document.getElementById('blog-form-method').value = 'POST';
            document.getElementById('blog_title').value = '';
            document.getElementById('blog_slug').value = '';
            document.getElementById('blog_category').selectedIndex = 0;
            document.getElementById('blog_published_at').value = "{{ date('Y-m-d\TH:i') }}";
            document.getElementById('blog_summary').value = '';
            document.getElementById('blog_schema_markup').value = '';
            document.getElementById('blog_metatitle').value = '';
            document.getElementById('blog_metadescription').value = '';
            document.getElementById('blog_metakeywords').value = '';
            document.getElementById('blog_image_url').value = '';
            if (blogEditor) {
                blogEditor.setData('');
            } else {
                document.getElementById('blog_content').value = '';
            }
            document.getElementById('blog-submit-btn').innerText = 'Publish Blog Article';
            document.getElementById('blog-cancel-btn').style.display = 'none';
        }


        // HTML escaping helper
        function escapeHtml(text) {
            if (!text) return '';
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // FAQ Repeater actions
        function addFaqInput(question = '', answer = '') {
            const container = document.getElementById('faq-repeater-container');
            const faqRow = document.createElement('div');
            faqRow.className = 'faq-repeater-row';
            faqRow.style = 'background: rgba(255,255,255,0.01); border: 1px solid var(--admin-border); padding: 1rem; border-radius: var(--radius-md); position: relative; margin-bottom: 0.5rem;';
            faqRow.innerHTML = `
                <button type="button" onclick="this.parentElement.remove()" style="position: absolute; right: 10px; top: 10px; background: none; border: none; color: #ef4444; cursor: pointer; font-size: 1.2rem;" title="Remove FAQ">&times;</button>
                <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 0.5rem;">
                    <div>
                        <label style="font-size: 0.8rem; color: rgba(255,255,255,0.6); display:block; margin-bottom:0.25rem;">Question</label>
                        <input type="text" name="faq_questions[]" class="form-control" value="${escapeHtml(question)}" required placeholder="e.g. What is the minimum interest rate?">
                    </div>
                    <div>
                        <label style="font-size: 0.8rem; color: rgba(255,255,255,0.6); display:block; margin-bottom:0.25rem;">Answer</label>
                        <textarea name="faq_answers[]" class="form-control" rows="2" required placeholder="e.g. The minimum interest rate starts from 10.49% p.a.">${escapeHtml(answer)}</textarea>
                    </div>
                </div>
            `;
            container.appendChild(faqRow);
            lucide.createIcons();
        }

        // Collection Edit functions
        function editCollection(data) {
            document.getElementById('collection-form-title-text').innerText = 'Edit Collection: ' + data.name;
            document.getElementById('collection-form').action = '/admin/collections/' + data.id + '/update';
            document.getElementById('collection-form-method').value = 'POST';
            
            document.getElementById('col_name').value = data.name;
            document.getElementById('col_slug').value = data.slug;
            document.getElementById('col_description').value = data.description || '';
            document.getElementById('col_metatitle').value = data.metatitle || '';
            document.getElementById('col_metakeywords').value = data.metakeywords || '';
            document.getElementById('col_metadescription').value = data.metadescription || '';
            document.getElementById('col_schema').value = data.schema_markup || '';
            document.getElementById('col_image_url').value = (data.image && (data.image.startsWith('http') || data.image.startsWith('//'))) ? data.image : '';
            
            document.getElementById('collection-form-container').scrollIntoView({ behavior: 'smooth' });
        }

        function resetCollectionForm() {
            document.getElementById('collection-form-title-text').innerText = 'Create New Collection';
            document.getElementById('collection-form').action = "{{ route('admin.collections.store') }}";
            document.getElementById('collection-form-method').value = 'POST';
            
            document.getElementById('col_name').value = '';
            document.getElementById('col_slug').value = '';
            document.getElementById('col_description').value = '';
            document.getElementById('col_metatitle').value = '';
            document.getElementById('col_metakeywords').value = '';
            document.getElementById('col_metadescription').value = '';
            document.getElementById('col_schema').value = '';
            document.getElementById('col_image_url').value = '';
        }

        // Marble Edit functions
        function editMarble(data) {
            document.getElementById('marble-form-title-text').innerText = 'Edit Marble / Product: ' + data.name;
            document.getElementById('marble-form').action = '/admin/marbles/' + data.id + '/update';
            document.getElementById('marble-form-method').value = 'POST';
            
            document.getElementById('m_name').value = data.name;
            document.getElementById('m_slug').value = data.slug;
            document.getElementById('m_origin').value = data.origin || '';
            document.getElementById('m_thickness').value = data.thickness || '';
            document.getElementById('m_finishes').value = data.finishes || '';
            document.getElementById('m_applications').value = data.applications || '';
            document.getElementById('m_description').value = data.description || '';
            document.getElementById('m_metatitle').value = data.metatitle || '';
            document.getElementById('m_metakeywords').value = data.metakeywords || '';
            document.getElementById('m_metadescription').value = data.metadescription || '';
            document.getElementById('m_schema').value = data.schema_markup || '';
            document.getElementById('m_image_url').value = (data.image && (data.image.startsWith('http') || data.image.startsWith('//'))) ? data.image : '';
            
            // Build gallery urls if available
            let gallery = [];
            if (typeof data.gallery === 'string') {
                try {
                    gallery = JSON.parse(data.gallery);
                } catch(e) {
                    gallery = [];
                }
            } else if (Array.isArray(data.gallery)) {
                gallery = data.gallery;
            }
            document.getElementById('m_gallery_urls').value = gallery.join(', ');

            // Set multiselect collections
            const selectEl = document.getElementById('m_collections');
            Array.from(selectEl.options).forEach(opt => {
                opt.selected = data.collections && data.collections.some(c => c.id == opt.value);
            });

            document.getElementById('marble-form-container').scrollIntoView({ behavior: 'smooth' });
        }

        function resetMarbleForm() {
            document.getElementById('marble-form-title-text').innerText = 'Create New Marble / Product';
            document.getElementById('marble-form').action = "{{ route('admin.marbles.store') }}";
            document.getElementById('marble-form-method').value = 'POST';
            
            document.getElementById('m_name').value = '';
            document.getElementById('m_slug').value = '';
            document.getElementById('m_origin').value = '';
            document.getElementById('m_thickness').value = '';
            document.getElementById('m_finishes').value = '';
            document.getElementById('m_applications').value = '';
            document.getElementById('m_description').value = '';
            document.getElementById('m_metatitle').value = '';
            document.getElementById('m_metakeywords').value = '';
            document.getElementById('m_metadescription').value = '';
            document.getElementById('m_schema').value = '';
            document.getElementById('m_image_url').value = '';
            document.getElementById('m_gallery_urls').value = '';
            
            const selectEl = document.getElementById('m_collections');
            Array.from(selectEl.options).forEach(opt => { opt.selected = false; });
        }

        // Location Edit functions
        function editLocation(data) {
            document.getElementById('location-form-title').querySelector('span').innerText = 'Edit Location Page Settings: ' + data.city;
            document.getElementById('location-form').action = '/admin/locations/' + data.id + '/update';
            document.getElementById('location-form-method').value = 'POST';
            
            document.getElementById('loc_city').value = data.city;
            document.getElementById('loc_slug').value = data.slug;
            document.getElementById('loc_title').value = data.title;
            document.getElementById('loc_meta_description').value = data.meta_description || '';
            document.getElementById('loc_content').value = typeof data.content === 'object' ? JSON.stringify(data.content) : (data.content || '');
            document.getElementById('loc_schema').value = data.schema_markup || '';
            
            document.getElementById('location-form-container').scrollIntoView({ behavior: 'smooth' });
        }

        function resetLocationForm() {
            document.getElementById('location-form-title').querySelector('span').innerText = 'Create New Location Page';
            document.getElementById('location-form').action = "{{ route('admin.locations.store') }}";
            document.getElementById('location-form-method').value = 'POST';
            
            document.getElementById('loc_city').value = '';
            document.getElementById('loc_slug').value = '';
            document.getElementById('loc_title').value = '';
            document.getElementById('loc_meta_description').value = '';
            document.getElementById('loc_content').value = '';
            document.getElementById('loc_schema').value = '';
        }

        // AI City Location generator AJAX trigger
        function triggerAiLocationGen() {
            const id = document.getElementById('ai_loc_select').value;
            const prompt = document.getElementById('ai_loc_prompt').value;
            
            if (!id) {
                alert('Please select a target city/location page to generate copy for.');
                return;
            }
            if (!prompt) {
                alert('Please specify AI guidelines or regional focus pointers.');
                return;
            }

            document.getElementById('ai_loc_loader').style.display = 'block';

            fetch('/admin/locations/ai-generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: id, prompt: prompt })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('ai_loc_loader').style.display = 'none';
                if (data.error) {
                    alert('AI Generation Error: ' + data.error);
                } else {
                    alert('Geological landing page content generated successfully!');
                    window.location.reload();
                }
            })
            .catch(err => {
                document.getElementById('ai_loc_loader').style.display = 'none';
                alert('Request failed: ' + err.message);
            });
        }

        // Specialist Edit functions
        function editSpecialist(data) {
            document.getElementById('specialist-form-title-text').innerText = 'Edit Specialist: ' + data.name;
            document.getElementById('specialist-form').action = '/admin/specialists/' + data.id + '/update';
            document.getElementById('specialist-form-method').value = 'POST';
            document.getElementById('spec_name').value = data.name;
            document.getElementById('spec_designation').value = data.designation;
            document.getElementById('spec_slug').value = data.slug;
            document.getElementById('spec_phone').value = data.phone || '';
            document.getElementById('spec_facebook').value = data.facebook || '';
            document.getElementById('spec_twitter').value = data.twitter || '';
            document.getElementById('spec_metatitle').value = data.metatitle || '';
            document.getElementById('spec_tags').value = data.tags || '';
            document.getElementById('spec_metadescription').value = data.metadescription || '';
            document.getElementById('spec_schema_markup').value = data.schema_markup || '';
            document.getElementById('spec_status').checked = !!data.status;
            
            if (specialistEditor) {
                specialistEditor.setData(data.description || '');
            } else {
                document.getElementById('spec_description').value = data.description || '';
            }
            document.getElementById('spec_image_url').value = (data.image && (data.image.startsWith('http') || data.image.startsWith('//'))) ? data.image : '';
            document.getElementById('spec-cancel-btn').style.display = 'inline-block';
            
            document.getElementById('specialist-form').scrollIntoView({ behavior: 'smooth' });
        }

        function cancelSpecialistEdit() {
            document.getElementById('specialist-form-title-text').innerText = 'Add New Clinic Specialist';
            document.getElementById('specialist-form').action = "{{ route('admin.specialists.store') }}";
            document.getElementById('specialist-form-method').value = 'POST';
            document.getElementById('spec_name').value = '';
            document.getElementById('spec_designation').value = '';
            document.getElementById('spec_slug').value = '';
            document.getElementById('spec_phone').value = '';
            document.getElementById('spec_facebook').value = '';
            document.getElementById('spec_twitter').value = '';
            document.getElementById('spec_metatitle').value = '';
            document.getElementById('spec_tags').value = '';
            document.getElementById('spec_metadescription').value = '';
            document.getElementById('spec_schema_markup').value = '';
            document.getElementById('spec_status').checked = true;
            if (specialistEditor) {
                specialistEditor.setData('');
            } else {
                document.getElementById('spec_description').value = '';
            }
            document.getElementById('spec_image_url').value = '';
            document.getElementById('spec-cancel-btn').style.display = 'none';
        }

        // CMS Page Edit functions
        function editCmsPage(data) {
            document.getElementById('cms-form-title-text').innerText = 'Edit CMS Page: ' + data.title;
            document.getElementById('cms-form').action = '/admin/cms-pages/' + data.id + '/update';
            document.getElementById('cms-form-method').value = 'POST';
            document.getElementById('cms_title').value = data.title;
            document.getElementById('cms_slug').value = data.slug;
            document.getElementById('cms_metatitle').value = data.metatitle || '';
            document.getElementById('cms_metakeywords').value = data.metakeywords || '';
            document.getElementById('cms_metadescription').value = data.metadescription || '';
            document.getElementById('cms_schema_markup').value = data.schema_markup || '';
            document.getElementById('cms_status').checked = !!data.status;
            
            if (cmsEditor) {
                cmsEditor.setData(data.description || '');
            } else {
                document.getElementById('cms_description').value = data.description || '';
            }
            document.getElementById('cms_image_url').value = (data.image && (data.image.startsWith('http') || data.image.startsWith('//'))) ? data.image : '';
            document.getElementById('cms-cancel-btn').style.display = 'inline-block';
            
            document.getElementById('cms-form').scrollIntoView({ behavior: 'smooth' });
        }

        function cancelCmsPageEdit() {
            document.getElementById('cms-form-title-text').innerText = 'Add New CMS Page';
            document.getElementById('cms-form').action = "{{ route('admin.cms_pages.store') }}";
            document.getElementById('cms-form-method').value = 'POST';
            document.getElementById('cms_title').value = '';
            document.getElementById('cms_slug').value = '';
            document.getElementById('cms_metatitle').value = '';
            document.getElementById('cms_metakeywords').value = '';
            document.getElementById('cms_metadescription').value = '';
            document.getElementById('cms_schema_markup').value = '';
            document.getElementById('cms_status').checked = true;
            if (cmsEditor) {
                cmsEditor.setData('');
            } else {
                document.getElementById('cms_description').value = '';
            }
            document.getElementById('cms_image_url').value = '';
            document.getElementById('cms-cancel-btn').style.display = 'none';
        }

        function filterCmsPagesTable() {
            var input = document.getElementById("cms-search-input");
            if (!input) return;
            var filter = input.value.toLowerCase();
            var table = document.getElementById("cms-pages-table");
            if (!table) return;
            var tbody = table.getElementsByTagName("tbody")[0];
            if (!tbody) return;
            var trs = tbody.getElementsByTagName("tr");
            for (var i = 0; i < trs.length; i++) {
                var text = trs[i].innerText.toLowerCase();
                trs[i].style.display = text.indexOf(filter) > -1 ? "" : "none";
            }
        }

        // Dummy bank methods to prevent errors
        function editBank(data) {}
        function cancelBankEdit() {}

        // Copy URL Helper
        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                const originalText = button.innerHTML;
                button.innerHTML = '<i data-lucide="check" style="width: 12px; height: 12px;"></i> Copied!';
                button.style.backgroundColor = 'var(--accent-teal)';
                button.style.color = '#fff';
                lucide.createIcons();
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.backgroundColor = '';
                    button.style.color = '';
                    lucide.createIcons();
                }, 2000);
            }).catch(err => {
                alert('Failed to copy link: ' + err);
            });
        }

        // AJAX Media Upload Helper
        function uploadMediaFile(input) {
            if (input.files.length === 0) return;
            
            const file = input.files[0];
            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', "{{ csrf_token() }}");
            
            const progressContainer = document.getElementById('media-upload-progress');
            const progressBar = document.getElementById('media-progress-bar');
            
            progressContainer.style.display = 'block';
            progressBar.style.width = '0%';
            
            const xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('admin.media.upload') }}", true);
            
            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percentage = (e.loaded / e.total) * 100;
                    progressBar.style.width = percentage + '%';
                }
            };
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Image uploaded and optimized to WebP successfully!');
                        location.reload();
                    } else {
                        alert('Upload failed: ' + (response.message || 'Unknown error'));
                    }
                } else {
                    alert('Upload failed with status ' + xhr.status);
                }
                progressContainer.style.display = 'none';
            };
            
            xhr.onerror = function() {
                alert('Network error during upload.');
                progressContainer.style.display = 'none';
            };
            
            xhr.send(formData);
        }

        // AI Generation UI & AJAX Helpers
        function openAiModal(type) {
            const overlay = document.getElementById('ai-' + type + '-modal');
            if (overlay) {
                overlay.style.display = 'flex';
                setTimeout(() => overlay.classList.add('show'), 10);
            }
        }

        function closeAiModal(type) {
            const overlay = document.getElementById('ai-' + type + '-modal');
            if (overlay) {
                overlay.classList.remove('show');
                setTimeout(() => {
                    overlay.style.display = 'none';
                    const formWrapper = document.getElementById('ai-' + type + '-form-wrapper');
                    const loader = document.getElementById('ai-' + type + '-loader');
                    if (formWrapper) formWrapper.style.display = 'block';
                    if (loader) loader.style.display = 'none';
                    
                    const promptInput = document.getElementById('ai_' + type + '_prompt');
                    if (promptInput) promptInput.value = '';

                    const previewBox = document.getElementById('ai-image-preview-container');
                    if (previewBox) previewBox.style.display = 'none';
                }, 300);
            }
        }

        // Toast Notification System
        function showToast(title, message, type = 'info', uniqueId = null) {
            const container = document.getElementById('ai-toast-container');
            if (!container) return null;

            let toast = uniqueId ? document.getElementById(uniqueId) : null;
            let isNew = false;

            if (!toast) {
                isNew = true;
                toast = document.createElement('div');
                toast.className = 'ai-toast';
                if (uniqueId) toast.id = uniqueId;
            }

            let iconHtml = '';
            if (type === 'info') {
                iconHtml = '<div class="ai-toast-spinner"></div>';
            } else if (type === 'success') {
                iconHtml = '<div class="ai-toast-success-icon"><i data-lucide="check-circle" style="width: 20px; height: 20px;"></i></div>';
            } else if (type === 'error') {
                iconHtml = '<div class="ai-toast-error-icon"><i data-lucide="alert-triangle" style="width: 20px; height: 20px;"></i></div>';
            }

            toast.innerHTML = `
                ${iconHtml}
                <div class="ai-toast-content">
                    <div class="ai-toast-title">${title}</div>
                    <p class="ai-toast-message">${message}</p>
                </div>
                <button class="ai-toast-close" onclick="this.parentElement.remove()">&times;</button>
            `;

            if (isNew) {
                container.appendChild(toast);
            }

            lucide.createIcons();

            if (Notification.permission === 'granted' && isNew) {
                try {
                    new Notification(title, { body: message });
                } catch(e) {}
            }

            if (type !== 'info') {
                setTimeout(() => {
                    if (toast && toast.parentElement) {
                        toast.style.transform = 'translateX(120%)';
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 300);
                    }
                }, 6000);
            }

            return toast;
        }

        if (typeof Notification !== 'undefined' && Notification.permission === 'default') {
            Notification.requestPermission();
        }

        function generateLandingSlug(title) {
            document.getElementById('landing_slug').value = title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }

        function toggleEditLandingForm(id) {
            const row = document.getElementById('landing-editor-' + id);
            if (row.style.display === 'none') {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        }

        function openLandingAiModal(id, title) {
            document.getElementById('ai_landing_id').value = id;
            document.getElementById('ai_landing_target_title').value = title;
            document.getElementById('ai_landing_prompt').value = 'Create an optimized promotional landing page for ' + title + ' highlighting specialized orthopedic procedures, patient care, recovery success rate, and booking online consultations.';
            openAiModal('landing');
        }


        function generateAiLandingPage() {
            const id = document.getElementById('ai_landing_id').value;
            const prompt = document.getElementById('ai_landing_prompt').value.trim();
            
            if (!prompt) {
                alert('Please enter a description or topic for the landing page.');
                return;
            }
            
            const formWrapper = document.getElementById('ai-landing-form-wrapper');
            const loader = document.getElementById('ai-landing-loader');
            
            formWrapper.style.display = 'none';
            loader.style.display = 'flex';
            
            const jobId = 'landing-gen-' + Date.now();
            showToast("Generating AI Landing Page", "Gemini is writing the landing page copy...", "info", jobId);
            
            fetch('{{ route("admin.ai.landing") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    prompt: prompt
                })
            })
            .then(response => response.json())
            .then(data => {
                closeAiModal('landing');
                if (data.success) {
                    showToast("Generation Successful", "Your landing page content is ready. Reloading...", "success", jobId);
                    setTimeout(() => window.location.reload(), 1200);
                } else {
                    alert('Error: ' + (data.error || 'Failed to generate content.'));
                }
            })
            .catch(error => {
                closeAiModal('landing');
                alert('Request failed: ' + error.message);
            });
        }

        function syncGmbReviews() {
            const btn = document.getElementById('btn-sync-gmb');
            const icon = document.getElementById('icon-sync-gmb');
            
            btn.disabled = true;
            btn.innerHTML = '<i data-lucide="loader" class="animate-spin" style="width: 16px; height: 16px;"></i> Syncing Reviews...';
            lucide.createIcons();
            
            const jobId = 'gmb-sync-' + Date.now();
            showToast("Syncing GMB Reviews", "Gemini is pulling reviews from your GMB profile link...", "info", jobId);
            
            fetch('{{ route("admin.ai.gmb-sync") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="refresh-cw" id="icon-sync-gmb" style="width: 16px; height: 16px;"></i> Sync GMB Reviews via AI';
                lucide.createIcons();
                
                if (data.success) {
                    showToast("Sync Successful", data.message, "success", jobId);
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    showToast("Sync Failed", data.error || 'Unknown error occurred.', "error", jobId);
                    alert('Error: ' + (data.error || 'Unknown error occurred.'));
                }
            })
            .catch(error => {
                btn.disabled = false;
                btn.innerHTML = '<i data-lucide="refresh-cw" id="icon-sync-gmb" style="width: 16px; height: 16px;"></i> Sync GMB Reviews via AI';
                lucide.createIcons();
                showToast("Request Failed", error.message, "error", jobId);
                alert('Request failed: ' + error.message);
            });
        }

        function generateAiBlog() {
            const prompt = document.getElementById('ai_blog_prompt').value.trim();
            const tone = document.getElementById('ai_blog_tone').value;
            const generateImage = document.getElementById('ai_blog_gen_image').checked;

            if (!prompt) {
                alert('Please enter a description or topic for the blog article.');
                return;
            }

            const formWrapper = document.getElementById('ai-blog-form-wrapper');
            const loader = document.getElementById('ai-blog-loader');

            formWrapper.style.display = 'none';
            loader.style.display = 'flex';

            let existingTitle = '';
            let existingSummary = '';
            let existingContent = '';
            const isEditing = document.getElementById('blog-cancel-btn').style.display !== 'none';
            if (isEditing) {
                existingTitle = document.getElementById('blog_title').value.trim();
                existingSummary = document.getElementById('blog_summary').value.trim();
                if (blogEditor) {
                    existingContent = blogEditor.getData().trim();
                } else {
                    existingContent = document.getElementById('blog_content').value.trim();
                }
            }

            // Generate blog text FIRST (without image to keep it fast!)
            fetch("{{ route('admin.ai.blog') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    prompt: prompt,
                    tone: tone,
                    generate_image: false,
                    existing_title: existingTitle,
                    existing_summary: existingSummary,
                    existing_content: existingContent
                })
            })

            .then(res => res.json())
            .then(res => {
                if (res.success && res.data) {
                    const data = res.data;
                    if (data.category) {
                        const catSelect = document.getElementById('blog_category');
                        let exists = Array.from(catSelect.options).some(o => o.value === data.category);
                        if (!exists) {
                            const newOpt = new Option(data.category, data.category, true, true);
                            catSelect.add(newOpt, catSelect.options[1]);
                        }
                        catSelect.value = data.category;
                    } else if (document.getElementById('blog_category').options[1]) {
                        document.getElementById('blog_category').selectedIndex = 1;
                    }
                    document.getElementById('blog_summary').value = data.summary || '';
                    
                    if (blogEditor) {
                        blogEditor.setData(data.content || '');
                    } else {
                        document.getElementById('blog_content').value = data.content || '';
                    }

                    closeAiModal('blog');
                    
                    // Now, if generateImage was checked, kick off background cover image generation!
                    if (generateImage) {
                        const imgPrompt = data.image_prompt || prompt;
                        
                        showToast("Generating Blog Cover", "AI is rendering cover image in the background...", "info", "ai-blog-cover-job");
                        
                        fetch("{{ route('admin.ai.image') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                prompt: imgPrompt,
                                aspect_ratio: "16:9"
                            })
                        })
                        .then(imgRes => imgRes.json())
                        .then(imgRes => {
                            if (imgRes.success && imgRes.url) {
                                document.getElementById('blog_image_url').value = imgRes.url;
                                showToast("Cover Image Attached!", "AI cover image generated and attached to blog form successfully.", "success", "ai-blog-cover-job");
                            } else {
                                showToast("Cover Image Failed", imgRes.error || "Failed to generate cover image. You can upload or paste a link manually.", "error", "ai-blog-cover-job");
                            }
                        })
                        .catch(err => {
                            showToast("Cover Image Failed", "Network error during cover image generation.", "error", "ai-blog-cover-job");
                        });
                    } else {
                        alert('AI generated draft successfully! Please review the form before publishing.');
                    }
                    
                    document.getElementById('blog-form-container').scrollIntoView({ behavior: 'smooth' });
                } else {
                    alert('AI Generation Error: ' + (res.error || 'Failed to generate blog article.'));
                    formWrapper.style.display = 'block';
                    loader.style.display = 'none';
                }
            })
            .catch(err => {
                alert('Network Error: ' + err.message);
                formWrapper.style.display = 'block';
                loader.style.display = 'none';
            });
        }

        function generateAiService() {
            const prompt = document.getElementById('ai_service_prompt').value.trim();
            const tone = document.getElementById('ai_service_tone').value;

            if (!prompt) {
                alert('Please enter a description for the service page.');
                return;
            }

            const formWrapper = document.getElementById('ai-service-form-wrapper');
            const loader = document.getElementById('ai-service-loader');

            formWrapper.style.display = 'none';
            loader.style.display = 'flex';

            let existingName = '';
            let existingHeroTitle = '';
            let existingHeroSub = '';
            let existingIntro = '';
            let existingTips = '';
            let existingSummary = '';
            let existingFaqs = '';

            const isEditing = document.getElementById('service-cancel-btn').style.display !== 'none';
            if (isEditing) {
                existingName = document.getElementById('ser_service_name').value.trim();
                existingHeroTitle = document.getElementById('ser_hero_title').value.trim();
                existingHeroSub = document.getElementById('ser_hero_subtitle').value.trim();
                existingSummary = document.getElementById('ser_summary').value.trim();
                
                if (serviceIntroEditor) {
                    existingIntro = serviceIntroEditor.getData().trim();
                } else {
                    existingIntro = document.getElementById('ser_intro_content').value.trim();
                }
                
                if (serviceTipsEditor) {
                    existingTips = serviceTipsEditor.getData().trim();
                } else {
                    existingTips = document.getElementById('ser_tips_content').value.trim();
                }

                const faqItems = [];
                const questions = document.querySelectorAll('input[name="faq_questions[]"]');
                const answers = document.querySelectorAll('textarea[name="faq_answers[]"]');
                for (let i = 0; i < questions.length; i++) {
                    if (questions[i] && answers[i]) {
                        faqItems.push({
                            question: questions[i].value.trim(),
                            answer: answers[i].value.trim()
                        });
                    }
                }
                existingFaqs = JSON.stringify(faqItems);
            }

            fetch("{{ route('admin.ai.service') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    prompt: prompt,
                    tone: tone,
                    existing_service_name: existingName,
                    existing_hero_title: existingHeroTitle,
                    existing_hero_subtitle: existingHeroSub,
                    existing_intro_content: existingIntro,
                    existing_tips_content: existingTips,
                    existing_summary: existingSummary,
                    existing_faqs: existingFaqs
                })
            })

            .then(res => res.json())
            .then(res => {
                if (res.success && res.data) {
                    const data = res.data;
                    
                    document.getElementById('ser_service_name').value = data.service_name || '';
                    if (data.service_name) {
                        const slug = data.service_name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                        document.getElementById('ser_slug').value = slug;
                    }
                    
                    document.getElementById('ser_badge').value = data.badge || '';
                    document.getElementById('ser_hero_category').value = data.hero_category || '';
                    document.getElementById('ser_hero_title').value = data.hero_title || '';
                    document.getElementById('ser_hero_subtitle').value = data.hero_subtitle || '';
                    
                    document.getElementById('ser_rate_value').value = data.rate_value || '';
                    document.getElementById('ser_max_loan').value = data.max_loan || '';
                    document.getElementById('ser_tenure').value = data.tenure || '';
                    document.getElementById('ser_intro_title').value = data.intro_title || '';
                    
                    if (serviceIntroEditor) {
                        serviceIntroEditor.setData(data.intro_content || '');
                    } else {
                        document.getElementById('ser_intro_content').value = data.intro_content || '';
                    }
                    
                    document.getElementById('ser_eligibility_criteria').value = data.eligibility_criteria || '';
                    document.getElementById('ser_documents_required').value = data.documents_required || '';
                    document.getElementById('ser_tips_title').value = data.tips_title || '';
                    
                    if (serviceTipsEditor) {
                        serviceTipsEditor.setData(data.tips_content || '');
                    } else {
                        document.getElementById('ser_tips_content').value = data.tips_content || '';
                    }
                    
                    document.getElementById('ser_summary').value = data.summary || '';

                    // Clear existing FAQs
                    const faqContainer = document.getElementById('faq-repeater-container');
                    faqContainer.innerHTML = '';

                    // Populate FAQs
                    if (data.faqs && Array.isArray(data.faqs)) {
                        data.faqs.forEach(faq => {
                            addFaqInput(faq.question, faq.answer);
                        });
                    }

                    closeAiModal('service');
                    alert('AI generated service page details successfully! Please review the form before saving.');
                    document.getElementById('service-form-container').scrollIntoView({ behavior: 'smooth' });
                } else {
                    alert('AI Generation Error: ' + (res.error || 'Failed to generate service page.'));
                    formWrapper.style.display = 'block';
                    loader.style.display = 'none';
                }
            })
            .catch(err => {
                alert('Network Error: ' + err.message);
                formWrapper.style.display = 'block';
                loader.style.display = 'none';
            });
        }

        function generateAiImage() {
            const prompt = document.getElementById('ai_image_prompt').value.trim();
            const ratio = document.getElementById('ai_image_aspect_ratio').value;

            if (!prompt) {
                alert('Please describe the image you want to generate.');
                return;
            }

            // Close modal immediately and run in background!
            closeAiModal('image');
            
            const jobId = "ai-image-job-" + Date.now();
            showToast("Generating AI Image", "Gemini is rendering your picture in the background...", "info", jobId);

            fetch("{{ route('admin.ai.image') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    prompt: prompt,
                    aspect_ratio: ratio
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.success && res.url) {
                    const toast = showToast("AI Image Ready!", "Your generated image is ready and saved to the library.", "success", jobId);
                    
                    // Add Copy URL button directly in the background toast success notification!
                    const copyBtn = document.createElement('button');
                    copyBtn.className = 'btn-submit';
                    copyBtn.style = 'margin-top: 8px; font-size: 0.75rem; padding: 4px 8px; width: auto; display: inline-flex; align-items: center; gap: 4px;';
                    copyBtn.innerHTML = '<i data-lucide="copy" style="width: 12px; height: 12px;"></i> Copy URL';
                    const fullUrl = res.url.startsWith('http') || res.url.startsWith('//') || res.url.startsWith('/') 
                        ? res.url 
                        : ("{{ asset('storage') }}/" + res.url);
                    copyBtn.onclick = function() {
                        copyToClipboard(fullUrl, copyBtn);
                    };
                    
                    toast.querySelector('.ai-toast-content').appendChild(copyBtn);
                    lucide.createIcons();
                } else {
                    showToast("AI Generation Failed", res.error || "Failed to generate picture in background.", "error", jobId);
                }
            })
            .catch(err => {
                showToast("AI Generation Failed", "Network error during background image generation.", "error", jobId);
            });
        }
        function generateAiSlider() {
            const prompt = document.getElementById('ai_slider_prompt').value.trim();
            const genImg = document.getElementById('ai_slider_gen_image').checked;

            if (!prompt) {
                alert('Please describe the homepage slide theme or topic.');
                return;
            }

            const modal = document.getElementById('ai-slider-modal');
            const formWrapper = document.getElementById('ai-slider-form-wrapper');
            const loader = document.getElementById('ai-slider-loader');

            formWrapper.style.display = 'none';
            loader.style.display = 'block';

            fetch("{{ route('admin.ai.slider') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    prompt: prompt,
                    generate_image: genImg
                })
            })
            .then(res => res.json())
            .then(res => {
                formWrapper.style.display = 'block';
                loader.style.display = 'none';
                closeAiModal('slider');

                if (res.success && res.data) {
                    const data = res.data;
                    document.getElementById('slide_title').value = data.title || '';
                    document.getElementById('slide_subtitle').value = data.subtitle || '';
                    document.getElementById('slide_btn_text').value = data.button_text || '';
                    document.getElementById('slide_btn_link').value = data.button_link || '';
                    if (data.image_url) {
                        document.getElementById('slide_image_url').value = data.image_url;
                    }
                    
                    showToast('Slide Content Generated!', 'Slide fields have been auto-populated. Please review and click Add Slide.', 'success');
                } else {
                    alert('Error: ' + (res.error || 'Failed to generate slide content.'));
                }
            })
            .catch(err => {
                formWrapper.style.display = 'block';
                loader.style.display = 'none';
                closeAiModal('slider');
                alert('Request failed: ' + err.message);
            });
        }

        // dynamic AI Schema generation helper
        function generateAiSchemaForType(type) {
            let id = null;
            let textarea = null;
            let schemaTypes = [];

            if (type === 'treatment') {
                textarea = document.getElementById('treat_schema_markup');
                const actionUrl = document.getElementById('treatment-form').action;
                const parts = actionUrl.split('/');
                // Action URL is e.g. /admin/treatments/{id}/update
                id = parts[parts.length - 2];
                if (isNaN(parseInt(id))) id = null;
                schemaTypes = ['MedicalCondition', 'MedicalProcedure'];
            } else if (type === 'specialist') {
                textarea = document.getElementById('spec_schema_markup');
                const actionUrl = document.getElementById('specialist-form').action;
                const parts = actionUrl.split('/');
                id = parts[parts.length - 2];
                if (isNaN(parseInt(id))) id = null;
                schemaTypes = ['Physician', 'MedicalBusiness'];
            } else if (type === 'cms_page') {
                textarea = document.getElementById('cms_schema_markup');
                const actionUrl = document.getElementById('cms-form').action;
                const parts = actionUrl.split('/');
                id = parts[parts.length - 2];
                if (isNaN(parseInt(id))) id = null;
                schemaTypes = ['WebPage'];
            }

            if (!textarea) return;

            // Show a simple loading indicator in textarea
            const originalVal = textarea.value;
            textarea.value = 'Generating Schema with Gemini AI... Please wait...';
            textarea.disabled = true;

            fetch('/admin/ai/generate-schema', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    type: type,
                    id: id,
                    schema_types: schemaTypes
                })
            })
            .then(res => res.json())
            .then(res => {
                textarea.disabled = false;
                if (res.success) {
                    textarea.value = res.schema;
                    showToast('AI Schema generated successfully!', 'success');
                } else {
                    textarea.value = originalVal;
                    alert('AI Generation failed: ' + (res.error || 'Unknown error'));
                }
            })
            .catch(err => {
                textarea.disabled = false;
                textarea.value = originalVal;
                alert('Network error generating schema: ' + err.message);
            });
        }
    </script>

    <!-- My Profile Settings Modal -->
    <div class="ai-modal-overlay" id="profile-modal" style="display: none;">
        <div class="ai-modal-card" style="border-color: rgba(92, 203, 179, 0.4); box-shadow: 0 10px 30px rgba(92, 203, 179, 0.15);">
            <button class="ai-modal-close" onclick="closeProfileModal()">&times;</button>
            <h3><i data-lucide="user"></i> My Profile Settings</h3>
            
            <form action="{{ route('admin.profile.update') }}" method="POST" style="margin-top: 1rem;">
                @csrf
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="profile_name">Full Name</label>
                    <input type="text" id="profile_name" name="name" class="form-control" value="{{ Auth::user() ? Auth::user()->name : '' }}" required>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="profile_email">Email Address</label>
                    <input type="email" id="profile_email" name="email" class="form-control" value="{{ Auth::user() ? Auth::user()->email : '' }}" required>
                </div>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="profile_password">New Password (leave blank to keep current)</label>
                    <input type="password" id="profile_password" name="password" class="form-control" placeholder="Minimum 6 characters">
                </div>
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label for="profile_password_confirmation">Confirm New Password</label>
                    <input type="password" id="profile_password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-type password">
                </div>
                
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff;" onclick="closeProfileModal()">Cancel</button>
                    <button type="submit" class="btn-submit" style="background-color: var(--mint-green); color: #0d1718;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    @if($isSuper)
    <!-- Create Admin User Modal -->
    <div class="ai-modal-overlay" id="create-user-modal" style="display: none;">
        <div class="ai-modal-card" style="border-color: rgba(92, 203, 179, 0.4); box-shadow: 0 10px 30px rgba(92, 203, 179, 0.15); max-width: 650px;">
            <button class="ai-modal-close" onclick="closeCreateUserModal()">&times;</button>
            <h3><i data-lucide="user-plus"></i> Create New Admin User</h3>
            
            <form action="{{ route('admin.users.store') }}" method="POST" style="margin-top: 1rem;">
                @csrf
                <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group">
                        <label for="new_user_name">Full Name</label>
                        <input type="text" id="new_user_name" name="name" class="form-control" required placeholder="John Doe">
                    </div>
                    <div class="form-group">
                        <label for="new_user_email">Email Address</label>
                        <input type="email" id="new_user_email" name="email" class="form-control" required placeholder="john@example.com">
                    </div>
                </div>
                
                <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group">
                        <label for="new_user_password">Password</label>
                        <input type="password" id="new_user_password" name="password" class="form-control" required placeholder="Minimum 6 characters">
                    </div>
                    <div class="form-group">
                        <label for="new_user_role">Role</label>
                        <select id="new_user_role" name="role" class="form-control" onchange="togglePermissionsCheckboxGrid('new', this.value)">
                            <option value="admin">Regular Admin</option>
                            <option value="superadmin">Super Admin (All Permissions)</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group" id="new-user-permissions-group" style="margin-bottom: 1.5rem;">
                    <label style="margin-bottom: 0.5rem; display: block;">Module Access Permissions</label>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; max-height: 200px; overflow-y: auto; padding: 10px; border: 1px solid var(--admin-border); border-radius: var(--radius-sm); background: rgba(0,0,0,0.2);">
                        @php
                            $modules = [
                                'general' => 'General Settings',
                                'leads' => 'Leads Manager',
                                'livechat' => 'Live Chat Support',
                                'branding' => 'Branding & Logos',
                                'slider' => 'Homepage Slider',
                                'testimonials' => 'Testimonials',
                                'styling' => 'Section Backgrounds',
                                'pagecontents' => 'Page Editor',
                                'landing' => 'AI Landing Pages',
                                'collections' => 'Collections Manager',
                                'categories' => 'Categories Manager',
                                'marbles' => 'Marbles Manager',
                                'locations' => 'Locations Manager',
                                'specialists' => 'Specialists Manager',
                                'cms_pages' => 'CMS Pages Manager',
                                'blogs' => 'Blog Manager',
                                'media' => 'Media Manager',
                                'seo' => 'SEO Optimizer',
                                'analytics' => 'Analytics Dashboard'
                            ];
                        @endphp
                        @foreach($modules as $key => $label)
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; cursor: pointer; color: white;">
                                <input type="checkbox" name="permissions[]" value="{{ $key }}" class="new-user-perm-cb" checked style="width: 14px; height: 14px; accent-color: var(--mint-green);">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff;" onclick="closeCreateUserModal()">Cancel</button>
                    <button type="submit" class="btn-submit" style="background-color: var(--mint-green); color: #0d1718;">Create User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Admin User Modal -->
    <div class="ai-modal-overlay" id="edit-user-modal" style="display: none;">
        <div class="ai-modal-card" style="border-color: rgba(92, 203, 179, 0.4); box-shadow: 0 10px 30px rgba(92, 203, 179, 0.15); max-width: 650px;">
            <button class="ai-modal-close" onclick="closeEditUserModal()">&times;</button>
            <h3><i data-lucide="edit"></i> Edit Admin User</h3>
            
            <form id="edit-user-form" action="" method="POST" style="margin-top: 1rem;">
                @csrf
                <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group">
                        <label for="edit_user_name">Full Name</label>
                        <input type="text" id="edit_user_name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_user_email">Email Address</label>
                        <input type="email" id="edit_user_email" name="email" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="form-group">
                        <label for="edit_user_password">Password (leave blank to keep current)</label>
                        <input type="password" id="edit_user_password" name="password" class="form-control" placeholder="Minimum 6 characters">
                    </div>
                    <div class="form-group">
                        <label for="edit_user_role">Role</label>
                        <select id="edit_user_role" name="role" class="form-control" onchange="togglePermissionsCheckboxGrid('edit', this.value)">
                            <option value="admin">Regular Admin</option>
                            <option value="superadmin">Super Admin (All Permissions)</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group" id="edit-user-permissions-group" style="margin-bottom: 1.5rem;">
                    <label style="margin-bottom: 0.5rem; display: block;">Module Access Permissions</label>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; max-height: 200px; overflow-y: auto; padding: 10px; border: 1px solid var(--admin-border); border-radius: var(--radius-sm); background: rgba(0,0,0,0.2);">
                        @foreach($modules as $key => $label)
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; cursor: pointer; color: white;">
                                <input type="checkbox" name="permissions[]" value="{{ $key }}" id="edit_perm_{{ $key }}" class="edit-user-perm-cb" style="width: 14px; height: 14px; accent-color: var(--mint-green);">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-submit" style="background-color: var(--admin-input-bg); color: #fff;" onclick="closeEditUserModal()">Cancel</button>
                    <button type="submit" class="btn-submit" style="background-color: var(--mint-green); color: #0d1718;">Update User</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <script>
        function openProfileModal() {
            const modal = document.getElementById('profile-modal');
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('show'), 10);
        }
        function closeProfileModal() {
            const modal = document.getElementById('profile-modal');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
        
        @if($isSuper)
        function openCreateUserModal() {
            const modal = document.getElementById('create-user-modal');
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('show'), 10);
        }
        function closeCreateUserModal() {
            const modal = document.getElementById('create-user-modal');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
        function openEditUserModal(userJson) {
            const user = JSON.parse(userJson);
            document.getElementById('edit-user-form').action = '/admin/users/' + user.id + '/update';
            document.getElementById('edit_user_name').value = user.name;
            document.getElementById('edit_user_email').value = user.email;
            document.getElementById('edit_user_password').value = '';
            document.getElementById('edit_user_role').value = user.role;
            
            // Clear all checkboxes
            const checkboxes = document.querySelectorAll('.edit-user-perm-cb');
            checkboxes.forEach(cb => cb.checked = false);
            
            // Set checkboxes based on user permissions
            let permissions = user.permissions || [];
            if (typeof permissions === 'string') {
                try {
                    permissions = JSON.parse(permissions);
                } catch(e) {
                    permissions = [];
                }
            }
            if (user.role === 'superadmin' || permissions.includes('all')) {
                checkboxes.forEach(cb => cb.checked = true);
            } else {
                permissions.forEach(p => {
                    const cb = document.getElementById('edit_perm_' + p);
                    if (cb) cb.checked = true;
                });
            }
            
            togglePermissionsCheckboxGrid('edit', user.role);

            const modal = document.getElementById('edit-user-modal');
            modal.style.display = 'flex';
            setTimeout(() => modal.classList.add('show'), 10);
        }
        function closeEditUserModal() {
            const modal = document.getElementById('edit-user-modal');
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 300);
        }
        function togglePermissionsCheckboxGrid(prefix, role) {
            const container = document.getElementById(prefix + '-user-permissions-group');
            if (!container) return;
            if (role === 'superadmin') {
                container.style.opacity = '0.5';
                container.style.pointerEvents = 'none';
                const checkboxes = document.querySelectorAll('.' + prefix + '-user-perm-cb');
                checkboxes.forEach(cb => cb.checked = true);
            } else {
                container.style.opacity = '1';
                container.style.pointerEvents = 'auto';
            }
        }
        @endif

        function handleBroadcastTypeChange(type) {
            const types = ['blog', 'service', 'cms_page', 'landing', 'specialist'];
            types.forEach(t => {
                const el = document.getElementById('group-select-' + t);
                if (el) el.style.display = 'none';
            });
            
            document.getElementById('broadcast_title').value = '';
            document.getElementById('broadcast_message').value = '';
            document.getElementById('broadcast_url').value = '';
            
            if (type !== 'custom') {
                const group = document.getElementById('group-select-' + type);
                if (group) {
                    group.style.display = 'block';
                    document.getElementById('select_' + type).value = '';
                }
            }
            updateLivePreview();
        }

        function autoFillFromEntity(type, id) {
            if (!id) {
                document.getElementById('broadcast_title').value = '';
                document.getElementById('broadcast_message').value = '';
                document.getElementById('broadcast_url').value = '';
                updateLivePreview();
                return;
            }
            const select = document.getElementById('select_' + type);
            const option = select.options[select.selectedIndex];
            
            const title = option.getAttribute('data-title') || '';
            const summary = option.getAttribute('data-summary') || '';
            const url = option.getAttribute('data-url') || '';
            
            document.getElementById('broadcast_title').value = title;
            document.getElementById('broadcast_message').value = summary;
            document.getElementById('broadcast_url').value = url;
            
            updateLivePreview();
        }

        function updateLivePreview() {
            const title = document.getElementById('broadcast_title').value || 'Stone Hub India';
            const message = document.getElementById('broadcast_message').value || 'Waiting for input details...';
            const url = document.getElementById('broadcast_url').value || 'https://www.stonehubindia.com';
            
            if (document.getElementById('preview-title')) document.getElementById('preview-title').textContent = title;
            if (document.getElementById('preview-message')) document.getElementById('preview-message').textContent = message;
            if (document.getElementById('preview-url')) document.getElementById('preview-url').textContent = url;
        }

        function updateYtPreview(index, url) {
            url = (url || '').trim();
            let ytId = null;
            let match = url.match(/(?:youtube(?:-nocookie)?\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=|shorts\/|live\/)|youtu\.be\/)([^"&?\/\s]{11})/i);
            if (match && match[1]) {
                ytId = match[1];
            } else if (url.length === 11 && /^[a-zA-Z0-9_-]{11}$/.test(url)) {
                ytId = url;
            }
            
            const thumbImg = document.getElementById('yt_thumb_preview_' + index);
            const linkPreview = document.getElementById('yt_link_preview_' + index);
            const thumbInput = document.getElementById('thumb_input_' + index);
            
            if (linkPreview) {
                linkPreview.href = url || '#';
            }
            
            if (thumbImg) {
                if (thumbInput && thumbInput.value.trim() !== '') {
                    thumbImg.src = thumbInput.value.trim();
                } else if (ytId) {
                    thumbImg.src = 'https://img.youtube.com/vi/' + ytId + '/hqdefault.jpg';
                }
            }
        }

        function getInstagramReelCode(url) {
            if (!url) return null;
            url = url.trim();
            if (/^[a-zA-Z0-9_-]{9,15}$/.test(url)) return url;
            const match = url.match(/(?:instagram\.com|instagr\.am)\/(?:reel|reels|p|tv)\/([a-zA-Z0-9_-]+)/i);
            return match ? match[1] : null;
        }

        function updateReelPreview(index, url) {
            url = (url || '').trim();
            const linkPreview = document.getElementById('reel_link_preview_' + index);
            const thumbImg = document.getElementById('reel_thumb_preview_' + index);
            const thumbInput = document.getElementById('reel_thumb_input_' + index);
            
            if (linkPreview) {
                linkPreview.href = url || '#';
            }

            if (thumbImg) {
                const customThumb = thumbInput ? thumbInput.value.trim() : '';
                if (customThumb !== '') {
                    thumbImg.src = (customThumb.startsWith('http') || customThumb.startsWith('/') || customThumb.startsWith('uploads/')) ? customThumb : ('/' + customThumb);
                } else {
                    const igCode = getInstagramReelCode(url);
                    if (igCode) {
                        thumbImg.src = 'https://www.instagram.com/p/' + igCode + '/media/?size=l';
                    }
                }
            }
        }

        function updateReelThumbPreview(index, val) {
            val = (val || '').trim();
            const thumbImg = document.getElementById('reel_thumb_preview_' + index);
            const linkInput = document.getElementById('reel_input_' + index);

            if (thumbImg) {
                if (val !== '') {
                    thumbImg.src = (val.startsWith('http') || val.startsWith('/') || val.startsWith('uploads/')) ? val : ('/' + val);
                } else {
                    // Revert to auto Instagram thumbnail if link exists
                    const igUrl = linkInput ? linkInput.value.trim() : '';
                    const igCode = getInstagramReelCode(igUrl);
                    if (igCode) {
                        thumbImg.src = 'https://www.instagram.com/p/' + igCode + '/media/?size=l';
                    }
                }
            }
        }

        // ==================== SEO FILES GENERATOR (Sitemap, Robots, LLMO) ====================
        function getSeoRootUrl() {
            const input = document.getElementById('seo_root_url');
            if (!input) return window.location.origin;
            let val = input.value.trim();
            if (!val) {
                val = window.location.origin;
                input.value = val;
            }
            if (!val.startsWith('http://') && !val.startsWith('https://')) {
                val = 'https://' + val;
                input.value = val;
            }
            // Remove trailing slash
            val = val.replace(/\/+$/, '');
            input.value = val;
            return val;
        }

        function getCsrfHeader() {
            const meta = document.querySelector('meta[name="csrf-token"]');
            return meta ? meta.getAttribute('content') : '';
        }

        async function regenerateAllSeoFiles() {
            const btn = document.getElementById('btn-regen-all');
            const originalHtml = btn ? btn.innerHTML : '';
            const rootUrl = getSeoRootUrl();

            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i data-lucide="loader-2" class="spin" style="width:16px;height:16px;animation:spin 1s linear infinite;"></i> Generating 4 Files...';
                if (window.lucide) lucide.createIcons();
            }

            try {
                const res = await fetch('/admin/seo/regenerate-all', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfHeader(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ root_url: rootUrl })
                });

                const data = await res.json();

                if (res.ok && data.status === 'success') {
                    // Update Sitemap Card
                    if (data.sitemap) {
                        const smBadge = document.getElementById('sitemap-status-badge');
                        const smTime = document.getElementById('sitemap-time');
                        if (smBadge) smBadge.textContent = data.sitemap.size;
                        if (smTime) smTime.textContent = data.sitemap.last_generated;
                    }

                    // Update Robots Card
                    if (data.robots) {
                        const rbBadge = document.getElementById('robots-status-badge');
                        const rbTime = document.getElementById('robots-time');
                        if (rbBadge) rbBadge.textContent = data.robots.size;
                        if (rbTime) rbTime.textContent = data.robots.last_generated;
                    }

                    // Update LLMS Card
                    if (data.llms) {
                        const llBadge = document.getElementById('llms-status-badge');
                        const llTime = document.getElementById('llms-time');
                        if (llBadge) llBadge.textContent = data.llms.size;
                        if (llTime) llTime.textContent = data.llms.last_generated;
                    }

                    // Display Preview Box
                    const previewWrap = document.getElementById('seo-file-preview-wrap');
                    const previewTitle = document.getElementById('seo-preview-filename');
                    const previewContent = document.getElementById('seo-preview-content');

                    if (previewWrap && previewTitle && previewContent) {
                        previewTitle.textContent = `All SEO Files Generated Successfully (${rootUrl})`;
                        previewContent.textContent = `=== sitemap.xml Preview (${data.sitemap.url_count} URLs) ===\n` + 
                            (data.sitemap.preview || '') + 
                            `\n\n=== robots.txt Preview ===\n` + 
                            (data.robots.preview || '') + 
                            `\n\n=== llms.txt Preview ===\n` + 
                            (data.llms.preview || '');
                        previewWrap.style.display = 'block';
                    }

                    alert(`Successfully regenerated Sitemap (${data.sitemap.url_count} URLs), Robots.txt, and LLMO (llms.txt & llms-full.txt) using root URL: ${rootUrl}`);
                } else {
                    alert('Failed to regenerate SEO files: ' + (data.message || 'Unknown error'));
                }
            } catch (err) {
                alert('Network or server error regenerating SEO files: ' + err.message);
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                    if (window.lucide) lucide.createIcons();
                }
            }
        }

        async function regenerateSpecificSeoFile(type) {
            const btn = document.getElementById('btn-regen-' + type);
            const originalHtml = btn ? btn.innerHTML : '';
            const rootUrl = getSeoRootUrl();

            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i data-lucide="loader-2" style="width:13px;height:13px;animation:spin 1s linear infinite;"></i> Generating...';
                if (window.lucide) lucide.createIcons();
            }

            try {
                const res = await fetch('/admin/seo/regenerate-' + type, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfHeader(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ root_url: rootUrl })
                });

                const data = await res.json();

                if (res.ok && data.status === 'success') {
                    // Update badge and timestamp
                    const badge = document.getElementById(type + '-status-badge');
                    const time = document.getElementById(type + '-time');
                    if (badge && data.size) badge.textContent = data.size;
                    if (time && data.last_generated) time.textContent = data.last_generated;

                    // Display Preview Box
                    const previewWrap = document.getElementById('seo-file-preview-wrap');
                    const previewTitle = document.getElementById('seo-preview-filename');
                    const previewContent = document.getElementById('seo-preview-content');

                    if (previewWrap && previewTitle && previewContent) {
                        previewTitle.textContent = `${data.file || type} Preview (Root URL: ${rootUrl})`;
                        previewContent.textContent = data.preview || 'File updated successfully.';
                        previewWrap.style.display = 'block';
                    }

                    alert(`Successfully updated ${data.file || type} using root URL: ${rootUrl}`);
                } else {
                    alert('Error regenerating ' + type + ': ' + (data.message || 'Unknown error'));
                }
            } catch (err) {
                alert('Network or server error: ' + err.message);
            } finally {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                    if (window.lucide) lucide.createIcons();
                }
            }
        }

        // ==========================================
        // DYNAMIC CATEGORY MANAGEMENT JAVASCRIPT
        // ==========================================
        let currentQuickCategoryTargetId = 'blog_category';

        function autoGenerateCategorySlug(val) {
            const slugInput = document.getElementById('category_slug');
            if (slugInput && !slugInput.dataset.manual) {
                slugInput.value = val.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            }
        }

        function editCategory(id) {
            document.getElementById('category-form-title-text').innerText = 'Loading Category...';
            fetch('/admin/categories/' + id + '/detail')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('category-form-title-text').innerText = 'Edit Category: ' + data.name;
                    document.getElementById('category-form').action = '/admin/categories/' + data.id + '/update';
                    document.getElementById('category-form-method').value = 'POST';
                    document.getElementById('category_name').value = data.name;
                    document.getElementById('category_slug').value = data.slug;
                    document.getElementById('category_type').value = data.type || 'service';
                    document.getElementById('category_sort_order').value = data.sort_order || 0;
                    document.getElementById('category_description').value = data.description || '';
                    document.getElementById('category_status').checked = !!data.status;
                    document.getElementById('category-submit-btn').innerText = 'Update Category';
                    document.getElementById('category-cancel-btn').style.display = 'inline-block';
                    document.getElementById('category-form-container').scrollIntoView({ behavior: 'smooth' });
                })
                .catch(err => {
                    console.error('Error fetching category:', err);
                    alert('Failed to load category details.');
                    cancelCategoryEdit();
                });
        }

        function cancelCategoryEdit() {
            document.getElementById('category-form-title-text').innerText = 'Create New Category';
            document.getElementById('category-form').action = "{{ route('admin.categories.store') }}";
            document.getElementById('category-form-method').value = 'POST';
            document.getElementById('category_name').value = '';
            document.getElementById('category_slug').value = '';
            document.getElementById('category_type').value = 'service';
            document.getElementById('category_sort_order').value = '0';
            document.getElementById('category_description').value = '';
            document.getElementById('category_status').checked = true;
            document.getElementById('category-submit-btn').innerText = 'Save Category';
            document.getElementById('category-cancel-btn').style.display = 'none';
        }

        function openAddCategoryModal(targetSelectId = 'blog_category') {
            currentQuickCategoryTargetId = targetSelectId;
            const targetInput = document.getElementById('quick_cat_target_dropdown');
            if (targetInput) targetInput.value = targetSelectId;
            const nameInput = document.getElementById('quick_cat_name');
            const descInput = document.getElementById('quick_cat_desc');
            if (nameInput) nameInput.value = '';
            if (descInput) descInput.value = '';
            const modal = document.getElementById('add-category-modal');
            if (modal) {
                modal.style.display = 'flex';
                setTimeout(() => modal.classList.add('show'), 10);
                setTimeout(() => { if (nameInput) nameInput.focus(); }, 100);
            }
        }

        function closeAddCategoryModal() {
            const modal = document.getElementById('add-category-modal');
            if (modal) {
                modal.classList.remove('show');
                setTimeout(() => modal.style.display = 'none', 200);
            }
        }

        function handleCategoryDropdownChange(selectElem) {
            if (selectElem.value === '__add_new_category__') {
                selectElem.value = '';
                openAddCategoryModal(selectElem.id);
            }
        }

        function submitQuickAddCategory(e) {
            e.preventDefault();
            const nameInput = document.getElementById('quick_cat_name');
            const descInput = document.getElementById('quick_cat_desc');
            const submitBtn = document.getElementById('quick_cat_submit_btn');
            const name = nameInput.value.trim();
            if (!name) return;

            submitBtn.disabled = true;
            submitBtn.innerText = 'Saving...';

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch("{{ route('admin.categories.quick') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    description: descInput.value.trim()
                })
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Save Category';
                if (data.success) {
                    closeAddCategoryModal();
                    refreshCategoryDropdowns(data.categories, data.category.name, currentQuickCategoryTargetId);
                    if (typeof showToast === 'function') {
                        showToast('Category Added', `"${data.category.name}" has been created and selected.`, 'success');
                    } else {
                        alert(`Category "${data.category.name}" added successfully!`);
                    }
                } else {
                    alert(data.message || 'Failed to add category.');
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Save Category';
                console.error('Error adding category:', err);
                alert('An error occurred while creating category.');
            });
        }

        function refreshCategoryDropdowns(categoriesList, selectedName = null, targetSelectId = null) {
            const dropdowns = document.querySelectorAll('.category-dropdown-select');
            dropdowns.forEach(select => {
                const curVal = select.value;
                select.innerHTML = '<option value="">-- Select Category --</option>';
                categoriesList.forEach(cat => {
                    const opt = document.createElement('option');
                    opt.value = cat.name;
                    opt.textContent = cat.name;
                    select.appendChild(opt);
                });
                const addOpt = document.createElement('option');
                addOpt.value = '__add_new_category__';
                addOpt.textContent = '+ Add New Category...';
                addOpt.style.color = '#5ccbb3';
                addOpt.style.fontWeight = '600';
                select.appendChild(addOpt);

                if (select.id === targetSelectId && selectedName) {
                    select.value = selectedName;
                } else if (curVal) {
                    select.value = curVal;
                }
            });
        }

        // Ensure mouse wheel over header forwards scroll to content
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('.admin-header');
            const content = document.querySelector('.admin-content');
            if (header && content) {
                header.addEventListener('wheel', function(e) {
                    content.scrollTop += e.deltaY;
                }, { passive: true });
            }
        });
    </script>


<!-- 1. Menu Item Edit Modal -->
<div class="ai-modal-overlay" id="menuEditModal" style="display:none; z-index:999999;">
    <div class="ai-modal-card" style="max-width:560px; background:#121826; border:1px solid #2d3748; box-shadow:0 25px 50px -12px rgba(0,0,0,0.8);">
        <button type="button" class="ai-modal-close" onclick="closeMenuEditModal()">&times;</button>
        <h3 style="color:#fff; margin-top:0; display:flex; align-items:center; gap:8px;">
            <i data-lucide="edit-3" style="color:var(--mint-green, #5ccbb3);"></i> Edit Navigation Item
        </h3>
        <p style="font-size:0.85rem; color:var(--admin-text-muted); margin-bottom:1.25rem;">
            Update title, destination URL, sorting, or column categorization.
        </p>
        <form id="menuEditForm" method="POST">
            @csrf
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Menu Label / Title <span style="color:#ef4444;">*</span></label>
                <input type="text" id="edit_menu_title" name="title" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Destination URL <span style="color:#ef4444;">*</span></label>
                <input type="text" id="edit_menu_url" name="url" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom:1rem; display:none;" id="edit_menu_cat_div">
                <label style="color:#fff; font-weight:600;">Column Category (For Mega Menu)</label>
                <input type="text" id="edit_menu_category_group" name="category_group" class="form-control" placeholder="e.g. 01 DIGITAL MARKETING">
            </div>
            <div class="form-group" style="margin-bottom:1rem; display:none;" id="edit_menu_desc_div">
                <label style="color:#fff; font-weight:600;">Description / Subtitle</label>
                <input type="text" id="edit_menu_desc" name="description" class="form-control" placeholder="e.g. Earn a stronger place in search.">
            </div>
            <div class="form-group" style="margin-bottom:1rem; display:none;" id="edit_menu_icon_div">
                <label style="color:#fff; font-weight:600;">Service Dropdown Icon</label>
                <select id="edit_menu_icon" name="icon" class="form-control" style="background:#0b1120; color:#fff; border:1px solid #334155;">
                    <option value="">-- Select Icon --</option>
                    <option value="search">Search Glass (SEO)</option>
                    <option value="camera">Instagram Camera (Social Media Marketing)</option>
                    <option value="trending-up">Trending Up Arrow (Lead Generation)</option>
                    <option value="download">Inbound Arrow / Tray (Inbound Marketing)</option>
                    <option value="layout">Layout / Browser Window (Digital Media Planning)</option>
                    <option value="file-text">Document / Text File (Content Marketing)</option>
                    <option value="video">Video Camera (Video Marketing)</option>
                    <option value="users">Users / Group (Influencer Marketing)</option>
                    <option value="star">Star Badge (Online Reputation Management)</option>
                    <option value="bar-chart-2">Bar Chart (Social Media Analytics)</option>
                    <option value="monitor">Monitor Screen (Website Design &amp; Development)</option>
                    <option value="smartphone">Smartphone Device (Mobile Application Development)</option>
                    <option value="cpu">Automation Sun / Gear (Marketing Automation)</option>
                    <option value="smile">Smiley Face (Sentiment Analysis)</option>
                    <option value="cloud">Cloud (DevOps Services)</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Sort Order</label>
                <input type="number" id="edit_menu_sort" name="sort_order" class="form-control">
            </div>
            <div style="margin-bottom:1.5rem;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; color:#fff;">
                    <input type="checkbox" id="edit_menu_active" name="is_active" value="1" style="width:18px; height:18px;">
                    Active on Frontend
                </label>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn-submit" style="background:#272732; color:#fff;" onclick="closeMenuEditModal()">Cancel</button>
                <button type="submit" class="btn-submit" style="background:var(--mint-green, #5ccbb3); color:#071526; font-weight:700;">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. Hero Slide Edit Modal -->
<div class="ai-modal-overlay" id="slideEditModal" style="display:none; z-index:999999;">
    <div class="ai-modal-card" style="max-width:580px; background:#121826; border:1px solid #2d3748; box-shadow:0 25px 50px -12px rgba(0,0,0,0.8);">
        <button type="button" class="ai-modal-close" onclick="closeSlideEditModal()">&times;</button>
        <h3 style="color:#fff; margin-top:0; display:flex; align-items:center; gap:8px;">
            <i data-lucide="sparkles" style="color:var(--mint-green, #5ccbb3);"></i> Edit Hero Slide
        </h3>
        <p style="font-size:0.85rem; color:var(--admin-text-muted); margin-bottom:1.25rem;">
            Edit headline, subtitle, action buttons, and background graphic for this hero slide.
        </p>
        <form id="slideEditForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Slide Main Title <span style="color:#ef4444;">*</span></label>
                <input type="text" id="edit_slide_title" name="title" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Slide Subtitle</label>
                <input type="text" id="edit_slide_subtitle" name="subtitle" class="form-control">
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:1rem;">
                <div class="form-group">
                    <label style="color:#fff; font-weight:600;">Button Text</label>
                    <input type="text" id="edit_slide_btn_text" name="button_text" class="form-control" placeholder="e.g. Explore Services">
                </div>
                <div class="form-group">
                    <label style="color:#fff; font-weight:600;">Button Link</label>
                    <input type="text" id="edit_slide_btn_link" name="button_link" class="form-control" placeholder="e.g. /services">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Slide Background Image (Upload File)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <div style="margin-top:6px;">
                    <label style="font-size:0.8rem; color:var(--admin-text-muted);">Or Paste Image Path / URL</label>
                    <input type="text" id="edit_slide_image_url" name="image_url" class="form-control" placeholder="assets/slider/banner.jpg">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:1.5rem;">
                <label style="color:#fff; font-weight:600;">Sort Order</label>
                <input type="number" id="edit_slide_sort" name="sort_order" class="form-control" value="0">
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn-submit" style="background:#272732; color:#fff;" onclick="closeSlideEditModal()">Cancel</button>
                <button type="submit" class="btn-submit" style="background:var(--mint-green, #5ccbb3); color:#071526; font-weight:700;">Update Slide</button>
            </div>
        </form>
    </div>
</div>

<!-- 3. Client & Partner Logo Edit Modal -->
<div class="ai-modal-overlay" id="partnerEditModal" style="display:none; z-index:999999;">
    <div class="ai-modal-card" style="max-width:540px; background:#121826; border:1px solid #2d3748; box-shadow:0 25px 50px -12px rgba(0,0,0,0.8);">
        <button type="button" class="ai-modal-close" onclick="closePartnerEditModal()">&times;</button>
        <h3 style="color:#fff; margin-top:0; display:flex; align-items:center; gap:8px;">
            <i data-lucide="layout-grid" style="color:var(--mint-green, #5ccbb3);"></i> Edit Client &amp; Partner Brand Logo
        </h3>
        <p style="font-size:0.85rem; color:var(--admin-text-muted); margin-bottom:1.25rem;">
            Update brand name, ticker graphic, website URL, and position.
        </p>
        <form id="partnerEditForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Brand / Client Name <span style="color:#ef4444;">*</span></label>
                <input type="text" id="edit_partner_name" name="name" class="form-control" required>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Website Link</label>
                <input type="text" id="edit_partner_website" name="website_url" class="form-control" placeholder="https://example.com">
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Brand Logo (Upload File)</label>
                <input type="file" name="logo" class="form-control" accept="image/*">
                <div style="margin-top:6px;">
                    <label style="font-size:0.8rem; color:var(--admin-text-muted);">Or Paste Logo Path / URL</label>
                    <input type="text" id="edit_partner_logo_url" name="logo_url" class="form-control" placeholder="assets/clients/logo.png">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Sort Order</label>
                <input type="number" id="edit_partner_sort" name="sort_order" class="form-control" value="0">
            </div>
            <div style="margin-bottom:1.5rem;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; color:#fff;">
                    <input type="checkbox" id="edit_partner_active" name="is_active" value="1" style="width:18px; height:18px;">
                    Active in Marquee Ticker
                </label>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn-submit" style="background:#272732; color:#fff;" onclick="closePartnerEditModal()">Cancel</button>
                <button type="submit" class="btn-submit" style="background:var(--mint-green, #5ccbb3); color:#071526; font-weight:700;">Update Brand Logo</button>
            </div>
        </form>
    </div>
</div>

<!-- 4. Testimonial Edit Modal -->
<div class="ai-modal-overlay" id="testimonialEditModal" style="display:none; z-index:999999;">
    <div class="ai-modal-card" style="max-width:580px; background:#121826; border:1px solid #2d3748; box-shadow:0 25px 50px -12px rgba(0,0,0,0.8);">
        <button type="button" class="ai-modal-close" onclick="closeTestimonialEditModal()">&times;</button>
        <h3 style="color:#fff; margin-top:0; display:flex; align-items:center; gap:8px;">
            <i data-lucide="message-square-quote" style="color:var(--mint-green, #5ccbb3);"></i> Edit Customer Testimonial
        </h3>
        <p style="font-size:0.85rem; color:var(--admin-text-muted); margin-bottom:1.25rem;">
            Update client feedback, rating, role/company, and client photo.
        </p>
        <form id="testimonialEditForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:1rem;">
                <div class="form-group">
                    <label style="color:#fff; font-weight:600;">Client Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" id="edit_test_name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label style="color:#fff; font-weight:600;">Client Role / Company</label>
                    <input type="text" id="edit_test_role" name="role" class="form-control" placeholder="e.g. CMO, FinEdge">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Star Rating <span style="color:#ef4444;">*</span></label>
                <select id="edit_test_rating" name="rating" class="form-control" required>
                    <option value="5">★★★★★ (5 Stars - Outstanding)</option>
                    <option value="4">★★★★☆ (4 Stars - Very Good)</option>
                    <option value="3">★★★☆☆ (3 Stars - Average)</option>
                    <option value="2">★★☆☆☆ (2 Stars - Poor)</option>
                    <option value="1">★☆☆☆☆ (1 Star - Terrible)</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Review Content <span style="color:#ef4444;">*</span></label>
                <textarea id="edit_test_content" name="content" rows="4" class="form-control" required></textarea>
            </div>
            <div class="form-group" style="margin-bottom:1rem;">
                <label style="color:#fff; font-weight:600;">Client Avatar (Upload File)</label>
                <input type="file" name="avatar" class="form-control" accept="image/*">
                <div style="margin-top:6px;">
                    <label style="font-size:0.8rem; color:var(--admin-text-muted);">Or Paste Avatar Path / URL</label>
                    <input type="text" id="edit_test_avatar_url" name="avatar_url" class="form-control" placeholder="assets/testimonials/avatar.png">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:1.5rem;">
                <label style="color:#fff; font-weight:600;">Sort Order</label>
                <input type="number" id="edit_test_sort" name="sort_order" class="form-control" value="0">
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn-submit" style="background:#272732; color:#fff;" onclick="closeTestimonialEditModal()">Cancel</button>
                <button type="submit" class="btn-submit" style="background:var(--mint-green, #5ccbb3); color:#071526; font-weight:700;">Update Testimonial</button>
            </div>
        </form>
    </div>
</div>

<script>
/* 1. Menu Items Edit Logic */
function openMenuEditModal(target, title, url, type, cat, desc, sort, active, icon) {
    var id, mTitle, mUrl, mType, mCat, mDesc, mSort, mActive, mIcon;
    if (typeof target === 'object' && target !== null && target.dataset) {
        id = target.dataset.id;
        mTitle = target.dataset.title;
        mUrl = target.dataset.url;
        mType = target.dataset.type;
        mCat = target.dataset.category;
        mDesc = target.dataset.description;
        mSort = target.dataset.sort;
        mActive = target.dataset.active == '1';
        mIcon = target.dataset.icon;
    } else {
        id = target;
        mTitle = title;
        mUrl = url;
        mType = type;
        mCat = cat;
        mDesc = desc;
        mSort = sort;
        mActive = !!active;
        mIcon = icon;
    }

    var modal = document.getElementById('menuEditModal');
    var form = document.getElementById('menuEditForm');
    form.action = '/admin/menu-items/' + id + '/update';
    document.getElementById('edit_menu_title').value = mTitle || '';
    document.getElementById('edit_menu_url').value = mUrl || '';
    document.getElementById('edit_menu_category_group').value = mCat || '';
    document.getElementById('edit_menu_desc').value = mDesc || '';
    var elIcon = document.getElementById('edit_menu_icon');
    if (elIcon) elIcon.value = mIcon || '';
    document.getElementById('edit_menu_sort').value = mSort || 0;
    document.getElementById('edit_menu_active').checked = mActive;

    var catDiv = document.getElementById('edit_menu_cat_div');
    var descDiv = document.getElementById('edit_menu_desc_div');
    var iconDiv = document.getElementById('edit_menu_icon_div');
    if (mType === 'mega_services') {
        if (catDiv) catDiv.style.display = 'block';
        if (descDiv) descDiv.style.display = 'block';
        if (iconDiv) iconDiv.style.display = 'block';
    } else if (mType === 'portfolio_menu') {
        if (catDiv) catDiv.style.display = 'none';
        if (descDiv) descDiv.style.display = 'block';
        if (iconDiv) iconDiv.style.display = 'none';
    } else {
        if (catDiv) catDiv.style.display = 'none';
        if (descDiv) descDiv.style.display = 'none';
        if (iconDiv) iconDiv.style.display = 'none';
    }

    modal.style.display = 'flex';
    modal.classList.add('show');
    if (window.lucide) { lucide.createIcons(); }
}

function closeMenuEditModal() {
    var modal = document.getElementById('menuEditModal');
    modal.classList.remove('show');
    setTimeout(function() { modal.style.display = 'none'; }, 200);
}

function toggleMegaFields(val) {
    var catField = document.getElementById('group_cat_field');
    var descField = document.getElementById('group_desc_field');
    var iconField = document.getElementById('group_icon_field');
    if (val === 'mega_services') {
        if (catField) catField.style.display = 'block';
        if (descField) descField.style.display = 'block';
        if (iconField) iconField.style.display = 'block';
    } else if (val === 'portfolio_menu') {
        if (catField) catField.style.display = 'none';
        if (descField) descField.style.display = 'block';
        if (iconField) iconField.style.display = 'none';
    } else {
        if (catField) catField.style.display = 'none';
        if (descField) descField.style.display = 'none';
        if (iconField) iconField.style.display = 'none';
    }
}

/* 2. Hero Slide Edit Logic */
function openSlideEditModal(target) {
    var id = target.dataset.id;
    var title = target.dataset.title;
    var subtitle = target.dataset.subtitle;
    var btnText = target.dataset.button_text;
    var btnLink = target.dataset.button_link;
    var sort = target.dataset.sort;
    var img = target.dataset.image;

    var modal = document.getElementById('slideEditModal');
    var form = document.getElementById('slideEditForm');
    form.action = '/admin/slides/' + id + '/update';
    document.getElementById('edit_slide_title').value = title || '';
    document.getElementById('edit_slide_subtitle').value = subtitle || '';
    document.getElementById('edit_slide_btn_text').value = btnText || '';
    document.getElementById('edit_slide_btn_link').value = btnLink || '';
    document.getElementById('edit_slide_image_url').value = img || '';
    document.getElementById('edit_slide_sort').value = sort || 0;

    modal.style.display = 'flex';
    modal.classList.add('show');
    if (window.lucide) { lucide.createIcons(); }
}

function closeSlideEditModal() {
    var modal = document.getElementById('slideEditModal');
    modal.classList.remove('show');
    setTimeout(function() { modal.style.display = 'none'; }, 200);
}

/* 3. Partner / Client Logo Edit Logic */
function openPartnerEditModal(target) {
    var id = target.dataset.id;
    var name = target.dataset.name;
    var logo = target.dataset.logo;
    var website = target.dataset.website;
    var sort = target.dataset.sort;
    var active = target.dataset.active == '1';

    var modal = document.getElementById('partnerEditModal');
    var form = document.getElementById('partnerEditForm');
    form.action = '/admin/partners/' + id + '/update';
    document.getElementById('edit_partner_name').value = name || '';
    document.getElementById('edit_partner_website').value = (website && website !== 'None') ? website : '';
    document.getElementById('edit_partner_logo_url').value = logo || '';
    document.getElementById('edit_partner_sort').value = sort || 0;
    document.getElementById('edit_partner_active').checked = active;

    modal.style.display = 'flex';
    modal.classList.add('show');
    if (window.lucide) { lucide.createIcons(); }
}

function closePartnerEditModal() {
    var modal = document.getElementById('partnerEditModal');
    modal.classList.remove('show');
    setTimeout(function() { modal.style.display = 'none'; }, 200);
}

/* 4. Testimonial Edit Logic */
function openTestimonialEditModal(target) {
    var id = target.dataset.id;
    var name = target.dataset.name;
    var role = target.dataset.role;
    var rating = target.dataset.rating;
    var content = target.dataset.content;
    var sort = target.dataset.sort;
    var avatar = target.dataset.avatar;

    var modal = document.getElementById('testimonialEditModal');
    var form = document.getElementById('testimonialEditForm');
    form.action = '/admin/testimonials/' + id + '/update';
    document.getElementById('edit_test_name').value = name || '';
    document.getElementById('edit_test_role').value = role || '';
    document.getElementById('edit_test_rating').value = rating || 5;
    document.getElementById('edit_test_content').value = content || '';
    document.getElementById('edit_test_avatar_url').value = avatar || '';
    document.getElementById('edit_test_sort').value = sort || 0;

    modal.style.display = 'flex';
    modal.classList.add('show');
    if (window.lucide) { lucide.createIcons(); }
}

function closeTestimonialEditModal() {
    var modal = document.getElementById('testimonialEditModal');
    modal.classList.remove('show');
    setTimeout(function() { modal.style.display = 'none'; }, 200);
}

/* Global backdrop click closer & delegation for all edit modals */
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList && e.target.classList.contains('ai-modal-overlay')) {
        e.target.classList.remove('show');
        setTimeout(function() { e.target.style.display = 'none'; }, 200);
        return;
    }

    var menuBtn = e.target.closest ? e.target.closest('.edit-menu-btn') : null;
    if (menuBtn) {
        window.openMenuEditModal(menuBtn);
        return;
    }
    var slideBtn = e.target.closest ? e.target.closest('.edit-slide-btn') : null;
    if (slideBtn) {
        window.openSlideEditModal(slideBtn);
        return;
    }
    var partnerBtn = e.target.closest ? e.target.closest('.edit-partner-btn') : null;
    if (partnerBtn) {
        window.openPartnerEditModal(partnerBtn);
        return;
    }
    var testBtn = e.target.closest ? e.target.closest('.edit-testimonial-btn') : null;
    if (testBtn) {
        window.openTestimonialEditModal(testBtn);
        return;
    }
});

/* Escape key closer for all modals */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.ai-modal-overlay.show').forEach(function(m) {
            m.classList.remove('show');
            setTimeout(function() { m.style.display = 'none'; }, 200);
        });
    }
});
</script>
</body>
</html>

