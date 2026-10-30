<?php
/**
 * Automated Deployment Script for Stone Hub India
 * 
 * Can be executed via:
 * 1. CLI: php deploy.php
 * 2. Web Browser / Webhook: https://yourdomain.com/deploy.php
 */

// Set time limit and memory
@set_time_limit(600);
@ini_set('memory_limit', '512M');

// Security Token (Optional: pass ?key=stonehub2026 or set custom token in environment)
$secretKey = getenv('DEPLOY_KEY') ?: 'stonehub2026';
$providedKey = $_GET['key'] ?? ($_POST['key'] ?? '');

$isCli = (php_sapi_name() === 'cli');

// If accessed via web without valid key and key is enforced, allow manual trigger button with key input
$requiresAuth = false; // Set to true if you want to strictly require ?key=...

// Determine project root directory
$projectRoot = __DIR__;
if (basename($projectRoot) === 'public') {
    $projectRoot = dirname($projectRoot);
}

// Ensure execution directory is project root
chdir($projectRoot);

// Determine current git branch
$currentBranch = trim((string)@shell_exec('git rev-parse --abbrev-ref HEAD 2>/dev/null'));
if (empty($currentBranch)) {
    $currentBranch = 'main';
}

$branch = $_GET['branch'] ?? ($_POST['branch'] ?? $currentBranch);

// Deployment execution logic
function runDeployment($projectRoot, $branch) {
    $output = [];
    $timestamp = date('Y-m-d H:i:s T');
    $output[] = "========================================================";
    $output[] = "  STONE HUB INDIA - DEPLOYMENT PIPELINE";
    $output[] = "  Timestamp : {$timestamp}";
    $output[] = "  Directory : {$projectRoot}";
    $output[] = "  Branch    : {$branch}";
    $output[] = "========================================================\n";

    // Required upload directories
    $uploadDirs = [
        $projectRoot . '/public/uploads/hero',
        $projectRoot . '/public/uploads/collection',
        $projectRoot . '/public/uploads/treatments',
        $projectRoot . '/public/uploads/blogs',
        $projectRoot . '/public/uploads/product',
        $projectRoot . '/public/uploads/gallery',
        $projectRoot . '/public/uploads/customs',
        $projectRoot . '/public/uploads/city',
        $projectRoot . '/public/uploads/resumes',
        $projectRoot . '/public/uploads/enquiries',
        $projectRoot . '/public/uploads/ai_visuals',
        $projectRoot . '/storage/framework/views',
        $projectRoot . '/storage/framework/cache',
        $projectRoot . '/storage/framework/sessions',
        $projectRoot . '/storage/logs'
    ];
    foreach ($uploadDirs as $dir) {
        if (!file_exists($dir)) {
            @mkdir($dir, 0775, true);
            $output[] = "[DIR] Created directory: " . str_replace($projectRoot . '/', '', $dir);
        }
    }

    $commands = [
        "Git Status Before Pull" => "git status -s",
        "Fetch Remote Updates" => "git fetch origin {$branch}",
        "Pull Latest Changes" => "git pull origin {$branch}",
        "Run DB Migrations" => "php artisan migrate --force",
        "Sync City Pages & Location Data" => "php -r \"require 'vendor/autoload.php'; \\\$app = require_once 'bootstrap/app.php'; \\\$app->make(Illuminate\\\\Contracts\\\\Console\\\\Kernel::class)->bootstrap(); if (\\\\Illuminate\\\\Support\\\\Facades\\\\Schema::hasTable('location_pages') && \\\\App\\\\Models\\\\LocationPage::count() === 0 && file_exists('scripts/migrate_old_website_data.php')) { require 'scripts/migrate_old_website_data.php'; echo 'Restored 61 city pages from migration script.'; } else { echo 'Location pages count: ' . (\\\\Illuminate\\\\Support\\\\Facades\\\\Schema::hasTable('location_pages') ? \\\\App\\\\Models\\\\LocationPage::count() : 0); }\"",
        "Regenerate XML Sitemap" => "php -r \"require 'vendor/autoload.php'; \\\$app = require_once 'bootstrap/app.php'; \\\$app->make(Illuminate\\\\Contracts\\\\Console\\\\Kernel::class)->bootstrap(); \\\$admin = new \\\\App\\\\Http\\\\Controllers\\\\AdminController(); \\\$admin->regenerateSitemap(Illuminate\\\\Http\\\\Request::create('/admin/seo/regenerate-sitemap', 'POST')); echo 'Sitemap XML refreshed with all city URLs.';\"",
        "Clear Optimize Cache" => "php artisan optimize:clear",
        "Clear Route Cache" => "php artisan route:clear",
        "Clear View Cache" => "php artisan view:clear",
        "Clear App Cache" => "php artisan cache:clear",
        "Clear Config Cache" => "php artisan config:clear",
        "Link Storage (if missing)" => "php artisan storage:link"
    ];

    foreach ($commands as $label => $cmd) {
        $output[] = "\n>>> Executing: {$label}";
        $output[] = "$ {$cmd}";
        
        $descriptors = [
            0 => ["pipe", "r"],
            1 => ["pipe", "w"],
            2 => ["pipe", "w"]
        ];

        $process = proc_open($cmd, $descriptors, $pipes, $projectRoot);
        if (is_resource($process)) {
            fclose($pipes[0]);
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            $returnCode = proc_close($process);

            if (!empty(trim($stdout))) {
                $output[] = trim($stdout);
            }
            if (!empty(trim($stderr))) {
                $output[] = "[STDERR] " . trim($stderr);
            }
            $output[] = ($returnCode === 0) ? "[STATUS: SUCCESS]" : "[STATUS: CODE {$returnCode}]";
        } else {
            $output[] = "[ERROR] Unable to execute command.";
        }
    }

    $output[] = "\n========================================================";
    $output[] = "  DEPLOYMENT COMPLETED AT " . date('Y-m-d H:i:s T');
    $output[] = "========================================================";

    return implode("\n", $output);
}

// If CLI execution
if ($isCli) {
    echo runDeployment($projectRoot, $branch) . "\n";
    exit(0);
}

// If Web Request
$log = null;
$autoTrigger = isset($_GET['auto']) || isset($_POST['deploy']);

if ($autoTrigger) {
    $log = runDeployment($projectRoot, $branch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stone Hub India - Deployment Console</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #0b0b0d;
            color: #e4e4e7;
            min-height: 100vh;
            padding: 2.5rem 1.5rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        .container {
            width: 100%;
            max-width: 960px;
            background: #141418;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            overflow: hidden;
        }
        .header {
            padding: 2rem 2.5rem;
            background: linear-gradient(135deg, #18181f 0%, #111114 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .header-title h1 {
            font-size: 1.65rem;
            color: #ffffff;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(197, 168, 128, 0.15);
            border: 1px solid rgba(197, 168, 128, 0.4);
            color: #C5A880;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .header-meta {
            font-size: 0.88rem;
            color: #a1a1aa;
            margin-top: 0.35rem;
        }
        .content {
            padding: 2.5rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            margin-bottom: 2rem;
            align-items: end;
        }
        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
        }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #d4d4d8;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        input[type="text"] {
            width: 100%;
            background: #09090b;
            border: 1px solid rgba(255,255,255,0.15);
            color: #ffffff;
            padding: 0.85rem 1.25rem;
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: 'JetBrains Mono', monospace;
            outline: none;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus {
            border-color: #C5A880;
        }
        .btn {
            background: #C5A880;
            color: #0b0b0d;
            border: none;
            padding: 0.85rem 2rem;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .btn:hover {
            background: #d6bc96;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(197, 168, 128, 0.2);
        }
        .console-wrap {
            background: #09090b;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            overflow: hidden;
        }
        .console-header {
            background: #111114;
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
        .dot-red { background: #ef4444; }
        .dot-yellow { background: #f59e0b; }
        .dot-green { background: #10b981; }
        .console-title {
            font-size: 0.8rem;
            color: #71717a;
            font-family: 'JetBrains Mono', monospace;
            margin-left: 6px;
        }
        pre.console {
            padding: 1.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.88rem;
            line-height: 1.65;
            color: #34d399;
            white-space: pre-wrap;
            word-break: break-all;
            max-height: 520px;
            overflow-y: auto;
        }
        .footer {
            padding: 1.25rem 2.5rem;
            background: #111114;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #71717a;
        }
        .footer a { color: #C5A880; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-title">
                <h1>Stone Hub India <span class="badge">Production Deployer</span></h1>
                <div class="header-meta">Kishangarh Production Server &bull; PHP <?php echo PHP_VERSION; ?></div>
            </div>
            <div>
                <a href="/" class="btn" style="background: rgba(255,255,255,0.08); color: #fff; border: 1px solid rgba(255,255,255,0.15);">View Website &rarr;</a>
            </div>
        </div>

        <div class="content">
            <form method="POST" action="deploy.php">
                <div class="form-grid">
                    <div>
                        <label for="branch">Target Git Branch</label>
                        <input type="text" id="branch" name="branch" value="<?php echo htmlspecialchars($branch); ?>" required>
                    </div>
                    <div>
                        <button type="submit" name="deploy" value="1" class="btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                            Execute Deploy Now
                        </button>
                    </div>
                </div>
            </form>

            <?php if ($log): ?>
                <div class="console-wrap">
                    <div class="console-header">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                        <span class="console-title">deployment-output.log &mdash; <?php echo date('H:i:s'); ?></span>
                    </div>
                    <pre class="console"><?php echo htmlspecialchars($log); ?></pre>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 3rem 1rem; color: #71717a; border: 1px dashed rgba(255,255,255,0.1); border-radius: 12px;">
                    <p style="font-size: 1rem; margin-bottom: 0.5rem; color: #a1a1aa;">Ready for deployment.</p>
                    <p style="font-size: 0.85rem;">Click <strong>"Execute Deploy Now"</strong> above to pull latest code from GitHub and clear caches.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="footer">
            <span>&copy; <?php echo date('Y'); ?> Stone Hub India. All rights reserved.</span>
            <span><a href="/admin">Admin Panel</a></span>
        </div>
    </div>
</body>
</html>
